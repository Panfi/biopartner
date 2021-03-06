<?php

namespace biopartnering\biopartnering\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use biopartnering\biopartnering\Models\User;
use biopartnering\biopartnering\Models\Message;
use biopartnering\biopartnering\Models\Notification;
use Auth;
use Response;
use Carbon;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function notifications()
    {
        return view('biopartnering::users.notifications.notifications');
    }

    public function view_notification($id)
    {
        $notification = Notification::find($id);
        $notification->is_read = true;
        $notification->save();

        return view('biopartnering::users.notifications.view', compact('notification'));
    }

    public function delete_notification($id)
    {
        $notification = Notification::find($id);
        $notification->delete();

        return redirect('user/notifications');
    }

    public function messages()
    {
        return view('biopartnering::users.messages.dashboard');
    }

    public function get_message_content($section)
    {
        $html = view("biopartnering::users.messages.$section")->render();

        return Response::json(['status' => true, 'content' => $html]);
    }

    public function send_message(Request $request)
    {
        $data = $request->get('data');
        $message_id = isset($data['message_id']) ? $data['message_id'] : null;
        $user_id = Auth::user()->id;
        
        $message = new Message();
        $message->sender_id = $user_id;
        $message->recipient_id = $data['recipient'];
        $message->message_id = $message_id;
        $message->subject = $data['subject'];
        $message->body = $data['message'];
        $message->created_at = Carbon\Carbon::now();
        $message->save();

        return Response::json(['status' => true]);
    }

    public function get_message_history($id)
    {
        $message = Message::find($id);
        $message = ($message->root) ? $message->root : $message;
        
        //Mark as read
        Message::where('recipient_id', Auth::user()->id)->where(function($q) use ($message) {
            $q->where('id', $message->id)->orWhere('message_id', $message->id);
        })->update(['is_read' => 1]);

        $html = view("biopartnering::users.messages.history", compact('message'))->render();
        
        return Response::json(['status' => true, 'content' => $html]);
    }
}
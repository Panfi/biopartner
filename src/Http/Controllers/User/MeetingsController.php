<?php

namespace biopartnering\biopartnering\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use biopartnering\biopartnering\Models\User;
use biopartnering\biopartnering\Models\Meeting;
use biopartnering\biopartnering\Models\MeetingInvites;
use \biopartnering\biopartnering\plugins\Mailer;
use Mail;
use Auth;
use Response;
use Carbon;
use Calendar;

class MeetingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function meetings()
    {
        $meetings = Meeting::where('organizer_id', Auth::user()->id)->paginate(10);

        return view('biopartnering::users.meetings.meetings', compact('meetings'));
    }

    public function add_meeting(Request $request)
    {
        if($request->isMethod('post'))
        {
            $meeting = new Meeting();
            $meeting->organizer_id = Auth::user()->id;
            $meeting->subject = $request->get('subject');
            $meeting->body = $request->get('body');
            $meeting->room_number = $request->get('room_number');
            $meeting->start_at = $request->get('start_date');
            $meeting->end_at = $request->get('end_date');
            $meeting->save();

            $invite = new MeetingInvites();
            $invite->meeting_id = $meeting->id;
            $invite->attendee_id = $request->get('recipient');
            $invite->created_at = Carbon\Carbon::now();
            $invite->save();

            $user = User::find($request->get('recipient'));
            $input = [
                'invite_id' => $invite->id, 
                'to' => $user->email, 
                'title' => $meeting->subject, 
                'start_at' => $meeting->start_at, 
                'end_at' => $meeting->end_at,
                'room_number' => $meeting->room_number
            ];

            $this->send_meeting_request_mail($input);

            return redirect('user/meetings');
        }

        return view('biopartnering::users.meetings.add');
    }

    public function edit_meeting(Request $request, $id)
    {
        if($request->isMethod('put'))
        {
            $meeting = Meeting::find($id);
            // $meeting->organizer_id = Auth::user()->id;
            $meeting->subject = $request->get('subject');
            $meeting->body = $request->get('body');
            $meeting->room_number = $request->get('room_number');
            $meeting->start_at = $request->get('start_date');
            $meeting->end_at = $request->get('end_date');
            $meeting->save();

            // $invite = new MeetingInvites();
            // $invite->meeting_id = $meeting->id;
            // $invite->attendee_id = $request->get('recipient');
            // $invite->created_at = Carbon\Carbon::now();
            // $invite->save();

            return redirect('user/meetings');
        }

        $meeting = Meeting::find($id);
        
        return view('biopartnering::users.meetings.edit', compact('meeting'));
    }

    public function delete_meeting($id)
    {
        $meeting = Meeting::find($id);
        
        MeetingInvites::where('meeting_id', $meeting->id)->delete();
        
        $meeting->delete();

        return redirect('user/meetings');
    }

    public function calender()
    {
        $meetings = Auth::user()->meetings;
        $invites = MeetingInvites::where('attendee_id', Auth::user()->id)->get();
        
        $events = [];

        if($meetings->count())
        {
            foreach($meetings as $meeting)
            {
                $events[] = Calendar::event(
                    $meeting->subject . " (Room " . $meeting->room_number . ")",
                    false,
                    $meeting->start_at,
                    $meeting->end_at,
                    null,
                    [
                        'color' => '#f05050',
                        'url' => url('user/meeting/edit', $meeting->id),
                    ]
                );
            }
        }

        if($invites->count())
        {
            foreach($invites as $invite)
            {
                $meeting = $invite->meeting;
                $events[] = Calendar::event(
                    $meeting->subject . " (Room " . $meeting->room_number . ")",
                    false,
                    $meeting->start_at,
                    $meeting->end_at,
                    null,
                    [
                        'color' => '#f05050',
                        'url' => '#'//url('user/meeting/edit', $meeting->id),
                    ]
                );
            }
        }

        $calendar = Calendar::addEvents($events);

        return view('biopartnering::users.meetings.calender', compact('calendar'));
    }

    private function send_meeting_request_mail($input)
    {
        $input['subject'] = "Meeting Request";
        $input['mail_template'] = 'biopartnering::emails.meeting_request';
        $input['organizer'] = Auth::user()->email;

        Mail::to($input['to'])->send(new Mailer($input));
    }

    public function confirm_meeting($id, $accept)
    {
        $invite = MeetingInvites::find($id);
        $invite->status = ($accept) ? "Accepted" : "Declined";
        $invite->save();

        return redirect('/user/meetings');
    }
}
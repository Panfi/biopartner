<?php

namespace biopartnering\biopartnering\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use biopartnering\biopartnering\Models\User;
use biopartnering\biopartnering\Models\Meeting;
use biopartnering\biopartnering\Models\MeetingInvites;
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
            $meeting->start_at = $request->get('start_date');
            $meeting->end_at = $request->get('end_date');
            $meeting->save();

            $invite = new MeetingInvites();
            $invite->meeting_id = $meeting->id;
            $invite->attendee_id = $request->get('recipient');
            $invite->created_at = Carbon\Carbon::now();
            $invite->save();

            return redirect('user/meetings');
        }

        return view('biopartnering::users.meetings.add');
    }

    public function edit_meeting(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            $meeting = Meeting::find($id);
            // $meeting->organizer_id = Auth::user()->id;
            $meeting->subject = $request->get('subject');
            $meeting->body = $request->get('body');
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

        return view('biopartnering::users.meetings.edit');
    }

    public function calender()
    {
        $invites = MeetingInvites::where('attendee_id', Auth::user()->id)->get();
        
        $events = [];

        if($invites->count())
        {
            foreach($invites as $invite)
            {
                $meeting = $invite->meeting;
                $events[] = Calendar::event(
                    $meeting->subject,
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

        $calendar = Calendar::addEvents($events);

        return view('biopartnering::users.meetings.calender', compact('calendar'));
    }
}
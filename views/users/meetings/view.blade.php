@extends('biopartnering::layouts.dashboard_layout')

@section('content')

@php
    $invites = $meeting->invites;
    $invite = $invites[0];
    $attendee = $invite->attendee;
    $email = $attendee->email;
    $details = ($attendee->details->count()) ? array_pluck($attendee->details, 'detail_value', 'detail_key') : [];
    $fname = isset($details['first_name']) ? $details['first_name'] : '';
    $lname = isset($details['last_name']) ? $details['last_name'] : '';
    $invited =  (empty($fname) || empty($lname)) ? explode('@', $email)[0] : "$fname $lname";

    $organizer = $meeting->organizer;
    $details = ($organizer->details->count()) ? array_pluck($organizer->details, 'detail_value', 'detail_key') : [];
    $fname = isset($details['first_name']) ? $details['first_name'] : '';
    $lname = isset($details['last_name']) ? $details['last_name'] : '';
    $organizer =  (empty($fname) || empty($lname)) ? explode('@', $organizer->email)[0] : "$fname $lname";
@endphp

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive m-b-40">
            <table class="table table-striped table-data2">
                <tbody>
                    <tr>
                        <td>Room Number</td>
                        <td>Room {!! $meeting->room_number !!}</td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td>{!! $meeting->subject !!}</td>
                    </tr>
                    <tr>
                        <td>Start At</td>
                        <td>{!! date('F d, Y H:i', strtotime($meeting->start_at)) !!}</td>
                    </tr>
                    <tr>
                        <td>End At</td>
                        <td>{!! date('F d, Y H:i', strtotime($meeting->start_at)) !!}</td>
                    </tr>
                    <tr>
                        <td>Organised By</td>
                        <td>{!! $organizer !!}</td>
                    </tr>
                    <tr>
                        <td>Invited</td>
                        <td>{!! $invited !!}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>{!! $invite->status !!}</td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>{!! nl2br($meeting->body) !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </dv>
</dv>

@endsection
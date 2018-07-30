@extends('biopartnering::layouts.dashboard_layout')

@section('content')

<div class="row">
    <div class="col-lg-12 mb-2">
        <a href="{!! url('user/meeting/add') !!}" class="btn btn-secondary float-right">
            <i class="fa fa-plus"></i> Add Meeting
        </a>
    </div>
    <div class="col-lg-12">
        <div class="table-responsive m-b-40">
            @if($meetings->count())
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Room Number</th>
                            <th>Start At</th>
                            <th>End At</th>
                            <th>Invited</th>
                            <th>Status</th>
                            <th width="24%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meetings as $meeting)
                        @php
                            $invites = $meeting->invites;
                            $invite = $invites[0];
                            $attendee = $invite->attendee;
                            $details = ($attendee->details->count()) ? array_pluck($attendee->details, 'detail_value', 'detail_key') : [];
                            $fname = isset($details['first_name']) ? $details['first_name'] : '';
                            $lname = isset($details['last_name']) ? $details['last_name'] : '';
                            
                            $email = $attendee->email;
                            $invited =  (empty($fname) || empty($lname)) ? explode('@', $email)[0] : "$fname $lname";
                        @endphp

                        <tr>
                            <td class="text-info pointer" title="{!! $meeting->body !!}" data-toggle="toolti">
                                {!! $meeting->subject !!}
                            </td>
                            <td>Room {!! $meeting->room_number !!}</td>
                            <td>{!! date('F d, Y H:i', strtotime($meeting->start_at)) !!}</td>
                            <td>{!! date('F d, Y H:i', strtotime($meeting->end_at)) !!}</td>
                            <td>{!! $invited !!}</td>
                            <td>{!! $invite->status !!}</td>
                            <td class="text-center">
                                <div class="row">
                                    @if($meeting->organizer_id == Auth::user()->id)
                                        <div class="col-md-4">
                                            <a href="{!! url('user/meeting/view', $meeting->id) !!}" class="text-success">
                                                <i class="fa fa-user"></i> View
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{!! url('user/meeting/edit', $meeting->id) !!}">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{!! url('user/meeting/delete', $meeting->id) !!}" class="text-danger">
                                                <i class="fa fa-remove"></i> Delete
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <a href="{!! url('user/meeting/view', $meeting->id) !!}" class="text-success">
                                                <i class="fa fa-user"></i> View
                                            </a>
                                        </div>                                    
                                    @endif
                                </div>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                {!! $meetings->links() !!}
            @else
                <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
                    You have not meeetings, please click <a href="{!! url('user/meeting/add') !!}">here</a> to add a new meeting!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush
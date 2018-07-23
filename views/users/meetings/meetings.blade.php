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
                            {{-- <th class="text-center">Active</th> --}}
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Created Date</th>
                            <th>Updated Date</th>
                            <th width="18%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meetings as $meeting)
                        <tr>
                            <td class="text-info pointer" title="{!! $meeting->body !!}" data-toggle="tooltip">
                                {!! $meeting->subject !!}
                            </td>
                            {{-- <td class="text-center {!! ($meeting->is_active) ? 'process' : 'denied' !!}">{!! ($meeting->is_active) ? "Yes" : "No" !!}</td> --}}
                            <td>{!! date('F d, Y H:i', strtotime($meeting->start_at)) !!}</td>
                            <td>{!! date('F d, Y H:i', strtotime($meeting->end_at)) !!}</td>
                            <td>{!! date('F d, Y H:i', strtotime($meeting->created_at)) !!}</td>
                            <td>{!! date('F d, Y H:i', strtotime($meeting->updated_at)) !!}</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{!! url('user/meeting/edit', $meeting->id) !!}">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <a href="{!! url('user/meeting/invite', $meeting->id) !!}" class="text-success">
                                            <i class="fa fa-user"></i> Invite
                                        </a>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <a href="{!! url('user/meeting/delete', $meeting->id) !!}" class="text-danger">
                                            <i class="fa fa-remove"></i> Delete
                                        </a>
                                    </div>
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
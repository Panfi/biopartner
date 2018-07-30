@extends('biopartnering::layouts.dashboard_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive m-b-40">
            <table class="table table-striped table-data2">
                <tbody>
                    <tr>
                        <td>Title</td>
                        <td>{!! $notification->title !!}</td>
                    </tr>
                    <tr>
                        <td>Created At</td>
                        <td>{!! date('F d, Y H:i', strtotime($notification->created_at)) !!}</td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>{!! nl2br($notification->description) !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </dv>
    <div class="col-lg-12">
        <a href="{!! url('user/notifications') !!}" class="btn btn-secondary">
            <i class="fa fa-list"></i> All notifications
        </a>
    </dv>
</dv>

@endsection
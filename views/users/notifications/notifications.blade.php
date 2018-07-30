@php($notifications = Notification::all())
@extends('biopartnering::layouts.dashboard_layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive m-b-40">

            <h3 class="title-5 m-b-35">Your Notifications</h3>
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="rs-select2--light rs-select2--md">
                        <select class="js-select2" name="property">
                            <option selected="selected" name="is_read" id="is_read">All Notifications</option>
                            <option value="1">Read</option>
                            <option value="0">Unread</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
            </div>

            <div class="table-responsive table-responsive-data2">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="40%">Title</th>
                            <th width="20%" class="text-center">Status</th>
                            <th width="20%">Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($notifications)
                            @foreach($notifications as $notification)
                                <tr class="tr-shadow">
                                    <td>
                                        <label class="au-checkbox">
                                            <input type="checkbox">
                                            <span class="au-checkmark"></span>
                                        </label>
                                    </td>
                                    <td title="{!! $notification->description !!}">
                                        <a href="{!! url('user/notification/view', $notification->id) !!}">{!! $notification->title !!}</a>
                                    </td>
                                    <td class="text-center {!! ($notification->is_read) ? 'text-success' : 'text-danger' !!}">{!! ($notification->is_read) ? "Read" : "Unread" !!}</td>
                                    <td>{!! date('F d, Y H:i', strtotime($notification->created_at)) !!}</td>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{!! url('user/notification/view', $notification->id) !!}" class="text-success">
                                                    <i class="fa fa-user"></i> View
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="{!! url('user/notification/delete', $notification->id) !!}" class="text-danger">
                                                    <i class="fa fa-remove"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
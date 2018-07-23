@php($notifications = Notification::UserAll())
@extends('biopartnering::layouts.dashboard_layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
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
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>
                                <label class="au-checkbox">
                                    <input type="checkbox">
                                    <span class="au-checkmark"></span>
                                </label>
                            </th>
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
                                <td title="{!! $notification->details->description !!}">
                                    <a href="">{!! $notification->details->title !!}</a>
                                </td>
                                <td class="text-center {!! ($notification->is_read) ? 'text-success' : 'text-danger' !!}">{!! ($notification->is_read) ? "Read" : "Unread" !!}</td>
                                <td>{!! $notification->created_at !!}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                            <i class="zmdi zmdi-mail-send"></i>
                                        </button>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-more"></i>
                                        </button>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
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
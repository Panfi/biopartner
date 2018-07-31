@extends('biopartnering::layouts.dashboard_layout')

@section('content')

    @php
        $meetings = Auth::user()->meetings;
        $invites = Auth::user()->invites;
    @endphp

    <div class="row m-t-25">
        <div class="col-sm-6 col-lg-6">
            <div class="overview-item overview-item--c1">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>
                        </div>
                        <div class="text">
                            <h2>{!! count(Msg::recipients()) + 1 !!}</h2>
                            <span>Total members</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        {{-- <canvas id="widgetChart1"></canvas> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c2">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                        <div class="text">
                            <h2>388,688</h2>
                            <span>items solid</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        <canvas id="widgetChart2"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-sm-6 col-lg-6">
            <div class="overview-item overview-item--c3">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-calendar-note"></i>
                        </div>
                        <div class="text">
                            <h2>{!! $meetings->count() + $invites->count() !!}</h2>
                            <span>meetings</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        {{-- <canvas id="widgetChart3"></canvas> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c4">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-money"></i>
                        </div>
                        <div class="text">
                            <h2>$1,060,386</h2>
                            <span>total earnings</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        <canvas id="widgetChart4"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                    <div class="bg-overlay bg-overlay--blue"></div>
                    <h3>
                        <i class="zmdi zmdi-account-calendar"></i>{!! date('F d, Y') !!}</h3>
                    <a class="au-btn-plus" href="{!! url('user/meeting/add') !!}">
                        <i class="zmdi zmdi-plus"></i>
                    </a>
                </div>
                <div class="au-task js-list-load">
                    <div class="au-task__title">
                        <p>Your meetings</p>
                    </div>
                    <div class="au-task-list js-scrollbar3">

                        @if($invites->count())
                            @foreach ($invites as $index=>$invite)
                                @if($index <= 6)
                                    @php
                                        $meeting = $invite->meeting;
                                    @endphp
                                    <div class="au-task__item au-task__item--success">
                                        <div class="au-task__item-inner">
                                            <h5 class="task">
                                                <a href="{!! url('user/meeting/view', $meeting->id) !!}">
                                                    {!! $meeting->subject !!}
                                                </a>
                                            </h5>
                                            <span class="time">
                                                <i>{!! date('F d, Y H:i', strtotime($meeting->start_at)) !!}</i>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="au-task__footer">
                        <a href="{!! url('user/meetings') !!}" class="au-btn au-btn-load js-load-btn">View more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            @php
                $all_messages = Msg::all();
                $unread_messages = Msg::unread();
                $total_unread_messages = $unread_messages->count();
            @endphp

            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                    <div class="bg-overlay bg-overlay--blue"></div>
                    <h3>
                        <i class="zmdi zmdi-comment-text"></i>New Messages</h3>
                            <a href="{!! url('user/messages') !!}" class="au-btn-plus">
                        <i class="zmdi zmdi-plus"></i>
                    </a>
                </div>
                <div class="au-inbox-wrap js-inbox-wrap">
                    <div class="au-message js-list-load">
                        <div class="au-message__noti">
                            <p>You Have
                                <span>{!! $total_unread_messages !!}</span>

                                new messages
                            </p>
                        </div>
                        <div class="au-message-list">
                            @if($total_unread_messages)
                                @foreach ($unread_messages as $message)
                                @php
                                    $sender = $message->sender;
                                    $details = ($sender->details->count()) ? array_pluck($sender->details, 'detail_value', 'detail_key') : [];
                                    $fname = isset($details['first_name']) ? $details['first_name'] : '';
                                    $lname = isset($details['last_name']) ? $details['last_name'] : '';
                                    $pname =  (empty($fname) || empty($lname)) ? explode('@', $sender->email)[0] : $fname;
                                @endphp
                                    <div class="au-message__item unread" onclick="get_message_history('{!! $message->id !!}')">
                                        <div class="au-message__item-inner">
                                            <div class="au-message__item-text">
                                                <div class="avatar-wrap">
                                                    <div class="avatar">
                                                        <img src="{!! asset('vendor/biopartnering/img/avatar.jpg') !!}" alt="Avatar">
                                                    </div>
                                                </div>
                                                <div class="text">
                                                    <a href="{!! url('user/messages') !!}">
                                                        <h5 class="name">{!! $pname !!}</h5>
                                                        <p>{!! substr($message->subject, 0, 100) !!}</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="au-message__item-time">
                                                <span><i>{!! date('F d, Y H:i', strtotime($message->created_at)) !!}</i></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="au-message__footer">
                            <a href="{!! url('user/messages') !!}" class="au-btn au-btn-load js-load-btn">View more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function()
        {
            //notify('info', 'Hello and welcome to biopartnering panel.');
        });
    </script>
@endpush

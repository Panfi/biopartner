@extends('biopartnering::layouts.dashboard_layout')

@section('content')

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
                        <canvas id="widgetChart1"></canvas>
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
                            <h2>1,086</h2>
                            <span>this week</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        <canvas id="widgetChart3"></canvas>
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
                    <button class="au-btn-plus">
                        <i class="zmdi zmdi-plus"></i>
                    </button>
                </div>
                <div class="au-task js-list-load">
                    <div class="au-task__title">
                        <p>Your meetings</p>
                    </div>
                    <div class="au-task-list js-scrollbar3">
                        @php
                            $meetings = Auth::user()->meetings;
                        @endphp

                        @if($meetings->count())
                            @foreach ($meetings as $meeting)
                                <div class="au-task__item au-task__item--success">
                                    <div class="au-task__item-inner">
                                        <h5 class="task">
                                            <a href="{!! url('user/meeting/edit', $meeting->id) !!}">
                                                {!! $meeting->subject !!}
                                            </a>
                                        </h5>
                                        <span class="time">
                                            <i>{!! date('F d, Y H:i', strtotime($meeting->start_at)) !!}</i>
                                        </span>
                                    </div>
                                </div>
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
            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                    <div class="bg-overlay bg-overlay--blue"></div>
                    <h3>
                        <i class="zmdi zmdi-comment-text"></i>New Messages</h3>
                    <button class="au-btn-plus">
                        <i class="zmdi zmdi-plus"></i>
                    </button>
                </div>
                <div class="au-inbox-wrap js-inbox-wrap">
                    <div class="au-message js-list-load">
                        <div class="au-message__noti">
                            <p>You Have
                                <span>0</span>

                                new messages
                            </p>
                        </div>
                        <div class="au-message-list">
                            {{-- <div class="au-message__item unread">
                                <div class="au-message__item-inner">
                                    <div class="au-message__item-text">
                                        <div class="avatar-wrap">
                                            <div class="avatar">
                                            <img src="{!! asset('vendor/biopartnering/img/avatar-06.jpg') !!}" alt="Avatar" />
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h5 class="name">John Smith</h5>
                                            <p>Have sent a photo</p>
                                        </div>
                                    </div>
                                    <div class="au-message__item-time">
                                        <span>12 Min ago</span>
                                    </div>
                                </div>
                            </div>
                            <div class="au-message__item unread">
                                <div class="au-message__item-inner">
                                    <div class="au-message__item-text">
                                        <div class="avatar-wrap online">
                                            <div class="avatar">
                                            <img src="{!! asset('vendor/biopartnering/img/avatar-06.jpg') !!}" alt="Avatar" />
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h5 class="name">Nicholas Martinez</h5>
                                            <p>You are now connected on message</p>
                                        </div>
                                    </div>
                                    <div class="au-message__item-time">
                                        <span>11:00 PM</span>
                                    </div>
                                </div>
                            </div>
                            <div class="au-message__item">
                                <div class="au-message__item-inner">
                                    <div class="au-message__item-text">
                                        <div class="avatar-wrap online">
                                            <div class="avatar">
                                            <img src="{!! asset('vendor/biopartnering/img/avatar-06.jpg') !!}" alt="Avatar" />
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h5 class="name">Michelle Sims</h5>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>
                                    <div class="au-message__item-time">
                                        <span>Yesterday</span>
                                    </div>
                                </div>
                            </div>
                            <div class="au-message__item">
                                <div class="au-message__item-inner">
                                    <div class="au-message__item-text">
                                        <div class="avatar-wrap">
                                            <div class="avatar">
                                            <img src="{!! asset('vendor/biopartnering/img/avatar-06.jpg') !!}" alt="Avatar" />
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h5 class="name">Michelle Sims</h5>
                                            <p>Purus feugiat finibus</p>
                                        </div>
                                    </div>
                                    <div class="au-message__item-time">
                                        <span>Sunday</span>
                                    </div>
                                </div>
                            </div>
                            <div class="au-message__item js-load-item">
                                <div class="au-message__item-inner">
                                    <div class="au-message__item-text">
                                        <div class="avatar-wrap online">
                                            <div class="avatar">
                                            <img src="{!! asset('vendor/biopartnering/img/avatar-06.jpg') !!}" alt="Avatar" />
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h5 class="name">Michelle Sims</h5>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>
                                    <div class="au-message__item-time">
                                        <span>Yesterday</span>
                                    </div>
                                </div>
                            </div>
                            <div class="au-message__item js-load-item">
                                <div class="au-message__item-inner">
                                    <div class="au-message__item-text">
                                        <div class="avatar-wrap">
                                            <div class="avatar">
                                            <img src="{!! asset('vendor/biopartnering/img/avatar-06.jpg') !!}" alt="Avatar" />
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h5 class="name">Michelle Sims</h5>
                                            <p>Purus feugiat finibus</p>
                                        </div>
                                    </div>
                                    <div class="au-message__item-time">
                                        <span>Sunday</span>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="au-message__footer">
                            <button class="au-btn au-btn-load js-load-btn">load more</button>
                        </div>
                    </div>
                    <div class="au-chat">
                        <div class="au-chat__title">
                            <div class="au-chat-info">
                                <div class="avatar-wrap online">
                                    <div class="avatar avatar--small">
                                    <img src="{!! asset('vendor/biopartnering/img/avatar-06.jpg') !!}" alt="Avatar" />
                                    </div>
                                </div>
                                <span class="nick">
                                    <a href="#">John Smith</a>
                                </span>
                            </div>
                        </div>
                        <div class="au-chat__content">
                            <div class="recei-mess-wrap">
                                <span class="mess-time">12 Min ago</span>
                                <div class="recei-mess__inner">
                                    <div class="avatar avatar--tiny">
                                    <img src="{!! asset('vendor/biopartnering/img/avatar-06.jpg') !!}" alt="Avatar" />
                                    </div>
                                    <div class="recei-mess-list">
                                        <div class="recei-mess">Lorem ipsum dolor sit amet, consectetur adipiscing elit non iaculis</div>
                                        <div class="recei-mess">Donec tempor, sapien ac viverra</div>
                                    </div>
                                </div>
                            </div>
                            <div class="send-mess-wrap">
                                <span class="mess-time">30 Sec ago</span>
                                <div class="send-mess__inner">
                                    <div class="send-mess-list">
                                        <div class="send-mess">Lorem ipsum dolor sit amet, consectetur adipiscing elit non iaculis</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="au-chat-textfield">
                            <form class="au-form-icon">
                                <input class="au-input au-input--full au-input--h65" type="text" placeholder="Type a message">
                                <button class="au-input-icon">
                                    <i class="zmdi zmdi-camera"></i>
                                </button>
                            </form>
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

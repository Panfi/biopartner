 @php
    $user = Auth::user();
    $user_email = $user->email;
    $details = ($user->details->count()) ? array_pluck($user->details, 'detail_value', 'detail_key') : [];
    $fname = isset($details['first_name']) ? $details['first_name'] : '';
    $profile_name =  (empty($fname)) ? explode('@', $user_email)[0] : $fname;

    $unread_notifications = Notification::unread();
    $total_unread_notifications = $unread_notifications->count();

    $unread_messages = Msg::unread();
    $total_unread_messages = $unread_messages->count();
 @endphp

 <!-- HEADER DESKTOP-->
 <header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <form class="form-header" action="#" method="POST">
                    <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; meetings . . ." />
                    <button class="au-btn--submit disabled" type="button">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </form>
                <div class="header-button">
                    <div class="noti-wrap">
                        <!-- This will be associated with the Conversation table, more like an online chat -->
                        <!-- <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-comment-more"></i>
                            <span class="quantity">1</span>
                            <div class="mess-dropdown js-dropdown">
                                <div class="mess__title">
                                    <p>You have 2 news message</p>
                                </div>
                                <div class="mess__ite{!! url('user/messages') !!}m">
                                    <div class="image img-cir img-40">
                                        <img src="{!! asset('vendor/biopartnering/img/avatar-06.jpg') !!}" alt="Avatar" />
                                    </div>
                                    <div class="content">
                                        <h6>Michelle Moreno</h6>
                                        <p>Have sent a photo</p>
                                        <span class="time">3 min ago</span>
                                    </div>
                                </div>
                                <div class="mess__item">
                                    <div class="image img-cir img-40">
                                        <img src="{!! asset('vendor/biopartnering/img/avatar-04.jpg') !!}" alt="Avatar" />
                                    </div>
                                    <div class="content">
                                        <h6>Diane Myers</h6>
                                        <p>You are now connected on message</p>
                                        <span class="time">Yesterday</span>
                                    </div>
                                </div>
                                <div class="mess__footer">
                                    <a href="#">View all messages</a>
                                </div>
                            </div>
                        </div> -->

                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-email"></i>
                            <span class="quantity">{!! $total_unread_messages !!}</span>
                            <div class="email-dropdown js-dropdown">
                                <div class="email__title">
                                    <p>You have {!! $total_unread_messages !!} New Messages</p>
                                </div>
                                @if($total_unread_messages)
                                    @foreach($unread_messages as $index=>$message)
                                        @if($index <= 5)
                                            @php
                                                $sender = $message->sender;
                                                $details = ($sender->details->count()) ? array_pluck($sender->details, 'detail_value', 'detail_key') : [];
                                                $fname = isset($details['first_name']) ? $details['first_name'] : '';
                                                $lname = isset($details['last_name']) ? $details['last_name'] : '';
                                                $pname =  (empty($fname) || empty($lname)) ? explode('@', $sender->email)[0] : $fname;
                                            @endphp

                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="{!! asset('vendor/biopartnering/img/avatar.jpg') !!}" alt="Avatar" />
                                                </div>
                                                <div class="content">
                                                    <p>{!! substr($message->subject, 0, 33) !!}</p>
                                                    <span>{!! $pname !!}, {!! date('F d, Y H:i', strtotime($message->created_at)) !!}</span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                                <div class="email__footer">
                                    <a href="{!! url('user/messages') !!}">See all messages</a>
                                </div>
                            </div>
                        </div>
                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <span class="quantity">{!! $total_unread_notifications !!}</span>
                            <div class="notifi-dropdown js-dropdown">
                                <div class="notifi__title">
                                    <p>You have {!! $total_unread_notifications !!} Notifications</p>
                                </div>
                                @if($total_unread_notifications)
                                    @foreach($unread_notifications as $index=>$notification)
                                        @if($index <= 5)
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <a href="{!! url('user/notification/view', $notification->id) !!}">
                                                        <p>{!! substr($notification->title, 0, 33) !!}</p>
                                                        <span class="date">
                                                            {!! date('F d, Y H:i', strtotime($notification->created_at)) !!}
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="notifi__footer">
                                    <a href="{!! url('user/notifications') !!}">All notifications</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                            <img src="{!! asset('vendor/biopartnering/img/avatar.jpg') !!}" alt="Avatar" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="{!! url('/user/account') !!}">{!! $profile_name !!}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="{!! url('/user/account') !!}">
                                        <img src="{!! asset('vendor/biopartnering/img/avatar.jpg') !!}" alt="Avatar" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="{!! url('/user/account') !!}">{!! $profile_name !!}</a>
                                        </h5>
                                        <span class="email">{!! $user_email !!}</a></span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="{!! url('/user/account') !!}">
                                            <i class="zmdi zmdi-account"></i>Account</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="{!! url('/user/settings') !!}">
                                            <i class="zmdi zmdi-settings"></i>Setting
                                        </a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    {!! Form::open(['url' => url('logout'), 'id' => 'logout-form']) !!}
                                    {!! Html::tag('a', Html::tag('i', '', ['class' => 'zmdi zmdi-power']).' Logout', ['href' => '#', 'onclick' => "$('#logout-form').submit()"]) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER DESKTOP-->
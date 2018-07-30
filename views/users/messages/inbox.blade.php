@php
    $all_messages = Msg::all();
    $unread_messages = Msg::unread();
    $total_unread_messages = $unread_messages->count();
@endphp

<div class="tab-pane fade show active" id="inbox">
    <div class="card no-top-border">
        <div class="card-body mt-4">
            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                <div class="au-card-title">
                    <div class="bg-overlay bg-overlay--blue"></div>
                    <h3>
                        <i class="zmdi zmdi-comment-text"></i>Messages</h3>
                    <button class="au-btn-plus" onclick="get_message_content('compose')">
                        <i class="zmdi zmdi-plus"></i>
                    </button>
                </div>
                <div class="au-inbox-wrap js-inbox-wrap">
                    <div class="au-message js-list-load">
                        <div class="au-message__noti">
                            <p>
                                You Have
                                <span>{!! $total_unread_messages !!}</span>
                                new messages
                            </p>
                        </div>
                        <div class="au-message-list">
                            
                            @if($all_messages->count())
                                @foreach($all_messages as $message)
                                    @php
                                        $sender = $message->sender;
                                        $details = ($sender->details->count()) ? array_pluck($sender->details, 'detail_value', 'detail_key') : [];
                                        $fname = isset($details['first_name']) ? $details['first_name'] : '';
                                        $lname = isset($details['last_name']) ? $details['last_name'] : '';
                                        $pname =  (empty($fname) || empty($lname)) ? explode('@', $sender->email)[0] : $fname;
                                        
                                        $class = ($message->is_read) ? '' : 'unread';
                                    @endphp
                                    
                                    <div class="au-message__item {!! $class !!}" onclick="get_message_history('{!! $message->id !!}')">
                                        <div class="au-message__item-inner">
                                            <div class="au-message__item-text">
                                                <div class="avatar-wrap">
                                                    <div class="avatar">
                                                        <img src="{!! asset('vendor/biopartnering/img/avatar.jpg') !!}" alt="Avatar">
                                                    </div>
                                                </div>
                                                <div class="text">
                                                    <h5 class="name">{!! $pname !!}</h5>
                                                    <p>{!! substr($message->subject, 0, 100) !!}</p>
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
                        {{-- <div class="au-message__footer">
                            <button class="au-btn au-btn-load js-load-btn">load more</button>
                        </div> --}}
                    </div>

                    <div class="au-chat">
                        
                    </div>
                </div>
            </div
        </div>
    </div>
</div>
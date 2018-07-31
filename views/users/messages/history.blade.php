@php
    $message_id = $message->id;
    $subject = $message->subject;
    $sender_id = $message->sender->id;
    $temp_sender_id = ($message->sender->id == Auth::user()->id) ? $message->recipient->id : $message->sender->id;

    $sender = $message->sender;
    $details = ($sender->details->count()) ? array_pluck($sender->details, 'detail_value', 'detail_key') : [];
    $fname = isset($details['first_name']) ? $details['first_name'] : '';
    $lname = isset($details['last_name']) ? $details['last_name'] : '';
    $profile_name =  (empty($fname) || empty($lname)) ? explode('@', $sender->email)[0] : $fname;
@endphp

<div class="au-chat__title">
    <div class="au-chat-info">
        <div class="avatar-wrap">
            <div class="avatar avatar--small">
                <img src="{!! asset('vendor/biopartnering/img/avatar.jpg') !!}" alt="Avatar">
            </div>
        </div>
        <span class="nick">
            <a>{!! $profile_name !!}</a>
        </span>
    </div>
</div>
<div class="au-chat__content">
    
    @if($sender_id == Auth::user()->id)
        <div class="send-mess-wrap">
            <span class="mess-time">{!! date('F d, Y H:i', strtotime($message->created_at)) !!}</span>
            <div class="send-mess__inner">
                <div class="send-mess-list">
                    <div class="send-mess">{!! $message->body !!}</div>
                </div>
            </div>
        </div>
    @else
        <div class="recei-mess-wrap">
            <span class="mess-time">{!! date('F d, Y H:i', strtotime($message->created_at)) !!}</span>
            <div class="recei-mess__inner">
                <div class="avatar avatar--tiny">
                    <img src="{!! asset('vendor/biopartnering/img/avatar.jpg') !!}" alt="Avatar">
                </div>
                <div class="recei-mess-list">
                    <div class="recei-mess">{!! $message->body !!}</div>
                </div>
            </div>
        </div>
    @endif

    @if($message->replies->count())
        @foreach($message->replies as $reply)

        @php($sid = $reply->sender->id)
        @if($sid == Auth::user()->id)
            <div class="send-mess-wrap">
                <span class="mess-time">{!! date('F d, Y H:i', strtotime($reply->created_at)) !!}</span>
                <div class="send-mess__inner">
                    <div class="send-mess-list">
                        <div class="send-mess">{!! $reply->body !!}</div>
                    </div>
                </div>
            </div>
        @else
            <div class="recei-mess-wrap">
                <span class="mess-time">{!! date('F d, Y H:i', strtotime($reply->created_at)) !!}</span>
                <div class="recei-mess__inner">
                    <div class="avatar avatar--tiny">
                        <img src="{!! asset('vendor/biopartnering/img/avatar.jpg') !!}" alt="Avatar">
                    </div>
                    <div class="recei-mess-list">
                        <div class="recei-mess">{!! $reply->body !!}</div>
                    </div>
                </div>
            </div>
        @endif

        @endforeach
    @endif
</div>
<div class="au-chat-textfield">
    <form class="au-form-icon" id="reply-form">
        <input class="au-input au-input--full au-input--h65" type="text" id="message" name="message" placeholder="Type a message">
        <button type="button" class="au-input-icon" onclick="send_reply_message('{!! $temp_sender_id !!}', '{!! $message_id !!}', '{!! $subject !!}')">
            <i class="zmdi zmdi-camera"></i>
        </button>
    </form>
</div>

<script type="text/javascript">
    $("form#reply-form").validate({
        onkeyup: false,
        rules: {
            message: { required: true},
        },
        tooltip_options: {
            message: { placement: 'top' },
        }
    });
</script>
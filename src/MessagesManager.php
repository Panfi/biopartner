<?php

namespace biopartnering\biopartnering;

use \biopartnering\biopartnering\Models\Message;
use \biopartnering\biopartnering\Models\User;
use Auth;
use Carbon;

class MessagesManager
{
    public function all()
    {
        return Message::whereNull('message_id')->where(function($q) {
            $q->where('recipient_id', Auth::user()->id)->orWhere('sender_id', Auth::user()->id);
        })->orderBy('created_at', 'desc')->get();
    }

    public function unread()
    {
        return Message::where('recipient_id', Auth::user()->id)->where('is_read', 0)->get();
    }

    public function recipients()
    {
        return User::where('id', '!=', Auth::user()->id)->where('role_id', 2)->where('verified', 1)->get();
    }
}
?>
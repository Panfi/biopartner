<?php

namespace biopartnering\biopartnering;

use \biopartnering\biopartnering\Models\Message;
use \biopartnering\biopartnering\Models\User;
use Auth;
use Carbon;

class MessagesManager
{
    public function UserAll()
    {
        return Message::where('recipient_id', Auth::user()->id)->where('is_root', 1)->get();
        /*return Message::where('is_root', 1)->where(function($q) {
            $q->where('recipient_id', Auth::user()->id)->orWhere('sender_id', Auth::user()->id);
        })->get();*/
    }

    public function UserUnread()
    {
        // return Message::where('recipient_id', Auth::user()->id)->where('is_root', 1)->where('is_read', 0)->get();
        return Message::where('is_read', 0)->where(function($q) {
            $q->where('recipient_id', Auth::user()->id);
        })->groupBy('message_id');
    }

    public function recipients()
    {
        return User::where('id', '!=', Auth::user()->id)->where('role_id', 2)->where('verified', 1)->get();
    }
}
?>
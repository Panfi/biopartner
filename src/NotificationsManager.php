<?php

namespace biopartnering\biopartnering;

use \biopartnering\biopartnering\Models\Notification;
use Auth;
use Carbon;

class NotificationsManager
{
    public function all()
    {
        return Notification::where('user_id', Auth::user()->id)->get();
    }

    public function unread()
    {
        return Notification::where('user_id', Auth::user()->id)->where('is_read', 0)->get();
    }

    public function create($data)
    {
        return Notification::create($data);
    }
}

?>
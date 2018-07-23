<?php

namespace biopartnering\biopartnering;

use \biopartnering\biopartnering\Models\UserNotifications;
use Auth;
use Carbon;

class NotificationsManager
{
    public function UserAll()
    {
        return UserNotifications::where('user_id', Auth::user()->id)->get();
    }

    public function UserUnread()
    {
        return UserNotifications::where('user_id', Auth::user()->id)->where('is_read', 0)->get();
    }
}

?>
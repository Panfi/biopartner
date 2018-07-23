<?php

namespace biopartnering\biopartnering\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \biopartnering\biopartnering\NotificationsManager
 */
class Notification extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'notification';
    }
}

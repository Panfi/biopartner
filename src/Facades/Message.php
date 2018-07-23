<?php

namespace biopartnering\biopartnering\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \biopartnering\biopartnering\MessagesManager
 */
class Message extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'message';
    }
}

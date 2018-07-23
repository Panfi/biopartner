<?php

namespace biopartnering\biopartnering\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * @package App
 */
class Notification extends Model
{
    /**
     * @var string
     */
    protected $table = "notifications";

    /**
     * @var array
     */
    protected $fillable = ['id', 'title', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_notifications()
    {
        return $this->hasMany(UserNotifications::class);
    }
}
<?php

namespace biopartnering\biopartnering\Models;

use Illuminate\Database\Eloquent\Model;
use biopartnering\biopartnering\Models\User;

/**
 * Class UserNotifications
 * @package App
 */
class UserNotifications extends Model
{
    /**
     * @var string
     */
    protected $table = "user_notifications";

    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'notification_id', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function details()
    {
        return $this->belongsTo(Notification::class, 'notification_id');
    }
}
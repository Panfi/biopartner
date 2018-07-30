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
    protected $fillable = ['id', 'user_id', 'meeting_id', 'title', 'description', 'is_read'];
}
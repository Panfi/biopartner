<?php

namespace biopartnering\biopartnering\Models;

use Illuminate\Database\Eloquent\Model;
use biopartnering\biopartnering\Models\User;

/**
 * Class Availability
 * @package App
 */
class Availability extends Model
{
    /**
     * @var string
     */
    protected $table = "availability";

    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'check_date', 'from_time', 'to_time', 'status'];
}

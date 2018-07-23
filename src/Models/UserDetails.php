<?php

namespace biopartnering\biopartnering\Models;

use Illuminate\Database\Eloquent\Model;
use biopartnering\biopartnering\Models\User;

/**
 * Class UserDetails
 * @package App
 */
class UserDetails extends Model
{
    /**
     * @var string
     */
    protected $table = "user_details";

    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'detail_key', 'detail_value'];
}

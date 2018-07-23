<?php

namespace biopartnering\biopartnering\Models;

use Illuminate\Database\Eloquent\Model;
use biopartnering\biopartnering\Models\User;

/**
 * Class VerifyUser
 * @package App
 */
class VerifyUser extends Model
{
    /**
     * @var string
     */
    protected $table = "verify_users";

    /**
     * @var array
     */
    protected $fillable = ["user_id", "token", "email"];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

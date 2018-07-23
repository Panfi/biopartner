<?php

namespace biopartnering\biopartnering\Models;

use Illuminate\Database\Eloquent\Model;
use biopartnering\biopartnering\Models\User;

/**
 * Class Role
 * @package App
 */
class Role extends Model
{
    /**
     * @var string
     */
    protected $table = "roles";

    /**
     * @var array
     */
    protected $fillable = ['id', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

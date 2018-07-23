<?php

namespace biopartnering\biopartnering\Models;

use Illuminate\Database\Eloquent\Model;
use biopartnering\biopartnering\Models\User;

/**
 * Class MeetingInvites
 * @package App
 */
class MeetingInvites extends Model
{
    /**
     * @var string
     */
    protected $table = "meeting_invites";

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $timestamps = false;

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}

<?php

namespace biopartnering\biopartnering\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @package App
 */
class Message extends Model
{
    /**
     * @var string
     */
    protected $table = "messages";

    /**
     * @var array
     */
    protected $fillable = ['id', 'sender_id', 'recipient_id', 'message_id', 'subject', 'body', 'is_root', 'is_read', 'is_deleted', 'created_at'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function root()
    {
        return $this->belongsTo($this, 'message_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function replies()
    {
        return $this->hasMany($this, 'message_id');
    }
}
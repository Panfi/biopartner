<?php

namespace biopartnering\biopartnering\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use biopartnering\biopartnering\Models\Role;
use biopartnering\biopartnering\Models\VerifyUser;
use biopartnering\biopartnering\Models\UserDetails;
use \biopartnering\biopartnering\plugins\Mailer;
use Mail;
use Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'email', 'password',
    ];

     /**
     * Automatically creates hash for the user password.
     *
     * @param  string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function details()
    {
        return $this->hasMany(UserDetails::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function meetings()
    {
        return $this->hasMany(Meeting::class, 'organizer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function invites()
    {
        return $this->hasMany(MeetingInvites::class, 'attendee_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function notifications()
    {
        return $this->hasMany(UserNotifications::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function availability()
    {
        return $this->hasMany(Availability::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function verifyUser()
    {
        return $this->hasOne(VerifyUser::class);
    }

     /**
     *  * Send a password reset email to the user
     *  
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        //$this->notify(new MailResetPasswordToken($token));
       
        $input['token'] = $token;
        $input['subject'] = "User Verificaion";
        $input['mail_template'] = 'biopartnering::emails.reset_password';

        Mail::to($this->email)->send(new Mailer($input));
    }
}

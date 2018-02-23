<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'username',
        'picture',
        'email',
        'contact',
        'reset',
        'password',
        'is_verified',
    ];

    protected $hidden = [
        'reset',
        'password',
        'remember_token',
    ];

    public function company()
    {
        return $this->hasMany('App\Company');
    }

    public function timesheets()
    {
        return $this->hasMany('App\Timesheet');
    }

    public function student()
    {
        return $this->hasOne('App\Student');
    }
}

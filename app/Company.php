<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'picture',
        'contact',
        'address',
        'email',
        'lng',
        'lat',
    ];

    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

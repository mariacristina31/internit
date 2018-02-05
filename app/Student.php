<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'section_id',
        'address',
        'sex',
        'birthdate',
        'guardian_name',
        'guardian_contact',
        'remaining_time',
    ];

    public function requirements()
    {
        return $this->belongsToMany('App\Requirement')->withPivot('attachment')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}

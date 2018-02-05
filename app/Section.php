<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'name',
        'school_year',
    ];

    public function students()
    {
        return $this->hasMany('App\Student');
    }
}

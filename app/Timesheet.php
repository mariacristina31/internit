<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $fillable = [
        'user_id',
        'time_in',
        'time_out',
        'task',
        'duration',
        'is_checked',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $table = 'timelines';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    

    public function getHorarioAttribute()
    {
        $date = Carbon::parse($this->created_at);
        return $date->diffForHumans();
    }
}

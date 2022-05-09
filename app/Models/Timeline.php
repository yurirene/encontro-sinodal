<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $table = 'timelines';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnibusConfirmado extends Model
{
    protected $table = 'onibus_confirmados';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}

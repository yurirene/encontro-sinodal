<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camisa extends Model
{

    protected $table ='camisas';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public const ABERTO = 0;
    public const CONFIRMADO = 1;

    public const LABELS = [
        self::ABERTO => [
            'label' => 'danger',
            'text' => 'Em Aberto'
        ],
        self::CONFIRMADO => [
            'label' => 'success',
            'text' => 'Confirmado'
        ]
    ];
    
    public function getStatusFormatadoAttribute()
    {
        return self::LABELS[$this->status]['text'];
    }
    
    public function getCriadoEmAttribute()
    {
        return Carbon::createFromDate($this->created_at)->format('d/m/y H:i:s');
    }
}

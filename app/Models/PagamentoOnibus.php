<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagamentoOnibus extends Model
{
    protected $table = 'pagamento_onibus';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public const ABERTO = 0;
    public const PAGO = 1;

    public const LABELS = [
        self::ABERTO => [
            'label' => 'danger',
            'text' => 'Em Aberto'
        ],
        self::PAGO => [
            'label' => 'success',
            'text' => 'Pago'
        ],
    ];

    public function getStatusFormatadoAttribute()
    {
        return '<span class="badge badge-'. self::LABELS[$this->status]['label'] .'">'. self::LABELS[$this->status]['text'] .'</span>';
    }

    public function getCriadoEmAttribute()
    {
        return Carbon::createFromDate($this->created_at)->format('d/m/y');
    }
    public function inscricao()
    {
        return $this->belongsTo(Inscricao::class);
    }
}

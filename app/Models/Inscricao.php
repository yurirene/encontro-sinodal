<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    protected $table = 'inscricoes';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public const ABERTO = 0;
    public const PAGAMENTO_INCOMPLETO = 1;
    public const PAGAMENTO_COMPLETO = 2;

    public const LABELS = [
        self::ABERTO => [
            'label' => 'danger',
            'text' => 'Em Aberto'
        ],
        self::PAGAMENTO_INCOMPLETO => [
            'label' => 'warning',
            'text' => 'Pagamento Incompleto'
        ],
        self::PAGAMENTO_COMPLETO => [
            'label' => 'success',
            'text' => 'Confirmado'
        ]
    ];

    public function getPrimeiroNomeAttribute()
    {
        $nome = explode(' ', $this->nome);
        return $nome[0];
    }

    public function getStatusInscricaoAttribute()
    {
        return self::LABELS[$this->status]['text'];
    }

    public function getTotalPagoAttribute()
    {
        $pagamentos = $this->pagamentos()->where('status', 1)->get();
        $total = 0;
        foreach ($pagamentos as $pagamento) {
            $total += floatval($pagamento->valor);
        }
        return $total;
    }

    public function getTotalPagoOnibusAttribute()
    {
        $pagamentos = $this->pagamentoOnibus()->where('status', 1)->get();
        $total = 0;
        foreach ($pagamentos as $pagamento) {
            $total += floatval($pagamento->valor);
        }
        return $total;
    }

    public function getCriadoEmAttribute()
    {
        return Carbon::createFromDate($this->created_at)->format('d/m/y H:i:s');
    }

    public function timeline()
    {
        return $this->hasMany(Timeline::class);
    }

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class);
    }

    public function pagamentoOnibus()
    {
        return $this->hasMany(PagamentoOnibus::class);
    }
}

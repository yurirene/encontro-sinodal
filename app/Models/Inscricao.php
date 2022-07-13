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

    public function getMsgAttribute()
    {
        $telefone = str_replace(['(', ')', ' ', '-', '.'], '', $this->celular);
        return "https://web.whatsapp.com/send?phone=55" . $telefone . "&text=O%20Encontro%20Sinodal%20est%C3%A1%20chegando%20e%20n%C3%A3o%20queremos%20que%20voc%C3%AA%20fique%20de%20fora!%20Fique%20atento%20ao%20prazo%20de%20pagamento%20da%20inscri%C3%A7%C3%A3o%20(31%2F07%2F2022%20)%20.%20--%20%20CHAVE%20PIX%3A%206.240.558%2F0001-45%20%20%20--";
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

    public function confirmacaoOnibus()
    {
        return $this->hasOne(OnibusConfirmado::class, 'inscrito_id');
    }
}

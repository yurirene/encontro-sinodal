<?php

namespace App\Mail;

use App\Models\Inscricao;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class COLEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $inscricao;
    public $mensagem;

    public function __construct(Inscricao $inscricao, string $mensagem)
    {
        $this->inscricao = $inscricao;
        $this->mensagem = $mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->view('email.template')
            ->with([
                'inscricao' => $this->inscricao,
                'mensagem' => $this->mensagem
            ]);
    }
}

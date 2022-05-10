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
    public $assunto;

    public function __construct(Inscricao $inscricao, string $mensagem, string $assunto)
    {
        $this->inscricao = $inscricao;
        $this->mensagem = $mensagem;
        $this->assunto = $assunto;
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
            ->subject($this->assunto)
            ->with([
                'inscricao' => $this->inscricao,
                'mensagem' => $this->mensagem
            ]);
    }
}

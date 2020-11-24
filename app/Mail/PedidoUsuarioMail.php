<?php

namespace App\Mail;

use App\Models\Usuario;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PedidoUsuarioMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from(config('mail.from.address'), config('mail.from.name'))
        ->view('emails.bienvenidaUsuario')
        ->with([
            'usuario' => $this->usuario,
            ])
        ->subject(config('app.name').' - ¡Te damos la bienvenida!');
    }
}

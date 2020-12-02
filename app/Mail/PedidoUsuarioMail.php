<?php

namespace App\Mail;

use App\Models\Usuario;
use App\Models\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PedidoUsuarioMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $usuario;
    protected $pedido;

    /**
     * Create a new message instance.
     *
     * 
     */
    public function __construct(Usuario $usuario,Pedido $pedido)
    {
        $this->usuario = $usuario;
        $this->pedido = $pedido;
        
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
        ->view('emails.correoPedidos')
        ->with([
            'usuario' => $this->usuario,
            'pedido' => $this->pedido,
            ])
        ->subject(config('app.name').' - ¡Te damos la bienvenida!');
    }
}

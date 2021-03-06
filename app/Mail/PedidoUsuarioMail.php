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
    protected $tipo;

    /**
     * Create a new message instance.
     *
     * 
     */
    public function __construct(Usuario $usuario,Pedido $pedido, $tipo)
    {
        $this->usuario = $usuario;
        $this->pedido = $pedido;
        $this->tipo = $tipo;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $tipoTitulo = 'Se ha registrado un pedido';
        if($this->tipo == 'admin'){
            $tipoTitulo = 'Tu pedido ha sido registrado!';
        }
        return $this
        ->from(config('mail.from.address'), config('mail.from.name'))
        ->view('emails.correoPedidos')
        ->with([
            'usuario' => $this->usuario,
            'pedido' => $this->pedido,
            ])
        ->subject(config('app.name').$tipoTitulo);
    }
}

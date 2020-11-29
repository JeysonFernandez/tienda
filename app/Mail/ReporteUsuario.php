<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReporteUsuario extends Mailable
{
    use Queueable, SerializesModels;
    public $correo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo)
    {
            $this->correo=$correo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->correo['tipo']=='pedido'){
            return $this->view('emails.enviarPedido');
        }elseif($this->correo['tipo']=='compra'){
            return $this->view('emails.enviarCompra');
        }else{
            return $this->view('emails.enviarPago');
        }
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReporteAdmin extends Mailable
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
            return $this->view('emailsAdmin.enviarPedido');
        }elseif($this->correo['tipo']=='compra'){
            return $this->view('emailsAdmin.enviarCompra');
        }elseif($this->correo['tipo']=='pago'){
            return $this->view('emailsAdmin.enviarPago');
        }elseif($this->correo['tipo']=='usuario_critico'){
            return $this->view('emailsAdmin.usuarioCritico');
        }elseif($this->correo['tipo']=='producto_critico'){
            return $this->view('emailsAdmin.productoCritico');
        }elseif($this->correo['tipo']=='sinStock'){
            return $this->view('emailsAdmin.sinStock');
        }else{
            return $this->view('emailsAdmin.reyVentas');
        }
    }
}

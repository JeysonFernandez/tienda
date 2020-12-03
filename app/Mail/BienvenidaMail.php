<?php

namespace App\Mail;

use App\Models\Usuario;
use App\Models\Compra;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BienvenidaMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $usuario;
    /**
     * Create a new message instance.
     *
     * 
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
        ->view('emails.bienvenida')
        ->with([
            'usuario' => $this->usuario
            ])
        ->subject(config('app.name').'La Tiendita de Pilar te da la bienvenida');
    }
}

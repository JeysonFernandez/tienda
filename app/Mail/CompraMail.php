<?php

namespace App\Mail;

use App\Models\Usuario;
use App\Models\Compra;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompraMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $usuario;
    protected $compra;
    protected $tipo;
    /**
     * Create a new message instance.
     *
     * 
     */
    public function __construct(Usuario $usuario,Compra $compra, $tipo)
    {
        $this->usuario = $usuario;
        $this->compra = $compra;
        $this->tipo = $tipo;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $tipoTitulo = 'Se ha registrado una compra';
        if($this->tipo == 'admin'){
            $tipoTitulo = 'Tu compra ha sido registrada!';
        }
        return $this
        ->from(config('mail.from.address'), config('mail.from.name'))
        ->view('emails.correoCompras')
        ->with([
            'usuario' => $this->usuario,
            'compra' => $this->compra,
            ])
        ->subject(config('app.name').$tipoTitulo);
    }
}

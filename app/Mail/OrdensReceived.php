<?php

namespace App\Mail;

use App\Models\Orden;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrdensReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $orden;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Orden $orden)
    {
        $this->orden = $orden;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('ordens.pdf',compact('orden'));
    }
}

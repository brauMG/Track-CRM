<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class Comentario extends  Mailable
{
    public $my_name;
    public $my_email;
    public $commentary;
    public $username;
    public $catalogue;
    public $subject = "Tienes un nuevo comentario de un contacto";

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($my_name, $my_email, $commentary, $username, $catalogue)
    {
        $this->my_name = $my_name;
        $this->my_email = $my_email;
        $this->commentary = $commentary;
        $this->username = $username;
        $this->catalogue = $catalogue;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.commentary');
    }
}

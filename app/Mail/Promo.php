<?php


namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Promo  extends Mailable
{
    public $title;
    public $firstP;
    public $secondP;
    public $imageLink;
    public $pdf;
    public $url;
    public $subject = "Conoce nuestras promociones- Track";

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $firstP, $secondP, $imageLink, $pdf, $url)
    {
        $this->title = $title;
        $this->firstP = $firstP;
        $this->secondP = $secondP;
        $this->imageLink = $imageLink;
        $this->pdf = $pdf;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $catalogue = $this->pdf;
        return $this->view('email_promos.template')->attach($catalogue, ['as' => 'catalogo.pdf', 'mime' => 'application/pdf']);
    }
}

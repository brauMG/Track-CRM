<?php


namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Campaign  extends Mailable
{
    public $title;
    public $firstP;
    public $secondP;
    public $link;
    public $imageLink;
    public $pdf;
    public $subject = "Conoce nuestros servicios y productos - Track CRM";

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $firstP, $secondP, $link, $imageLink, $pdf)
    {
        $this->title = $title;
        $this->firstP = $firstP;
        $this->secondP = $secondP;
        $this->link = $link;
        $this->imageLink = $imageLink;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $catalogue = $this->pdf;
        return $this->view('email_marketing.template')->attach($catalogue, ['as' => 'catalogo.pdf', 'mime' => 'application/pdf']);
    }
}

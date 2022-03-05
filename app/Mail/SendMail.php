<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $view, $subject, $params;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $view, string $subject, array $params)
    {
        $this->view = $view;
        $this->subject = $subject;
        $this->params = $params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $response = $this->subject($this->subject)->view($this->view)->with($this->params);
        return $response;
    }
}

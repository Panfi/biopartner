<?php
namespace biopartnering\biopartnering\plugins;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailer extends Mailable
{
    use Queueable, SerializesModels;

    public $input;

    public function __construct($input)
    {
        $this->input = $input;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->input['subject'];
        $mail_template = $this->input['mail_template'];

        return $this->subject($subject)->from("info@creatic.co.za", 'Creatic')->view($mail_template);
    }
}
<?php

namespace App\Mail\Web\Contact;

use App\Models\EmailWeb;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewMessage extends Mailable
{
    use Queueable, SerializesModels;

    private $emailWeb;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EmailWeb $emailWeb){
        $this->emailWeb = $emailWeb;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->subject($this->emailWeb->subject)->markdown('web.emails.contact.new-message', [
            'emailWeb' => $this->emailWeb
        ]);
    }
}

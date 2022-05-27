<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BackupsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Backups fallidos";

    public $failed;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($failed)
    {
        $this->failed = $failed;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('pruebasmtpcorreo342@gmail.com', 'VirtualAdmin')->
        view('emails.backups');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public $shopName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message, $shopName)
    {
        $this->content = $message;
        $this->shopName = $shopName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification_mail')
                ->with(['content' => $this->content])
                ->with(['shopName' => $this->shopName])
                ->from('rese@example.com', 'Rese')
                ->text('emails.notification_mail')
                ->subject('お知らせ');
    }
}

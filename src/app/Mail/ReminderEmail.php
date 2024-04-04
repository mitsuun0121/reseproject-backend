<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The reservation instance.
     *
     * @var \App\Models\Reservation
     */
    public $reservation;
    public $qrCodeImage;
    
    /**
     * Create a new message instance.
     *
     * @param \App\Models\Reservation $reservations
     * @return void
     */

    public function __construct($reservation, $qrCodeImage)
    {
        $this->reservation = $reservation;
        $this->qrCodeImage = $qrCodeImage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->view('emails.reminder_mail')
            ->from('rese@example.com', 'Rese')
            ->text('emails.reminder_mail')
            ->subject('ご予約のご案内')
            ->with([
                'reservation' => $this->reservation,
                'qrCodeImage' => $this->qrCodeImage
            ]);
    }
}

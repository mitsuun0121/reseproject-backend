<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ReminderEmail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The reservation instance.
     *
     * @var \App\Models\Reservation
     */
    protected $reservation;
    

    /**
     * Create a new job instance.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return void
     */

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reservation = $this->reservation;

        if (!$reservation) {
            // 予約が見つからない場合
            \Log::error("Reservation not found: {$this->reservation->id}");
            return;
        }
        // QRコードを生成
        $uniqueIdentifier = 'Reservation ID: ' . $reservation->id;

        $qrCode = QrCode::size(100)->generate($uniqueIdentifier);

        $qrCodeImage = base64_encode($qrCode);

        Mail::to($reservation->user->email)->send(new ReminderEmail($reservation, $qrCodeImage));
    }
}

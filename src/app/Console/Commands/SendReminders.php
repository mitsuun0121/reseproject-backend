<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderEmail;
use App\Models\Reservation;
use App\Jobs\SendReminderEmail;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now()->format('Y-m-d');
        $reservations = Reservation::where('date', $today)
                        ->whereBetween('time',['18:00:00', "20:00:00"])
                        ->get();

        // リマインダーメールを送信
        foreach ($reservations as $reservation) {
            SendReminderEmail::dispatch($reservation);
        }
        
        $this->info('Reminders sent successfully.');
    }
}

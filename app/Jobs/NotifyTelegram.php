<?php

namespace App\Jobs;

use App\Console\Commands\TelegramBotMessage;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class NotifyTelegram implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Order $order)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        app(TelegramBotMessage::class)->handle($this->order);
    }
}

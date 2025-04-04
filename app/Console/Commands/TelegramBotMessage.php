<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TelegramBotMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sendTelegramMessage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(Order $order)
    {

     $request =    Http::post(
            sprintf('https://api.telegram.org/bot%s/sendMessage', config('services.telegram.bot_key')),
            [
                'chat_id' => config('services.telegram.chat_id'),
                'text' => 'Order Created at ' . now('America/Sao_Paulo')->format('H:i') . " by user:  {$order->user->name} with id {$order->user_id} ",
            ]
        )->throw();


    }
}

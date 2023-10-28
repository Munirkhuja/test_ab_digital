<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class TelegramLogError implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $token = config('services.telegram-bot-api.token');
        $param = [
            'chat_id' => config('services.telegram-bot-api.chat_id'),
            'text' => $this->message,
        ];
        $url = "https://api.telegram.org/bot{$token}/sendMessage?" . http_build_query($param);
        Http::get($url);
    }
}

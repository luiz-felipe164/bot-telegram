<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Services\NewMessageService;
use Illuminate\Support\Facades\Redis;

class NewMessageSubscribe extends Command
{
    protected $messageService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:new-message-subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to a Redis channel new_message';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(NewMessageService $messageService)
    {
        parent::__construct();
        $this->messageService = $messageService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Redis::subscribe(['new_message'], function ($message) {
            $message = json_decode($message, true);
            $this->messageService->handle($message);
        });
    }
}

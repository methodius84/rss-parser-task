<?php

namespace App\Console\Commands;

use App\Http\Controllers\RequestController;
use Illuminate\Console\Command;

class ParseRSS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse-request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        resolve(RequestController::class)->getRSS();
        return Command::SUCCESS;
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExpireCredits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-credits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app('App\Http\Controllers\HomeController')->expire_credits();
        app('App\Http\Controllers\HomeController')->expire_property();
    }
}

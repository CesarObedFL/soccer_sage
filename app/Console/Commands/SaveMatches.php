<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;

class SaveMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:save-matches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to get the matches from the api-football and save them on the db';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $number = mt_rand(10, 9999999);
    }
}

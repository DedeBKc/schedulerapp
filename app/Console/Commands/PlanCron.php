<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class PlanCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan:cron';

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
        // return Command::SUCCESS;
        \Log::info("Cron is working fine!");

        User::create(['name' => fake()->name(), 'email' => fake()->unique()->email(), 'password' => bcrypt('password')]);
    }
}

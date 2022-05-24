<?php

namespace App\Console\Commands;

use App\Models\Generation;
use Illuminate\Console\Command;

class DistributionCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'distribution:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Generation::create([
                'title' => 'Test',
                'percentage' => 7
            ]);
        \Log::info("Cron is working fine!");
    }
}

<?php

namespace App\Console\Commands;

use App\Models\PointWallet;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserBalanceWallat;
use Carbon\Carbon;
use FontLib\Table\Type\post;
use Illuminate\Console\Command;

class PointConversationCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'conversation:cron';

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
        $rate = Setting::find(2)->point_rate;
        $date = Carbon::now()->subDays(1);
        $users = PointWallet::where('created_at', '>=', $date)->get();
        $user_wallet = [];
        $point_wallet = [];
        foreach ($users->unique('user_id') as $u){
            $point = PointWallet::where('user_id', $u->user_id)->sum('point');
            if ($point > 0){
                $user_wallet [] = [
                    'user_id' => $u->user_id,
                    'balance' => $point/$rate,
                    'from' => 1,
                    'created_by' => 1,
                    'target_id' => $u->user_id,
                    'status' => 1,
                ];
                $point_wallet [] = [
                    'user_id' => $u->user_id,
                    'point' => -$point,
                    'generate_from' => 'Point conversation',
                ];
            }
        }
       UserBalanceWallat::insert($user_wallet);
       PointWallet::insert($point_wallet);

        \Log::info("Conversation Cron is working fine!");
    }
}

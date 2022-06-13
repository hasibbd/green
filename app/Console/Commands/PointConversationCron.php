<?php

namespace App\Console\Commands;

use App\Models\PointWallet;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserBalanceWallat;
use App\Models\UserInformation;
use App\Models\UserReserve;
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
        $rate = Setting::find(CONST_SETTING_POINT_RATE)->point_rate;
        $today = Carbon::today()->toDateString();
        $targets = UserInformation::with('user','last_shop')
            ->withSum('point', 'point')
            ->whereRelation('user','status', CONST_STATUS_ENABLED)
            ->get();
        $point_wallet = [];
        $reserve_wallet = [];
        foreach ($targets as $t){
            if ($t->point_sum_point >= 100){
                if ($t->user->distribution_date == $today){
                    $reserve_wallet [] = [
                        'user_id' => $t->user_id,
                        'balance' => 100/$rate,
                        'status' => CONST_DISTRIBUTE_PENDING,
                    ];
                    $point_wallet [] = [
                        'user_id' => $t->user_id,
                        'point' => -100,
                        'generate_from' => 'Point conversation',
                        'status' => CONST_DISTRIBUTE_DONE,
                    ];
                    User::where('id', $t->user_id)->update([
                        'distribution_date' => Carbon::today()->addDays(CONST_DISTRIBUTE_DATE)
                    ]);
                }
            }
        }
         UserReserve::insert($reserve_wallet);
         PointWallet::insert($point_wallet);

        \Log::info("Conversation Cron is working fine!");
    }
}

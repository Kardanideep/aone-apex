<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Purchase;
use App\Models\Setting;
use App\Models\UserWallet;
use App\Models\UserWalletTransaction;
use Illuminate\Support\Facades\DB;

class DistributeDailyROI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:distribute-daily-roi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Distributes daily investment ROI to users based on their active packages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting daily ROI distribution...');

        // Get daily percentage from settings
        $dailyPercentSetting = Setting::where('key', 'daily_investment_percent')->first();
        if (!$dailyPercentSetting || !$dailyPercentSetting->value || $dailyPercentSetting->value <= 0) {
            $this->error('Daily investment percent is not set or is 0. Aborting.');
            return;
        }

        $dailyPercent = (float) $dailyPercentSetting->value;

        // Get all completed purchases
        // Assuming 'completed' means active and eligible for ROI.
        $activePurchases = Purchase::where('status', 'completed')->get();
        $count = 0;

        foreach ($activePurchases as $purchase) {
            $amount = $purchase->amount * ($dailyPercent / 100);
            
            if ($amount <= 0) continue;

            DB::transaction(function () use ($purchase, $amount) {
                // Update user wallet balance
                $wallet = UserWallet::firstOrCreate(
                    ['user_id' => $purchase->user_id],
                    ['balance' => 0, 'total_earned' => 0, 'total_withdrawn' => 0]
                );

                $wallet->balance += $amount;
                $wallet->total_earned += $amount;
                $wallet->save();

                // Record transaction
                UserWalletTransaction::create([
                    'user_id' => $purchase->user_id,
                    'type' => 'credit',
                    'source' => 'daily_investment',
                    'amount' => $amount,
                    'description' => "Daily ROI for package purchase #{$purchase->id}",
                    'status' => 'completed'
                ]);
            });

            $count++;
        }

        $this->info("Successfully distributed daily ROI to {$count} active packages.");
    }
}

<?php

namespace Database\Seeders;

use App\Models\LenderWallet;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LenderWalletSeeder extends Seeder
{
    public function run(): void
    {
        LenderWallet::create([
            'lender_id' => 3,
            'balance' => 5000000,
            'total_invested' => 0,
            'total_profit' => 0,
        ]);

        LenderWallet::create([
            'lender_id' => 4,
            'balance' => 5000000,
            'total_invested' => 0,
            'total_profit' => 0,
        ]);
    }
}

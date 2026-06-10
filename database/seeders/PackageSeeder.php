<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amounts = [20, 50, 100, 200, 500, 1000, 2000, 5000, 10000, 20000];

        foreach ($amounts as $index => $amount) {
            Package::firstOrCreate(
                ['amount' => $amount],
                [
                    'name' => 'Tier ' . ($index + 1),
                    'status' => true
                ]
            );
        }
    }
}

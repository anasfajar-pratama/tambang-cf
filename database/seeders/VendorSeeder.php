<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        Vendor::create([
            'user_id' => 2,
            'company_name' => 'PT Bumi Resources Mineral',
            'description' => 'Perusahaan pertambangan yang bergerak di bidang eksplorasi dan eksploitasi mineral logam dan batubara. Berpengalaman lebih dari 15 tahun di industri pertambangan Indonesia dengan berbagai proyek yang tersebar di seluruh nusantara.',
            'address' => 'Menara Bumi, Jl. HR Rasuna Said Kav 10, Jakarta Selatan',
            'phone' => '021-12345678',
            'is_verified' => true,
        ]);
    }
}

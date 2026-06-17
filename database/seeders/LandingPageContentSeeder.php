<?php

namespace Database\Seeders;

use App\Models\LandingPageContent;
use Illuminate\Database\Seeder;

class LandingPageContentSeeder extends Seeder
{
    public function run(): void
    {
        LandingPageContent::create([
            'section_key' => 'hero',
            'title' => 'Investasi Tambang, Raih Keuntungan Bersama Kami',
            'subtitle' => 'Platform crowdfunding pertambangan terpercaya di Indonesia. Danai proyek tambang potensial dan dapatkan bagi hasil menarik.',
            'content' => null,
            'is_active' => true,
        ]);

        LandingPageContent::create([
            'section_key' => 'stats',
            'title' => 'Platform Terpercaya',
            'subtitle' => 'Kami telah membantu mendanai berbagai proyek tambang di seluruh Indonesia',
            'content' => '{"total_projects":10,"total_funding":100000000000,"total_investors":50,"total_profit":5000000000}',
            'is_active' => true,
        ]);

        LandingPageContent::create([
            'section_key' => 'how_it_works',
            'title' => 'Cara Kerja',
            'subtitle' => 'Mulai investasi tambang dalam 3 langkah mudah',
            'content' => 'Langkah 1: Daftar akun dan lengkapi profil. Langkah 2: Top up saldo dompet Anda. Langkah 3: Pilih proyek dan danai.',
            'is_active' => true,
        ]);

        LandingPageContent::create([
            'section_key' => 'about',
            'title' => 'Tentang Kami',
            'subtitle' => 'Mitra Investasi Pertambangan Terpercaya',
            'content' => 'Kami adalah platform crowdfunding yang menghubungkan pemilik proyek pertambangan dengan para investor. Dengan pengalaman lebih dari 15 tahun di industri pertambangan, kami menyediakan akses investasi yang transparan dan menguntungkan.',
            'is_active' => true,
        ]);

        LandingPageContent::create([
            'section_key' => 'why_us',
            'title' => 'Mengapa Memilih Kami',
            'subtitle' => 'Keunggulan berinvestasi melalui platform kami',
            'content' => 'Legalitas Terjamin|Transparan & Terpercaya|Bagi Hasil Menarik|Didukung Tim Ahli',
            'is_active' => true,
        ]);

        LandingPageContent::create([
            'section_key' => 'contact',
            'title' => 'Hubungi Kami',
            'subtitle' => 'Konsultasi gratis tentang investasi tambang',
            'content' => 'Email: info@tambangcrowd.com | Telepon: 021-12345678 | Alamat: Jakarta, Indonesia',
            'is_active' => true,
        ]);
    }
}

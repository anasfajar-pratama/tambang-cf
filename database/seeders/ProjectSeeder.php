<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectDocument;
use App\Models\ProjectFaq;
use App\Models\ProjectGallery;
use App\Models\ProjectMilestone;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Eksplorasi Emas Rakyat Poboya',
                'slug' => 'eksplorasi-emas-poboya',
                'tagline' => 'Potensi emas alluvial di Sulawesi Tengah',
                'description' => 'Proyek eksplorasi emas rakyat di wilayah Poboya, Kota Palu, Sulawesi Tengah. Area ini dikenal sebagai salah satu sentra pertambangan emas rakyat yang telah beroperasi sejak tahun 2000-an. Metode penambangan menggunakan teknik amalgamasi dan sianidasi sederhana yang telah dimodernisasi. Potensi sumber daya emas teridentifikasi mencapai 50.000 oz dengan kadar rata-rata 3-5 gr/ton. Proyek ini bertujuan untuk meningkatkan efisiensi produksi dan memastikan praktik pertambangan yang lebih ramah lingkungan.',
                'location' => 'Poboya, Palu, Sulawesi Tengah',
                'mining_type' => 'Emas',
                'total_capital' => 2500000000,
                'min_investment' => 1000000,
                'investment_type' => 'multi',
                'investor_share' => 40,
                'vendor_share' => 60,
                'duration_months' => 12,
                'risk_level' => 'tinggi',
                'permit_status' => 'IUP Rakyat',
                'luas_lahan' => '25 Hektar',
                'status' => 'fundraising',
            ],
            [
                'title' => 'Pengembangan Tambang Nikel Morowali',
                'slug' => 'tambang-nikel-morowali',
                'tagline' => 'Ekspansi tambang nikel di kawasan industri Morowali',
                'description' => 'Proyek pengembangan tambang nikel laterit di kawasan industri Morowali, Sulawesi Tengah. Area ini merupakan bagian dari proyek strategis nasional pengembangan industri baterai kendaraan listrik. Kandungan nikel laterit dengan kadar 1.8-2.0% tersebar di area seluas 500 hektar. Proyek ini mencakup pengembangan pit tambang, pembangunan fasilitas pengolahan, dan infrastruktur pendukung.',
                'location' => 'Morowali, Sulawesi Tengah',
                'mining_type' => 'Nikel',
                'total_capital' => 15000000000,
                'min_investment' => 1000000,
                'investment_type' => 'multi',
                'investor_share' => 35,
                'vendor_share' => 65,
                'duration_months' => 18,
                'risk_level' => 'sedang',
                'permit_status' => 'IUP Operasi Produksi',
                'luas_lahan' => '500 Hektar',
                'status' => 'fundraising',
            ],
            [
                'title' => 'Tambang Batubara Muara Enim',
                'slug' => 'tambang-batubara-muara-enim',
                'tagline' => 'Tambang batubara kalori tinggi di Sumatera Selatan',
                'description' => 'Proyek optimalisasi tambang batubara di Muara Enim, Sumatera Selatan. Batubara dengan kalori 6.000-7.000 kcal/kg ini merupakan salah satu batubara kualitas terbaik di Indonesia. Area tambang terletak di cekungan Sumatera Selatan yang dikenal sebagai salah satu daerah penghasil batubara terbesar. Proyek ini menggunakan metode open pit mining dengan rasio pengupasan yang efisien.',
                'location' => 'Muara Enim, Sumatera Selatan',
                'mining_type' => 'Batubara',
                'total_capital' => 8000000000,
                'min_investment' => 1000000,
                'investment_type' => 'multi',
                'investor_share' => 30,
                'vendor_share' => 70,
                'duration_months' => 12,
                'risk_level' => 'rendah',
                'permit_status' => 'PKP2B',
                'luas_lahan' => '1000 Hektar',
                'status' => 'fundraising',
            ],
            [
                'title' => 'Eksplorasi Tembaga Batu Hijau',
                'slug' => 'eksplorasi-tembaga-batu-hijau',
                'tagline' => 'Eksplorasi tembaga di area prospek Sumbawa',
                'description' => 'Proyek eksplorasi tembaga di area prospek Batu Hijau, Sumbawa, NTB. Area ini berada di dekat tambang tembaga besar yang sudah beroperasi, dengan indikasi mineralisasi tembaga-emas yang signifikan. Kegiatan eksplorasi mencakup pemetaan geologi detail, geokimia, geofisika, dan pengeboran eksplorasi. Target sumber daya teridentifikasi mencapai 200 juta ton bijih dengan kadar tembaga 0.5-0.8%.',
                'location' => 'Sumbawa, NTB',
                'mining_type' => 'Tembaga',
                'total_capital' => 20000000000,
                'min_investment' => 1000000,
                'investment_type' => 'single',
                'investor_share' => 40,
                'vendor_share' => 60,
                'duration_months' => 24,
                'risk_level' => 'tinggi',
                'permit_status' => 'IUP Eksplorasi',
                'luas_lahan' => '750 Hektar',
                'status' => 'fundraising',
            ],
            [
                'title' => 'Tambang Pasir Besi Kulon Progo',
                'slug' => 'tambang-pasir-besi-kulonprogo',
                'tagline' => 'Eksploitasi pasir besi di pesisir selatan Yogyakarta',
                'description' => 'Proyek eksploitasi pasir besi di pesisir selatan Kulon Progo, DIY. Area ini memiliki potensi pasir besi dengan cadangan terukur mencapai 15 juta ton. Pasir besi mengandung mineral magnetit dan ilmenit yang dapat diolah menjadi konsentrat besi. Metode penambangan menggunakan teknik penambangan terbuka dengan sistem konveyor untuk meminimalkan dampak lingkungan.',
                'location' => 'Kulon Progo, DIY',
                'mining_type' => 'Pasir Besi',
                'total_capital' => 5000000000,
                'min_investment' => 1000000,
                'investment_type' => 'multi',
                'investor_share' => 35,
                'vendor_share' => 65,
                'duration_months' => 10,
                'risk_level' => 'sedang',
                'permit_status' => 'IUP Operasi Produksi',
                'luas_lahan' => '300 Hektar',
                'status' => 'fundraising',
            ],
            [
                'title' => 'Tambang Batubara Kaltim Prima',
                'slug' => 'tambang-batubara-kaltim',
                'tagline' => 'Optimalisasi produksi batubara di Kalimantan Timur',
                'description' => 'Proyek optimalisasi produksi tambang batubara di Samarinda, Kalimantan Timur. Area ini merupakan bagian dari cekungan Kutai yang kaya akan batubara berkualitas ekspor. Batubara dengan kalori 5.500-6.500 kcal/kg dan kandungan sulfur rendah sangat diminati pasar internasional. Proyek ini bertujuan meningkatkan kapasitas produksi dari 500.000 ton menjadi 1 juta ton per tahun.',
                'location' => 'Samarinda, Kalimantan Timur',
                'mining_type' => 'Batubara',
                'total_capital' => 10000000000,
                'min_investment' => 1000000,
                'investment_type' => 'multi',
                'investor_share' => 30,
                'vendor_share' => 70,
                'duration_months' => 12,
                'risk_level' => 'rendah',
                'permit_status' => 'PKP2B',
                'luas_lahan' => '1500 Hektar',
                'status' => 'fundraising',
            ],
            [
                'title' => 'Tambang Emas Tradisional Bombana',
                'slug' => 'tambang-emas-bombana',
                'tagline' => 'Emas aluvial di daratan Sulawesi Tenggara',
                'description' => 'Proyek pengembangan tambang emas aluvial di Bombana, Sulawesi Tenggara. Wilayah ini terkenal dengan penemuan emas aluvial yang tersebar di sepanjang sungai-sungai besar. Emas aluvial dengan kemurnian tinggi (90-95%) dapat ditambang menggunakan metode tambang semprot dan pengolahan gravitasi. Potensi sumber daya emas diperkirakan mencapai 20.000 oz.',
                'location' => 'Bombana, Sulawesi Tenggara',
                'mining_type' => 'Emas',
                'total_capital' => 3000000000,
                'min_investment' => 1000000,
                'investment_type' => 'multi',
                'investor_share' => 45,
                'vendor_share' => 55,
                'duration_months' => 8,
                'risk_level' => 'sedang',
                'permit_status' => 'IUP Rakyat',
                'luas_lahan' => '40 Hektar',
                'status' => 'fundraising',
            ],
            [
                'title' => 'Eksplorasi Mangan Timor Tengah',
                'slug' => 'eksplorasi-mangan-ttu',
                'tagline' => 'Potensi mangan di perbatasan NTT',
                'description' => 'Proyek eksplorasi mangan di Kabupaten Timor Tengah Utara, NTT. Wilayah perbatasan Indonesia-Timor Leste ini memiliki potensi mangan yang belum tergarap optimal. Mineral mangan tersebar dalam bentuk nodul dan lapisan tipis di batuan sedimen. Kadar mangan berkisar 30-45% dengan target sumber daya 500.000 ton. Proyek ini masih dalam tahap eksplorasi awal.',
                'location' => 'Timor Tengah Utara, NTT',
                'mining_type' => 'Mangan',
                'total_capital' => 4500000000,
                'min_investment' => 1000000,
                'investment_type' => 'multi',
                'investor_share' => 40,
                'vendor_share' => 60,
                'duration_months' => 14,
                'risk_level' => 'sedang',
                'permit_status' => 'IUP Eksplorasi',
                'luas_lahan' => '200 Hektar',
                'status' => 'draft',
            ],
            [
                'title' => 'Tambang Pasir Batu Merapi',
                'slug' => 'tambang-pasir-merapi',
                'tagline' => 'Material tambang dari lereng Merapi',
                'description' => 'Proyek penambangan pasir dan batu dari material vulkanik Gunung Merapi, Sleman, DIY. Material hasil letusan Merapi berupa pasir, kerikil, dan batu-batuan yang berkualitas tinggi untuk bahan konstruksi. Cadangan material melimpah dengan kualitas yang terus diperbarui oleh aktivitas vulkanik. Penambangan dilakukan secara selektif dengan memperhatikan keseimbangan lingkungan.',
                'location' => 'Sleman, DIY',
                'mining_type' => 'Pasir & Batu',
                'total_capital' => 1800000000,
                'min_investment' => 1000000,
                'investment_type' => 'multi',
                'investor_share' => 30,
                'vendor_share' => 70,
                'duration_months' => 6,
                'risk_level' => 'rendah',
                'permit_status' => 'IUP Operasi Produksi',
                'luas_lahan' => '15 Hektar',
                'status' => 'pending',
            ],
            [
                'title' => 'Proyek Bijih Besi Tanah Laut',
                'slug' => 'proyek-bijih-besi-tanah-laut',
                'tagline' => 'Eksplorasi bijih besi di Kalimantan Selatan',
                'description' => 'Proyek eksplorasi bijih besi di Kabupaten Tanah Laut, Kalimantan Selatan. Area prospek memiliki indikasi bijih besi laterit dengan sebaran luas. Kadar bijih besi bervariasi antara 40-55% Fe dengan target sumber daya 2 juta ton. Proyek ini bertujuan untuk mengidentifikasi potensi ekonomi dan mempersiapkan studi kelayakan untuk pengembangan tambang skala menengah.',
                'location' => 'Tanah Laut, Kalimantan Selatan',
                'mining_type' => 'Bijih Besi',
                'total_capital' => 7000000000,
                'min_investment' => 1000000,
                'investment_type' => 'multi',
                'investor_share' => 35,
                'vendor_share' => 65,
                'duration_months' => 16,
                'risk_level' => 'sedang',
                'permit_status' => 'IUP Eksplorasi',
                'luas_lahan' => '400 Hektar',
                'status' => 'fundraising',
            ],
        ];

        foreach ($projects as $index => $projectData) {
            $project = Project::create(array_merge($projectData, [
                'vendor_id' => 1,
                'started_at' => Carbon::now()->addDays(rand(1, 30)),
            ]));

            $this->createGalleries($project);
            $this->createMilestones($project);
            $this->createDocuments($project);
            $this->createFaqs($project);
        }
    }

    private function createGalleries(Project $project): void
    {
        $captions = [
            'Area tambang dari udara',
            'Aktivitas penambangan',
            'Peralatan dan mesin tambang',
            'Pemandangan area proyek',
        ];

        for ($i = 0; $i < 4; $i++) {
            ProjectGallery::create([
                'project_id' => $project->id,
                'image' => "https://picsum.photos/seed/{$project->slug}-{$i}/800/600",
                'caption' => $captions[$i],
                'order' => $i + 1,
            ]);
        }
    }

    private function createMilestones(Project $project): void
    {
        $duration = $project->duration_months;
        $milestones = [
            [
                'phase_name' => 'Persiapan & Perizinan',
                'description' => 'Pengurusan dokumen perizinan dan persiapan administratif proyek, termasuk pengadaan IUP, AMDAL, dan perizinan lainnya.',
                'target_date' => Carbon::now()->addMonths(1),
                'order' => 1,
            ],
            [
                'phase_name' => 'Eksplorasi & Studi Kelayakan',
                'description' => 'Melakukan eksplorasi detail, pemetaan geologi, pengeboran, dan penyusunan studi kelayakan teknis dan ekonomi.',
                'target_date' => Carbon::now()->addMonths(max(3, intval($duration * 0.25))),
                'order' => 2,
            ],
            [
                'phase_name' => 'Pembangunan Infrastruktur',
                'description' => 'Pembangunan akses jalan, fasilitas pengolahan, Gudang material, dan infrastruktur pendukung operasi tambang.',
                'target_date' => Carbon::now()->addMonths(max(6, intval($duration * 0.5))),
                'order' => 3,
            ],
            [
                'phase_name' => 'Produksi & Operasi',
                'description' => 'Memulai kegiatan produksi tambang, pengolahan bahan galian, dan pengangkutan hasil tambang.',
                'target_date' => Carbon::now()->addMonths(max(9, intval($duration * 0.75))),
                'order' => 4,
            ],
            [
                'phase_name' => 'Distribusi & Bagi Hasil',
                'description' => 'Distribusi hasil produksi, perhitungan pendapatan, dan pembagian hasil investasi kepada seluruh investor.',
                'target_date' => Carbon::now()->addMonths($duration),
                'order' => 5,
            ],
        ];

        foreach ($milestones as $milestone) {
            ProjectMilestone::create([
                'project_id' => $project->id,
                'phase_name' => $milestone['phase_name'],
                'description' => $milestone['description'],
                'target_date' => $milestone['target_date'],
                'is_completed' => false,
                'order' => $milestone['order'],
            ]);
        }
    }

    private function createDocuments(Project $project): void
    {
        $documents = [
            [
                'name' => 'Izin Usaha Pertambangan (IUP)',
                'file' => "documents/{$project->slug}/iup.pdf",
                'type' => 'iup',
            ],
            [
                'name' => 'Analisis Dampak Lingkungan (AMDAL)',
                'file' => "documents/{$project->slug}/amdal.pdf",
                'type' => 'amdal',
            ],
            [
                'name' => 'Studi Kelayakan (Feasibility Study)',
                'file' => "documents/{$project->slug}/feasibility-study.pdf",
                'type' => 'fs',
            ],
        ];

        foreach ($documents as $document) {
            ProjectDocument::create([
                'project_id' => $project->id,
                'name' => $document['name'],
                'file' => $document['file'],
                'type' => $document['type'],
            ]);
        }
    }

    private function createFaqs(Project $project): void
    {
        $faqs = [
            [
                'question' => 'Berapa minimal investasi untuk proyek ini?',
                'answer' => 'Minimal investasi untuk proyek ini adalah Rp ' . number_format($project->min_investment, 0, ',', '.') . '. Anda dapat berinvestasi dalam jumlah kelipatan dari nominal tersebut.',
                'order' => 1,
            ],
            [
                'question' => 'Bagaimana cara mendapatkan return investasi?',
                'answer' => 'Bagi hasil akan didistribusikan setelah proyek selesai sesuai dengan persentase kepemilikan investor. Pembagian dilakukan secara transparan melalui platform kami.',
                'order' => 2,
            ],
            [
                'question' => 'Apa jaminan keamanan investasi?',
                'answer' => 'Proyek memiliki legalitas lengkap termasuk IUP dan dokumen perizinan lainnya. Seluruh dokumen dapat diakses dan diverifikasi melalui platform kami.',
                'order' => 3,
            ],
            [
                'question' => 'Berapa lama proyek ini berlangsung?',
                'answer' => 'Proyek ini memiliki durasi ' . $project->duration_months . ' bulan sejak pendanaan tercapai dan proyek dinyatakan aktif.',
                'order' => 4,
            ],
        ];

        foreach ($faqs as $faq) {
            ProjectFaq::create([
                'project_id' => $project->id,
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'order' => $faq['order'],
            ]);
        }
    }
}

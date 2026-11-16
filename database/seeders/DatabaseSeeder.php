<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Person;
use App\Models\Event;
use App\Models\Venue;
use App\Models\EventSetting;
use App\Models\Organization;
use App\Models\CampusProfile;
use App\Models\CompanyProfile;
use App\Models\SchoolProfile;
use App\Models\OrganizationMembership;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Registration;
use App\Models\Booth;
use App\Models\BoothAllocation;
use App\Models\Project;
use App\Models\ProjectVersion;
use App\Models\ProjectMedia;
use App\Models\TechnicalRequirement;
use App\Models\PublicationApproval;
use App\Models\EventSession;
use App\Models\Speaker;
use App\Models\TourSlot;
use App\Models\SchoolVisit;
use App\Models\CollaborationNeed;
use App\Models\Meeting;
use App\Models\MeetingParticipant;
use App\Models\FollowUp;
use App\Models\SponsorshipPackage;
use App\Models\SponsorshipAgreement;
use App\Models\Benefit;
use App\Models\BenefitFulfillment;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\PaymentAllocation;
use App\Models\Expense;
use App\Models\InKindContribution;
use App\Models\RubricVersion;
use App\Models\Criterion;
use App\Models\JudgeAssignment;
use App\Models\Assessment;
use App\Models\Score;
use App\Models\Vote;
use App\Models\ProjectFeedback;
use App\Models\SurveyResponse;
use App\Models\Ticket;
use App\Models\CheckInLog;
use App\Models\Task;
use App\Models\SupportTicket;
use App\Models\Document;
use App\Models\Notification;
use App\Models\AuditLog;
use App\Models\News;
use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ROLES
        $rolesData = [
            ['name' => 'Super Admin', 'slug' => 'super-admin', 'description' => 'Konfigurasi acara, pengguna, peran dan seluruh modul.'],
            ['name' => 'Ketua Pelaksana', 'slug' => 'ketua-pelaksana', 'description' => 'Dashboard lintas divisi, kesiapan, kendala, keputusan dan laporan.'],
            ['name' => 'Sekretariat', 'slug' => 'sekretariat', 'description' => 'Administrasi, dokumen, pengumuman dan korespondensi.'],
            ['name' => 'Keuangan', 'slug' => 'keuangan', 'description' => 'Tagihan, verifikasi penerimaan, alokasi pembayaran dan laporan dana.'],
            ['name' => 'Program dan Kurasi', 'slug' => 'program-kurasi', 'description' => 'Pemeriksaan karya, revisi, keputusan, penugasan juri dan finalis pitching.'],
            ['name' => 'Kampus dan Sekolah', 'slug' => 'kampus-sekolah', 'description' => 'Verifikasi kampus, rombongan sekolah dan jadwal tur.'],
            ['name' => 'Industri dan Sponsor', 'slug' => 'industri-sponsor', 'description' => 'Prospek, penawaran, kesepakatan, manfaat, materi dan pertemuan.'],
            ['name' => 'Venue dan Teknis', 'slug' => 'venue-teknis', 'description' => 'Alokasi booth, denah, perangkat, listrik, internet, loading dan checklist.'],
            ['name' => 'Publikasi', 'slug' => 'publikasi', 'description' => 'CMS, katalog publik, media, sponsor publik dan dokumentasi.'],
            ['name' => 'Registrasi dan Layanan', 'slug' => 'registrasi-layanan', 'description' => 'Check-in, pencarian peserta, antrean dan tiket bantuan.'],
            ['name' => 'PIC Kampus', 'slug' => 'pic-kampus', 'description' => 'Profil institusi, tim, dua karya usulan, dokumen dan administrasi kampusnya.'],
            ['name' => 'Tim Mahasiswa', 'slug' => 'tim-mahasiswa', 'description' => 'Materi karya yang ditugaskan, jadwal, feedback dan tindak lanjut.'],
            ['name' => 'PIC Industri / Mitra', 'slug' => 'pic-industri', 'description' => 'Profil, partisipasi, teknis dan pertemuan organisasinya.'],
            ['name' => 'PIC Sponsor', 'slug' => 'pic-sponsor', 'description' => 'Kesepakatan, materi dan manfaat sponsor organisasinya.'],
            ['name' => 'PIC Sekolah', 'slug' => 'pic-sekolah', 'description' => 'Rombongan, slot tur dan konfirmasi sekolahnya.'],
            ['name' => 'Juri', 'slug' => 'juri', 'description' => 'Karya yang ditugaskan dan penilaian sendiri.'],
            ['name' => 'Pengunjung', 'slug' => 'pengunjung', 'description' => 'Tiket, aktivitas, feedback, voting dan survei sesuai ketentuan.'],
        ];

        $roles = [];
        foreach ($rolesData as $rd) {
            $roles[$rd['slug']] = Role::create($rd);
        }

        // 2. EVENT & VENUE
        $event = Event::create([
            'name' => 'FUTURiSE 2026 - West Java Digital Innovation Festival',
            'slug' => 'futurise-2026',
            'edition' => '2026',
            'theme' => 'Bridging Higher Education Innovation with Industry & Society in West Java',
            'start_date' => Carbon::now()->addDays(14)->toDateString(),
            'end_date' => Carbon::now()->addDays(15)->toDateString(),
            'venue_name' => 'Sasana Budaya Ganesha (Sabuga) ITB Bandung',
            'venue_address' => 'Jl. Tamansari No. 73, Lebak Siliwangi, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132',
            'city' => 'Bandung',
            'quota_campus' => 30,
            'quota_projects_per_campus' => 2,
            'quota_industry' => 10,
            'quota_partner' => 5,
            'target_pitching_finalists' => 10,
            'target_collaboration_meetings' => 30,
            'target_visitors' => 1000,
            'target_h30_followups' => 10,
            'target_satisfaction_rate' => 85.00,
            'min_survey_responses' => 200,
            'registration_deadline' => Carbon::now()->addDays(7),
            'voting_start_at' => Carbon::now()->addDays(14)->setHour(8),
            'voting_end_at' => Carbon::now()->addDays(15)->setHour(16),
            'is_date_confirmed' => true,
            'is_results_published' => false,
            'is_active' => true,
        ]);

        $venue = Venue::create([
            'event_id' => $event->id,
            'name' => 'Sasana Budaya Ganesha (Sabuga) ITB',
            'address' => 'Jl. Tamansari No. 73, Lebak Siliwangi, Coblong, Kota Bandung',
            'map_embed_url' => 'https://maps.google.com/?q=Sabuga+ITB+Bandung',
            'floor_plan_image' => '/images/denah-sabuga.svg',
            'concurrent_capacity' => 600, // BR-12
            'facilities' => [
                'Free High-Speed Wi-Fi',
                'Ruang VIP & Media Center',
                'Panggung Utama & LED Display 4K',
                'Meja Business Matchmaking (10 Meja Khusus)',
                'Kantin & Food Court Area',
                'Musholla & Toilet Difabel',
                'Klinik & Pos Medis Pertolongan Pertama',
                'Area Parkir 500 Mobil & 1000 Motor'
            ],
            'transport_guide' => 'Dapat diakses melalui Angkot Cicaheum-Ciroyom, Dago-Stasiun Hall, atau bus Damri Dipatiukur. Dari Stasiun Bandung sekitar 15 menit menggunakan taksi/ojek online.',
        ]);

        // Event settings
        $settings = [
            ['key' => 'organizer_name', 'value' => 'APTIKOM Wilayah IV Jawa Barat', 'group' => 'general'],
            ['key' => 'organizer_email', 'value' => 'sekretariat@aptikom-jabar.id', 'group' => 'general'],
            ['key' => 'organizer_phone', 'value' => '+62 22 2504444', 'group' => 'general'],
            ['key' => 'bank_name', 'value' => 'Bank BJB Cabang Utama Bandung', 'group' => 'finance'],
            ['key' => 'bank_account_number', 'value' => '001-2345678-001', 'group' => 'finance'],
            ['key' => 'bank_account_name', 'value' => 'APTIKOM JABAR EVENT FESTIVAL', 'group' => 'finance'],
            ['key' => 'registration_fee_campus', 'value' => '1500000', 'group' => 'finance'],
            ['key' => 'registration_fee_industry', 'value' => '5000000', 'group' => 'finance'],
        ];
        foreach ($settings as $st) {
            EventSetting::create(array_merge($st, ['event_id' => $event->id]));
        }

        // 3. RUBRIC & 5 CRITERIA (Section 13)
        $rubric = RubricVersion::create([
            'event_id' => $event->id,
            'version_name' => 'Rubrik Kurasi & Penjurian FUTURiSE 2026 v1.0',
            'description' => 'Standar penilaian karya inovasi digital mahasiswa APTIKOM Jawa Barat',
            'is_active' => true,
        ]);

        $criteriaData = [
            ['code' => 'C1', 'name' => 'Relevansi Masalah', 'weight_percent' => 25.00, 'description' => 'Ketajaman analisis masalah nyata di Jawa Barat / Indonesia dan validasi pengguna sasaran.', 'sort_order' => 1],
            ['code' => 'C2', 'name' => 'Fungsi Prototipe', 'weight_percent' => 25.00, 'description' => 'Kelayakan, keandalan fungsional, dan stabilitas fitur sistem/aplikasi yang didemokan.', 'sort_order' => 2],
            ['code' => 'C3', 'name' => 'Kebaruan Solusi', 'weight_percent' => 20.00, 'description' => 'Unsur orisinalitas, diferensiasi dari produk sejenis, dan inovasi pendekatan teknologi.', 'sort_order' => 3],
            ['code' => 'C4', 'name' => 'Potensi Dampak', 'weight_percent' => 20.00, 'description' => 'Kelayakan adopsi industri/masyarakat, skalabilitas bisnis, dan dampak sosial-ekonomi.', 'sort_order' => 4],
            ['code' => 'C5', 'name' => 'Komunikasi dan Demo', 'weight_percent' => 10.00, 'description' => 'Kejelasan pemaparan, respon tanya jawab tim, serta kualitas demonstrasi langsung.', 'sort_order' => 5],
        ];

        $criteria = [];
        foreach ($criteriaData as $cd) {
            $criteria[$cd['code']] = Criterion::create(array_merge($cd, ['rubric_version_id' => $rubric->id]));
        }

        // 4. USERS & PERSONS
        $usersList = [
            ['name' => 'Super Administrator', 'email' => 'admin@futurise.id', 'role' => 'super-admin', 'phone' => '081122334401'],
            ['name' => 'Dr. Ir. Hendra Gunawan (Ketua Pelaksana)', 'email' => 'ketua@futurise.id', 'role' => 'ketua-pelaksana', 'phone' => '081122334402'],
            ['name' => 'Sekretariat APTIKOM', 'email' => 'sekretariat@futurise.id', 'role' => 'sekretariat', 'phone' => '081122334403'],
            ['name' => 'Bendahara & Keuangan', 'email' => 'keuangan@futurise.id', 'role' => 'keuangan', 'phone' => '081122334404'],
            ['name' => 'Koordinator Kurator & Program', 'email' => 'kurator@futurise.id', 'role' => 'program-kurasi', 'phone' => '081122334405'],
            ['name' => 'Divisi Kampus & Sekolah', 'email' => 'kampus@futurise.id', 'role' => 'kampus-sekolah', 'phone' => '081122334406'],
            ['name' => 'Divisi Industri & Sponsor', 'email' => 'sponsor@futurise.id', 'role' => 'industri-sponsor', 'phone' => '081122334407'],
            ['name' => 'Koordinator Venue & Teknis', 'email' => 'venue@futurise.id', 'role' => 'venue-teknis', 'phone' => '081122334408'],
            ['name' => 'Tim Publikasi & Media', 'email' => 'publikasi@futurise.id', 'role' => 'publikasi', 'phone' => '081122334409'],
            ['name' => 'Petugas Registrasi Gate Sabuga', 'email' => 'registrasi@futurise.id', 'role' => 'registrasi-layanan', 'phone' => '081122334410'],
            ['name' => 'Prof. Dr. Juri Teknologi (Juri)', 'email' => 'juri@futurise.id', 'role' => 'juri', 'phone' => '081122334411'],
            ['name' => 'Dr. Rina Widyastuti (Juri Industri)', 'email' => 'juri2@futurise.id', 'role' => 'juri', 'phone' => '081122334412'],
            ['name' => 'PIC Kampus ITB', 'email' => 'kampus@itb.ac.id', 'role' => 'pic-kampus', 'phone' => '081220000001'],
            ['name' => 'Rian Pratama (Tim Mahasiswa ITB)', 'email' => 'tim@itb.ac.id', 'role' => 'tim-mahasiswa', 'phone' => '081220000002'],
            ['name' => 'PIC Kampus Telkom University', 'email' => 'kampus@telkomuniversity.ac.id', 'role' => 'pic-kampus', 'phone' => '081220000003'],
            ['name' => 'PIC Kampus UNIKOM Bandung', 'email' => 'kampus@unikom.ac.id', 'role' => 'pic-kampus', 'phone' => '081220000004'],
            ['name' => 'VP Innovation PT Telkom Indonesia', 'email' => 'industri@telkom.co.id', 'role' => 'pic-industri', 'phone' => '081230000001'],
            ['name' => 'Corporate Secretary Bank BJB', 'email' => 'sponsor@bankbjb.co.id', 'role' => 'pic-sponsor', 'phone' => '081230000002'],
            ['name' => 'Koordinator SMKN 4 Bandung', 'email' => 'sekolah@smkn4bdg.sch.id', 'role' => 'pic-sekolah', 'phone' => '081240000001'],
            ['name' => 'Budi Santoso (Pengunjung Umum)', 'email' => 'pengunjung@gmail.com', 'role' => 'pengunjung', 'phone' => '081250000001'],
        ];

        $users = [];
        foreach ($usersList as $u) {
            $user = User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'phone' => $u['phone'],
                'password' => Hash::make('password'),
                'active_role_id' => $roles[$u['role']]->id,
                'status' => 'active',
                'is_verified' => true,
            ]);
            $user->roles()->attach($roles[$u['role']]->id);

            Person::create([
                'user_id' => $user->id,
                'full_name' => $u['name'],
                'email' => $u['email'],
                'phone' => $u['phone'],
                'organization_name' => 'APTIKOM Jabar Ecosystem',
                'position' => $u['role'],
            ]);

            $users[$u['email']] = $user;
        }

        // Multi-role demo for Super Admin (has super-admin, ketua-pelaksana, and juri)
        $users['admin@futurise.id']->roles()->syncWithoutDetaching([
            $roles['super-admin']->id,
            $roles['ketua-pelaksana']->id,
            $roles['juri']->id,
        ]);

        // 5. BOOTHS (45 Booths: 30 Kampus, 10 Industri, 5 Mitra)
        $booths = [];
        // 30 Campus Booths
        for ($i = 1; $i <= 30; $i++) {
            $code = sprintf('B-%02d', $i);
            $booths[$code] = Booth::create([
                'event_id' => $event->id,
                'code' => $code,
                'category' => 'campus',
                'size' => '3x3 m',
                'power_watt' => 450,
                'max_projects' => 2, // BR-03
                'zone' => 'Hall Utama - Zona Akademik',
                'location_description' => "Sayap Kiri Sabuga Lantai 1, Booth {$code}",
                'x_coord' => 50 + (($i - 1) % 6) * 150,
                'y_coord' => 100 + floor(($i - 1) / 6) * 120,
                'is_active' => true,
            ]);
        }

        // 10 Industry Booths
        for ($i = 1; $i <= 10; $i++) {
            $code = sprintf('I-%02d', $i);
            $booths[$code] = Booth::create([
                'event_id' => $event->id,
                'code' => $code,
                'category' => 'industry',
                'size' => '4x4 m',
                'power_watt' => 1200,
                'max_projects' => 1,
                'zone' => 'Hall Utama - Zona Korporat & Startup',
                'location_description' => "Koridor Tengah Sabuga, Booth {$code}",
                'x_coord' => 100 + (($i - 1) % 5) * 180,
                'y_coord' => 750 + floor(($i - 1) / 5) * 150,
                'is_active' => true,
            ]);
        }

        // 5 Partner Booths
        for ($i = 1; $i <= 5; $i++) {
            $code = sprintf('M-%02d', $i);
            $booths[$code] = Booth::create([
                'event_id' => $event->id,
                'code' => $code,
                'category' => 'partner',
                'size' => '3x3 m',
                'power_watt' => 600,
                'max_projects' => 1,
                'zone' => 'Zona Ekosistem & Komunitas Mitra',
                'location_description' => "Foyer Depan Sabuga, Booth {$code}",
                'x_coord' => 150 + ($i - 1) * 180,
                'y_coord' => 1100,
                'is_active' => true,
            ]);
        }

        // 6. ORGANIZATIONS (30 Kampus, 10 Industri, 5 Mitra, 1 Sponsor Khusus, 1 Sekolah)
        $campuses = [
            ['name' => 'Institut Teknologi Bandung (ITB)', 'city' => 'Bandung', 'pic' => 'Dr. Eng. Ayu Wulandari', 'email' => 'kampus@itb.ac.id', 'user' => 'kampus@itb.ac.id', 'booth' => 'B-01'],
            ['name' => 'Telkom University (Tel-U)', 'city' => 'Bandung', 'pic' => 'Dr. Bambang Setiawan, M.T.', 'email' => 'kampus@telkomuniversity.ac.id', 'user' => 'kampus@telkomuniversity.ac.id', 'booth' => 'B-02'],
            ['name' => 'Universitas Komputer Indonesia (UNIKOM)', 'city' => 'Bandung', 'pic' => 'Dr. Ir. Bobi Kurniawan', 'email' => 'kampus@unikom.ac.id', 'user' => 'kampus@unikom.ac.id', 'booth' => 'B-03'],
            ['name' => 'Universitas Padjadjaran (UNPAD)', 'city' => 'Jatinangor', 'pic' => 'Dr. Candra Wijaya', 'email' => 'pic@unpad.ac.id', 'booth' => 'B-04'],
            ['name' => 'Universitas Pendidikan Indonesia (UPI)', 'city' => 'Bandung', 'pic' => 'Dr. Dedi Rosadi', 'email' => 'pic@upi.edu', 'booth' => 'B-05'],
            ['name' => 'Politeknik Negeri Bandung (POLBAN)', 'city' => 'Bandung Barat', 'pic' => 'Ir. Eko Purwanto', 'email' => 'pic@polban.ac.id', 'booth' => 'B-06'],
            ['name' => 'Universitas Katolik Parahyangan (UNPAR)', 'city' => 'Bandung', 'pic' => 'Ferryanto, M.Sc.', 'email' => 'pic@unpar.ac.id', 'booth' => 'B-07'],
            ['name' => 'Universitas Pasundan (UNPAS)', 'city' => 'Bandung', 'pic' => 'Dr. Gilang Ramadhan', 'email' => 'pic@unpas.ac.id', 'booth' => 'B-08'],
            ['name' => 'Universitas Widyatama', 'city' => 'Bandung', 'pic' => 'Hadi Sucipto, M.Kom.', 'email' => 'pic@widyatama.ac.id', 'booth' => 'B-09'],
            ['name' => 'Institut Pertanian Bogor (IPB University)', 'city' => 'Bogor', 'pic' => 'Prof. Dr. Irfan Syarif', 'email' => 'pic@ipb.ac.id', 'booth' => 'B-10'],
            ['name' => 'Universitas Singaperbangsa Karawang (UNSIKA)', 'city' => 'Karawang', 'pic' => 'Joko Triyono, M.T.', 'email' => 'pic@unsika.ac.id', 'booth' => 'B-11'],
            ['name' => 'Universitas Siliwangi (UNSIL)', 'city' => 'Tasikmalaya', 'pic' => 'Kusnadi, M.Kom.', 'email' => 'pic@unsil.ac.id', 'booth' => 'B-12'],
            ['name' => 'UIN Sunan Gunung Djati Bandung', 'city' => 'Bandung', 'pic' => 'Dr. Lukman Hakim', 'email' => 'pic@uinsgd.ac.id', 'booth' => 'B-13'],
            ['name' => 'Universitas Kristen Maranatha', 'city' => 'Bandung', 'pic' => 'Maria Kristina, M.T.', 'email' => 'pic@maranatha.edu', 'booth' => 'B-14'],
            ['name' => 'Universitas Islam Bandung (UNISBA)', 'city' => 'Bandung', 'pic' => 'Nurul Huda, M.Kom.', 'email' => 'pic@unisba.ac.id', 'booth' => 'B-15'],
            ['name' => 'Universitas Swadaya Gunung Jati (UGJ)', 'city' => 'Cirebon', 'pic' => 'Oman Fathurohman', 'email' => 'pic@ugj.ac.id', 'booth' => 'B-16'],
            ['name' => 'Universitas Kuningan (UNIKU)', 'city' => 'Kuningan', 'pic' => 'Panji Nugraha, M.Kom.', 'email' => 'pic@uniku.ac.id', 'booth' => 'B-17'],
            ['name' => 'Universitas Majalengka (UNMA)', 'city' => 'Majalengka', 'pic' => 'Qoriatul Aini, M.T.', 'email' => 'pic@unma.ac.id', 'booth' => 'B-18'],
            ['name' => 'Universitas Galuh (UNIGAL)', 'city' => 'Ciamis', 'pic' => 'Rahmat Hidayat, M.Kom.', 'email' => 'pic@unigal.ac.id', 'booth' => 'B-19'],
            ['name' => 'Politeknik Manufaktur Bandung (POLMAN)', 'city' => 'Bandung', 'pic' => 'Soni Wicaksono, M.T.', 'email' => 'pic@polman-bandung.ac.id', 'booth' => 'B-20'],
            ['name' => 'Politeknik Pos Indonesia (ULBI)', 'city' => 'Bandung', 'pic' => 'Taufik Ridwan, M.T.', 'email' => 'pic@ulbi.ac.id', 'booth' => 'B-21'],
            ['name' => 'STMIK AMIK Bandung', 'city' => 'Bandung', 'pic' => 'Umar Said, M.Kom.', 'email' => 'pic@amikbandung.ac.id', 'booth' => 'B-22'],
            ['name' => 'STMIK IKMI Cirebon', 'city' => 'Cirebon', 'pic' => 'Vina Panduwinata, M.Kom.', 'email' => 'pic@ikmi.ac.id', 'booth' => 'B-23'],
            ['name' => 'Universitas Pakuan Bogor', 'city' => 'Bogor', 'pic' => 'Wahyu Hidayat, M.T.', 'email' => 'pic@unpak.ac.id', 'booth' => 'B-24'],
            ['name' => 'Universitas Ibn Khaldun Bogor', 'city' => 'Bogor', 'pic' => 'Xaverius Bram, M.Kom.', 'email' => 'pic@uika-bogor.ac.id', 'booth' => 'B-25'],
            ['name' => 'Universitas Presiden (President University)', 'city' => 'Bekasi', 'pic' => 'Yoga Pratama, Ph.D.', 'email' => 'pic@president.ac.id', 'booth' => 'B-26'],
            ['name' => 'Universitas Djuanda Bogor', 'city' => 'Bogor', 'pic' => 'Zulfikar Ali, M.T.', 'email' => 'pic@unida.ac.id', 'booth' => 'B-27'],
            ['name' => 'Universitas Muhammadiyah Sukabumi (UMMI)', 'city' => 'Sukabumi', 'pic' => 'Agus Priyono, M.Kom.', 'email' => 'pic@ummi.ac.id', 'booth' => 'B-28'],
            ['name' => 'Universitas Subang (UNSUB)', 'city' => 'Subang', 'pic' => 'Budi Santika, M.T.', 'email' => 'pic@unsub.ac.id', 'booth' => 'B-29'],
            ['name' => 'Universitas Garut (UNIGA)', 'city' => 'Garut', 'pic' => 'Cecep Ramdani, M.Kom.', 'email' => 'pic@uniga.ac.id', 'booth' => 'B-30'],
        ];

        $orgModels = [];

        foreach ($campuses as $c) {
            $slug = Str::slug($c['name']);
            $org = Organization::create([
                'event_id' => $event->id,
                'type' => 'campus',
                'name' => $c['name'],
                'slug' => $slug,
                'address' => "Kampus {$c['name']}, {$c['city']}, Jawa Barat",
                'city' => $c['city'],
                'website' => "https://{$slug}.ac.id",
                'logo' => null,
                'pic_name' => $c['pic'],
                'pic_position' => 'Ketua Jurusan / Dosen Pendamping',
                'pic_email' => $c['email'],
                'pic_phone' => '0812' . rand(10000000, 99999999),
                'pic_contact_public' => false,
                'status' => 'verified',
            ]);

            CampusProfile::create([
                'organization_id' => $org->id,
                'rector_name' => 'Rektor ' . $c['name'],
                'campus_type' => str_contains($c['name'], 'ITB') || str_contains($c['name'], 'UNPAD') || str_contains($c['name'], 'UPI') ? 'PTN' : 'PTS',
                'accreditation' => 'Unggul',
                'student_count' => rand(8000, 30000),
                'faculty_name' => 'Fakultas Teknologi Informasi / Ilmu Komputer',
            ]);

            // Allocate Booth (BR-05)
            if (isset($booths[$c['booth']])) {
                BoothAllocation::create([
                    'event_id' => $event->id,
                    'booth_id' => $booths[$c['booth']]->id,
                    'organization_id' => $org->id,
                    'status' => 'confirmed',
                    'allocated_at' => Carbon::now()->subDays(5),
                    'notes' => 'Alokasi booth standar 2 karya mahasiswa',
                ]);
            }

            // Membership link if user exists
            if (isset($c['user']) && isset($users[$c['user']])) {
                OrganizationMembership::create([
                    'organization_id' => $org->id,
                    'user_id' => $users[$c['user']]->id,
                    'role_in_org' => 'pic',
                    'is_active' => true,
                ]);
            }

            $orgModels[$slug] = $org;
        }

        // Link student user to ITB
        OrganizationMembership::create([
            'organization_id' => $orgModels['institut-teknologi-bandung-itb']->id,
            'user_id' => $users['tim@itb.ac.id']->id,
            'role_in_org' => 'student',
            'is_active' => true,
        ]);

        // 10 Industry Organizations
        $industries = [
            ['name' => 'PT Telkom Indonesia (Persero) Tbk', 'sector' => 'Telekomunikasi & Cloud', 'pic' => 'VP Innovation Telkom', 'email' => 'industri@telkom.co.id', 'user' => 'industri@telkom.co.id', 'booth' => 'I-01', 'is_sponsor' => true],
            ['name' => 'PT Bank Pembangunan Daerah Jawa Barat (Bank BJB)', 'sector' => 'Perbankan & Financial Technology', 'pic' => 'Divisi Corporate Secretary BJB', 'email' => 'sponsor@bankbjb.co.id', 'user' => 'sponsor@bankbjb.co.id', 'booth' => 'I-02', 'is_sponsor' => true],
            ['name' => 'PT Paragon Technology and Innovation', 'sector' => 'Consumer Goods & IoT Supply Chain', 'pic' => 'Head of Tech Innovation', 'email' => 'tech@paragon-corp.com', 'booth' => 'I-03', 'is_sponsor' => false],
            ['name' => 'PT Pos Indonesia (Persero)', 'sector' => 'Logistik Digital & Smart Delivery', 'pic' => 'VP Digital Transformation', 'email' => 'digital@posindonesia.co.id', 'booth' => 'I-04', 'is_sponsor' => false],
            ['name' => 'PT Len Industri (Persero)', 'sector' => 'Elektronika Pertahanan & Smart Transportation', 'pic' => 'GM R&D Len Industri', 'email' => 'rnd@len.co.id', 'booth' => 'I-05', 'is_sponsor' => false],
            ['name' => 'PT Bio Farma (Persero)', 'sector' => 'Healthcare Biotech & Digital Health', 'pic' => 'Head of Healthcare Tech', 'email' => 'healthtech@biofarma.co.id', 'booth' => 'I-06', 'is_sponsor' => false],
            ['name' => 'Dicoding Indonesia', 'sector' => 'EdTech & Software Developer Platform', 'pic' => 'Partnership Lead Dicoding', 'email' => 'partner@dicoding.com', 'booth' => 'I-07', 'is_sponsor' => false],
            ['name' => 'eFishery (PT Koltiva / Akur Maha)', 'sector' => 'AgriTech & Aquaculture IoT', 'pic' => 'VP Engineering eFishery', 'email' => 'eng@efishery.com', 'booth' => 'I-08', 'is_sponsor' => false],
            ['name' => 'Agate International', 'sector' => 'Game Development & Interactive VR', 'pic' => 'Head of Studio Agate', 'email' => 'business@agate.id', 'booth' => 'I-09', 'is_sponsor' => false],
            ['name' => 'Jabar Digital Service (JDS)', 'sector' => 'Government Tech & Smart Province', 'pic' => 'Chief of Data JDS Diskominfo', 'email' => 'partnership@digital.jabarprov.go.id', 'booth' => 'I-10', 'is_sponsor' => false],
        ];

        foreach ($industries as $ind) {
            $slug = Str::slug($ind['name']);
            $org = Organization::create([
                'event_id' => $event->id,
                'type' => 'industry',
                'name' => $ind['name'],
                'slug' => $slug,
                'address' => "Kantor Pusat {$ind['name']}, Bandung / Jawa Barat",
                'city' => 'Bandung',
                'website' => "https://{$slug}.co.id",
                'logo' => null,
                'pic_name' => $ind['pic'],
                'pic_position' => 'Head of Technology / Business Lead',
                'pic_email' => $ind['email'],
                'pic_phone' => '0813' . rand(10000000, 99999999),
                'pic_contact_public' => true,
                'status' => 'verified',
            ]);

            CompanyProfile::create([
                'organization_id' => $org->id,
                'sector' => $ind['sector'],
                'profile_summary' => "Pemimpin ekosistem industri {$ind['sector']} yang berkomitmen menyerap talenta dan inovasi kampus Jawa Barat.",
                'solutions_offered' => 'Infrastruktur Cloud, API Gateway, Program Inkubasi, Co-Development, Pilot Project Implementation.',
                'collaboration_needs' => 'Teknologi AI/ML Computer Vision, Solusi IoT Terintegrasi, Automasi Bisnis, dan Talenta Digital Siap Pakai.',
                'is_exhibitor' => true,
                'is_sponsor' => $ind['is_sponsor'],
            ]);

            // Allocate Booth (BR-04, BR-05)
            if (isset($booths[$ind['booth']])) {
                BoothAllocation::create([
                    'event_id' => $event->id,
                    'booth_id' => $booths[$ind['booth']]->id,
                    'organization_id' => $org->id,
                    'status' => 'confirmed',
                    'allocated_at' => Carbon::now()->subDays(3),
                    'notes' => 'Booth Korporat & Showcase Solusi Industri',
                ]);
            }

            if (isset($ind['user']) && isset($users[$ind['user']])) {
                OrganizationMembership::create([
                    'organization_id' => $org->id,
                    'user_id' => $users[$ind['user']]->id,
                    'role_in_org' => 'pic',
                    'is_active' => true,
                ]);
            }

            $orgModels[$slug] = $org;
        }

        // 5 Partner Organizations
        $partners = [
            ['name' => 'KADIN Jawa Barat', 'city' => 'Bandung', 'pic' => 'Ketua Komite Tetap ICT KADIN', 'booth' => 'M-01'],
            ['name' => 'Bandung Digital Valley (BDV)', 'city' => 'Bandung', 'pic' => 'Community Manager BDV', 'booth' => 'M-02'],
            ['name' => 'APJII Pengwil Jawa Barat', 'city' => 'Bandung', 'pic' => 'Sekretaris APJII Jabar', 'booth' => 'M-03'],
            ['name' => 'Relawan TIK Jawa Barat', 'city' => 'Bandung', 'pic' => 'Ketua Pengurus RTIK Jabar', 'booth' => 'M-04'],
            ['name' => 'Asosiasi Game Indonesia (AGI) Jabar', 'city' => 'Bandung', 'pic' => 'Koordinator Wilayah AGI', 'booth' => 'M-05'],
        ];

        foreach ($partners as $p) {
            $slug = Str::slug($p['name']);
            $org = Organization::create([
                'event_id' => $event->id,
                'type' => 'partner',
                'name' => $p['name'],
                'slug' => $slug,
                'address' => "Sekretariat {$p['name']}, Bandung",
                'city' => $p['city'],
                'website' => "https://{$slug}.org",
                'pic_name' => $p['pic'],
                'pic_position' => 'Pengurus Asosiasi / Mitra',
                'pic_email' => "kontak@{$slug}.org",
                'pic_phone' => '0818' . rand(10000000, 99999999),
                'pic_contact_public' => true,
                'status' => 'verified',
            ]);

            if (isset($booths[$p['booth']])) {
                BoothAllocation::create([
                    'event_id' => $event->id,
                    'booth_id' => $booths[$p['booth']]->id,
                    'organization_id' => $org->id,
                    'status' => 'confirmed',
                    'allocated_at' => Carbon::now()->subDays(2),
                    'notes' => 'Booth Mitra Strategis & Asosiasi',
                ]);
            }

            $orgModels[$slug] = $org;
        }

        // 1 School Organization
        $schoolOrg = Organization::create([
            'event_id' => $event->id,
            'type' => 'school',
            'name' => 'SMKN 4 Bandung',
            'slug' => 'smkn-4-bandung',
            'address' => 'Jl. Kliningan No. 6, Buahbatu, Kota Bandung',
            'city' => 'Bandung',
            'website' => 'https://smkn4bdg.sch.id',
            'pic_name' => 'Dra. Endang Sulastri',
            'pic_position' => 'Wakil Kepala Sekolah Bidang Humas & Hubin',
            'pic_email' => 'sekolah@smkn4bdg.sch.id',
            'pic_phone' => '081240000001',
            'pic_contact_public' => false,
            'status' => 'verified',
        ]);

        SchoolProfile::create([
            'organization_id' => $schoolOrg->id,
            'school_type' => 'SMK',
            'principal_name' => 'Dr. H. Asep Tapip Yani, M.Pd.',
            'total_students_group' => 80,
            'total_teachers_group' => 6,
            'visit_purpose' => 'Eksplorasi Inovasi Digital Kampus & Pengenalan Program Studi Informatika untuk Siswa RPL, TKJ, dan SIJA.',
        ]);

        OrganizationMembership::create([
            'organization_id' => $schoolOrg->id,
            'user_id' => $users['sekolah@smkn4bdg.sch.id']->id,
            'role_in_org' => 'pic',
            'is_active' => true,
        ]);

        // 7. 60 KARYA MAHASISWA (2 karya per booth kampus, BR-03)
        // 10 di antaranya Pitching Finalists
        $projectsList = [
            // ITB (Booth B-01)
            [
                'campus' => 'institut-teknologi-bandung-itb',
                'booth' => 'B-01',
                'title' => 'AgriSense AI: Edge IoT & Computer Vision for Smart Paddy Monitoring',
                'category' => 'AI/IoT',
                'readiness' => 'Prototipe Teruji (TRL 6)',
                'problem' => 'Petani Jawa Barat sering mengalami gagal panen hingga 35% akibat hama wereng dan kekeringan air irigasi yang terlambat terdeteksi.',
                'target' => 'Kelompok tani padi, Dinas Tanaman Pangan dan Hortikultura Jabar, pengelola irigasi pintar.',
                'solution' => 'Perangkat Edge AI bertenaga surya dengan sensor kelembaban multi-depth dan kamera deteksi optik hama berbasis YOLOv8 lokal.',
                'features' => 'Deteksi otomatis wereng coklat & penggerek batang, automasi katup air irigasi via LoRaWAN, dashboard mobile notifikasi real-time.',
                'tech' => 'ESP32, Raspberry Pi Edge, PyTorch, LoRaWAN, Flutter, Laravel 12 API',
                'tests' => 'Telah diuji pada 5 hektar sawah percontohan di Rancaekek dengan akurasi deteksi hama 94.2% dan efisiensi air 28%.',
                'limits' => 'Jangkauan kamera optimal pada radius 12 meter dan membutuhkan pembersihan lensa berkala setiap 2 minggu.',
                'demo' => 'https://agrisense.itb.ac.id/demo',
                'collab' => 'Membutuhkan kemitraan industri agritech untuk fabrikasi massal casing tahan cuaca ekstrem dan pendanaan uji lapangan multi-region.',
                'is_pitch' => true,
                'pitch_order' => 1,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Tim Ganendra AgroTech ITB',
                'leader' => 'Rian Pratama',
            ],
            [
                'campus' => 'institut-teknologi-bandung-itb',
                'booth' => 'B-01',
                'title' => 'NeuroStroke: Portable AI Tele-rehabilitation & EMG Glove',
                'category' => 'HealthTech',
                'readiness' => 'Prototipe Teruji (TRL 5)',
                'problem' => 'Pasien pasca-stroke di daerah rural Jawa Barat kesulitan mengakses fisioterapi rutin karena keterbatasan terapis dan jarak RS rujukan.',
                'target' => 'Pasien rehabilitasi stroke fase pemulihan, dokter spesialis kedokteran fisik dan rehabilitasi (Sp.KFR).',
                'solution' => 'Sarung tangan sensorik EMG dan bending fleksibel yang terhubung ke aplikasi gamifikasi pemulihan motorik berbasis tele-monitoring.',
                'features' => 'Sensor fleksi 5 jari, real-time EMG biofeedback, 8 mini-games terapi adiktif, dashboard analisis perkembangan sudut gerak untuk dokter.',
                'tech' => 'Bio-EMG Sensor, BLE 5.0, Unity Mobile, Node.js WebSocket, PostgreSQL',
                'tests' => 'Uji klinis awal terhadap 12 pasien di RS Hasan Sadikin menunjukkan peningkatan kepatuhan latihan mandiri sebesar 70%.',
                'limits' => 'Daya tahan baterai sarung tangan saat ini sekitar 4 jam operasi intensif dan membutuhkan kalibrasi awal setiap pengguna.',
                'demo' => 'https://neurostroke.itb.ac.id',
                'collab' => 'Mencari mitra produsen alat kesehatan untuk uji sertifikasi Kemenkes dan kerjasama uji klinis fase lanjutan.',
                'is_pitch' => true,
                'pitch_order' => 2,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Tim Bionika Medika ITB',
                'leader' => 'Nabila Putri Santoso',
            ],

            // Telkom University (Booth B-02)
            [
                'campus' => 'telkom-university-tel-u',
                'booth' => 'B-02',
                'title' => 'CitarumGuard: Smart Autonomous Drone & River Pollution Indexer',
                'category' => 'Smart City',
                'readiness' => 'Prototipe Teruji (TRL 6)',
                'problem' => 'Pencemaran limbah industri cair di DAS Sungai Citarum sering terjadi pada malam hari secara sporadis dan sulit dilacak sumbernya.',
                'target' => 'Satgas Citarum Harum, Dinas Lingkungan Hidup Jabar, komunitas peduli sungai.',
                'solution' => 'Drone otonom patroli terjadwal dengan kamera multispektral dan perahu pelampung mini pembaca pH, DO, TDS, serta temperatur terintegrasi satelit.',
                'features' => 'Waypoint patroli otonom 15 km, geo-tagging anomali warna air limbah, deteksi tumpahan oli dengan CNN, transmisi GSM 4G & Satelit Iridium.',
                'tech' => 'Pixhawk 4, Jetson Orin Nano, OpenCV, Multispectral Sensor, Cloud Telemetry',
                'tests' => 'Uji terbang 40 kali di wilayah Majalaya berhasil mengidentifikasi 8 titik pembuangan pipa siluman.',
                'limits' => 'Kemampuan terbang terbatasi jika curah hujan ekstrem di atas 40 mm/jam.',
                'demo' => 'https://citarumguard.telkomuniversity.ac.id',
                'collab' => 'Mencari integrasi dengan Command Center Diskominfo Jabar dan sponsor pengadaan armada drone.',
                'is_pitch' => true,
                'pitch_order' => 3,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'AeroVision Lab Tel-U',
                'leader' => 'Faisal Akbar',
            ],
            [
                'campus' => 'telkom-university-tel-u',
                'booth' => 'B-02',
                'title' => 'PasarLink: Blockchain Decentralized Micro-Finance for Traditional Merchants',
                'category' => 'FinTech',
                'readiness' => 'Prototipe Teruji (TRL 5)',
                'problem' => 'Pedagang pasar tradisional di Jawa Barat terjebak rentenir dengan bunga harian hingga 20% karena ketiadaan riwayat kredit formal (unbanked).',
                'target' => 'Pedagang pasar tradisional, koperasi simpan pinjam pasar, bank pembangunan daerah.',
                'solution' => 'Sistem pencatatan transaksi harian berbasis QRIS suara interaktif yang menghasilkan skor kelayakan kredit berbasis on-chain zero-knowledge.',
                'features' => 'Smart speaker konfirmasi QRIS suara bilingual Sunda-Indonesia, credit scoring transparan, pencairan micro-loan instan tanpa jaminan fisik.',
                'tech' => 'Solana Smart Contracts, Rust, React Native, AWS Lambda, OCR Struk',
                'tests' => 'Pilot test di Pasar Kosambi Bandung dengan 45 pedagang menghasilkan 1.200 transaksi tercatat tanpa kredit macet selama 3 bulan.',
                'limits' => 'Bergantung pada ketersediaan sinyal seluler kasir pedagang.',
                'demo' => 'https://pasarlink.telkomuniversity.ac.id',
                'collab' => 'Mencari kemitraan Bank BJB untuk penyaluran KUR mikro terintegrasi.',
                'is_pitch' => false,
                'pitch_order' => null,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Tim Fintech Rakyat Tel-U',
                'leader' => 'Aditya Nugraha',
            ],

            // UNIKOM Bandung (Booth B-03)
            [
                'campus' => 'universitas-komputer-indonesia-unikom',
                'booth' => 'B-03',
                'title' => 'RoboTrash AI: Autonomous Indoor Sorting Robot with Robotic Arm',
                'category' => 'AI/IoT',
                'readiness' => 'Prototipe Teruji (TRL 6)',
                'problem' => 'Pemisahan sampah organik, anorganik, dan B3 di fasilitas umum kampus dan mal sering gagal karena kepatuhan masyarakat rendah.',
                'target' => 'Pengelola gedung perkantoran, universitas, stasiun KAI, pusat perbelanjaan.',
                'solution' => 'Robot otonom pemilah sampah dengan lengan robotik 4-DOF dan visi komputer multimodal yang langsung memilah saat pengunjung membuang.',
                'features' => 'Klasifikasi 32 jenis sampah dalam 0.8 detik, kompresor otomatis penampung botol, navigasi LiDAR SLAM mandiri, self-docking charger.',
                'tech' => 'ROS 2 Humble, NVIDIA Jetson, YOLOv9, LiDAR RPLIDAR A2, DC Planetary Motors',
                'tests' => 'Dioperasikan di lobby Smart Building UNIKOM selama 60 hari dengan akurasi sortir sampah 96.8%.',
                'limits' => 'Lengan robot belum mampu mengangkat benda basah bermassa lebih dari 1.5 kg.',
                'demo' => 'https://robotics.unikom.ac.id/robotrash',
                'collab' => 'Kemitraan investor manufaktur mekanik dan uji coba di Stasiun Whoosh KCIC.',
                'is_pitch' => true,
                'pitch_order' => 4,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Tim Robotika Juara UNIKOM',
                'leader' => 'Kevin Sanjaya',
            ],
            [
                'campus' => 'universitas-komputer-indonesia-unikom',
                'booth' => 'B-03',
                'title' => 'HeritageVR: Metaverse Budaya Sunda & Museum Virtual Angklung Udjo',
                'category' => 'Creative Media',
                'readiness' => 'Produksi Terbatas (TRL 7)',
                'problem' => 'Minat generasi muda terhadap seni tradisi Jawa Barat seperti Wayang Golek dan Angklung menurun karena media konservasi konvensional kurang interaktif.',
                'target' => 'Pelajar sekolah, wisatawan mancanegara, museum daerah, sanggar seni budaya.',
                'solution' => 'Platform virtual reality interaktif di mana pengguna dapat memainkan angklung virtual dengan pelacakan gestur tangan tanpa controller.',
                'features' => 'Haptic feedback spatial audio 3D, tutorial interaktif tangga nada pentatonik Sunda, multiplayer orkestra angklung virtual lintas negara.',
                'tech' => 'Unreal Engine 5, Meta Quest OpenXR, WebXR, Spatial Audio API',
                'tests' => 'Telah dicoba oleh lebih dari 1.500 pengunjung Saung Angklung Udjo dengan kepuasan impresi 95%.',
                'limits' => 'Membutuhkan headset VR 6-DOF (Oculus Quest 2/3 atau Pico 4) untuk pengalaman optimal.',
                'demo' => 'https://heritagevr.unikom.ac.id',
                'collab' => 'Kerjasama Dinas Pariwisata dan Kebudayaan Jabar untuk pengadaan di 50 sekolah percontohan.',
                'is_pitch' => false,
                'pitch_order' => null,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Divisi Multimedia Animasi UNIKOM',
                'leader' => 'Siti Fatimah',
            ],

            // UNPAD (Booth B-04)
            [
                'campus' => 'universitas-padjadjaran-unpad',
                'booth' => 'B-04',
                'title' => 'StuntingZero: AI Early Childhood Growth Predictor & Nutrition Guide',
                'category' => 'HealthTech',
                'readiness' => 'Prototipe Teruji (TRL 6)',
                'problem' => 'Angka stunting di Jawa Barat masih berada di kisaran 20%, dengan keterbatasan alat ukur antropometri digital di posyandu pelosok.',
                'target' => 'Kader Posyandu, Puskesmas, BKKBN Jawa Barat, ibu balita.',
                'solution' => 'Aplikasi kamera foto berbasis computer vision yang menghitung tinggi badan balita secara presisi hanya dengan kartu kalibrasi standar.',
                'features' => 'Estimasi panjang badan akurasi 98.5% tanpa pita ukur fisik, analisis asupan gizi lokal khas Sunda, warning early detection kurva WHO.',
                'tech' => 'TensorFlow Lite, Kotlin, Python FastAPI, Cloud Run, Supabase',
                'tests' => 'Divalidasi pada 300 balita di Puskesmas Jatinangor dibandingkan alat ukur stadiometer medis resmi.',
                'limits' => 'Membutuhkan pencahayaan ruangan minimal 200 lux saat pengambilan foto balita.',
                'demo' => 'https://stuntingzero.unpad.ac.id',
                'collab' => 'Adopsi resmi oleh Dinas Kesehatan Jabar dan sponsor pengadaan smartphone untuk kader posyandu.',
                'is_pitch' => true,
                'pitch_order' => 5,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Tim Padjadjaran Inovasi Kesehatan',
                'leader' => 'Dewi Anggraeni',
            ],
            [
                'campus' => 'universitas-padjadjaran-unpad',
                'booth' => 'B-04',
                'title' => 'GreenTrace: Life Cycle Assessment & Carbon Footprint for MSME Garment',
                'category' => 'Smart City',
                'readiness' => 'Prototipe Teruji (TRL 5)',
                'problem' => 'UMKM konveksi & garmen di Majalaya dan Soreang dituntut memenuhi syarat audit jejak karbon ekspor namun tidak sanggup membayar konsultan mahal.',
                'target' => 'UMKM garmen dan tekstil, eksportir fesyen lokal, kementerian perindustrian.',
                'solution' => 'SaaS kalkulator emisi karbon terotomasi berbasis data input bahan baku, listrik, dan logistik lokal dengan sertifikat digital blockchain.',
                'features' => 'Rekomendasi optimasi rantai pasok rendah emisi, cetak sertifikat QR jejak karbon garmen, integrasi standar GHG Protocol.',
                'tech' => 'Laravel 12, Tailwind CSS, Vue 3, Polygon Network Smart Contract',
                'tests' => 'Digunakan oleh 18 pengrajin rajut Binong Jati dengan penghematan emisi rata-rata 14%.',
                'limits' => 'Database koefisien emisi saat ini terfokus pada industri tekstil dan garmen lokal.',
                'demo' => 'https://greentrace.unpad.ac.id',
                'collab' => 'Kerjasama dengan KADIN Jabar dan asosiasi ekspor produk tekstil.',
                'is_pitch' => false,
                'pitch_order' => null,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Green Economy Lab UNPAD',
                'leader' => 'Rizki Fauzi',
            ],

            // UPI (Booth B-05)
            [
                'campus' => 'universitas-pendidikan-indonesia-upi',
                'booth' => 'B-05',
                'title' => 'AksaraAI: Interactive Sundanese Script Handwriting OCR & Adaptive Tutor',
                'category' => 'EdTech',
                'readiness' => 'Prototipe Teruji (TRL 6)',
                'problem' => 'Generasi muda semakin kesulitan membaca dan menulis Aksara Sunda kuno, sedangkan kurikulum muatan lokal kekurangan media pembelajaran cerdas.',
                'target' => 'Guru dan siswa SD-SMP di Jawa Barat, pegiat pelestari budaya Sunda.',
                'solution' => 'Aplikasi tablet edukatif dengan AI pengenal goresan tulisan tangan Aksara Sunda secara real-time disertai umpan balik koreksi goresan.',
                'features' => 'Koreksi goresan stroke-by-stroke, pengenalan aksara ngalagena, rarangken, dan angka, gamifikasi kuis petualangan Pasundan.',
                'tech' => 'CNN Handwriting Recognition, ONNX Runtime Mobile, Flutter, SQLite',
                'tests' => 'Diujicobakan pada 500 siswa di 4 SMP Kota Bandung dengan peningkatan nilai ulangan aksara 42%.',
                'limits' => 'Optimal pada layar sentuh dengan stylus atau jari berukuran standar.',
                'demo' => 'https://aksarasunda.upi.edu',
                'collab' => 'Integrasi ke Kurikulum Merdeka Disdik Jabar dan penerbit buku sekolah.',
                'is_pitch' => true,
                'pitch_order' => 6,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Laboratorium EduTech UPI',
                'leader' => 'Annisa Rahmawati',
            ],
            [
                'campus' => 'universitas-pendidikan-indonesia-upi',
                'booth' => 'B-05',
                'title' => 'SimuLab AR: Low-Cost Augmented Reality Physics Experiment for Remote Schools',
                'category' => 'EdTech',
                'readiness' => 'Prototipe Teruji (TRL 6)',
                'problem' => 'Sekolah menengah di daerah 3T Jawa Barat Selatan tidak memiliki laboratorium fisika dan kimia memadai untuk praktikum gelombang dan optik.',
                'target' => 'SMA/SMK di daerah pelosok, dinas pendidikan kabupaten.',
                'solution' => 'Alat peraga AR berbasis marker kartu murah yang dapat memvisualisasikan medan magnet, pembiasan cahaya, dan gerak parabola secara 3D.',
                'features' => 'Simulasi interaktif tanpa bahan kimia berbahaya, jalan tanpa koneksi internet (offline-first), panduan modul LKS terintegrasi.',
                'tech' => 'ARCore, Unity, C#, Local Cache Database',
                'tests' => 'Uji coba di 6 SMA di Kabupaten Cianjur Selatan dengan respon antusiasme 92%.',
                'limits' => 'Membutuhkan smartphone Android dengan dukungan sensor giroskop.',
                'demo' => 'https://simulab.upi.edu',
                'collab' => 'Distribusi gratis ke 100 sekolah daerah 3T dengan dukungan CSR BUMN.',
                'is_pitch' => false,
                'pitch_order' => null,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Fisika Inovatif UPI',
                'leader' => 'Bagas Wicaksono',
            ],

            // POLBAN (Booth B-06)
            [
                'campus' => 'politeknik-negeri-bandung-polban',
                'booth' => 'B-06',
                'title' => 'SmartSolarMicrogrid: AI Peak-Shaving & Battery Optimization for Industry',
                'category' => 'AI/IoT',
                'readiness' => 'Prototipe Teruji (TRL 6)',
                'problem' => 'Pabrik industri di kawasan industri Karawang dan Cikarang menanggung tagihan daya puncak listrik PLN yang mahal saat jam operasional 17.00 - 22.00.',
                'target' => 'Manajer energi pabrik, industri manufaktur tekstil dan komponen otomotif.',
                'solution' => 'Kontroler cerdas berbasis algoritma prediksi beban LSTM yang mengatur switching baterai PLTS atap secara otomatis untuk memotong daya puncak.',
                'features' => 'Prediksi cuaca & iradiasi surya 24 jam ke depan, otomatisasi switching relai daya tinggi, dashboard SCADA berbasis cloud.',
                'tech' => 'Modbus RTU, ESP32-S3, Python TensorFlow, Grafana, InfluxDB, Docker',
                'tests' => 'Telah dipasang di workshop manufaktur POLBAN dengan penghematan biaya listrik bulanan sebesar 22.4%.',
                'limits' => 'Kapasitas switching unit uji coba saat ini maksimal pada arus 100 Ampere 3-fase.',
                'demo' => 'https://microgrid.polban.ac.id',
                'collab' => 'Pilot project di pabrik kawasan industri KIIC Karawang.',
                'is_pitch' => true,
                'pitch_order' => 7,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Pusat Riset Energi Terbarukan POLBAN',
                'leader' => 'Danang Prasetyo',
            ],
            [
                'campus' => 'politeknik-negeri-bandung-polban',
                'booth' => 'B-06',
                'title' => 'MachinaVision: High-Speed Edge Defect Inspection for Conveyor Line',
                'category' => 'AI/IoT',
                'readiness' => 'Prototipe Teruji (TRL 6)',
                'problem' => 'Pemeriksaan cacat fisik botol dan kemasan makanan di industri FMCG masih mengandalkan mata manusia yang rentan kelelahan setelah 2 jam kerja.',
                'target' => 'Industri manufaktur makanan & minuman, kemasan farmasi.',
                'solution' => 'Sistem vision kamera berkecepatan tinggi dengan pencahayaan stroboskopik dan model deteksi anomali real-time 120 botol/menit.',
                'features' => 'Deteksi cacat tutup miring, retak mikro, dan volume cairan di bawah standar, aktuator penolak pneumatik instan.',
                'tech' => 'Industrial GigE Camera, NVIDIA Jetson Xavier, TensorRT, PLC Siemens S7-1200',
                'tests' => 'Uji kecepatan 2 botol per detik dengan false negative di bawah 0.2%.',
                'limits' => 'Membutuhkan kalibrasi ulang jika varian botol berganti dimensi secara signifikan.',
                'demo' => 'https://machinavision.polban.ac.id',
                'collab' => 'Kerjasama implementasi lini produksi pabrik Bio Farma atau Paragon.',
                'is_pitch' => false,
                'pitch_order' => null,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Otomasi Industri POLBAN',
                'leader' => 'Dimas Arya',
            ],

            // IPB University (Booth B-10)
            [
                'campus' => 'institut-pertanian-bogor-ipb-university',
                'booth' => 'B-10',
                'title' => 'SmartPoultry: Acoustic & Computer Vision Welfare Monitor for Broiler Chicken',
                'category' => 'AI/IoT',
                'readiness' => 'Prototipe Teruji (TRL 6)',
                'problem' => 'Kematian ayam pedaging akibat heat stress dan gangguan pernapasan infeksius di kandang closed-house sering terlambat diketahui peternak.',
                'target' => 'Peternak unggas modern, integrator perunggasan Jawa Barat (Bogor, Subang, Ciamis).',
                'solution' => 'Sistem AI pemantau suara batuk ayam (bioakustik) dan densitas persebaran gerak ayam menggunakan kamera thermal-RGB terintegrasi.',
                'features' => 'Deteksi dini penyakit Newcastle Disease dan bronkitis dari spektrum suara, automasi kipas exhaust kandang, estimasi bobot ayam harian.',
                'tech' => 'Thermal Camera FLIR, Mel-Frequency Cepstral Coefficients (MFCC), Edge TPU, Node-RED',
                'tests' => 'Diuji pada populasi 20.000 ayam di Subang dengan penurunan angka mortalitas dari 4.8% menjadi 1.9%.',
                'limits' => 'Mikrofon directional memerlukan proteksi debu sekam bulu ayam berkala.',
                'demo' => 'https://smartpoultry.ipb.ac.id',
                'collab' => 'Kemitraan integrasi sensor dengan pabrik pakan dan kandang percontohan Pemprov Jabar.',
                'is_pitch' => true,
                'pitch_order' => 8,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'IPB Precision Livestock Team',
                'leader' => 'Fadhil Muhammad',
            ],
            [
                'campus' => 'institut-pertanian-bogor-ipb-university',
                'booth' => 'B-10',
                'title' => 'KopiTrace: AI Near-Infrared Bean Sorter & Origin Authentication for West Java Java Preanger',
                'category' => 'AI/IoT',
                'readiness' => 'Prototipe Teruji (TRL 5)',
                'problem' => 'Kopi specialty Java Preanger sering dicampur biji cacat (defect) atau biji daerah lain sehingga menurunkan nilai jual ekspor petani.',
                'target' => 'Koperasi petani kopi Jawa Barat (Pangalengan, Ciwidey, Puntang), roastery, eksportir kopi.',
                'solution' => 'Alat sortir biji kopi portabel dengan spektroskopi NIR mini dan algoritma machine learning pemilah biji cacat dan kadar air instan.',
                'features' => 'Analisis kadar air dan defect dalam 3 detik, paspor digital asal kebun berbasis geo-tagging, sertifikasi mutu digital.',
                'tech' => 'NIR Spectral Sensor, Raspberry Pi 4, LightGBM, React Native Mobile',
                'tests' => 'Uji pada 100 sampel green beans kopi Puntang dengan akurasi klasifikasi grade specialty 93.5%.',
                'limits' => 'Sampel harus berada dalam wadah transparan tanpa pantulan cahaya luar berlebih.',
                'demo' => 'https://kopitrace.ipb.ac.id',
                'collab' => 'Mencari kemitraan asosiasi specialty coffee dan Dinas Perkebunan Jawa Barat.',
                'is_pitch' => false,
                'pitch_order' => null,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Agro-Robotics IPB',
                'leader' => 'Hana Lestari',
            ],

            // UNPAR (Booth B-07)
            [
                'campus' => 'universitas-katolik-parahyangan-unpar',
                'booth' => 'B-07',
                'title' => 'StructuralHealth: Wireless LoRa Accelerometer Network for Heritage Buildings',
                'category' => 'Smart City',
                'readiness' => 'Prototipe Teruji (TRL 6)',
                'problem' => 'Gedung bersejarah heritage di Kota Bandung rentan retak dan degradasi struktur akibat getaran lalu lintas padat dan gempa bumi sesar Lembang.',
                'target' => 'Dinas Cagar Budaya Kota Bandung, pengelola Gedung Sate, Bank Indonesia, ITB heritage.',
                'solution' => 'Jaringan sensor akselerometer ultra-presisi nirkabel LoRaWAN berdaya baterai 3 tahun yang mendeteksi anomali frekuensi natural gedung.',
                'features' => 'Sensor getaran tri-axial MEMS 24-bit, analisis Fast Fourier Transform (FFT) on-edge, sistem alarm dini pergeseran struktur mikro.',
                'tech' => 'MEMS Accelerometer ADXL355, LoRaWAN 915MHz, Python SciPy, Web Dashboard GIS 3D',
                'tests' => 'Dipasang di menara Gedung Rektorat UNPAR dan Gedung Merdeka selama 6 bulan pemantauan getaran.',
                'limits' => 'Sensor harus dilekatkan pada pilar utama struktur beton atau baja.',
                'demo' => 'https://structuralhealth.unpar.ac.id',
                'collab' => 'Implementasi di Gedung Sate dan Gedung Indonesia Menggugat.',
                'is_pitch' => true,
                'pitch_order' => 9,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Civil & Computer Science Collaboration UNPAR',
                'leader' => 'Ignatius Mario',
            ],
            [
                'campus' => 'universitas-katolik-parahyangan-unpar',
                'booth' => 'B-07',
                'title' => 'CivicVoice: NLP Sentiment Analysis for Public Policy Consultation Jabar',
                'category' => 'Smart City',
                'readiness' => 'Prototipe Teruji (TRL 5)',
                'problem' => 'Pemerintah daerah kewalahan membaca ribuan aspirasi dan keluhan masyarakat di media sosial mengenai transportasi publik dan bansos.',
                'target' => 'Bappeda Jabar, Diskominfo Jabar, DPRD Provinsi.',
                'solution' => 'Engine NLP berbahasa Indonesia dan dialek Sunda yang mengelompokkan aspirasi publik ke dalam topik prioritas dan sentimen urgensi.',
                'features' => 'Scraping resmi Twitter/X, Instagram, dan SP4N Lapor, deteksi hoax otomatis, visualisasi heatmap isu per kabupaten/kota.',
                'tech' => 'IndoBERT Fine-Tuned, Transformers, FastAPI, Elasticsearch, Kibana',
                'tests' => 'Memproses 250.000 komentar isu kemacetan Bandung Raya dengan akurasi sentimen 89%.',
                'limits' => 'Bergantung pada ketersediaan API pihak ketiga media sosial.',
                'demo' => 'https://civicvoice.unpar.ac.id',
                'collab' => 'Adopsi di Jabar Digital Service Command Center.',
                'is_pitch' => false,
                'pitch_order' => null,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Data Science Parahyangan',
                'leader' => 'Jessica Tanuwijaya',
            ],

            // UNSIKA Karawang (Booth B-11)
            [
                'campus' => 'universitas-singaperbangsa-karawang-unsika',
                'booth' => 'B-11',
                'title' => 'LogisTrack AI: Smart Warehouse Pallet RFID & Autonomous Mobile Robot (AMR)',
                'category' => 'AI/IoT',
                'readiness' => 'Prototipe Teruji (TRL 6)',
                'problem' => 'Pusat logistik e-commerce dan gudang kawasan industri Karawang sering mengalami salah letak barang (misplacement) yang memakan waktu pencarian hingga 40 menit per pesanan.',
                'target' => 'Pengelola gudang 3PL, pabrik otomotif Karawang, logistik e-commerce.',
                'solution' => 'Robot forklift mini otomatis (AMR) dengan pembaca RFID jarak jauh yang memperbarui peta lokasi stok 3D gudang secara real-time.',
                'features' => 'Pemetaan SLAM 2D/3D tanpa strip magnet lantai, pemindaian 100 pallet per menit, kalkulasi rute picking tercepat berbasis algoritma Dijkstra dinamis.',
                'tech' => 'UHF RFID Reader, ROS 2, Stereo Camera, Python, Fleet Management Server',
                'tests' => 'Uji operasi di gudang logistik seluas 2.000 m2 di KIIC Karawang dengan akurasi pencatatan inventaris 99.7%.',
                'limits' => 'Daya angkut beban robot saat ini maksimal 150 kg per rak.',
                'demo' => 'https://logistrack.unsika.ac.id',
                'collab' => 'Kemitraan PT Pos Indonesia atau pergudangan e-commerce nasional.',
                'is_pitch' => true,
                'pitch_order' => 10,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Tim Otomasi Logistik UNSIKA',
                'leader' => 'Kurnia Ramadhan',
            ],
            [
                'campus' => 'universitas-singaperbangsa-karawang-unsika',
                'booth' => 'B-11',
                'title' => 'PaddyYield: Satellite Multispectral Early Yield Forecasting for Karawang Granary',
                'category' => 'AI/IoT',
                'readiness' => 'Prototipe Teruji (TRL 5)',
                'problem' => 'Prediksi cadangan beras nasional di lumbung padi Karawang sering meleset akibat anomali cuaca El Nino, memicu spekulasi harga beras.',
                'target' => 'Bulog, Dinas Pertanian Karawang, Kementerian Pertanian.',
                'solution' => 'Platform prediksi hasil panen padi 45 hari sebelum panen dengan integrasi citra satelit Sentinel-2 dan pemodelan machine learning indeks vegetasi NDVI/EVI.',
                'features' => 'Peta prediksi tonase per kecamatan, peringatan dini defisit beras, estimasi tanggal panen raya optimal.',
                'tech' => 'Google Earth Engine API, Sentinel-2 Multispectral, XGBoost, Mapbox GL',
                'tests' => 'Validasi dengan data riil panen Dinas Pertanian Karawang 2025 dengan deviasi prediksi di bawah 6.2%.',
                'limits' => 'Tertutup awan tebal pada puncak musim hujan dapat menunda pembaharuan citra satelit optik.',
                'demo' => 'https://paddyyield.unsika.ac.id',
                'collab' => 'Kolaborasi dengan Perum BULOG dan BPS Jawa Barat.',
                'is_pitch' => false,
                'pitch_order' => null,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => 'Geoinformatika UNSIKA',
                'leader' => 'Luki Hermawan',
            ],
        ];

        // Generate remaining campus projects to reach 60 projects total (2 per campus for 30 campuses)
        $categoriesPool = ['AI/IoT', 'Smart City', 'FinTech', 'EdTech', 'HealthTech', 'Creative Media'];
        $readinessPool = ['Prototipe Teruji (TRL 6)', 'Prototipe Laboratorium (TRL 4)', 'Validasi Komponen (TRL 5)', 'Produksi Terbatas (TRL 7)'];

        // Collect existing campus slugs used
        $usedCampuses = array_unique(array_column($projectsList, 'campus'));

        // For remaining campuses, add 2 projects each
        foreach ($campuses as $c) {
            $cSlug = Str::slug($c['name']);
            if (in_array($cSlug, $usedCampuses)) {
                continue;
            }

            // Project 1
            $cat1 = $categoriesPool[array_rand($categoriesPool)];
            $projectsList[] = [
                'campus' => $cSlug,
                'booth' => $c['booth'],
                'title' => "Inovasi {$cat1}: Solusi Cerdas {$c['name']} untuk Kemandirian Daerah",
                'category' => $cat1,
                'readiness' => $readinessPool[array_rand($readinessPool)],
                'problem' => "Kebutuhan automasi dan efisiensi digital di wilayah {$c['city']} yang membutuhkan solusi terjangkau dan handal.",
                'target' => "Masyarakat dan UMKM di wilayah {$c['city']} serta dinas terkait pemerintah daerah.",
                'solution' => "Aplikasi dan perangkat cerdas terintegrasi cloud yang dikembangkan khusus oleh mahasiswa {$c['name']}.",
                'features' => "Dashboard monitoring real-time, integrasi pesan instan, pelaporan terautomasi, dan antarmuka ramah pengguna.",
                'tech' => 'Laravel 12, Python, IoT Sensors, Flutter, MySQL, Tailwind CSS',
                'tests' => 'Telah diuji di lingkungan laboratorium kampus dan percontohan mitra setempat.',
                'limits' => 'Dukungan skalabilitas masih dalam proses optimasi beban puncak.',
                'demo' => "https://demo.{$cSlug}.ac.id/p1",
                'collab' => 'Mencari mitra industri dan pemerintah daerah untuk pengujian skala penuh.',
                'is_pitch' => false,
                'pitch_order' => null,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => "Tim Inovator 1 {$c['name']}",
                'leader' => 'Ketua Tim 1 ' . $c['city'],
            ];

            // Project 2
            $cat2 = $categoriesPool[array_rand($categoriesPool)];
            $projectsList[] = [
                'campus' => $cSlug,
                'booth' => $c['booth'],
                'title' => "Sistem {$cat2} Berkelanjutan: Pemberdayaan Digital Berbasis Kampus {$c['name']}",
                'category' => $cat2,
                'readiness' => $readinessPool[array_rand($readinessPool)],
                'problem' => "Kendala aksesibilitas data dan koordinasi lintas sektor di Jawa Barat.",
                'target' => "Pengambil kebijakan, akademisi, dan praktisi industri.",
                'solution' => "Platform kolaboratif berbasis kecerdasan data dan sensor cerdas berbiaya rendah.",
                'features' => "Visualisasi analitik interaktif, notifikasi deteksi anomali, pelindung privasi data pengguna.",
                'tech' => 'Vue.js, Express/Laravel, PostgreSQL, MQTT, ESP32',
                'tests' => 'Telah lolos uji fungsionalitas 10 skenario pengujian utama.',
                'limits' => 'Membutuhkan koneksi internet stabil untuk sinkronisasi cloud real-time.',
                'demo' => "https://demo.{$cSlug}.ac.id/p2",
                'collab' => 'Pendanaan riset lanjutan dan pilot study.',
                'is_pitch' => false,
                'pitch_order' => null,
                'status' => 'lolos',
                'pub_status' => 'terbit',
                'team_name' => "Tim Inovator 2 {$c['name']}",
                'leader' => 'Ketua Tim 2 ' . $c['city'],
            ];
        }

        $projectModels = [];

        foreach ($projectsList as $pIdx => $p) {
            $org = $orgModels[$p['campus']] ?? null;
            if (!$org) continue;

            $team = Team::create([
                'organization_id' => $org->id,
                'name' => $p['team_name'],
            ]);

            TeamMember::create([
                'team_id' => $team->id,
                'user_id' => ($p['leader'] === 'Rian Pratama') ? $users['tim@itb.ac.id']->id : null,
                'name' => $p['leader'],
                'nim_nisn' => '1352' . rand(1000, 9999),
                'study_program' => 'Teknik Informatika / Sistem Informasi',
                'student_status' => 'Aktif',
                'is_leader' => true,
                'email' => Str::slug($p['leader']) . '@student.' . $p['campus'] . '.ac.id',
                'phone' => '0812' . rand(10000000, 99999999),
            ]);

            // Add 2 team members
            for ($m = 1; $m <= 2; $m++) {
                TeamMember::create([
                    'team_id' => $team->id,
                    'name' => "Anggota {$m} ({$p['team_name']})",
                    'nim_nisn' => '1352' . rand(1000, 9999),
                    'study_program' => 'Teknik Elektro / Desain Komunikasi Visual',
                    'student_status' => 'Aktif',
                    'is_leader' => false,
                    'email' => "anggota{$m}@" . $p['campus'] . '.ac.id',
                    'phone' => '0812' . rand(10000000, 99999999),
                ]);
            }

            $boothObj = $booths[$p['booth']] ?? null;

            $slug = Str::slug($p['title']);
            $proj = Project::create([
                'event_id' => $event->id,
                'organization_id' => $org->id,
                'team_id' => $team->id,
                'booth_id' => $boothObj?->id,
                'title' => $p['title'],
                'slug' => $slug,
                'category' => $p['category'],
                'problem_statement' => $p['problem'],
                'target_users' => $p['target'],
                'solution_description' => $p['solution'],
                'key_features' => $p['features'],
                'technology_stack' => $p['tech'],
                'readiness_level' => $p['readiness'],
                'test_results' => $p['tests'],
                'limitations' => $p['limits'],
                'demo_url' => $p['demo'],
                'video_url' => 'https://youtube.com/watch?v=futurise2026',
                'poster_image' => "/images/posters/poster-{$pIdx}.jpg",
                'thumbnail' => "/images/thumbnails/thumb-{$pIdx}.jpg",
                'collaboration_needs' => $p['collab'],
                'is_published_consent' => true, // Section 2 & 10
                'status' => $p['status'],
                'is_locked' => false,
                'curator_notes' => 'Karya memenuhi kelayakan inovasi tingkat regional dan lolos seleksi berkas teknis.',
                'reviewed_by' => $users['kurator@futurise.id']->id,
                'reviewed_at' => Carbon::now()->subDays(4),
                'publication_status' => $p['pub_status'],
                'is_pitch_finalist' => $p['is_pitch'],
                'pitch_order' => $p['pitch_order'],
                'view_count' => rand(50, 420),
            ]);

            // Version 1 snapshot
            ProjectVersion::create([
                'project_id' => $proj->id,
                'version_number' => 1,
                'snapshot_data' => [
                    'title' => $p['title'],
                    'solution' => $p['solution'],
                    'tech' => $p['tech'],
                ],
                'revision_notes' => 'Pengajuan berkas awal karya',
                'submitted_by' => $users['kampus@itb.ac.id']->id ?? $users['kurator@futurise.id']->id,
            ]);

            // Publication approval (BR-11 Acceptance)
            PublicationApproval::create([
                'project_id' => $proj->id,
                'approved_by' => $users['publikasi@futurise.id']->id,
                'status' => 'approved',
                'remarks' => 'Semua materi telah diverifikasi dan disetujui untuk terbit dalam katalog publik.',
                'approved_at' => Carbon::now()->subDays(3),
            ]);

            // Technical requirements
            TechnicalRequirement::create([
                'project_id' => $proj->id,
                'organization_id' => $org->id,
                'device_list' => 'Laptop Demo, Prototype Hardware Box, Tablet Interaktif, Kabel Roll 5M',
                'device_count' => 3,
                'power_watt' => rand(250, 400),
                'internet_type' => 'wifi_high_speed',
                'demo_area_type' => 'Standard Booth Table + Poster Board Stand',
                'special_requests' => 'Membutuhkan akses stop kontak stabil untuk adaptor charger',
                'status' => 'verified',
                'verifier_notes' => 'Daya dan kebutuhan ruang aman serta telah terverifikasi oleh tim teknis.',
            ]);

            // Collaboration Need entry
            CollaborationNeed::create([
                'organization_id' => $org->id,
                'project_id' => $proj->id,
                'title' => "Peluang Kolaborasi: {$p['title']}",
                'description' => $p['collab'],
                'target_partner_type' => 'industry',
                'scope_of_work' => 'Co-development, Pilot Testing, Inkubasi Bisnis & Hilirisasi Produk',
            ]);

            $projectModels[] = $proj;
        }

        // 8. JUDGING ASSIGNMENTS & SAMPLE ASSESSMENTS (Section 13)
        // Assign Judge to First 10 Pitching Projects
        $juri1 = $users['juri@futurise.id'];
        $juri2 = $users['juri2@futurise.id'];

        foreach (array_slice($projectModels, 0, 10) as $pIdx => $proj) {
            // Juri 1 assignment
            $ja1 = JudgeAssignment::create([
                'event_id' => $event->id,
                'user_id' => $juri1->id,
                'project_id' => $proj->id,
                'has_conflict_of_interest' => false,
                'conflict_declaration_notes' => 'Tidak memiliki afiliasi keluarga atau finansial dengan tim pengusul.',
                'is_active' => true,
            ]);

            // Assessment Juri 1 (Locked)
            $asm1 = Assessment::create([
                'judge_assignment_id' => $ja1->id,
                'user_id' => $juri1->id,
                'project_id' => $proj->id,
                'status' => 'locked', // BR-08 Acceptance: terkunci setelah final
                'general_feedback' => 'Inovasi sangat aplikatif dan menunjukkan penguasaan teknologi yang matang oleh mahasiswa.',
                'locked_at' => Carbon::now()->subHours(2),
            ]);

            $scores1 = [
                'C1' => rand(4, 5),
                'C2' => rand(4, 5),
                'C3' => rand(4, 5),
                'C4' => rand(3, 5),
                'C5' => rand(4, 5),
            ];

            foreach ($scores1 as $code => $val) {
                $crit = $criteria[$code];
                $weighted = ($val / 5.0) * $crit->weight_percent;
                Score::create([
                    'assessment_id' => $asm1->id,
                    'criterion_id' => $crit->id,
                    'score_value' => $val,
                    'weighted_score' => $weighted,
                    'notes' => 'Indikator teruji baik saat demonstrasi.',
                ]);
            }
            $asm1->calculateFinalScore();

            // Juri 2 assignment
            $ja2 = JudgeAssignment::create([
                'event_id' => $event->id,
                'user_id' => $juri2->id,
                'project_id' => $proj->id,
                'has_conflict_of_interest' => false,
                'conflict_declaration_notes' => 'Bebas dari konflik kepentingan.',
                'is_active' => true,
            ]);

            $asm2 = Assessment::create([
                'judge_assignment_id' => $ja2->id,
                'user_id' => $juri2->id,
                'project_id' => $proj->id,
                'status' => 'locked',
                'general_feedback' => 'Potensi hilirisasi tinggi, perlu penguatan perlindungan HKI dan roadmap bisnis.',
                'locked_at' => Carbon::now()->subHours(1),
            ]);

            $scores2 = [
                'C1' => rand(4, 5),
                'C2' => rand(4, 5),
                'C3' => rand(3, 5),
                'C4' => rand(4, 5),
                'C5' => rand(4, 5),
            ];

            foreach ($scores2 as $code => $val) {
                $crit = $criteria[$code];
                $weighted = ($val / 5.0) * $crit->weight_percent;
                Score::create([
                    'assessment_id' => $asm2->id,
                    'criterion_id' => $crit->id,
                    'score_value' => $val,
                    'weighted_score' => $weighted,
                    'notes' => 'Penilaian juri industri.',
                ]);
            }
            $asm2->calculateFinalScore();
        }

        // 9. SPONSORSHIP PACKAGES, AGREEMENTS & FINANCE (Section 10 & 16)
        $pkgPlatinum = SponsorshipPackage::create([
            'event_id' => $event->id,
            'name' => 'Platinum Sponsor',
            'slug' => 'platinum',
            'price' => 50000000.00,
            'quota' => 2,
            'benefits_summary' => 'Booth Korporat Utama 4x4m, Keynote Speaker Sesi Pleno, Logo Raksasa Main Stage & Website, Video Profil 60s di Layar LED Utama Sabuga.',
            'includes_booth' => true, // BR-04
            'is_active' => true,
        ]);

        $pkgGold = SponsorshipPackage::create([
            'event_id' => $event->id,
            'name' => 'Gold Sponsor',
            'slug' => 'gold',
            'price' => 25000000.00,
            'quota' => 4,
            'benefits_summary' => 'Booth Korporat 3x3m, Panel Speaker di Sesi Industri, Penayangan Logo di Buku Program & Sertifikat, Akses Meja Prioritas Matchmaking.',
            'includes_booth' => true,
            'is_active' => true,
        ]);

        $pkgSilver = SponsorshipPackage::create([
            'event_id' => $event->id,
            'name' => 'Silver Sponsor',
            'slug' => 'silver',
            'price' => 10000000.00,
            'quota' => 6,
            'benefits_summary' => 'Logo di Backdrop Acara, Website, Media Sosial Resmi APTIKOM Jabar, 2 VIP Pass Gala Dinner.',
            'includes_booth' => false,
            'is_active' => true,
        ]);

        // Benefits for Platinum
        $b1 = Benefit::create(['package_id' => $pkgPlatinum->id, 'name' => 'Keynote Speaker Sesi Pleno', 'required_proof_type' => 'photo']);
        $b2 = Benefit::create(['package_id' => $pkgPlatinum->id, 'name' => 'Logo Raksasa Main Backdrop & LED Sabuga', 'required_proof_type' => 'photo']);
        $b3 = Benefit::create(['package_id' => $pkgPlatinum->id, 'name' => 'Booth Korporat 4x4m', 'required_proof_type' => 'photo']);

        // Agreement with Bank BJB (Platinum)
        $bjbOrg = $orgModels['pt-bank-pembangunan-daerah-jawa-barat-bank-bjb'];
        $agrBJB = SponsorshipAgreement::create([
            'event_id' => $event->id,
            'organization_id' => $bjbOrg->id,
            'package_id' => $pkgPlatinum->id,
            'agreement_number' => 'SPON/FTR-2026/001-BJB',
            'agreed_amount' => 50000000.00,
            'support_type' => 'cash',
            'status' => 'signed',
            'agreed_at' => Carbon::now()->subDays(10),
            'contract_document' => '/docs/contracts/spk-bjb-platinum.pdf',
        ]);

        // Benefit fulfillments
        BenefitFulfillment::create([
            'agreement_id' => $agrBJB->id,
            'benefit_id' => $b1->id,
            'status' => 'fulfilled',
            'proof_url' => 'https://futurise.id/gallery/speaker-bjb',
            'notes' => 'Direktur IT Bank BJB telah dijadwalkan sebagai Keynote Speaker Sesi 1.',
        ]);

        // Invoice for Bank BJB
        $invBJB = Invoice::create([
            'event_id' => $event->id,
            'organization_id' => $bjbOrg->id,
            'invoice_number' => 'INV/2026/10/001',
            'subtotal' => 50000000.00,
            'discount' => 0.00,
            'tax' => 5500000.00, // PPN 11%
            'total_amount' => 55500000.00,
            'due_date' => Carbon::now()->addDays(5)->toDateString(),
            'status' => 'paid',
            'notes' => 'Tagihan Sponsorship Platinum FUTURiSE 2026 Bank BJB',
        ]);

        $invItemBJB = InvoiceItem::create([
            'invoice_id' => $invBJB->id,
            'description' => 'Paket Platinum Sponsorship FUTURiSE 2026',
            'quantity' => 1,
            'unit_price' => 50000000.00,
            'total_price' => 50000000.00,
        ]);

        // Payment for Bank BJB (BR-06 & BR-07: Verified payment)
        $payBJB = Payment::create([
            'invoice_id' => $invBJB->id,
            'payment_number' => 'PAY/2026/10/001',
            'amount' => 55500000.00,
            'payment_date' => Carbon::now()->subDays(3)->toDateString(),
            'payment_method' => 'bank_transfer',
            'bank_source' => 'Bank BJB',
            'account_number' => '0010998877665',
            'account_holder' => 'PT BANK PEMBANGUNAN DAERAH JABAR',
            'receipt_file' => '/receipts/transfer-bjb-55m.pdf',
            'status' => 'verified',
            'verified_by' => $users['keuangan@futurise.id']->id,
            'verified_at' => Carbon::now()->subDays(2),
        ]);

        PaymentAllocation::create([
            'payment_id' => $payBJB->id,
            'invoice_item_id' => $invItemBJB->id,
            'allocated_amount' => 55500000.00,
            'notes' => 'Alokasi lunas paket Platinum BJB',
        ]);

        // Agreement with Telkom (In-Kind & Hybrid) - Demonstrates BR-08
        $telkomOrg = $orgModels['pt-telkom-indonesia-persero-tbk'];
        $agrTelkom = SponsorshipAgreement::create([
            'event_id' => $event->id,
            'organization_id' => $telkomOrg->id,
            'package_id' => $pkgPlatinum->id,
            'agreement_number' => 'SPON/FTR-2026/002-TLKM',
            'agreed_amount' => 30000000.00,
            'support_type' => 'hybrid', // BR-08: Cash + In-Kind
            'in_kind_description' => 'Dedicated Bandwidth 1 Gbps Sabuga & Cloud Server Hosting 1 Tahun untuk Pemenang',
            'status' => 'signed',
            'agreed_at' => Carbon::now()->subDays(8),
        ]);

        // BR-08: Dukungan barang/jasa terpisah dari kas
        InKindContribution::create([
            'agreement_id' => $agrTelkom->id,
            'organization_id' => $telkomOrg->id,
            'item_name' => 'Dedicated High-Speed Fiber Internet 1 Gbps & Wi-Fi 6 Access Points',
            'estimated_value' => 20000000.00,
            'quantity' => 1,
            'unit' => 'Paket Event 2 Hari',
            'description' => 'Penyediaan jaringan internet tanpa hambatan untuk 1.000 pengunjung dan 45 booth',
            'delivery_status' => 'verified',
            'received_at' => Carbon::now()->subDays(1),
            'receiver_name' => 'Koordinator Venue & Teknis Sabuga',
        ]);

        InKindContribution::create([
            'agreement_id' => $agrTelkom->id,
            'organization_id' => $telkomOrg->id,
            'item_name' => 'Cloud Hosting Credits Telkom Cloud untuk 10 Finalis Pitching',
            'estimated_value' => 15000000.00,
            'quantity' => 10,
            'unit' => 'Voucher Akun',
            'description' => 'Paket cloud hosting masing-masing Rp 1.500.000 untuk inkubasi pasca-event',
            'delivery_status' => 'pledged',
        ]);

        // Expenses
        $expensesData = [
            ['category' => 'venue', 'description' => 'Sewa Gedung Sabuga ITB (Hall Utama, Panggung, Ruang VIP, Meja & Kursi)', 'amount' => 35000000.00],
            ['category' => 'production', 'description' => 'Pemasangan Booth Partisi Standar 45 Unit & Karpet Hall', 'amount' => 18000000.00],
            ['category' => 'marketing', 'description' => 'Pencetakan Backdrop, Spanduk Bandung Raya, Id Card & Buku Panduan', 'amount' => 6500000.00],
            ['category' => 'consumption', 'description' => 'Katering Makan Siang & Coffee Break Juri, Panitia, dan VIP 2 Hari', 'amount' => 8500000.00],
        ];

        foreach ($expensesData as $exp) {
            Expense::create(array_merge($exp, [
                'event_id' => $event->id,
                'expense_date' => Carbon::now()->subDays(2)->toDateString(),
                'approved_by' => $users['keuangan@futurise.id']->id,
            ]));
        }

        // 10. PROGRAMS & RUNDOWN (7 Program Utama)
        $programsData = [
            [
                'title' => 'Grand Opening & Keynote Tech Leaders: Masa Depan Inovasi Digital Jabar',
                'slug' => 'grand-opening-keynote',
                'type' => 'keynote',
                'stage' => 'Main Stage Sabuga',
                'start' => Carbon::now()->addDays(14)->setHour(8)->setMinute(30),
                'end' => Carbon::now()->addDays(14)->setHour(10)->setMinute(30),
                'desc' => 'Pembukaan resmi oleh Ketua APTIKOM Pusat, Pj Gubernur Jawa Barat, dan Rektor ITB dilanjutkan keynote speech pimpinan industri teknologi.',
                'speakers' => [
                    ['name' => 'Dr. H. Bey Triadi Machmudin, S.E., M.T.', 'title' => 'Pj Gubernur Jawa Barat', 'org' => 'Pemerintah Provinsi Jawa Barat'],
                    ['name' => 'Prof. Ir. Nizam, M.Sc., Ph.D.', 'title' => 'Dewan Pembina APTIKOM', 'org' => 'APTIKOM Pusat'],
                    ['name' => 'Direktur Enterprise PT Telkom Indonesia', 'title' => 'Keynote Speaker', 'org' => 'Telkom Indonesia'],
                ],
            ],
            [
                'title' => 'Digital Innovation Showcase: 60 Karya Mahasiswa Kampus Jawa Barat',
                'slug' => 'digital-innovation-showcase',
                'type' => 'workshop',
                'stage' => 'Zona Booth Hall Utama (Booth B-01 s/d B-30)',
                'start' => Carbon::now()->addDays(14)->setHour(10)->setMinute(30),
                'end' => Carbon::now()->addDays(15)->setHour(16)->setMinute(0),
                'desc' => 'Pameran terbuka 60 karya teknologi inovatif mahasiswa 30 perguruan tinggi se-Jawa Barat. Pengunjung dapat mencoba langsung prototipe dan memberikan feedback serta vote.',
                'speakers' => [],
            ],
            [
                'title' => 'West Java Pitching Arena: Presentasi 10 Finalis di Depan Investor & Industri',
                'slug' => 'west-java-pitching-arena',
                'type' => 'pitching',
                'stage' => 'Main Stage Sabuga',
                'start' => Carbon::now()->addDays(14)->setHour(13)->setMinute(30),
                'end' => Carbon::now()->addDays(14)->setHour(16)->setMinute(30),
                'desc' => 'Kompetisi presentasi 10 tim mahasiswa terbaik di hadapan dewan juri ahli dan perwakilan modal ventura (VC/Angel Investor).',
                'speakers' => [
                    ['name' => 'Dewan Juri Akademisi & Industri APTIKOM Jabar', 'title' => 'Juri Pitching', 'org' => 'APTIKOM Jabar'],
                ],
            ],
            [
                'title' => 'Business & Technology Matchmaking (Pertemuan Kolaborasi Meja)',
                'slug' => 'business-technology-matchmaking',
                'type' => 'networking',
                'stage' => 'Collaboration Lounge Meja 1 - 10',
                'start' => Carbon::now()->addDays(14)->setHour(11)->setMinute(0),
                'end' => Carbon::now()->addDays(15)->setHour(15)->setMinute(0),
                'desc' => 'Sesi tatap muka one-on-one terjadwal antara perwakilan kampus/tim inovator dengan industri dan instansi pemerintah guna menjajaki kemitraan hilirisasi.',
                'speakers' => [],
            ],
            [
                'title' => 'School Tech Tour: Kunjungan Edukasi Siswa SMK/SMA se-Jawa Barat',
                'slug' => 'school-tech-tour',
                'type' => 'tour',
                'stage' => 'Hall Sabuga & Guided Booth Tour',
                'start' => Carbon::now()->addDays(14)->setHour(9)->setMinute(0),
                'end' => Carbon::now()->addDays(15)->setHour(14)->setMinute(0),
                'desc' => 'Tur terjadwal dengan pemandu khusus bagi rombongan sekolah untuk memperkenalkan teknologi mutakhir kampus dan prospek karir di era digital.',
                'speakers' => [],
            ],
            [
                'title' => 'Panel Discussion: AI Governance & Link-and-Match Kurikulum Pendidikan Tinggi',
                'slug' => 'panel-discussion-aptikom',
                'type' => 'panel',
                'stage' => 'Auditorium Lantai 2 Sabuga',
                'start' => Carbon::now()->addDays(15)->setHour(9)->setMinute(30),
                'end' => Carbon::now()->addDays(15)->setHour(12)->setMinute(0),
                'desc' => 'Diskusi strategis pimpinan prodi informatika dan pelaku industri seputar integrasi GenAI dalam kurikulum dan standar kompetensi kerja nasional.',
                'speakers' => [
                    ['name' => 'Prof. Dr. Ir. Juri Senior', 'title' => 'Pakar AI Indonesia', 'org' => 'APTIKOM Jabar'],
                    ['name' => 'Head of People & Culture Dicoding', 'title' => 'Panelis Industri', 'org' => 'Dicoding Indonesia'],
                ],
            ],
            [
                'title' => 'Awarding Ceremony & Closing: Pengumuman Juara Karya, People Choice & Doorprize',
                'slug' => 'awarding-closing-ceremony',
                'type' => 'awarding',
                'stage' => 'Main Stage Sabuga',
                'start' => Carbon::now()->addDays(15)->setHour(15)->setMinute(30),
                'end' => Carbon::now()->addDays(15)->setHour(17)->setMinute(30),
                'desc' => 'Pemberian penghargaan Karya Terbaik Kategori Juri, Pemenang Pitching Arena, dan Juara Favorit Pengunjung (People\'s Choice Award).',
                'speakers' => [
                    ['name' => 'Ketua Pelaksana FUTURiSE 2026', 'title' => 'Host & Ketua', 'org' => 'APTIKOM Jawa Barat'],
                ],
            ],
        ];

        foreach ($programsData as $pProg) {
            $sess = EventSession::create([
                'event_id' => $event->id,
                'title' => $pProg['title'],
                'slug' => $pProg['slug'],
                'type' => $pProg['type'],
                'stage_or_room' => $pProg['stage'],
                'start_time' => $pProg['start'],
                'end_time' => $pProg['end'],
                'description' => $pProg['desc'],
                'is_active' => true,
            ]);

            foreach ($pProg['speakers'] as $spk) {
                Speaker::create([
                    'session_id' => $sess->id,
                    'name' => $spk['name'],
                    'title' => $spk['title'],
                    'organization' => $spk['org'] ?? null,
                ]);
            }
        }

        // 11. TOUR SLOTS & SCHOOL VISITS (Section 8)
        $slot1 = TourSlot::create([
            'event_id' => $event->id,
            'slot_name' => 'Slot Tur Pagi 1 (Hari 1)',
            'date' => Carbon::now()->addDays(14)->toDateString(),
            'start_time' => '09:00:00',
            'end_time' => '11:00:00',
            'max_capacity' => 150,
            'booked_count' => 86,
            'guide_name' => 'Kang Asep & Teh Sarah (Duta Kampus)',
            'status' => 'open',
        ]);

        $slot2 = TourSlot::create([
            'event_id' => $event->id,
            'slot_name' => 'Slot Tur Siang 1 (Hari 1)',
            'date' => Carbon::now()->addDays(14)->toDateString(),
            'start_time' => '13:00:00',
            'end_time' => '15:00:00',
            'max_capacity' => 150,
            'booked_count' => 0,
            'guide_name' => 'Kang Diki & Teh Melati',
            'status' => 'open',
        ]);

        // School Visit for SMKN 4 Bandung
        SchoolVisit::create([
            'tour_slot_id' => $slot1->id,
            'organization_id' => $schoolOrg->id,
            'student_count' => 80,
            'teacher_count' => 6,
            'pic_name' => 'Dra. Endang Sulastri',
            'pic_phone' => '081240000001',
            'qr_group_token' => 'GRP-SMKN4BDG-' . strtoupper(Str::random(8)),
            'arrival_status' => 'confirmed',
            'actual_attendees' => 86, // Section 8: separated group count from attendees
            'arrival_notes' => 'Rombongan menggunakan 2 bus pariwisata, tiba pukul 08.45 WIB di Gate Bus Sabuga.',
        ]);

        // 12. MEETINGS & BR-13 DEMO (Conflict Prevention) & H+30 FOLLOW-UPS
        $meeting1 = Meeting::create([
            'event_id' => $event->id,
            'requester_org_id' => $orgModels['institut-teknologi-bandung-itb']->id,
            'target_org_id' => $telkomOrg->id,
            'project_id' => $projectModels[0]->id, // AgriSense AI
            'table_number' => 'Meja Kolaborasi 1',
            'start_time' => Carbon::now()->addDays(14)->setHour(11)->setMinute(0),
            'end_time' => Carbon::now()->addDays(14)->setHour(11)->setMinute(45),
            'agenda_topic' => 'Diskusi Pilot Project AgriSense AI pada Lahan Binaan CSR Telkom di Jawa Barat',
            'status' => 'confirmed',
            'discussion_notes' => 'Pihak Telkom tertarik memasukkan sensor AgriSense ke platform Antares IoT.',
        ]);

        MeetingParticipant::create([
            'meeting_id' => $meeting1->id,
            'user_id' => $users['kampus@itb.ac.id']->id,
            'organization_id' => $orgModels['institut-teknologi-bandung-itb']->id,
            'role' => 'host',
            'status' => 'confirmed',
        ]);

        MeetingParticipant::create([
            'meeting_id' => $meeting1->id,
            'user_id' => $users['industri@telkom.co.id']->id,
            'organization_id' => $telkomOrg->id,
            'role' => 'invitee',
            'status' => 'confirmed',
        ]);

        // H+30 Follow up from Meeting 1 (Section 9 & 15)
        FollowUp::create([
            'event_id' => $event->id,
            'meeting_id' => $meeting1->id,
            'project_id' => $projectModels[0]->id,
            'organization_id' => $orgModels['institut-teknologi-bandung-itb']->id,
            'pic_user_id' => $users['kampus@itb.ac.id']->id,
            'title' => 'Penyusunan Perjanjian Kerjasama (PKS) Uji Coba AgriSense & Telkom Antares',
            'action_plan' => '1. Pengiriman spesifikasi API Antares. 2. Integrasi firmware ESP32. 3. Penandatanganan MoU uji 10 titik sawah.',
            'deadline_h30' => Carbon::now()->addDays(30)->toDateString(),
            'status' => 'in_progress',
            'result_summary' => 'Draf dokumen teknis integrasi telah dikirimkan ke tim Engineering Telkom.',
            'h30_notes' => 'Target selesai penandatanganan minggu ke-3 pasca festival.',
        ]);

        // Meeting 2 (UNIKOM with Bank BJB)
        $meeting2 = Meeting::create([
            'event_id' => $event->id,
            'requester_org_id' => $orgModels['universitas-komputer-indonesia-unikom']->id,
            'target_org_id' => $bjbOrg->id,
            'project_id' => $projectModels[4]->id, // RoboTrash AI
            'table_number' => 'Meja Kolaborasi 2',
            'start_time' => Carbon::now()->addDays(14)->setHour(14)->setMinute(0),
            'end_time' => Carbon::now()->addDays(14)->setHour(14)->setMinute(45),
            'agenda_topic' => 'Penempatan Robot Pemilah Sampah Cerdas di Kantor Pusat Menara Bank BJB',
            'status' => 'confirmed',
            'discussion_notes' => 'Bank BJB mendukung inisiatif Green Banking & ESG.',
        ]);

        FollowUp::create([
            'event_id' => $event->id,
            'meeting_id' => $meeting2->id,
            'project_id' => $projectModels[4]->id,
            'organization_id' => $orgModels['universitas-komputer-indonesia-unikom']->id,
            'pic_user_id' => $users['kampus@unikom.ac.id']->id,
            'title' => 'Pengiriman Proposal ESG Penempatan RoboTrash AI di Kantor Pusat BJB',
            'action_plan' => 'Kirimkan rincian anggaran sewa dan maintenance unit robot ke bagian Umum BJB.',
            'deadline_h30' => Carbon::now()->addDays(20)->toDateString(),
            'status' => 'open',
            'h30_notes' => 'PIC BJB: Bpk. Aditya bagian General Affairs.',
        ]);

        // 13. TICKETING, CHECK-IN LOGS & BR-11 UNIQUE VISITOR DEMO
        $visitorUser = $users['pengunjung@gmail.com'];
        $ticketVisitor = Ticket::create([
            'event_id' => $event->id,
            'user_id' => $visitorUser->id,
            'ticket_number' => 'FTR-VIS-88899',
            'qr_token' => 'FTR_SECURE_TOKEN_' . Str::random(32), // BR-17: random safe token
            'category' => 'visitor',
            'status' => 'checked_in',
            'has_checked_in' => true,
            'first_checked_in_at' => Carbon::now()->subHours(4),
        ]);

        // First check-in scan: is_unique_first_entry = true (BR-11)
        CheckInLog::create([
            'event_id' => $event->id,
            'ticket_id' => $ticketVisitor->id,
            'user_id' => $visitorUser->id,
            'scan_type' => 'in',
            'is_unique_first_entry' => true, // Counted once!
            'gate_location' => 'Gate Utama Sabuga Lantai 1',
            'scanned_by' => $users['registrasi@futurise.id']->id,
            'scanned_at' => Carbon::now()->subHours(4),
        ]);

        // Re-entry scan: is_unique_first_entry = false (BR-06 Acceptance)
        CheckInLog::create([
            'event_id' => $event->id,
            'ticket_id' => $ticketVisitor->id,
            'user_id' => $visitorUser->id,
            'scan_type' => 'in',
            'is_unique_first_entry' => false, // Repeated scan does NOT increase unique count!
            'gate_location' => 'Gate Samping Food Court Sabuga',
            'scanned_by' => $users['registrasi@futurise.id']->id,
            'scanned_at' => Carbon::now()->subHours(1),
        ]);

        // Generate 25 additional sample tickets and check-in logs to populate live dashboard
        for ($k = 1; $k <= 25; $k++) {
            $sampleUser = User::create([
                'name' => "Pengunjung Terdaftar {$k}",
                'email' => "visitor{$k}@example.com",
                'phone' => '0812' . rand(10000000, 99999999),
                'password' => Hash::make('password'),
                'active_role_id' => $roles['pengunjung']->id,
                'status' => 'active',
                'is_verified' => true,
            ]);

            $tk = Ticket::create([
                'event_id' => $event->id,
                'user_id' => $sampleUser->id,
                'ticket_number' => sprintf('FTR-VIS-%05d', 1000 + $k),
                'qr_token' => 'FTR_TOKEN_' . Str::random(32),
                'category' => 'visitor',
                'status' => 'checked_in',
                'has_checked_in' => true,
                'first_checked_in_at' => Carbon::now()->subMinutes(rand(10, 300)),
            ]);

            CheckInLog::create([
                'event_id' => $event->id,
                'ticket_id' => $tk->id,
                'user_id' => $sampleUser->id,
                'scan_type' => 'in',
                'is_unique_first_entry' => true,
                'gate_location' => 'Gate Utama Sabuga',
                'scanned_by' => $users['registrasi@futurise.id']->id,
                'scanned_at' => Carbon::now()->subMinutes(rand(10, 300)),
            ]);

            // Sample Voting from checked-in user (Section 14 & BR-14)
            if ($k <= 15) {
                $targetProj = $projectModels[$k % 10];
                Vote::create([
                    'event_id' => $event->id,
                    'project_id' => $targetProj->id,
                    'user_id' => $sampleUser->id,
                    'ticket_id' => $tk->id,
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Mozilla/5.0 Mobile Browser',
                ]);
            }

            // Sample CSAT Survey Response (Section 14)
            // Persentase puas: score 4 atau 5 (target minimal 85%)
            $scoreVal = ($k % 10 == 0) ? 3 : ($k % 5 == 0 ? 4 : 5);
            SurveyResponse::create([
                'event_id' => $event->id,
                'user_id' => $sampleUser->id,
                'ticket_id' => $tk->id,
                'satisfaction_score' => $scoreVal,
                'respondent_category' => 'visitor',
                'feedback_text' => 'Acaranya sangat keren dan inovasi kampusnya inspiratif!',
                'would_recommend' => true,
            ]);
        }

        // 14. TASKS, SUPPORT TICKETS, FAQS, NEWS, AUDIT LOG
        Task::create([
            'event_id' => $event->id,
            'title' => 'Finalisasi Sound System dan Layar LED Panggung Utama Sabuga',
            'division' => 'venue',
            'assigned_to' => $users['venue@futurise.id']->id,
            'due_date' => Carbon::now()->addDays(5)->toDateString(),
            'status' => 'in_progress',
            'priority' => 'high',
            'description' => 'Pastikan kabel HDMI switcher dan mic wireless juri siap pakai.',
        ]);

        Task::create([
            'event_id' => $event->id,
            'title' => 'Cetak Name Tag Peserta & E-Ticket Scanner Android Gate Sabuga',
            'division' => 'pendaftaran',
            'assigned_to' => $users['registrasi@futurise.id']->id,
            'due_date' => Carbon::now()->addDays(3)->toDateString(),
            'status' => 'completed',
            'priority' => 'urgent',
            'description' => '10 unit smartphone scanner telah terinstall aplikasi registrasi.',
        ]);

        SupportTicket::create([
            'user_id' => $users['kampus@itb.ac.id']->id,
            'ticket_code' => 'HLP-100234',
            'category' => 'booth',
            'subject' => 'Permintaan Tambahan Daya Listrik untuk Mesin Edge AI',
            'message' => 'Selamat siang panitia, kami membutuhkan penambahan daya sekitar 200 Watt untuk power supply box Edge AI di Booth B-01.',
            'status' => 'answered',
            'priority' => 'normal',
            'response_text' => 'Permintaan telah disetujui oleh tim Venue & Teknis. Stop kontak tambahan akan disiapkan di Booth B-01 tanpa biaya tambahan.',
            'responded_by' => $users['venue@futurise.id']->id,
            'responded_at' => Carbon::now()->subHours(5),
        ]);

        // FAQs
        $faqsData = [
            ['category' => 'Umum', 'question' => 'Apa itu FUTURiSE 2026?', 'answer' => 'FUTURiSE (West Java Digital Innovation Festival) adalah ajang pameran dan kolaborasi tahunan yang diselenggarakan oleh APTIKOM Jawa Barat, mempertemukan 30 kampus, 60 karya teknologi inovatif mahasiswa, puluhan industri terkemuka, dan ribuan pengunjung.'],
            ['category' => 'Pendaftaran', 'question' => 'Apakah pengunjung umum dipungut biaya tiket masuk?', 'answer' => 'Tidak. Pendaftaran tiket pengunjung umum adalah GRATIS dengan melakukan registrasi online di website ini untuk mendapatkan E-Ticket QR Code resmi.'],
            ['category' => 'Booth', 'question' => 'Berapa karya yang dapat ditampilkan dalam satu booth kampus?', 'answer' => 'Sesuai aturan bisnis BR-03, setiap booth kampus berukuran 3x3 meter memfasilitasi maksimal 2 karya mahasiswa terpilih yang masing-masing dinilai dan dipublikasikan secara independen.'],
            ['category' => 'Penjurian', 'question' => 'Apa saja kriteria penilaian karya inovasi mahasiswa?', 'answer' => 'Penjurian mengacu pada 5 indikator standar APTIKOM Jabar: Relevansi Masalah (25%), Fungsi Prototipe (25%), Kebaruan Solusi (20%), Potensi Dampak (20%), serta Komunikasi dan Demo (10%).'],
            ['category' => 'Kolaborasi', 'question' => 'Bagaimana industri dapat menjadwalkan pertemuan kolaborasi dengan kampus?', 'answer' => 'Perwakilan industri yang telah terverifikasi dapat masuk ke Portal Industri dan memilih karya di menu Direktori / Showcase, lalu menekan tombol "Ajukan Pertemuan Meja Kolaborasi" pada slot waktu yang tersedia.'],
        ];

        foreach ($faqsData as $fIdx => $f) {
            Faq::create(array_merge($f, ['sort_order' => $fIdx + 1, 'is_published' => true]));
        }

        // News
        News::create([
            'event_id' => $event->id,
            'title' => 'APTIKOM Jabar Umumkan 60 Karya Inovasi Digital Mahasiswa Lolos Kurasi FUTURiSE 2026',
            'slug' => 'pengumuman-60-karya-lolos-kurasi-futurise-2026',
            'category' => 'Kurasi',
            'excerpt' => 'Sebanyak 60 karya dari 30 perguruan tinggi se-Jawa Barat berhasil melewati tahap kurasi ketat dan siap dipamerkan di Sabuga ITB.',
            'content' => 'Bandung, APTIKOM Jawa Barat resmi merilis daftar 60 karya teknologi inovatif mahasiswa yang lolos tahap kurasi untuk berlaga pada festival FUTURiSE 2026. Dari total ratusan proposal yang masuk, dewan kurator menetapkan 60 karya unggulan yang terbagi dalam bidang AI/IoT, Smart City, FinTech, EdTech, HealthTech, dan Creative Media. 10 tim di antaranya juga terpilih sebagai finalis Pitching Arena di hadapan pimpinan industri dan investor modal ventura.',
            'cover_image' => '/images/news/kurasi-announcement.jpg',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(2),
        ]);

        News::create([
            'event_id' => $event->id,
            'title' => 'Panduan Akses & Denah Booth Sabuga ITB untuk Peserta dan Pengunjung',
            'slug' => 'panduan-akses-dan-denah-sabuga-itb',
            'category' => 'Informasi',
            'excerpt' => 'Informasi lengkap pintu masuk, fasilitas parkir, peta pembagian zona 45 booth, dan akses transportasi umum menuju venue.',
            'content' => 'Panitia pelaksana mengimbau seluruh exhibitor dan pengunjung untuk memperhatikan akses masuk Sasana Budaya Ganesha (Sabuga) ITB. Pintu gerbang dibuka mulai pukul 08.00 WIB. E-Ticket QR Code harus ditunjukkan di meja registrasi gate utama untuk ditukar dengan lanyard ID resmi dan hak voting People\'s Choice Award.',
            'cover_image' => '/images/news/venue-guide.jpg',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(1),
        ]);

        // Documents
        Document::create([
            'event_id' => $event->id,
            'title' => 'Buku Panduan Teknis Exhibitor & Peserta Kampus FUTURiSE 2026',
            'category' => 'panduan',
            'file_path' => '/documents/buku-panduan-peserta-futurise-2026.pdf',
            'file_size_kb' => 2450,
            'is_public' => true,
            'download_count' => 142,
        ]);

        Document::create([
            'event_id' => $event->id,
            'title' => 'Paket Proposal Sponsorship FUTURiSE 2026 (APTIKOM Jawa Barat)',
            'category' => 'template',
            'file_path' => '/documents/proposal-sponsorship-futurise-2026.pdf',
            'file_size_kb' => 4820,
            'is_public' => true,
            'download_count' => 89,
        ]);

        // Audit Log Sample (BR-13 Acceptance)
        AuditLog::log(
            'payment_verified',
            'Payment',
            $payBJB->id,
            ['status' => 'pending_verification'],
            ['status' => 'verified', 'verified_by' => $users['keuangan@futurise.id']->name],
            'Verifikasi transfer lunas rekening koran Bank BJB',
            $event->id
        );

        AuditLog::log(
            'booth_allocated',
            'BoothAllocation',
            1,
            null,
            ['booth_code' => 'B-01', 'organization' => 'Institut Teknologi Bandung (ITB)'],
            'Penetapan alokasi booth akademik oleh panitia venue',
            $event->id
        );
    }
}

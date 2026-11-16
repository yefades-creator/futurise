# Panduan Pengguna FUTURiSE

Panduan ini merangkum seluruh aktor pada halaman 3 **FUTURiSE_Spesifikasi_Website.pdf** dan menjelaskan fungsi yang tersedia pada aplikasi saat ini. Jika sebuah menu belum tersedia, bagian tersebut ditandai sebagai keterbatasan supaya pengguna tidak mengira prosesnya sudah otomatis.

## Mulai menggunakan aplikasi

1. Pengunjung dan peserta dapat membuka **Daftar**, memilih kategori yang sesuai, lalu mengisi data PIC dan organisasi jika diminta. Pendaftaran organisasi akan berstatus **Menunggu Verifikasi**.
2. Panitia masuk memakai akun yang diberikan administrator. Akun seed lokal tersedia dengan kata sandi `password`; akun contoh ini hanya untuk lingkungan lokal/UAT dan jangan dipakai pada server publik.
3. Setelah masuk, gunakan menu di sisi kiri. Menu panitia dan endpoint backend dibatasi menurut peran. Jika seseorang memiliki beberapa peran, pilih peran aktif dari pemilih peran di bilah atas.
4. Untuk akun organisasi yang baru mendaftar, pantau keputusan verifikasi sebelum mengajukan kegiatan yang mensyaratkan organisasi terverifikasi.

## Aktor dan panduan tugas

| Aktor | Halaman utama | Panduan penggunaan dan batas fungsi saat ini |
|---|---|---|
| **Super Admin** | `/admin` | Mengatur parameter acara di **Pengaturan Acara**, mengelola akun, peran, serta tautan organisasi/tim di **Data User**, meninjau semua organisasi, mengelola kurasi/publikasi, booth, keuangan, check-in, penjurian, rapat, ekspor, dan audit. Hanya Super Admin yang dapat membuka ulang nilai juri yang sudah terkunci. |
| **Ketua Pelaksana** | `/admin` | Gunakan dashboard lintas divisi untuk memantau kesiapan, kehadiran, dana, dan tindak lanjut. Dapat melihat rekap penjurian dan mengesahkan/menarik publikasi hasil resmi. Hak verifikasi pembayaran tetap pada Keuangan. |
| **Sekretariat** | `/admin/organizations` | Tinjau pendaftaran organisasi, pilih **Verifikasi** atau **Tolak**, tulis catatan, lalu simpan. Dapat melihat audit dan mengelola jadwal/pertemuan yang masuk. Editor berita, FAQ, surat, dan dokumen terpisah belum tersedia. |
| **Keuangan** | `/admin/finance` | Periksa tagihan dan pembayaran yang menunggu. Buka **Lihat Bukti**, cocokkan bukti transfer, lalu pilih **Verifikasi Lunas**. Pembayaran yang diunggah peserta belum dianggap terbayar sampai diverifikasi. Ringkasan memisahkan kas dari barang/jasa. |
| **Program dan Kurasi** | `/admin/projects`, `/admin/judging` | Buka karya untuk meninjau, memberi catatan, dan memilih status. Pilih **Perlu Revisi** untuk membuka kembali materi; status pemeriksaan/keputusan menguncinya. Tetapkan finalis pitching di halaman karya. Di **Penjurian & Pemenang**, tugaskan akun Juri aktif ke karya berstatus lolos kurasi. Editor versi rubrik belum tersedia. |
| **Kampus dan Sekolah (panitia)** | `/admin/organizations`, `/admin/tours` | Verifikasi organisasi bertipe kampus atau sekolah. Buat dan perbarui slot tur dari **Jadwal Tur Sekolah**; slot yang dibuka akan muncul di portal PIC Sekolah. Menu booth hanya untuk melihat alokasi. |
| **Industri dan Sponsor (panitia)** | `/admin/organizations`, `/admin/sponsorship` | Verifikasi organisasi industri/mitra/sponsor. Di **Sponsorship & Manfaat**, buat atau ubah kesepakatan, catat status pemenuhan, unggah bukti, lalu simpan. CRM prospek dan editor paket sponsor belum tersedia lengkap. |
| **Venue dan Teknis** | `/admin/booths` | Alokasikan organisasi terverifikasi ke booth dengan kategori yang sesuai, lalu lepas alokasi jika perlu. Booth sponsor memakai kuota booth industri. Sistem menolak alokasi ganda untuk organisasi/booth. Editor denah seret-dan-lepas dan checklist teknis belum tersedia. |
| **Publikasi** | `/admin/projects` | Tinjau status publikasi secara terpisah dari kelulusan kurasi. Di bagian **CMS Berita & Publikasi**, buat, ubah, jadwalkan, terbitkan, atau hapus berita kategori CMS, Katalog Publik, Media, Sponsor Publik, dan Dokumentasi dengan gambar/dokumen lampiran. |
| **Registrasi dan Layanan** | `/admin/checkin` | Pindai tiket pengunjung dengan kamera, scanner QR USB, atau masukkan token manual. Pilih arah **Masuk** atau **Keluar** dan gate. Scan ulang tidak menambah pengunjung unik. Untuk QR sekolah, isi jumlah hadir aktual sebelum scan; jumlah rombongan dicatat terpisah dari hitungan tiket individu. |
| **PIC Kampus** | `/portal` | Daftarkan kampus, tunggu verifikasi, lalu di tab **Karya Mahasiswa** pilih **Tambah Karya**. Isi data karya, pilih tim pengusul bila tersedia, simpan sebagai draft, lalu pilih **Ajukan Kurasi** setelah siap. Satu kampus maksimal dua karya. |
| **Tim Mahasiswa** | `/portal` | Lihat dan kelola karya yang ditugaskan ke tim tempat akun Anda terdaftar. Pendaftaran karya baru dilakukan oleh PIC Kampus. Hubungi PIC jika belum ada karya yang ditugaskan. Materi terkunci selama pemeriksaan dan terbuka kembali saat status **Perlu Revisi**. |
| **PIC Industri / Mitra** | `/portal` | Lihat informasi organisasi/booth, jadwalkan pertemuan dengan organisasi terverifikasi, dan pantau tindak lanjut. Permintaan pertemuan berstatus menunggu sampai panitia mengonfirmasi. Pengajuan prospek, profil/solusi, partisipasi, dan upload kebutuhan teknis belum tersedia lengkap. |
| **PIC Sponsor** | `/portal` | Lihat rincian kesepakatan dan bukti pemenuhan yang sudah dicatat panitia, serta unduh bukti. Bayar tagihan dengan mengunggah bukti transfer. Perubahan kontrak dan pencatatan pemenuhan dilakukan oleh panitia; hubungi PIC Industri dan Sponsor untuk koreksi. |
| **PIC Sekolah** | `/portal` | Setelah organisasi sekolah diverifikasi dan panitia membuat slot tur, pilih slot yang terbuka dan isi jumlah siswa serta pendamping. Setelah pemesanan, simpan token/QR grup. Saat datang, petugas gate memindai QR dan mencatat jumlah aktual. QR grup tidak mewakili tiket individu. |
| **Juri** | `/juri` | Buka hanya karya yang ditugaskan. Gunakan filter **Nilai terkunci** untuk melihat penilaian final, lalu pilih **Lihat Lembar Penilaian** untuk membuka secara baca-saja. Karya yang belum terkunci dapat dinilai dengan indikator skala 1–5 dan feedback, lalu disimpan sebagai draf atau **Kunci Nilai**. Ajukan deklarasi konflik kepentingan dari daftar penugasan. |
| **Pengunjung** | `/portal` | Daftar sebagai pengunjung, buka kartu tiket, dan tunjukkan QR saat masuk. Setelah check-in, pilih karya terbit untuk memberi satu suara dan isi satu survei per tiket. Feedback karya dapat dikirim dari halaman detail; nama/feedback hanya ditampilkan publik jika pemberi memilih persetujuan. |

## Alur umum yang perlu diikuti

### Mengatur periode voting

1. Masuk sebagai **Super Admin**, lalu buka **Pengaturan Acara** (`/admin/settings`).
2. Isi **Mulai Voting** dan **Akhir Voting** dalam waktu WIB. Kedua waktu harus diisi dan waktu akhir harus setelah waktu mulai.
3. Simpan konfigurasi. Voting dibuka pada waktu mulai dan ditutup tepat pada waktu akhir; sistem juga menolak vote dari backend di luar rentang tersebut.
4. Jika kedua kolom dikosongkan, voting tidak dibatasi waktu. Perubahan tercatat pada audit log.

### Pendaftaran dan verifikasi organisasi

Organisasi didaftarkan dari halaman **Daftar**. Panitia yang berwenang membuka **Verifikasi Organisasi**, memeriksa PIC/kategori, lalu menyimpan keputusan dan catatan. Organisasi yang ditolak dapat ditinjau kembali; mintalah PIC memperbaiki data melalui Sekretariat karena editor profil belum tersedia.

### Karya kampus

PIC Kampus mendaftarkan karya dari tab **Karya Mahasiswa** di portal, mengisi data, memilih tim pengusul bila tersedia, lalu menyimpan sebagai draft. PIC mengajukan karya untuk kurasi setelah siap. Tim Mahasiswa hanya melihat dan mengelola karya yang ditugaskan ke timnya. Jika akun mahasiswa belum terhubung, Super Admin membuka **Data User** (`/admin/users`) dan mengaitkan akun ke organisasi/tim yang tepat. Organisasi harus diverifikasi sebelum karya dapat didaftarkan. Satu organisasi kampus dibatasi maksimal dua karya.

### Pembayaran

PIC mengunggah nominal, tanggal, bank, pemilik rekening, dan file bukti. File disimpan privat. Keuangan membuka bukti, mengatur pembagian nominal ke rincian tagihan pada **Atur alokasi ke rincian tagihan**, lalu memverifikasi. Jumlah alokasi tidak boleh melebihi pembayaran; bila tidak diubah, pembayaran dialokasikan penuh ke rincian pertama. Jumlah pembayaran yang masih menunggu verifikasi mengurangi saldo yang bisa diunggah lagi.

Tagihan baru dibuat dan diubah oleh Keuangan dari **Keuangan & Verifikasi** (`/admin/finance`). Total dihitung dari subtotal dikurangi diskon ditambah pajak; sistem menolak perubahan total yang lebih kecil dari pembayaran terverifikasi atau yang sedang menunggu.

### Kesepakatan dan manfaat sponsor

Panitia Industri dan Sponsor membuka **Sponsorship & Manfaat** (`/admin/sponsorship`) untuk membuat atau memperbarui kontrak, paket, nilai komitmen, jenis dukungan, dan status. Di bawah tiap kesepakatan, tambahkan manfaat paket, atur status pelaksanaannya, dan unggah bukti JPG/PNG/PDF (maksimal 10 MB) atau tautan. File bukti disimpan privat dan dapat diunduh PIC organisasi terkait dari portal.

### Berita, gambar, dan dokumen publik

Super Admin atau Publikasi membuka `/admin/projects`, lalu bagian **CMS Berita & Publikasi**. Isi judul, kategori, ringkasan, dan isi; gambar sampul JPG/PNG/WEBP maksimal 5 MB dan dokumen PDF/DOC/XLS/PPT maksimal 20 MB bersifat opsional. Centang **Terbitkan ke halaman publik** agar berita muncul di `/berita`; waktu publikasi mendatang akan menahan tayang sampai waktunya. Berita dapat diperbarui atau dihapus dari daftar posting yang sama.

### Pertemuan kolaborasi

PIC organisasi terverifikasi mengajukan pihak tujuan, meja, waktu, dan topik. Sistem menolak bentrok pihak/meja. Permintaan organisasi menunggu konfirmasi panitia; penjadwalan oleh panitia dapat langsung dikonfirmasi setelah pemeriksaan bentrok.

### Tiket, check-in, dan survei

QR tiket memuat token acak, bukan nama/email. Scan masuk pertama menandai kehadiran. Scan ulang tercatat sebagai log tetapi tidak menambah jumlah unik. Check-out hanya diterima setelah ada check-in. Survei hanya dapat dikirim akun dengan tiket yang sudah check-in dan satu kali per tiket.

## Fitur yang belum tersedia sesuai spesifikasi

Bagian berikut masih memerlukan pengembangan; panduan ini tidak menganggapnya sudah berjalan:

- Pengelolaan pengguna/peran, undangan tim, reset kata sandi, verifikasi email, dan autentikasi tambahan admin.
- Editor CMS untuk berita, agenda, FAQ, halaman publik, dokumen unduhan, korespondensi, dan notifikasi dengan status kirim/retry.
- Editor profil organisasi dan dokumen pendaftaran; unggah media/poster karya.
- CRM prospek industri/sponsor, editor paket dan upload materi sponsor, serta akses laporan sponsor.
- CRUD lengkap untuk sesi/pembicara, kebutuhan teknis booth, biaya/pengeluaran, dan laporan H+30 lintas organisasi.
- Editor versi rubrik, aturan seri, dan koreksi suara dengan audit.
- Pemindai kehadiran individu untuk setiap anggota rombongan sekolah. Saat ini QR sekolah mencatat kunjungan grup dan jumlah aktual secara terpisah.
- Ekspor PDF, laporan lengkap yang dapat dikonfigurasi, serta prosedur backup/pemulihan dan pemantauan operasional.

## Catatan UAT

- Uji URL langsung, bukan hanya menu: role lain harus menerima penolakan akses pada endpoint yang tidak menjadi kewenangannya.
- Pastikan pendaftaran kampus/industri/sponsor/sekolah mencatat kategori organisasi yang benar dan tiket sesuai kategori yang diizinkan.
- Uji scan berulang, check-out tanpa check-in, dua suara, dua upload pembayaran yang menunggu, alokasi booth ganda, dan dua jadwal yang bentrok.
- Akun demo cepat hanya tersedia pada lingkungan `local`/`testing`. Jangan mengaktifkannya pada production.

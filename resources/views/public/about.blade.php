@extends('layouts.app', ['title' => 'Tentang FUTURiSE | West Java Digital Innovation Festival'])

@section('content')
<div class="gradient-brand text-white py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">West Java Digital Innovation Festival</span>
        <h1 class="text-4xl sm:text-5xl font-black mt-3">Tentang FUTURiSE</h1>
        <p class="text-orange-400 font-bold tracking-[0.2em] text-sm mt-4">IDEAS RISE. FUTURES BEGIN.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-16">
    <section id="profil" class="relative overflow-hidden rounded-[2rem] bg-slate-950 text-white shadow-xl">
        <div class="absolute -top-32 -right-24 w-96 h-96 rounded-full bg-cyan-500/20 blur-3xl"></div>
        <div class="absolute -bottom-40 left-1/3 w-96 h-96 rounded-full bg-indigo-500/20 blur-3xl"></div>
        <div class="relative grid grid-cols-1 lg:grid-cols-12 gap-10 p-7 sm:p-10 lg:p-14 items-center">
            <div class="lg:col-span-7 space-y-5">
                <span class="inline-flex items-center gap-2 rounded-full border border-cyan-400/30 bg-cyan-400/10 px-3 py-1.5 text-[11px] font-bold uppercase tracking-widest text-cyan-300">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-300"></span> Profil FUTURiSE
                </span>
                <h2 class="text-3xl sm:text-4xl xl:text-5xl font-black leading-tight">Ruang kolaborasi untuk <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-400">inovasi digital</span></h2>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed max-w-2xl">
                    <strong class="text-white">FUTURiSE – West Java Digital Innovation Festival</strong> diinisiasi oleh APTIKOM Jawa Barat untuk mempertemukan perguruan tinggi, mahasiswa, industri, pemerintah, komunitas, dan masyarakat dalam satu ekosistem inovasi.
                </p>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed max-w-2xl">
                    Dari pameran karya dan demo teknologi hingga presentasi inovasi dan pertemuan kolaborasi, FUTURiSE menghubungkan solusi kampus dengan kebutuhan nyata. Di sini, ide berkembang, karya dikenal, teknologi diuji, dan peluang masa depan mulai terbentuk.
                </p>
                <div class="flex items-center gap-3 pt-2">
                    <span class="h-px w-10 bg-orange-400"></span>
                    <span class="text-xs sm:text-sm font-extrabold tracking-[0.18em] text-orange-300">IDEAS RISE. FUTURES BEGIN.</span>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="rounded-3xl border border-white/10 bg-white/[0.06] p-5 sm:p-6 backdrop-blur-sm">
                    <div class="flex items-center justify-between mb-5">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-300">Satu ekosistem</span>
                        <i class="fa-solid fa-arrow-up-right-dots text-cyan-300"></i>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="rounded-2xl bg-blue-500/15 border border-blue-300/15 p-4"><i class="fa-solid fa-building-columns text-blue-300"></i><p class="text-xs font-semibold mt-3">Perguruan tinggi</p></div>
                        <div class="rounded-2xl bg-cyan-500/15 border border-cyan-300/15 p-4"><i class="fa-solid fa-lightbulb text-cyan-300"></i><p class="text-xs font-semibold mt-3">Mahasiswa</p></div>
                        <div class="rounded-2xl bg-orange-500/15 border border-orange-300/15 p-4"><i class="fa-solid fa-industry text-orange-300"></i><p class="text-xs font-semibold mt-3">Industri</p></div>
                        <div class="rounded-2xl bg-indigo-500/20 border border-indigo-300/15 p-4"><i class="fa-solid fa-landmark text-indigo-300"></i><p class="text-xs font-semibold mt-3">Pemerintah</p></div>
                        <div class="rounded-2xl bg-teal-500/15 border border-teal-300/15 p-4"><i class="fa-solid fa-people-group text-teal-300"></i><p class="text-xs font-semibold mt-3">Komunitas</p></div>
                        <div class="rounded-2xl bg-sky-500/15 border border-sky-300/15 p-4"><i class="fa-solid fa-users text-sky-300"></i><p class="text-xs font-semibold mt-3">Masyarakat</p></div>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-5">Ide bertemu kebutuhan. Kolaborasi membuka dampak.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="visi-misi" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <article class="rounded-3xl bg-gradient-to-br from-indigo-950 to-slate-900 p-8 sm:p-10 text-white shadow-lg">
            <!-- <div class="w-12 h-12 rounded-xl bg-cyan-400/15 text-cyan-300 flex items-center justify-center text-xl"><i class="fa-solid fa-eye"></i></div> -->
            <h2 class="text-2xl font-black mt-5">Visi</h2>
            <p class="text-sm text-slate-300 leading-relaxed mt-3">Menjadi wadah kolaborasi dan ekosistem inovasi digital yang menghubungkan perguruan tinggi, industri, pemerintah, dan masyarakat untuk mendorong lahirnya solusi teknologi yang inovatif, relevan, dan berdampak bagi masa depan.</p>
        </article>
        <article class="rounded-3xl bg-white border border-slate-200 p-8 sm:p-10 shadow-sm">
            <!-- <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center text-xl"><i class="fa-solid fa-compass"></i></div> -->
            <h2 class="text-2xl font-black text-slate-900 mt-5">Misi</h2>
            <ul class="text-sm text-slate-600 leading-relaxed mt-4 space-y-3">
                <li class="flex gap-3"><i class="fa-solid fa-check text-cyan-600 mt-1"></i><span>Memperkenalkan dan memperluas eksposur karya inovasi mahasiswa.</span></li>
                <li class="flex gap-3"><i class="fa-solid fa-check text-cyan-600 mt-1"></i><span>Memberi kesempatan bagi mahasiswa untuk mendemonstrasikan karya dan memperoleh masukan langsung.</span></li>
                <li class="flex gap-3"><i class="fa-solid fa-check text-cyan-600 mt-1"></i><span>Membangun kolaborasi antarperguruan tinggi melalui pertukaran ide, pengetahuan, dan pengalaman.</span></li>
                <li class="flex gap-3"><i class="fa-solid fa-check text-cyan-600 mt-1"></i><span>Mempertemukan inovasi akademik dengan kebutuhan industri dan mitra potensial.</span></li>
                <li class="flex gap-3"><i class="fa-solid fa-check text-cyan-600 mt-1"></i><span>Membuka peluang karier, magang, dan jejaring profesional bagi mahasiswa.</span></li>
                <li class="flex gap-3"><i class="fa-solid fa-check text-cyan-600 mt-1"></i><span>Mendorong pengembangan karya inovatif menjadi solusi yang memiliki nilai guna.</span></li>
            </ul>
        </article>
    </section>

    <section id="tujuan">
        <div class="max-w-3xl mb-7">
            <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">Tujuan FUTURiSE</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Dari eksposur menuju peluang penerapan</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="text-cyan-600 text-xl"><i class="fa-solid fa-images"></i></div><h3 class="font-bold text-slate-900 mt-4">Eksposur Karya</h3><p class="text-xs text-slate-600 mt-2 leading-relaxed">Memperluas pengenalan karya inovasi mahasiswa.</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="text-indigo-600 text-xl"><i class="fa-solid fa-comments"></i></div><h3 class="font-bold text-slate-900 mt-4">Masukan Pengguna</h3><p class="text-xs text-slate-600 mt-2 leading-relaxed">Memperoleh feedback langsung untuk penyempurnaan karya.</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="text-orange-500 text-xl"><i class="fa-solid fa-people-arrows-left-right"></i></div><h3 class="font-bold text-slate-900 mt-4">Kolaborasi Kampus</h3><p class="text-xs text-slate-600 mt-2 leading-relaxed">Membangun jejaring dan kolaborasi antarperguruan tinggi.</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="text-cyan-600 text-xl"><i class="fa-solid fa-laptop-code"></i></div><h3 class="font-bold text-slate-900 mt-4">Peluang Penerapan</h3><p class="text-xs text-slate-600 mt-2 leading-relaxed">Menghubungkan karya dengan kebutuhan nyata.</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="text-indigo-600 text-xl"><i class="fa-solid fa-briefcase"></i></div><h3 class="font-bold text-slate-900 mt-4">Talenta dan Karier</h3><p class="text-xs text-slate-600 mt-2 leading-relaxed">Membuka peluang magang, kerja, dan pengembangan karier.</p>
            </article>
        </div>
    </section>

    <section id="program">
        <div class="max-w-3xl mb-7">
            <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">Program utama</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Tujuh cara untuk bertemu dan berkolaborasi</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            <article class="rounded-2xl border border-slate-200 p-6"><div class="text-cyan-600 text-xl"><i class="fa-solid fa-lightbulb"></i></div><h3 class="font-bold text-slate-900 mt-3">Innovation Showcase</h3><p class="text-sm text-slate-600 mt-2 leading-relaxed">Pameran dan demonstrasi karya inovasi mahasiswa untuk memperkenalkan solusi teknologi kepada pengunjung, pengguna, dan calon mitra.</p></article>
            <article class="rounded-2xl border border-slate-200 p-6"><div class="text-indigo-600 text-xl"><i class="fa-solid fa-microchip"></i></div><h3 class="font-bold text-slate-900 mt-3">Industry Showcase</h3><p class="text-sm text-slate-600 mt-2 leading-relaxed">Pengenalan solusi, produk, dan teknologi perusahaan industri sekaligus membuka peluang kolaborasi dengan perguruan tinggi.</p></article>
            <article class="rounded-2xl border border-slate-200 p-6"><div class="text-orange-500 text-xl"><i class="fa-solid fa-school"></i></div><h3 class="font-bold text-slate-900 mt-3">School Discovery Tour</h3><p class="text-sm text-slate-600 mt-2 leading-relaxed">Kunjungan terarah bagi siswa SMA/SMK untuk mengenal, mencoba, dan memahami perkembangan teknologi serta inovasi digital.</p></article>
            <article class="rounded-2xl border border-slate-200 p-6"><div class="text-cyan-600 text-xl"><i class="fa-solid fa-microphone-lines"></i></div><h3 class="font-bold text-slate-900 mt-3">Future Talent Talk</h3><p class="text-sm text-slate-600 mt-2 leading-relaxed">Sesi berbagi wawasan mengenai perkembangan teknologi, kebutuhan industri, dan peluang karier masa depan.</p></article>
            <article class="rounded-2xl border border-slate-200 p-6"><div class="text-indigo-600 text-xl"><i class="fa-solid fa-chart-line"></i></div><h3 class="font-bold text-slate-900 mt-3">Innovation Pitch</h3><p class="text-sm text-slate-600 mt-2 leading-relaxed">Presentasi karya inovasi mahasiswa di hadapan juri untuk memperoleh penilaian, masukan, dan peluang pengembangan.</p></article>
            <article class="rounded-2xl border border-slate-200 p-6"><div class="text-orange-500 text-xl"><i class="fa-solid fa-trophy"></i></div><h3 class="font-bold text-slate-900 mt-3">Innovation Awards</h3><p class="text-sm text-slate-600 mt-2 leading-relaxed">Apresiasi karya inovasi mahasiswa melalui kategori Best Innovation, Best Impact, dan People’s Choice.</p></article>
            <article class="rounded-2xl border border-slate-200 p-6 md:col-span-2 xl:col-span-3"><div class="text-cyan-600 text-xl"><i class="fa-solid fa-handshake"></i></div><h3 class="font-bold text-slate-900 mt-3">Industry and Government Connect</h3><p class="text-sm text-slate-600 mt-2 leading-relaxed">Pertemuan terjadwal antara perguruan tinggi, industri, dan pemerintah untuk membahas kebutuhan, potensi penerapan, serta peluang kolaborasi.</p></article>
        </div>
    </section>

    <section id="ekosistem" class="rounded-3xl bg-slate-950 p-8 sm:p-10 text-white">
        <div class="max-w-3xl">
            <span class="text-cyan-400 font-extrabold text-xs uppercase tracking-widest">Ekosistem kolaborasi</span>
            <h2 class="text-2xl sm:text-3xl font-black mt-1">Enam kelompok, satu ruang inovasi</h2>
            <p class="text-sm text-slate-300 mt-3 leading-relaxed">FUTURiSE mempertemukan pemangku kepentingan yang memiliki peran dan kontribusi dalam membangun ekosistem inovasi digital.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-7">
            <div class="rounded-xl bg-slate-800 p-5"><h3 class="font-bold">Perguruan Tinggi</h3><p class="text-xs text-slate-400 mt-2">Membawa karya, inovasi, dan membangun jejaring.</p></div>
            <div class="rounded-xl bg-slate-800 p-5"><h3 class="font-bold">Mahasiswa</h3><p class="text-xs text-slate-400 mt-2">Mendemonstrasikan solusi dan menerima masukan.</p></div>
            <div class="rounded-xl bg-slate-800 p-5"><h3 class="font-bold">Industri</h3><p class="text-xs text-slate-400 mt-2">Mengenalkan teknologi, mencari talenta, dan menjajaki kolaborasi.</p></div>
            <div class="rounded-xl bg-slate-800 p-5"><h3 class="font-bold">Pemerintah dan Komunitas</h3><p class="text-xs text-slate-400 mt-2">Membawa kebutuhan serta peluang penerapan.</p></div>
            <div class="rounded-xl bg-slate-800 p-5"><h3 class="font-bold">SMA/SMK</h3><p class="text-xs text-slate-400 mt-2">Mengenal teknologi dan pilihan studi.</p></div>
            <div class="rounded-xl bg-slate-800 p-5"><h3 class="font-bold">Masyarakat</h3><p class="text-xs text-slate-400 mt-2">Mencoba inovasi dan berbagi pengalaman.</p></div>
        </div>
    </section>
</div>
@endsection

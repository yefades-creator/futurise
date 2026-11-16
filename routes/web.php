<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminSponsorshipController;

/*
|--------------------------------------------------------------------------
| Public Routes (Struktur Menu Publik)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/tentang', [PublicController::class, 'about'])->name('about');
Route::get('/agenda', [PublicController::class, 'agenda'])->name('agenda');
Route::get('/showcase', [PublicController::class, 'showcase'])->name('showcase');
Route::get('/showcase/{slug}', [PublicController::class, 'projectDetail'])->name('project.detail');
Route::post('/showcase/{project}/feedback', [PublicController::class, 'submitFeedback'])->name('project.feedback');
Route::post('/showcase/{project}/vote', [PublicController::class, 'submitVote'])->name('project.vote');
Route::get('/industri', [PublicController::class, 'industries'])->name('industries');
Route::get('/sponsor', [PublicController::class, 'sponsors'])->name('sponsors');
Route::get('/informasi-peserta', [PublicController::class, 'participantInfo'])->name('participant.info');
Route::get('/venue', [PublicController::class, 'venue'])->name('venue');
Route::get('/berita', [PublicController::class, 'news'])->name('news');
Route::get('/berita/{slug}/dokumen', [PublicController::class, 'downloadNewsDocument'])->name('news.document');
Route::get('/berita/{slug}', [PublicController::class, 'newsDetail'])->name('news.detail');
Route::get('/kontak', [PublicController::class, 'contact'])->name('contact');
Route::post('/survei', [PublicController::class, 'submitSurvey'])->name('survey.submit')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/masuk', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/keluar', [AuthController::class, 'logout']);

Route::get('/daftar', [AuthController::class, 'showRegister'])->name('register');
Route::post('/daftar', [AuthController::class, 'register'])->name('register.post');

// One-click demo login switcher
Route::get('/quick-login/{email}', [AuthController::class, 'quickLogin'])->name('quick.login');
Route::post('/switch-role', [AuthController::class, 'switchRole'])->name('switch.role')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Participant Portal Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('portal')->name('portal.')->group(function () {
    Route::get('/', [PortalController::class, 'dashboard'])->name('dashboard');
    Route::post('/projects', [PortalController::class, 'storeProject'])->middleware('role:pic-kampus')->name('projects.store');
    Route::put('/projects/{id}', [PortalController::class, 'updateProject'])->middleware('role:pic-kampus,tim-mahasiswa')->name('projects.update');
    Route::post('/projects/{id}/submit', [PortalController::class, 'submitProjectForReview'])->middleware('role:pic-kampus,tim-mahasiswa')->name('projects.submit');
    Route::post('/invoices/{id}/pay', [PortalController::class, 'uploadPaymentProof'])->middleware('role:pic-kampus,pic-industri,pic-sponsor')->name('invoices.pay');
    Route::get('/sponsorship/fulfillments/{fulfillmentId}/proof', [PortalController::class, 'downloadSponsorshipProof'])->middleware('role:pic-sponsor,super-admin,industri-sponsor,publikasi')->name('sponsorship.proofs.download');
    Route::get('/meetings', [PortalController::class, 'meetingRequestForm'])->middleware('role:pic-kampus,pic-industri,pic-sponsor')->name('meetings.form');
    Route::post('/meetings', [PortalController::class, 'requestMeeting'])->middleware('role:pic-kampus,pic-industri,pic-sponsor')->name('meetings.request');
    Route::post('/tours', [PortalController::class, 'bookTourSlot'])->middleware('role:pic-sekolah')->name('tours.book');
    Route::post('/support', [PortalController::class, 'submitSupportTicket'])->name('support.submit');
});

/*
|--------------------------------------------------------------------------
| Judge Portal Routes (Portal Juri)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:juri,super-admin'])->prefix('juri')->name('juri.')->group(function () {
    Route::get('/', [JudgeController::class, 'dashboard'])->name('dashboard');
    Route::get('/karya/{projectId}', [JudgeController::class, 'showAssessment'])->name('assessment.show');
    Route::post('/karya/{projectId}/penilaian', [JudgeController::class, 'storeAssessment'])->name('assessment.store');
    Route::post('/assignment/{id}/konflik', [JudgeController::class, 'declareConflict'])->name('conflict.declare');
});

/*
|--------------------------------------------------------------------------
| Committee & Admin Dashboard (Dashboard Panitia)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->middleware('role:super-admin,ketua-pelaksana')->name('dashboard');
    Route::get('/projects', [AdminController::class, 'projects'])->middleware('role:super-admin,program-kurasi,publikasi')->name('projects');
    Route::post('/news', [AdminController::class, 'storeNews'])->middleware('role:super-admin,publikasi')->name('news.store');
    Route::put('/news/{newsId}', [AdminController::class, 'updateNews'])->middleware('role:super-admin,publikasi')->name('news.update');
    Route::delete('/news/{newsId}', [AdminController::class, 'destroyNews'])->middleware('role:super-admin,publikasi')->name('news.destroy');
    Route::get('/organizations', [AdminController::class, 'organizations'])->middleware('role:super-admin,sekretariat,kampus-sekolah,industri-sponsor')->name('organizations');
    Route::post('/organizations/{id}/verify', [AdminController::class, 'verifyOrganization'])->middleware('role:super-admin,sekretariat,kampus-sekolah,industri-sponsor')->name('organizations.verify');
    Route::post('/projects/{id}/curate', [AdminController::class, 'curateProject'])->middleware('role:super-admin,program-kurasi')->name('projects.curate');
    Route::post('/projects/{id}/publication', [AdminController::class, 'updateProjectPublication'])->middleware('role:super-admin,publikasi')->name('projects.publication');
    Route::get('/booths', [AdminController::class, 'booths'])->middleware('role:super-admin,venue-teknis,kampus-sekolah,industri-sponsor')->name('booths');
    Route::post('/booths/allocate', [AdminController::class, 'allocateBooth'])->middleware('role:super-admin,venue-teknis')->name('booths.allocate');
    Route::post('/booths/{id}/release', [AdminController::class, 'releaseBooth'])->middleware('role:super-admin,venue-teknis')->name('booths.release');
    Route::get('/finance', [AdminController::class, 'finance'])->middleware('role:super-admin,ketua-pelaksana,keuangan')->name('finance');
    Route::post('/finance/invoices', [AdminController::class, 'storeInvoice'])->middleware('role:super-admin,keuangan')->name('finance.invoices.store');
    Route::put('/finance/invoices/{invoiceId}', [AdminController::class, 'updateInvoice'])->middleware('role:super-admin,keuangan')->name('finance.invoices.update');
    Route::post('/finance/{id}/verify', [AdminController::class, 'verifyPayment'])->middleware('role:super-admin,keuangan')->name('finance.verify');
    Route::get('/finance/{id}/receipt', [AdminController::class, 'downloadPaymentReceipt'])->middleware('role:super-admin,keuangan')->name('finance.receipt');
    Route::get('/sponsorship', [AdminSponsorshipController::class, 'index'])->middleware('role:super-admin,industri-sponsor,publikasi')->name('sponsorship');
    Route::post('/sponsorship/agreements', [AdminSponsorshipController::class, 'storeAgreement'])->middleware('role:super-admin,industri-sponsor')->name('sponsorship.agreements.store');
    Route::put('/sponsorship/agreements/{agreementId}', [AdminSponsorshipController::class, 'updateAgreement'])->middleware('role:super-admin,industri-sponsor')->name('sponsorship.agreements.update');
    Route::post('/sponsorship/agreements/{agreementId}/fulfillments', [AdminSponsorshipController::class, 'storeFulfillment'])->middleware('role:super-admin,industri-sponsor,publikasi')->name('sponsorship.fulfillments.store');
    Route::put('/sponsorship/fulfillments/{fulfillmentId}', [AdminSponsorshipController::class, 'updateFulfillment'])->middleware('role:super-admin,industri-sponsor,publikasi')->name('sponsorship.fulfillments.update');
    Route::get('/sponsorship/fulfillments/{fulfillmentId}/proof', [AdminSponsorshipController::class, 'downloadProof'])->middleware('role:super-admin,industri-sponsor,publikasi')->name('sponsorship.fulfillments.proof');
    Route::get('/checkin', [AdminController::class, 'checkIn'])->middleware('role:super-admin,registrasi-layanan')->name('checkin');
    Route::post('/checkin/scan', [AdminController::class, 'processScan'])->middleware('role:super-admin,registrasi-layanan')->name('checkin.scan');
    Route::post('/checkin/support/{ticketId}', [AdminController::class, 'updateCheckinSupportTicket'])->middleware('role:super-admin,registrasi-layanan')->name('checkin.support.update');
    Route::get('/tours', [AdminController::class, 'tourSlots'])->middleware('role:super-admin,kampus-sekolah')->name('tours');
    Route::post('/tours', [AdminController::class, 'storeTourSlot'])->middleware('role:super-admin,kampus-sekolah')->name('tours.store');
    Route::put('/tours/{slotId}', [AdminController::class, 'updateTourSlot'])->middleware('role:super-admin,kampus-sekolah')->name('tours.update');
    Route::get('/judging', [AdminController::class, 'judging'])->middleware('role:super-admin,program-kurasi,ketua-pelaksana')->name('judging');
    Route::post('/judging/assignments', [AdminController::class, 'assignJudge'])->middleware('role:super-admin,program-kurasi')->name('judging.assignments.store');
    Route::post('/judging/{id}/unlock', [AdminController::class, 'unlockScore'])->middleware('role:super-admin')->name('judging.unlock');
    Route::post('/judging/publish-toggle', [AdminController::class, 'togglePublishResults'])->middleware('role:super-admin,ketua-pelaksana')->name('judging.publish-toggle');
    Route::get('/meetings', [AdminController::class, 'meetings'])->middleware('role:super-admin,ketua-pelaksana,sekretariat,program-kurasi,industri-sponsor,venue-teknis')->name('meetings');
    Route::post('/meetings', [AdminController::class, 'scheduleMeetingManual'])->middleware('role:super-admin,sekretariat,program-kurasi,industri-sponsor')->name('meetings.schedule');
    Route::post('/meetings/{id}/status', [AdminController::class, 'updateMeetingStatus'])->middleware('role:super-admin,sekretariat,program-kurasi,industri-sponsor')->name('meetings.status');
    Route::get('/followups', [AdminController::class, 'followUps'])->middleware('role:super-admin,ketua-pelaksana,sekretariat,program-kurasi,industri-sponsor')->name('followups');
    Route::put('/followups/{id}', [AdminController::class, 'updateFollowUp'])->middleware('role:super-admin,sekretariat,program-kurasi,industri-sponsor')->name('followups.update');
    Route::get('/settings', [AdminController::class, 'settings'])->middleware('role:super-admin')->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->middleware('role:super-admin')->name('settings.update');
    Route::get('/users', [AdminUserController::class, 'index'])->middleware('role:super-admin')->name('users');
    Route::get('/users/create', [AdminUserController::class, 'create'])->middleware('role:super-admin')->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->middleware('role:super-admin')->name('users.store');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->middleware('role:super-admin')->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->middleware('role:super-admin')->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->middleware('role:super-admin')->name('users.destroy');
    Route::get('/audit', [AdminController::class, 'auditLogs'])->middleware('role:super-admin,ketua-pelaksana,sekretariat')->name('audit');
    Route::get('/export/{type}', [AdminController::class, 'export'])->middleware('role:super-admin,ketua-pelaksana,sekretariat,keuangan,program-kurasi,registrasi-layanan')->name('export');
});

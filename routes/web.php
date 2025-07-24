<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactPersonController;
use App\Http\Controllers\DetailTncController;
use App\Http\Controllers\FilePendukungController;
use App\Http\Controllers\FileProgressProjectController;
use App\Http\Controllers\ItemTncController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisPekerjaanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriItemController;
use App\Http\Controllers\KonsepKerjasamaController;
use App\Http\Controllers\ProgressProjectController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StatusProjectController;
use App\Http\Controllers\TncController;
use App\Http\Controllers\KategoriClientController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ViewLokerController;
use App\Models\PendaftaranLowongan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::guard('karyawan')->check()) {
        return redirect()->route('karyawan.dashboard');
    }
    return view('login');
});
Route::get('/mail/send', function () {
    $data = [
        'subject' => 'Testing Kirim Email Subject',
        'title' => 'Subject Testing Kirim Email title',
        'content' => 'Seseorang telah ditambahkan ke Project Bank Sinarmas, cek sekarang!',
        'link' => 'https://www.facebook.com'
    ];

    Mail::to('xixixisiaiaffsdjfs@gmail.com')->send(new \App\Mail\SendMail($data));
});

Route::get('/login', function () {
    if (Auth::guard('karyawan')->check()) {
        return redirect()->route('karyawan.dashboard');
    }
    return view('login');
})->name('karyawan.login');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('karyawan')->name('karyawan.')->group(function () {
    Route::middleware('multi.guard:karyawan,admin')->group(function () {

        Route::prefix('view-lowongan')->name('view-lowongan.')->group(function () {
            Route::get('/', [ViewLokerController::class, 'index'])->name('index');
            Route::get('/{id}/daftar', [ViewLokerController::class, 'daftar'])->name('daftar');
            Route::post('/store', [ViewLokerController::class, 'store'])->name('store');
        });

        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/get-data-chart-dashboard', [DashboardController::class, 'requestChartByKaryawan'])->name('requestChartByKaryawan');
        Route::get('/check-client-name', [ClientController::class, 'checkClientName'])->name('checkClientName');

        Route::prefix('project')->name('project.')->group(function () {
            Route::get('/', [ProjectController::class, 'index'])->name('index');
            Route::get('/create', [ProjectController::class, 'create'])->name('create');
            Route::post('/store', [ProjectController::class, 'store'])->name('store');
            Route::post('/update', [ProjectController::class, 'update'])->name('update');
            Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('edit');
            Route::get('/get-contact-person/{id}', [ProjectController::class, 'getContactPersonByClientId'])->name('getContactPersonByClientId');
            Route::get('/get-contact-person-selected', [ProjectController::class, 'getContactPersonByProjectId'])->name('getContactPersonByProjectId');
            Route::post('/delete', [ProjectController::class, 'delete'])->name('delete');

            Route::prefix('details')->group(function (){
                Route::get('{id}', [ProjectController::class, 'show'])->name('details');
            });
        });
        Route::prefix('client')->name('client.')->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('index');
            Route::get('/create', [ClientController::class, 'create'])->name('create');
            Route::get('/details/{id}', [ClientController::class, 'show'])->name('details');
            Route::post('/store', [ClientController::class, 'store'])->name('store');
            Route::post('/update', [ClientController::class, 'update'])->name('update');
            Route::post('/delete', [ClientController::class, 'delete'])->name('delete');
        });
        Route::prefix('kategori-client')->name('kategori-client.')->group(function (){
            Route::get('/', [KategoriClientController::class, 'index'])->name('index');
            Route::post('/store', [KategoriClientController::class, 'store'])->name('store');
            Route::get('/{kategori_client}/edit', [KategoriClientController::class, 'edit'])->name('edit');
            Route::post('/update', [KategoriClientController::class, 'update'])->name('update');
            Route::post('/delete', [KategoriClientController::class, 'delete'])->name('delete');
        });
        Route::prefix('contact-person')->name('contact-person.')->group(function () {
            Route::get('/', [ContactPersonController::class, 'index'])->name('index');
            Route::get('/create', [ContactPersonController::class, 'create'])->name('create');
            Route::post('/store', [ContactPersonController::class, 'store'])->name('store');
            Route::get('/details/{id}', [ContactPersonController::class, 'show'])->name('details');
            Route::post('/update', [ContactPersonController::class, 'update'])->name('update');
            Route::post('/delete', [ContactPersonController::class, 'delete'])->name('delete');
        });
        Route::prefix('tnc')->name('tnc.')->group(function () {
            Route::get('/{id_jenis_pekerjaan_project}/tnc', [TncController::class, 'index'])->name('index');
            Route::get('/{id_jenis_pekerjaan_project}/create', [TncController::class, 'create'])->name('create');
            Route::post('/store', [TncController::class, 'store'])->name('store');
            Route::get('/{id_tnc}/details', [TncController::class, 'show'])->name('details');
            Route::get('/{id_tnc}/edit', [TncController::class, 'edit'])->name('edit');
            Route::post('/update', [TncController::class, 'update'])->name('update');
            Route::post('/delete', [TncController::class, 'delete'])->name('delete');
            Route::get('/list', [TncController::class, 'list'])->name('list');
            Route::get('/{id_tnc}/print', [TncController::class, 'print'])->name('print');
        });
        Route::prefix('detail-tnc')->name('detail-tnc.')->group(function (){
            Route::post('store', [DetailTncController::class, 'store_update'])->name('store');
        });
        Route::prefix('progress-project')->name('progress-project.')->group(function () {
            Route::post('/store', [ProgressProjectController::class, 'store'])->name('store');
            Route::post('/update', [ProgressProjectController::class, 'update'])->name('update');
            Route::post('/delete', [ProgressProjectController::class, 'delete'])->name('delete');
        });
        Route::prefix('file-progress-project')->name('file-progress-project.')->group(function () {
            Route::post('/store', [FileProgressProjectController::class, 'store'])->name('store');
            Route::get('/index', [FileProgressProjectController::class, 'index'])->name('index');
            Route::post('/update', [FileProgressProjectController::class, 'update'])->name('update');
            Route::post('/delete', [FileProgressProjectController::class, 'delete'])->name('delete');
        });
        Route::prefix('file-pendukung')->name('file-pendukung.')->group(function () {
            Route::get('/', [FilePendukungController::class, 'index'])->name('index');
            Route::get('/fetch-files', [FilePendukungController::class, 'fetchFiles'])->name('fetchFiles');
            Route::post('/store', [FilePendukungController::class, 'store'])->name('store');
            Route::post('/update', [FilePendukungController::class, 'update'])->name('update');
            Route::delete('/delete', [FilePendukungController::class, 'delete'])->name('delete');
        });
        Route::prefix('laporan')->name('laporan.')->group(function (){
            Route::get('progress', [ProgressProjectController::class, 'laporan_progress'])->name('progress');
            Route::get('progress-chart', [ProgressProjectController::class, 'laporan_progress_chart'])->name('progress_chart');
            Route::get('rencana-progress', [ProgressProjectController::class, 'rencana_progress'])->name('rencana_progress');
        });
    });

    Route::middleware('guard:admin')->group(function (){

        Route::prefix('lowongan')->name('lowongan.')->group(function () {
            Route::get('/', [LowonganController::class, 'index'])->name('index');
            Route::get('/create', [LowonganController::class, 'create'])->name('create');
            Route::get('/details/{id}', [LowonganController::class, 'show'])->name('details');
            Route::post('/store', [LowonganController::class, 'store'])->name('store');
            Route::post('/update', [LowonganController::class, 'update'])->name('update');
            Route::post('/delete', [LowonganController::class, 'delete'])->name('delete');
        });
        Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
            Route::get('/', [PendaftaranController::class, 'index'])->name('index');
        });
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('dashboard');
            Route::get('/dashboard/follow-up/{karyawanId}', [DashboardController::class, 'dashboardAdminFollowUp'])->name('dashboardFollowUp');

            Route::get('/get-data-karyawan', [DashboardController::class, 'requestDatatableKaryawan'])->name('requestDatatableKaryawan');
            Route::get('/get-data-chart', [DashboardController::class, 'requestChart'])->name('requestDataChart');
            Route::get('/get-data-export-dashboard', [DashboardController::class, 'exportDashboardAdmin'])->name('exportDashboardAdmin');
        });

        Route::prefix('jabatan')->name('jabatan.')->group(function () {
            Route::get('/', [JabatanController::class, 'index'])->name('index');
            Route::get('/create', [JabatanController::class, 'create'])->name('create');
            Route::post('/store', [JabatanController::class, 'store'])->name('store');
            Route::get('/details', [JabatanController::class, 'show'])->name('details');
            Route::post('/update', [JabatanController::class, 'update'])->name('update');
            Route::post('/delete', [JabatanController::class, 'delete'])->name('delete');
        });
        Route::prefix('jenis-pekerjaan')->name('jenis-pekerjaan.')->group(function () {
            Route::get('/', [JenisPekerjaanController::class, 'index'])->name('index');
            Route::get('/create', [JenisPekerjaanController::class, 'create'])->name('create');
            Route::post('/store', [JenisPekerjaanController::class, 'store'])->name('store');
            Route::post('/update', [JenisPekerjaanController::class, 'update'])->name('update');
            Route::post('/delete', [JenisPekerjaanController::class, 'delete'])->name('delete');
        });
        Route::prefix('karyawan')->name('karyawan.')->group(function () {
            Route::get('/', [KaryawanController::class, 'index'])->name('index');
            Route::get('/create', [KaryawanController::class, 'create'])->name('create');
            Route::post('/store', [KaryawanController::class, 'store'])->name('store');
            Route::get('/details/{id}', [KaryawanController::class, 'show'])->name('details');
            Route::post('/update', [KaryawanController::class, 'update'])->name('update');
            Route::post('/delete', [KaryawanController::class, 'delete'])->name('delete');
        });
        Route::prefix('konsep-kerjasama')->name('konsep-kerjasama.')->group(function () {
            Route::get('/', [KonsepKerjasamaController::class, 'index'])->name('index');
            Route::get('/create', [KonsepKerjasamaController::class, 'create'])->name('create');
            Route::post('/store', [KonsepKerjasamaController::class, 'store'])->name('store');
            Route::get('/details/{id}', [KonsepKerjasamaController::class, 'show'])->name('details');
            Route::post('/update', [KonsepKerjasamaController::class, 'update'])->name('update');
            Route::post('/delete', [KonsepKerjasamaController::class, 'delete'])->name('delete');
        });
        Route::prefix('status-project')->name('status-project.')->group(function () {
            Route::get('/', [StatusProjectController::class, 'index'])->name('index');
            Route::post('/store', [StatusProjectController::class, 'store'])->name('store');
            Route::get('/details/{id}', [StatusProjectController::class, 'show'])->name('details');
            Route::post('/update', [StatusProjectController::class, 'update'])->name('update');
            Route::post('/delete', [StatusProjectController::class, 'delete'])->name('delete');
        });
        Route::prefix('kategori-item')->name('kategori-item.')->group(function () {
            Route::get('/', [KategoriItemController::class, 'index'])->name('index');
            Route::get('/create', [KategoriItemController::class, 'create'])->name('create');
            Route::post('/store', [KategoriItemController::class, 'store'])->name('store');
            Route::post('/update', [KategoriItemController::class, 'update'])->name('update');
            Route::post('/delete', [KategoriItemController::class, 'delete'])->name('delete');
        });
        Route::prefix('item-tnc')->name('item-tnc.')->group(function () {
            Route::get('/', [ItemTncController::class, 'index'])->name('index');
            Route::get('/create', [ItemTncController::class, 'create'])->name('create');
            Route::post('/store', [ItemTncController::class, 'store'])->name('store');
            Route::get('/details/{id}', [ItemTncController::class, 'show'])->name('details');
            Route::get('/{id}/edit', [ItemTncController::class, 'edit'])->name('edit');
            Route::post('/update', [ItemTncController::class, 'update'])->name('update');
            Route::post('/delete', [ItemTncController::class, 'delete'])->name('delete');
        });
    });
});

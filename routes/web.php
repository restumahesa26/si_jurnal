<?php

use App\Http\Controllers\Admin\AbsensiController as AdminAbsensiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\JurnalController as AdminJurnalController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\KelasSiswaController;
use App\Http\Controllers\Admin\KepalaSekolahController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MasterMataPelajaranController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\WakaKurikulumController;
use App\Http\Controllers\Admin\WaliSiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guru\AbsensiController;
use App\Http\Controllers\Guru\JurnalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WakaKurikulum\JurnalController as WakaKurikulumJurnalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::middleware(['auth'])
    ->group(function() {

        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::get('/dashboard/detail-absen-kelas/{id}', [DashboardController::class, 'show_absen'])->name('dashboard.show-absen-kelas');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    });

Route::middleware(['auth','admin'])
    ->group(function() {

        Route::put('/tahun-ajaran/update-status-aktif', [TahunAjaranController::class, 'updateStatus'])->name('tahun-ajaran.update-status-aktif');

        Route::resource('tahun-ajaran', TahunAjaranController::class);

        Route::resource('guru', GuruController::class);

        Route::post('/kelas/export-kelas', [KelasController::class, 'export_kelas'])->name('kelas.export-kelas');

        Route::resource('kelas', KelasController::class);

        Route::resource('siswa', SiswaController::class);

        Route::resource('kelas-siswa', KelasSiswaController::class);

        Route::resource('mata-pelajaran', MataPelajaranController::class);

        Route::resource('data-admin', AdminController::class);

        Route::resource('waka-kurikulum', WakaKurikulumController::class);

        Route::post('/data-absensi/delete', [AdminAbsensiController::class, 'delete'])->name('admin-absensi.delete');

        Route::get('/data-jurnal', [AdminJurnalController::class, 'index'])->name('admin-jurnal.index');

        Route::get('/data-jurnal/show', [AdminJurnalController::class, 'show'])->name('admin-jurnal.show');

        Route::put('/data-jurnal/update/{id}', [AdminJurnalController::class, 'update'])->name('admin-jurnal.update');

        Route::delete('/data-jurnal/delete/{id}', [AdminJurnalController::class, 'delete'])->name('admin-jurnal.delete');

    });

Route::middleware(['auth','guru'])
    ->group(function() {

        Route::get('/absensi/select', [AbsensiController::class, 'select'])->name('absensi.select');

        Route::get('/absensi/{id}/tambah', [AbsensiController::class, 'index'])->name('absensi.index');

        Route::post('/absensi/{mapel_id}/store', [AbsensiController::class, 'store'])->name('absensi.store');

        Route::get('/laporan/guru', [LaporanController::class, 'index2'])->name('laporan.index2');

        Route::get('/jurnal', [JurnalController::class, 'index'])->name('jurnal.index');

        Route::post('/jurnal/{mapel_id}/store', [JurnalController::class, 'store'])->name('jurnal.store');

    });

Route::middleware(['auth','wakakurikulum'])
    ->group(function() {

        Route::get('/riwayat-jurnal', [WakaKurikulumJurnalController::class, 'index'])->name('waka-kurikulum-jurnal.index');

        Route::get('/riwayat-jurnal/show', [WakaKurikulumJurnalController::class, 'show'])->name('waka-kurikulum-jurnal.show');

    });

Route::middleware(['auth','adminguru'])
    ->group(function() {

        Route::get('/laporan/cetak-berdasarkan-kelas', [LaporanController::class, 'cetak_kelas'])->name('laporan.cetak-kelas');

        Route::get('/laporan/cetak-berdasarkan-kelas-excel', [LaporanController::class, 'cetak_kelas_excel'])->name('laporan.cetak-kelas-excel');

        Route::get('/laporan/cetak-berdasarkan-mata-pelajaran', [LaporanController::class, 'cetak_mapel'])->name('laporan.cetak-mapel');

        Route::get('/laporan/cetak-berdasarkan-mata-pelajaran-excel', [LaporanController::class, 'cetak_mapel_excel'])->name('laporan.cetak-mapel-excel');

        Route::get('/laporan/cetak-semua-siswa', [LaporanController::class, 'cetak_semua'])->name('laporan.cetak-semua');

        Route::get('/laporan/cetak-semua-siswa-excel', [LaporanController::class, 'cetak_semua_excel'])->name('laporan.cetak-semua-excel');

        Route::get('/laporan/cetak-jurnal-guru', [LaporanController::class, 'cetak_guru'])->name('laporan.cetak-jurnal-guru');

        Route::get('/laporan/cetak-jurnal-guru-excel', [LaporanController::class, 'cetak_guru_excel'])->name('laporan.cetak-jurnal-guru-excel');

        Route::get('/data-absensi', [AdminAbsensiController::class, 'index'])->name('admin-absensi.index');

        Route::get('/data-absensi/show', [AdminAbsensiController::class, 'show'])->name('admin-absensi.show');

        Route::put('/data-absensi/update', [AdminAbsensiController::class, 'update'])->name('admin-absensi.update');
    });

Route::middleware(['auth','adminkepalasekolah'])
    ->group(function() {

        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    });

require __DIR__.'/auth.php';

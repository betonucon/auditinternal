<?php

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

Route::get('/cache-clear', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Cache facade value cleared</h1>';
});

Auth::routes();


Route::group(['middleware'    => 'auth'],function(){
    Route::get('/Sistem', 'SistemController@index');
    Route::get('/Sistem/detail', 'SistemController@detail');
    Route::get('/Sistem/tampil_detail', 'SistemController@tampil_detail');
    Route::get('/Sistem/get_data', 'SistemController@get_data');
    Route::post('/Sistem', 'SistemController@simpan'); 
    Route::post('/Sistemdetail', 'SistemController@simpan_detail'); 
    Route::get('/Sistem/hapus', 'SistemController@hapus'); 
    Route::get('/Sistem/hapus_detail', 'SistemController@hapus_detail'); 
    Route::get('/Sistem/form', 'SistemController@form');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/Pengguna', 'PenggunaController@index');
    Route::get('/Pengguna/detail', 'PenggunaController@detail');
    Route::get('/Pengguna/switch_akun', 'PenggunaController@switch_akun');
    Route::get('/Pengguna/tampil_detail', 'PenggunaController@tampil_detail');
    Route::get('/Pengguna/get_data', 'PenggunaController@get_data');
    Route::post('/Pengguna', 'PenggunaController@simpan'); 
    Route::post('/Penggunadetail', 'PenggunaController@simpan_detail'); 
    Route::get('/Pengguna/hapus', 'PenggunaController@hapus'); 
    Route::get('/Pengguna/hapus_detail', 'PenggunaController@hapus_detail'); 
    Route::get('/Pengguna/form', 'PenggunaController@form');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/Unit', 'UnitController@index');
    Route::get('/Unit/get_data', 'UnitController@get_data');
    Route::post('/Unit', 'UnitController@simpan');  
    Route::get('/Unit/hapus', 'UnitController@hapus');  
    Route::get('/Unit/form', 'UnitController@form');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/Audit', 'AuditController@index');
    Route::get('/Audit/get_data', 'AuditController@get_data');
    Route::get('/Audit/laporan', 'AuditController@laporan');
    Route::get('/Audit/modal', 'AuditController@modal');
    Route::get('/Audit/modal_auditor', 'AuditController@modal_auditor');
    Route::get('/Audit/sistem', 'AuditController@sistem');
    Route::get('/Audit/auditor', 'AuditController@auditor');
    Route::post('/Audit', 'AuditController@simpan');  
    Route::post('/Audit/simpan_sistem', 'AuditController@simpan_sistem');  
    Route::post('/Audit/simpan_auditor', 'AuditController@simpan_auditor');  
    Route::get('/Audit/hapus', 'AuditController@hapus');  
    Route::get('/Audit/form', 'AuditController@form');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/Temuan', 'TemuanController@index');
    Route::get('/Temuan/get_data', 'TemuanController@get_data');
    Route::get('/Temuan/detail', 'TemuanController@detail');
    Route::get('/Temuan/modal', 'TemuanController@modal');
    Route::get('/Temuan/export_excel', 'TemuanController@export_excel');
    Route::get('/Temuan/modal_Temuanor', 'TemuanController@modal_Temuanor');
    Route::get('/Temuan/sistem', 'TemuanController@sistem');
    Route::get('/Temuan/tampil_file_evidence', 'TemuanController@tampil_file_evidence');
    Route::post('/Temuan/filter', 'TemuanController@filternya');
    Route::get('/Temuan/file', 'TemuanController@file');
    Route::get('/Temuan/kirim_evidence', 'TemuanController@kirim_evidence');
    Route::post('/Temuan', 'TemuanController@simpan');  
    Route::post('/Temuan/create', 'TemuanController@create');  
    Route::post('/Temuan/open', 'TemuanController@open');  
    Route::post('/Temuan/evidence', 'TemuanController@evidence');  
    Route::post('/Temuan/penyebab', 'TemuanController@penyebab');  
    Route::post('/Temuan/review', 'TemuanController@review');  
    Route::post('/Temuan/perbaikan', 'TemuanController@perbaikan');  
    Route::post('/Temuan/simpan_sistem', 'TemuanController@simpan_sistem');  
    Route::post('/Temuan/simpan_file', 'TemuanController@simpan_file');  
    Route::post('/Temuan/simpan_file_evidence', 'TemuanController@simpan_file_evidence');  
    Route::get('/Temuan/hapus', 'TemuanController@hapus');  
    Route::get('/Temuan/hapus_file', 'TemuanController@hapus_file');  
    Route::get('/Temuan/hapus_file_evidence', 'TemuanController@hapus_file_evidence');  
    Route::get('/Temuan/form', 'TemuanController@form');
    Route::get('/Temuan/publish', 'TemuanController@publish');
    Route::get('/Temuan/onprogres', 'TemuanController@onprogres');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/Periode', 'PeriodeController@index');
    Route::get('/Periode/get_data', 'PeriodeController@get_data');
    Route::post('/Periode', 'PeriodeController@simpan');  
    Route::get('/Periode/hapus', 'PeriodeController@hapus');  
    Route::get('/Periode/form', 'PeriodeController@form');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/Pengaturan', 'PengaturanController@index');
    Route::get('/Help', 'PengaturanController@help');
    Route::get('/Book', 'PengaturanController@book');
    Route::get('/Pengaturan/get_data', 'PengaturanController@get_data');
    Route::get('/Pengaturan/tampil_help', 'PengaturanController@tampil_help');
    Route::get('/Pengaturan/form_help', 'PengaturanController@form_help');
    Route::get('/Pengaturan/hapus_help', 'PengaturanController@hapus_help');
    Route::post('/Pengaturan/help', 'PengaturanController@simpan_help');  
    Route::get('/Pengaturan/hapus', 'PengaturanController@hapus');  
    Route::get('/Pengaturan/form', 'PengaturanController@form');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/Chat', 'ChatController@index');
    Route::post('/Chat', 'ChatController@simpan');  
});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/tampil_dashboard', 'HomeController@tampil_dashboard');
    Route::get('/tampil_dashboard_sistem', 'HomeController@tampil_dashboard_sistem');
    Route::get('/tampil_grafik', 'HomeController@tampil_grafik');
    Route::get('/cari_tahun', 'HomeController@cari_tahun');
    Route::get('/tampil_loading', 'HomeController@tampil_loading');
});

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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

// ROUTE
Route::resource('dokter','DokterController');
Route::resource('karyawan_admin','KaryawanAdminController');
Route::resource('karyawan_perawat','KaryawanPerawatController');
Route::resource('karyawan_penunjang','KaryawanPenunjangController');
Route::resource('periode','PeriodeController');
Route::resource('ruangan','RuanganController');
Route::resource('kategori_tindakan','KategoriTindakanController');
Route::resource('deskripsi_tindakan','DeskripsiTindakanController');
Route::resource('data_keuangan_pasien','DataKeuanganPasienController');
Route::resource('data_pasien','DataPasienController');
Route::resource('data_tindakan_pasien','DataTindakanPasienController');
Route::resource('rekap_data','RekapDataController');
Route::resource('variable_rumus','variableRumusController');
Route::resource('dasboard','DashboardController');

Route::resource('proses_jp_perawat','ProsesJPPerawatController');
Route::resource('proses_jp_penunjang','ProsesJPPenunjangController');
Route::resource('proses_jp_admin','ProsesJPAdminController');


Route::post('import_data_keuangan_pasien','DataKeuanganPasienController@import')->name('data_keuangan_pasien.import');
Route::post('import_data_pasien','DataPasienController@import')->name('data_pasien.import');
Route::post('import_data_pasien_rawat_jalan','DataPasienController@importRj')->name('data_pasien.importRj');

// Pasien
Route::get('periode_pasien_rawat_inap','DataPasienController@periode_pasien_rawat_inap');
Route::get('ruangan_pasien_rawat_inap/{id_periode}','DataPasienController@ruangan_pasien_rawat_inap');
Route::get('data_pasien_rawat_inap/{id_periode}/{id_ruangan}','DataPasienController@data_pasien_rawat_inap');
Route::get('data_pasien_rawat_inap_detail_tindakan/{id}','DataPasienController@data_pasien_rawat_inap_tindakan');
Route::get('data_pasien_rawat_inap_tambah_detail_tindakan/{id}/{id_ruangan}/{id_data_pasien}','DataPasienController@data_pasien_rawat_inap_tambah_tindakan');
Route::get('periode_p_pasien_rawat_inap','ProsesPerhitunganController@periode__p_pasien_rawat_inap');
Route::get('ruangan_p_pasien_rawat_inap/{id_periode}','ProsesPerhitunganController@ruangan_p_pasien_rawat_inap');


Route::get('periode_pasien_rawat_jalan','DataPasienController@periode_pasien_rawat_jalan');
Route::get('ruangan_pasien_rawat_jalan/{id_periode}','DataPasienController@ruangan_pasien_rawat_jalan');
Route::get('data_pasien_rawat_jalan/{id_periode}/{id_ruangan}','DataPasienController@data_pasien_rawat_jalan');
Route::get('data_pasien_rawat_jalan_detail_tindakan/{id}','DataPasienController@data_pasien_rawat_jalan_tindakan');
Route::get('periode_p_pasien_rawat_jalan','ProsesPerhitunganController@periode__p_pasien_rawat_jalan');
Route::get('ruangan_p_pasien_rawat_jalan/{id_periode}','ProsesPerhitunganController@ruangan_p_pasien_rawat_jalan');

// Karyawan
Route::get('karyawan_admin_point','KaryawanAdminController@index_point');
Route::get('daftar_point_karyawan_admin/{id}','KaryawanAdminController@index_point_karyawan');
Route::put('update_point_karyawan_admin/{id}','KaryawanAdminController@update_point_karyawan_admin');
Route::get('proses_upah_admin/{id_periode}','ProsesJPAdminController@proses_upah_admin');
Route::get('karyawan_admin_upah','ProsesJPAdminController@index_upah');
Route::get('daftar_upah_karyawan_admin/{id_periode}','ProsesJPAdminController@daftar_upah_karyawan_admin');
Route::get('detail_upah_karyawan_admin/{id_periode}/{id_karyawan}','ProsesJPAdminController@detail_upah_karyawan_admin');

Route::get('karyawan_penunjang_point','KaryawanPenunjangController@index_point');
Route::get('daftar_point_karyawan_penunjang/{id}','KaryawanPenunjangController@index_point_karyawan');
Route::put('update_point_karyawan_penunjang/{id}','KaryawanPenunjangController@update_point_karyawan_penunjang');
Route::get('proses_upah_penunjang/{id_periode}','ProsesJPPenunjangController@proses_upah_penunjang');
Route::get('karyawan_penunjang_upah','ProsesJPPenunjangController@index_upah');
Route::get('daftar_upah_karyawan_penunjang/{id_periode}','ProsesJPPenunjangController@daftar_upah_karyawan_penunjang');
Route::get('detail_upah_karyawan_penunjang/{id_periode}/{id_karyawan}','ProsesJPPenunjangController@detail_upah_karyawan_penunjang');

Route::get('karyawan_perawat_point','KaryawanPerawatController@index_point');
Route::get('daftar_point_karyawan_perawat/{id}','KaryawanPerawatController@index_point_karyawan');
Route::put('update_point_karyawan_perawat/{id}','KaryawanPerawatController@update_point_karyawan_perawat');
Route::get('proses_upah_perawat/{id_periode}','ProsesJPPerawatController@proses_upah_perawat');
Route::get('karyawan_perawat_upah','ProsesJPPerawatController@index_upah');
Route::get('daftar_upah_karyawan_perawat/{id_periode}','ProsesJPPerawatController@daftar_upah_karyawan_perawat');
Route::get('detail_upah_karyawan_perawat/{id_periode}/{id_karyawan_perawat}','ProsesJPPerawatController@detail_upah_karyawan_perawat');

Route::get('generate_data_karyawan_admin/{id}','KaryawanAdminController@generate_data_karyawan_admin');
Route::get('generate_data_karyawan_penunjang/{id}','KaryawanPenunjangController@generate_data_karyawan_penunjang');
Route::get('generate_data_karyawan_perawat/{id}','KaryawanPerawatController@generate_data_karyawan_perawat');

// Proses perhitungan
Route::post('buat_data_gizi_pasien','ProsesPerhitunganController@create_data_gizi_pasien');
Route::post('buat_data_adm_pasien','ProsesPerhitunganController@create_data_adm_pasien');
Route::post('buat_data_visite_pasien','ProsesPerhitunganController@create_data_visite_pasien');
Route::put('ubah_data_visite_pasien/{id}','ProsesPerhitunganController@update_data_visite_pasien');
Route::delete('hapus_data_visite_pasien/{id}','ProsesPerhitunganController@delete_data_visite_pasien');

Route::get('proses_perhitungan_rawat_inap/{id_periode}/{id_ruangan}','ProsesPerhitunganController@proses_perhitungan_rawat_inap');
Route::get('show_proses_perhitungan_rawat_inap/{id_periode}/{id_ruangan}','ProsesPerhitunganController@show_proses_perhitungan_rawat_inap');
Route::get('show_detail_proses_perhitungan_rawat_inap/{id_periode}/{id_ruangan}/{id_data_pasien}','ProsesPerhitunganController@show_detail_proses_perhitungan_rawat_inap');

Route::get('proses_perhitungan_rawat_jalan/{id_periode}/{id_ruangan}','ProsesPerhitunganController@proses_perhitungan_rawat_jalan');
Route::get('show_proses_perhitungan_rawat_jalan/{id_periode}/{id_ruangan}','ProsesPerhitunganController@show_proses_perhitungan_rawat_jalan');
Route::get('show_detail_proses_perhitungan_rawat_jalan/{id_periode}/{id_ruangan}/{id_data_pasien}','ProsesPerhitunganController@show_detail_proses_perhitungan_rawat_jalan');


// Rekap data
Route::get('periode_rekap_data','RekapDataController@periode_rekap_data');
Route::get('daftar_rekap_data/{id}','RekapDataController@daftar_rekap_data');
Route::get('detail_rekap_data_dokter/{id_periode}/{id_karyawan}','RekapDataController@detail_rekap_data_dokter');
Route::get('detail_rekap_data_penunjang/{id_periode}/{id_karyawan}','RekapDataController@detail_rekap_data_penunjang');
Route::get('detail_rekap_data_perawat/{id_periode}/{id_karyawan}','RekapDataController@detail_rekap_data_perawat');

// Dashboard
Route::get('daftar_dashboard/{id}','DashboardController@daftar_dashboard');
Route::post('dashboard_pilih_tahun','DashboardController@dashboard_pilih_tahun');

// Rumus
Route::get('daftar_rumus_kategori/{id}','VariableRumusController@daftar_rumus_kategori');

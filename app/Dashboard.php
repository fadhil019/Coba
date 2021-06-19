<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\RekapData;
class Dashboard extends Model
{
    public function SelectDashboard($tahun){
        $data_periode = DB::table('periode')
        ->join('users', 'users.id_users', '=', 'periode.id_users')
        ->where('periode.tahun', '=', $tahun)
        ->orderby('periode.id_periode', 'ASC')
        ->get();

        $hasil = [];
        $i = 0;
        foreach($data_periode as $row){
            $rekap_data = new RekapData();
            $rekap_datas = $rekap_data->tampungJTL($row->id_periode);
            // DOKTER
            $data_dokter = DB::table('dokter')
            ->orderby('dokter.id_dokter', 'ASC')
            ->get();
            $tmp_total_pendapatan_dokter = 0;
            foreach($data_dokter as $row_dokter){
                $data_proses_perhitungan = DB::table('proses_perhitungan')
                ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
                ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
                ->where('proses_perhitungan.id_dokter', '=', $row_dokter->id_dokter)
                ->where('transaksi.id_periode', '=', $row->id_periode)
                ->where('proses_perhitungan.proses', '=', 'Ke 4')
                ->get();
                foreach($data_proses_perhitungan as $row_perhitungan){
                    $tmp_total_pendapatan_dokter += $row_perhitungan->jumlah_jp;
                }  
            }

            // ADMIN
            $data_keuangan_pasien = DB::table('data_keuangan_pasien')
                ->where('id_periode', '=', $row->id_periode)
                ->get();

            $tmp_total_pendapatan_admin = 0;
            //INI YANG DIPAKAI UNTUK AMBIL DATA STRUKTURAL DAN ADMIN UMUM TAPI EROR KALAU DITAMBAH INI
            $rekap_data_admin_remu = new RekapData();
            $rekap_data_admin_remus = $rekap_data_admin_remu->SelectRekapDataAdminRemuPerPeriode($row->id_periode);
            for($index_admin=0; $index_admin < count($rekap_data_admin_remus); $index_admin++){
                $tmp_total_pendapatan_admin += $rekap_data_admin_remus[$index_admin]['upah_jasa'];
            }
            
            
            $data_proses_perhitungan_admin_adm = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('proses_perhitungan.ket_kategori', '=', 'ADM')
            ->where('transaksi.id_periode', '=', $row->id_periode)
            ->where('proses_perhitungan.proses', '=', 'Ke 4')
            ->get();
            foreach($data_proses_perhitungan_admin_adm as $row_perhitungan_admin_adm){
                $tmp_total_pendapatan_admin += $row_perhitungan_admin_adm->jumlah_jp;
            }

            // PENUNJANG
            $kategori_tindakan = DB::table('kategori_tindakan')
            ->orderby('kategori_tindakan.id_kategori_tindakan', 'ASC')
            ->get();
            $tmp_total_pendapatan_penunjang = 0;
            foreach($kategori_tindakan as $row_kategori_tindakan){
                $data_proses_perhitungan_penunjang = DB::table('proses_perhitungan')
                ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
                ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
                ->where('proses_perhitungan.id_kategori_tindakan', '=', $row_kategori_tindakan->id_kategori_tindakan)
                ->where('transaksi.id_periode', '=', $row->id_periode)
                ->where('proses_perhitungan.proses', '=', 'Ke 4')
                ->get();
                
                foreach($data_proses_perhitungan_penunjang as $row_perhitungan_kategori_tindakan){
                    $tmp_total_pendapatan_penunjang += $row_perhitungan_kategori_tindakan->jumlah_jp;
                }
            }
            $data_proses_perhitungan_penunjang_gizi = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('proses_perhitungan.ket_kategori', '=', 'GIZI')
            ->where('transaksi.id_periode', '=', $row->id_periode)
            ->where('proses_perhitungan.proses', '=', 'Ke 4')
            ->get();
            foreach($data_proses_perhitungan_penunjang_gizi as $row_perhitungan_kat_gizi){
                $tmp_total_pendapatan_penunjang += $row_perhitungan_kat_gizi->jumlah_jp;
            }

            // PERAWAT
            $tmp_total_pendapatan_perawat = 0;
            $data_ruangan = DB::table('ruangan')
            ->orderby('ruangan.id_ruangan', 'ASC')
            ->get();
            foreach($data_ruangan as $row_ruangan){
                $data_proses_perhitungan_perawat_ruangan = DB::table('proses_perhitungan')
                ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
                ->join('transaksi', 'transaksi.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
                ->where('transaksi.id_periode', '=', $row->id_periode)
                ->where('proses_perhitungan.ket_kategori', '=', 'PERAWAT '.$row_ruangan->nama_ruangan)
                ->where('proses_perhitungan.proses', '=', 'Ke 4')
                ->get();
                foreach($data_proses_perhitungan_perawat_ruangan as $row_perhitungan_perawat_ruangan){
                    $tmp_total_pendapatan_perawat += $row_perhitungan_perawat_ruangan->jumlah_jp;
                }
            }

            $hasil['dokter'][$i] = $tmp_total_pendapatan_dokter;
            $hasil['admin'][$i] = $tmp_total_pendapatan_admin + $rekap_datas['JTL'][0]['upah_jasa'];
            $hasil['penunjang'][$i] = $tmp_total_pendapatan_penunjang;
            $hasil['perawat'][$i] = $tmp_total_pendapatan_perawat;
            $i++;
        }


        $sum_dokter = array_sum($hasil['dokter']);
        $rata_rata_dokter = $sum_dokter / 12;

        $sum_admin = array_sum($hasil['admin']);
        $rata_rata_admin = $sum_admin / 12;

        $sum_penunjang = array_sum($hasil['penunjang']);
        $rata_rata_penunjang = $sum_penunjang / 12;

        $sum_perawat = array_sum($hasil['perawat']);
        $rata_rata_perawat = $sum_perawat / 12;

        
        $hasil['rata_rata_dokter'] = $rata_rata_dokter;
        $hasil['rata_rata_admin'] = $rata_rata_admin;
        $hasil['rata_rata_penunjang'] = $rata_rata_penunjang;
        $hasil['rata_rata_perawat'] = $rata_rata_perawat;

        $hasil['terbesar_dokter'] = array_search(max($hasil['dokter']), $hasil['dokter']) + 1;
        $hasil['terbesar_admin'] = array_search(max($hasil['admin']), $hasil['admin']) + 1;
        $hasil['terbesar_penunjang'] = array_search(max($hasil['penunjang']), $hasil['penunjang']) + 1;
        $hasil['terbesar_perawat'] = array_search(max($hasil['perawat']), $hasil['perawat']) + 1;
        
        // dd($hasil);
        return $hasil;
    }
}

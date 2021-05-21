<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

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
            $data_dokter = DB::table('dokter')
            ->orderby('dokter.id_dokter', 'ASC')
            ->get();
            $tmp_total_pendapatan = 0;
            foreach($data_dokter as $row_dokter){
                $data_proses_perhitungan = DB::table('proses_perhitungan')
                ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
                ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
                ->where('proses_perhitungan.id_dokter', '=', $row_dokter->id_dokter)
                ->where('transaksi.id_periode', '=', $row->id_periode)
                ->get();
                // $hasil[$i]['id_dokter'] = $row->id_dokter;
                // $hasil[$i]['nama_dokter'] = $row->nama_dokter;
                
                foreach($data_proses_perhitungan as $row_perhitungan){
                    $tmp_total_pendapatan += $row_perhitungan->jumlah_jp;
                }
                
            }
            $hasil[$i]['total_pendapatan'] = $tmp_total_pendapatan;
            $i++;
            // $data_proses_perhitungan = DB::table('proses_perhitungan')
            // ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            // ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            // ->where('transaksi.id_periode', '=', $row->id_periode)
            // ->get();
            // // $hasil[$i]['bulan'] = $row->bulan;
            // $tmp_total_pendapatan = 0;
            // foreach($data_proses_perhitungan as $row_perhitungan){
            //     $tmp_total_pendapatan += $row_perhitungan->jumlah_jp;
            // }
            // $hasil[$i]['total_pendapatan'] = $tmp_total_pendapatan;
            // $i++;
        }
        // dd($hasil);
        return $hasil;
    }
}

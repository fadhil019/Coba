<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;
use App\Periode;

class RekapData extends Model
{
    public function SelectRekapDataDokterPerPeriode($id){
        $data_dokter = DB::table('dokter')
        ->orderby('dokter.id_dokter', 'ASC')
        ->get();

        $hasil = [];
        $i = 0;
        foreach($data_dokter as $row){
            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->where('transaksi.id_periode', '=', $id)
            ->where('proses_perhitungan.id_dokter', '=', $row->id_dokter)
            ->where('proses_perhitungan.proses', '=', 'Ke 4')
            ->get();
            $hasil[$i]['id_dokter'] = $row->id_dokter;
            $hasil[$i]['nama_dokter'] = $row->nama_dokter;
            $tmp_upah_jasa = 0;
            foreach($data_proses_perhitungan as $row_perhitungan){
                $tmp_upah_jasa += $row_perhitungan->jumlah_jp;
            }
            $hasil[$i]['upah_jasa'] = $tmp_upah_jasa;
            $i++;
        }
        // dd($hasil);
        return $hasil;
    }

    public function SelectRekapDataKategoriTindakanPerPeriode($id){
        $data_kategori_tindakan = DB::table('kategori_tindakan')
        ->orderby('kategori_tindakan.id_kategori_tindakan', 'ASC')
        ->get();

        $hasil = [];
        $i = 0;
        foreach($data_kategori_tindakan as $row){
            $hasil[$i]['id_kategori_tindakan'] = $row->id_kategori_tindakan;
            $hasil[$i]['nama_kategori_tindakan'] = $row->nama;
            $hasil[$i]['bagian_kategori_tindakan'] = $row->kategori_data;
            $tmp_upah_jasa = 0;
            if($row->nama == 'GIZI')
            {
                $data_proses_perhitungan = DB::table('proses_perhitungan')
                ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
                ->join('transaksi', 'transaksi.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
                ->where('transaksi.id_periode', '=', $id)
                ->where('proses_perhitungan.ket_kategori', '=', 'GIZI')
                ->where('proses_perhitungan.proses', '=', 'Ke 4')
                ->get();
                
                foreach($data_proses_perhitungan as $row_perhitungan){
                    $tmp_upah_jasa += $row_perhitungan->jumlah_jp;
                }
            }
            else
            {
                $data_proses_perhitungan = DB::table('proses_perhitungan')
                ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
                ->join('transaksi', 'transaksi.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
                ->where('transaksi.id_periode', '=', $id)
                ->where('proses_perhitungan.id_kategori_tindakan', '=', $row->id_kategori_tindakan)
                ->where('proses_perhitungan.proses', '=', 'Ke 4')
                ->get();
                
                foreach($data_proses_perhitungan as $row_perhitungan){
                    $tmp_upah_jasa += $row_perhitungan->jumlah_jp;
                }
            }
            
            $hasil[$i]['upah_jasa'] = $tmp_upah_jasa;
            $i++;
        }
        // dd($hasil);
        return $hasil;
    }

    public function SelectRekapDataRuanganPerPeriode($id){
        $data_ruangan = DB::table('ruangan')
        ->orderby('ruangan.id_ruangan', 'ASC')
        ->get();

        $hasil = [];
        $i = 0;
        foreach($data_ruangan as $row){
            $hasil[$i]['id_ruangan'] = $row->id_ruangan;
            $hasil[$i]['nama_ruangan'] = $row->nama_ruangan;
            $hasil[$i]['bagian'] = 'Perawat';
            $tmp_upah_jasa = 0;
            $data_proses_perhitungan_rpp = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->where('transaksi.id_periode', '=', $id)
            ->where('proses_perhitungan.id_ruangan', '=', $row->id_ruangan)
            ->where('proses_perhitungan.ket_kategori', '=', 'PERAWAT '.$row->nama_ruangan)
            ->where('proses_perhitungan.proses', '=', 'Ke 4')
            ->get();
            
            foreach($data_proses_perhitungan_rpp as $row_perhitungan){
                $tmp_upah_jasa += $row_perhitungan->jumlah_jp;
            }
            // $data_proses_perhitungan_igd = DB::table('proses_perhitungan')
            // ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            // ->join('transaksi', 'transaksi.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            // ->where('transaksi.id_periode', '=', $id)
            // ->where('proses_perhitungan.id_ruangan', '=', $row->id_ruangan)
            // ->where('proses_perhitungan.ket_kategori', '=', 'PERAWAT IGD')
            // ->where('proses_perhitungan.proses', '=', 'Ke 4')
            // ->get();
            
            // foreach($data_proses_perhitungan_igd as $row_perhitungan){
            //     $tmp_upah_jasa += $row_perhitungan->jumlah_jp;
            // }
            // $data_proses_perhitungan_iccu = DB::table('proses_perhitungan')
            // ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            // ->join('transaksi', 'transaksi.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            // ->where('transaksi.id_periode', '=', $id)
            // ->where('proses_perhitungan.id_ruangan', '=', $row->id_ruangan)
            // ->where('proses_perhitungan.ket_kategori', '=', 'PERAWAT ICCU')
            // ->where('proses_perhitungan.proses', '=', 'Ke 4')
            // ->get();
            
            // foreach($data_proses_perhitungan_iccu as $row_perhitungan){
            //     $tmp_upah_jasa += $row_perhitungan->jumlah_jp;
            // }
            
            $hasil[$i]['upah_jasa'] = $tmp_upah_jasa;
            $i++;
        }
        // dd($data_ruangan);
        return $hasil;
    }

    public function SelectRekapDataAdminRemuPerPeriode($id){
        $hasil = [];
        $hasil['nama_kategori'] = 'ADM';
        $hasil['bagian'] = 'Admin remunerasi';
        $data_keuangan_pasien = DB::table('data_keuangan_pasien')
        ->select('nominal_uang')
        ->join('periode', 'periode.id_periode', '=', 'data_keuangan_pasien.id_periode')
        ->where('data_keuangan_pasien.id_periode', '=', $id)
        ->orderby('data_keuangan_pasien.id_data_keuangan_pasien', 'ASC')
        ->get();
        $tmp_nominal_uang = 0;
        foreach($data_keuangan_pasien as $row_data_keuangan){
            $tmp_nominal_uang += $row_data_keuangan->nominal_uang;
        }
        $tmp_upah_jasa = 0;
            
        $data_proses_perhitungan = DB::table('proses_perhitungan')
        ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
        ->join('transaksi', 'transaksi.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
        ->where('transaksi.id_periode', '=', $id)
        ->where('proses_perhitungan.ket_kategori', '=', 'ADM')
        ->where('proses_perhitungan.proses', '=', 'Ke 4')
        ->get();
        foreach($data_proses_perhitungan as $row_perhitungan){
            $tmp_upah_jasa += $row_perhitungan->jumlah_jp;
        }
        
        $hasil['upah_jasa'] = $tmp_upah_jasa + ($tmp_nominal_uang * 0.05) + ($tmp_nominal_uang * 0.1) + ($tmp_nominal_uang * 0.15);
        // dd($hasil);
        return $hasil;
    }
}

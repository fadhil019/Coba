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
            ->where('data_pasien.id_periode', '=', $id)
            ->where('proses_perhitungan.id_dokter', '=', $row->id_dokter)
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
            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->where('data_pasien.id_periode', '=', $id)
            ->where('proses_perhitungan.id_kategori_tindakan', '=', $row->id_kategori_tindakan)
            ->get();
            $hasil[$i]['id_kategori_tindakan'] = $row->id_kategori_tindakan;
            $hasil[$i]['nama_kategori_tindakan'] = $row->nama;
            $hasil[$i]['bagian_kategori_tindakan'] = $row->kategori_data;
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
}

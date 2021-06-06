<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;
use PDF;

use App\User;
use App\Periode;

class ProsesJPAdmin extends Model
{
    protected $table = "proses_jp_admin";
    protected $primaryKey = "id_proses_jp_admin";

    public function SelectDaftarUpahAdmin($id_periode){
        $hasil = [];
        $point_admins = DB::table('karyawan_admin')
        ->join('point_karyawan', 'point_karyawan.id_karyawan_admin', 'karyawan_admin.id_karyawan_admin')
        ->where('point_karyawan.id_periode', '=',$id_periode)
        ->get();
        for ($i=0; $i < count($point_admins) ; $i++) { 
            $hasil[$i]['id_karyawan_admin'] = $point_admins[$i]->id_karyawan_admin;
            $hasil[$i]['nama'] = $point_admins[$i]->nama;
            $hasil[$i]['id_point_karyawan'] = $point_admins[$i]->id_point_karyawan;
            $hasil[$i]['kredential'] = $point_admins[$i]->kredential;
            $hasil[$i]['unit'] = $point_admins[$i]->unit;
            $hasil[$i]['posisi'] = $point_admins[$i]->posisi;
            $hasil[$i]['performa'] = $point_admins[$i]->performa;
            $hasil[$i]['disiplin'] = $point_admins[$i]->disiplin;
            $hasil[$i]['komplain'] = $point_admins[$i]->komplain;
            $hasil[$i]['pm'] = $point_admins[$i]->pm;
            $proses_admins = DB::table('proses_jp_admin')
            ->where('id_periode', '=',$id_periode)
            ->where('id_karyawan_admin', '=',$point_admins[$i]->id_karyawan_admin)
            ->first();
            $hasil[$i]['iku'] = $proses_admins->iku;
            $hasil[$i]['iki'] = $proses_admins->iki;
            $hasil[$i]['pm_proses'] = $proses_admins->pm;
        }
        // dd($hasil);
        return $hasil;
    }

    public function SelectDetailUpahAdmin($id_periode, $id_karyawan_admin){
        $hasil = [];
        $point_admins = DB::table('karyawan_admin')
        ->join('point_karyawan', 'point_karyawan.id_karyawan_admin', 'karyawan_admin.id_karyawan_admin')
        ->where('point_karyawan.id_periode', '=',$id_periode)
        ->where('point_karyawan.id_karyawan_admin', '=',$id_karyawan_admin)
        ->get();
        for ($i=0; $i < count($point_admins) ; $i++) { 
            $hasil[$i]['id_karyawan_admin'] = $point_admins[$i]->id_karyawan_admin;
            $hasil[$i]['nama'] = $point_admins[$i]->nama;
            $hasil[$i]['id_point_karyawan'] = $point_admins[$i]->id_point_karyawan;
            $hasil[$i]['kredential'] = $point_admins[$i]->kredential;
            $hasil[$i]['unit'] = $point_admins[$i]->unit;
            $hasil[$i]['posisi'] = $point_admins[$i]->posisi;
            $hasil[$i]['performa'] = $point_admins[$i]->performa;
            $hasil[$i]['disiplin'] = $point_admins[$i]->disiplin;
            $hasil[$i]['komplain'] = $point_admins[$i]->komplain;
            $hasil[$i]['pm'] = $point_admins[$i]->pm;
            $proses_admins = DB::table('proses_jp_admin')
            ->where('id_periode', '=',$id_periode)
            ->where('id_karyawan_admin', '=',$point_admins[$i]->id_karyawan_admin)
            ->first();
            $hasil[$i]['iku'] = $proses_admins->iku;
            $hasil[$i]['iki'] = $proses_admins->iki;
            $hasil[$i]['pm_proses'] = $proses_admins->pm;

            $data_proses_perhitungan_jtl = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.proses', '=', 'Ke 4')
            ->get();
            foreach($data_proses_perhitungan_jtl as $row_perhitungan_jtl){
                $hasil[$i]['tmp_jtl'][$row_perhitungan_jtl->id_proses_perhitungan] = $row_perhitungan_jtl->jumlah_jp;
            }
            $tmp_jasa_jtl = 0;
            foreach($hasil[$i]['tmp_jtl'] as $row) {
                $tmp_jasa_jtl += $row;
            }
            $hasil[$i]['upah_jasa_jtl'] = $tmp_jasa_jtl * 0.15;
            $hasil[$i]['upah_jasa'] = $proses_admins->iku + $proses_admins->iki + $proses_admins->pm + ($tmp_jasa_jtl * 0.15);
        }
        // dd($hasil);
        return $hasil;
    }
}

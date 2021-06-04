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

class ProsesJPPerawat extends Model
{
    protected $table = "proses_jp_perawat";
    protected $primaryKey = "id_proses_jp_perawat";

    public function SelectDaftarUpahperawat($id_periode){
        $hasil = [];
        $point_perawats = DB::table('karyawan_perawat')
        ->join('point_karyawan', 'point_karyawan.id_karyawan_perawat', 'karyawan_perawat.id_karyawan_perawat')
        ->where('point_karyawan.id_periode', '=',$id_periode)
        ->get();
        for ($i=0; $i < count($point_perawats) ; $i++) { 
            $hasil[$i]['id_karyawan_perawat'] = $point_perawats[$i]->id_karyawan_perawat;
            $hasil[$i]['nama'] = $point_perawats[$i]->nama;
            $hasil[$i]['id_point_karyawan'] = $point_perawats[$i]->id_point_karyawan;
            $hasil[$i]['kredential'] = $point_perawats[$i]->kredential;
            $hasil[$i]['unit'] = $point_perawats[$i]->unit;
            $hasil[$i]['posisi'] = $point_perawats[$i]->posisi;
            $hasil[$i]['performa'] = $point_perawats[$i]->performa;
            $hasil[$i]['disiplin'] = $point_perawats[$i]->disiplin;
            $hasil[$i]['komplain'] = $point_perawats[$i]->komplain;
            $hasil[$i]['pm'] = $point_perawats[$i]->pm;
            $proses_perawats1 = DB::table('proses_jp_perawat')
            ->where('id_periode', '=',$id_periode)
            ->where('tahapan', '=', 'Tahap 1')
            ->where('id_karyawan_perawat', '=',$point_perawats[$i]->id_karyawan_perawat)
            ->first();
            $proses_perawats2 = DB::table('proses_jp_perawat')
            ->where('id_periode', '=',$id_periode)
            ->where('tahapan', '=', 'Tahap 2')
            ->where('id_karyawan_perawat', '=',$point_perawats[$i]->id_karyawan_perawat)
            ->first();
            $hasil[$i]['iku'] = $proses_perawats1->iku + $proses_perawats2->iku;
            $hasil[$i]['iki'] = $proses_perawats1->iki + $proses_perawats2->iki;
            $hasil[$i]['pm_proses'] = $proses_perawats1->pm + $proses_perawats2->pm;
        }
        // dd($hasil);
        return $hasil;
    }

    public function SelectDetailUpahperawat($id_periode, $id_karyawan_perawat){
        $hasil = [];
        $point_perawats = DB::table('karyawan_perawat')
        ->join('point_karyawan', 'point_karyawan.id_karyawan_perawat', 'karyawan_perawat.id_karyawan_perawat')
        ->where('point_karyawan.id_periode', '=',$id_periode)
        ->where('point_karyawan.id_karyawan_perawat', '=',$id_karyawan_perawat)
        ->get();
        for ($i=0; $i < count($point_perawats) ; $i++) { 
            $hasil[$i]['id_karyawan_perawat'] = $point_perawats[$i]->id_karyawan_perawat;
            $hasil[$i]['nama'] = $point_perawats[$i]->nama;
            $hasil[$i]['id_point_karyawan'] = $point_perawats[$i]->id_point_karyawan;
            $hasil[$i]['kredential'] = $point_perawats[$i]->kredential;
            $hasil[$i]['unit'] = $point_perawats[$i]->unit;
            $hasil[$i]['posisi'] = $point_perawats[$i]->posisi;
            $hasil[$i]['performa'] = $point_perawats[$i]->performa;
            $hasil[$i]['disiplin'] = $point_perawats[$i]->disiplin;
            $hasil[$i]['komplain'] = $point_perawats[$i]->komplain;
            $hasil[$i]['pm'] = $point_perawats[$i]->pm;
            $proses_perawats1 = DB::table('proses_jp_perawat')
            ->where('id_periode', '=',$id_periode)
            ->where('tahapan', '=', 'Tahap 1')
            ->where('id_karyawan_perawat', '=',$point_perawats[$i]->id_karyawan_perawat)
            ->first();
            $proses_perawats2 = DB::table('proses_jp_perawat')
            ->where('id_periode', '=',$id_periode)
            ->where('tahapan', '=', 'Tahap 2')
            ->where('id_karyawan_perawat', '=',$point_perawats[$i]->id_karyawan_perawat)
            ->first();
            $hasil[$i]['iku_1'] = $proses_perawats1->iku;
            $hasil[$i]['iki_1'] = $proses_perawats1->iki;
            $hasil[$i]['pm_proses_1'] = $proses_perawats1->pm;

            $hasil[$i]['iku_2'] = $proses_perawats2->iku;
            $hasil[$i]['iki_2'] = $proses_perawats2->iki;
            $hasil[$i]['pm_proses_2'] = $proses_perawats2->pm;
        }
        // dd($hasil);
        return $hasil;
    }
}

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

class ProsesJPPenunjang extends Model
{
    protected $table = "proses_jp_penunjang";
    protected $primaryKey = "id_proses_jp_penunjang";

    public function SelectDaftarUpahPenunjang($id_periode){
        $hasil = [];
        $point_penunjangs = DB::table('karyawan_penunjang')
        ->join('point_karyawan', 'point_karyawan.id_karyawan_penunjang', 'karyawan_penunjang.id_karyawan_penunjang')
        ->where('point_karyawan.id_periode', '=',$id_periode)
        ->get();
        for ($i=0; $i < count($point_penunjangs) ; $i++) { 
            $hasil[$i]['id_karyawan_penunjang'] = $point_penunjangs[$i]->id_karyawan_penunjang;
            $hasil[$i]['nama'] = $point_penunjangs[$i]->nama;
            $hasil[$i]['id_point_karyawan'] = $point_penunjangs[$i]->id_point_karyawan;
            $hasil[$i]['kredential'] = $point_penunjangs[$i]->kredential;
            $hasil[$i]['unit'] = $point_penunjangs[$i]->unit;
            $hasil[$i]['posisi'] = $point_penunjangs[$i]->posisi;
            $hasil[$i]['performa'] = $point_penunjangs[$i]->performa;
            $hasil[$i]['disiplin'] = $point_penunjangs[$i]->disiplin;
            $hasil[$i]['komplain'] = $point_penunjangs[$i]->komplain;
            $hasil[$i]['pm'] = $point_penunjangs[$i]->pm;
            $proses_penunjangs = DB::table('proses_jp_penunjang')
            ->where('id_periode', '=',$id_periode)
            ->where('id_karyawan_penunjang', '=',$point_penunjangs[$i]->id_karyawan_penunjang)
            ->first();
            $hasil[$i]['iku'] = $proses_penunjangs->iku;
            $hasil[$i]['iki'] = $proses_penunjangs->iki;
            $hasil[$i]['pm_proses'] = $proses_penunjangs->pm;
        }
        // dd($hasil);
        return $hasil;
    }
}

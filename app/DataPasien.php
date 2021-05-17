<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;

class DataPasien extends Model
{
    protected $table = "data_pasien";
    protected $primaryKey = "id_data_pasien";

    public function SelectDataPasienRawatInap($id_periode, $id_ruangan){
        $data_data_pasien = DB::table('data_pasien')
        ->join('transaksi', 'data_pasien.id_data_pasien', '=', 'transaksi.id_data_pasien')
        ->leftjoin('dokter', 'transaksi.id_dokter_dpjp', '=', 'dokter.id_dokter')
        ->where('reg_type', '=', 'Rawat Inap')
        ->where('id_periode', '=', $id_periode)
        ->where('data_pasien.id_ruangan', '=', $id_ruangan)
        ->orderby('data_pasien.id_data_pasien', 'ASC')
        ->get();
        return $data_data_pasien;
    }

    public function SelectDataPasienRawatJalan($id_periode, $id_ruangan){
        $data_data_pasien = DB::table('data_pasien')
        ->join('transaksi', 'data_pasien.id_data_pasien', '=', 'transaksi.id_data_pasien')
        ->where('reg_type', '=', 'Rawat Jalan')
        ->where('id_periode', '=', $id_periode)
        ->where('data_pasien.id_ruangan', '=', $id_ruangan)
        ->orderby('data_pasien.id_data_pasien', 'ASC')
        ->get();
        return $data_data_pasien;
    }

    public function ShowDataPasien($id){
        $data_data_pasien = DB::table('data_pasien')
        ->join('transaksi', 'data_pasien.id_data_pasien', '=', 'transaksi.id_data_pasien')
        ->where('data_pasien.id_data_pasien', '=', $id)
        ->orderby('data_pasien.id_data_pasien', 'ASC')
        ->get();
        return $data_data_pasien;
    }

    public function ShowTindakanDataPasien($id){
        $data_data_pasien = DB::table('data_pasien')
        ->join('transaksi', 'data_pasien.id_data_pasien', '=', 'transaksi.id_data_pasien')
        ->leftjoin('dokter', 'transaksi.id_dokter_dpjp', '=', 'dokter.id_dokter')
        ->where('data_pasien.id_data_pasien', '=', $id)
        ->orderby('data_pasien.id_data_pasien', 'ASC')
        ->get();
        return $data_data_pasien;
    }

    // PINDAH KE MODEL TRANSAKSI

    // public function UpdateDataPasienDPJP(Request $request, $id) {
    //     try {
    //         $data_pasien = DataPasien::find($id);
    //         $data_pasien->id_dpjp = $request->id_dpjp;
    //         $data_pasien->updated_at = now();
    //         $data_pasien->save();

    //         return 'success';
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
}

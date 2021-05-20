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
        ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
        ->leftjoin('dokter', 'dokter.id_dokter', '=', 'transaksi.id_dokter_dpjp')
        ->where('transaksi.reg_type', '=', 'Rawat Inap')
        ->where('transaksi.id_periode', '=', $id_periode)
        ->where('transaksi.id_ruangan', '=', $id_ruangan)
        ->orderby('data_pasien.id_data_pasien', 'ASC')
        ->get();
        // dd($data_data_pasien);
        return $data_data_pasien;
    }

    public function SelectDataPasienRawatJalan($id_periode, $id_ruangan){
        $data_data_pasien = DB::table('data_pasien')
        ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
        ->where('transaksi.reg_type', '=', 'Rawat Jalan')
        ->where('transaksi.id_periode', '=', $id_periode)
        ->where('transaksi.id_ruangan', '=', $id_ruangan)
        ->orderby('data_pasien.id_data_pasien', 'ASC')
        ->get();
        foreach($data_data_pasien as $row){
            $nama_dokter = DB::table('data_tindakan_pasien')
            ->where('id_transaksi', '=', $row->id_transaksi)
            ->orderby('data_tindakan_pasien.id_data_tindakan_pasien', 'ASC')
            ->first();
            if(isset($nama_dokter))
            {
                $row->nama_dokter_perawat = $nama_dokter->nama_dokter_perawat;
            }
            else
            {
                $row->nama_dokter_perawat = '-';
            }
            
        }
        // dd($data_data_pasien);
        return $data_data_pasien;
    }

    public function ShowDataPasien($id){
        $data_data_pasien = DB::table('data_pasien')
        ->join('transaksi', 'transaksi.id_transaksi', '=', 'data_pasien.id_data_pasien')
        ->where('data_pasien.id_data_pasien', '=', $id)
        ->orderby('data_pasien.id_data_pasien', 'ASC')
        ->get();
        return $data_data_pasien;
    }

    public function ShowTindakanDataPasien($id){
        $data_data_pasien = DB::table('data_pasien')
        ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
        ->leftjoin('dokter', 'dokter.id_dokter', '=', 'transaksi.id_dokter_dpjp')
        ->where('data_pasien.id_data_pasien', '=', $id)
        ->orderby('data_pasien.id_data_pasien', 'ASC')
        ->get();
        return $data_data_pasien;
    }
}

<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;
use App\DataPasien;

class DataTindakanPasien extends Model
{
    protected $table = "data_tindakan_pasien";
    protected $primaryKey = "id_data_tindakan_pasien";

    public function SelectDataTindakanPasien($id){
        $data_data_tindakan_pasien = DB::table('data_tindakan_pasien')
        ->select('*', 'data_tindakan_pasien.jp as jp', 'data_tindakan_pasien.nama_dokter_perawat as nama_dokter_perawat')
        ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'data_tindakan_pasien.id_data_pasien')
        ->join('deskripsi_tindakan', 'deskripsi_tindakan.id_deskripsi_tindakan', '=', 'data_tindakan_pasien.id_deskripsi_tindakan')
        ->leftjoin('kategori_tindakan', 'deskripsi_tindakan.id_kategori_tindakan', '=', 'kategori_tindakan.id_kategori_tindakan')
        ->where('data_tindakan_pasien.id_data_pasien', '=', $id)
        ->orderby('data_tindakan_pasien.id_data_tindakan_pasien', 'ASC')
        ->get();
        // dd($data_data_tindakan_pasien);
        return $data_data_tindakan_pasien;
    }

    public function CreateDataTindakanPasien(Request $request) {
        try {
            $this->jp = $request->jp;
            $this->nama_dokter_perawat = $request->nama_dokter_perawat;
            $this->id_data_pasien = $request->id_data_pasien;
            $this->id_deskripsi_tindakan = $request->id_deskripsi_tindakan;
            $this->created_at = now();
            $this->updated_at = now();
            $this->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdateDataTindakanPasien(Request $request, $id) {
        try {
            $data_tindakan_pasien = DataTindakanPasien::find($id);
            $data_tindakan_pasien->jp = $request->jp;
            $data_tindakan_pasien->nama_dokter_perawat = $request->nama_dokter_perawat;
            $data_tindakan_pasien->id_deskripsi_tindakan = $request->id_deskripsi_tindakan;
            $data_tindakan_pasien->updated_at = now();
            $data_tindakan_pasien->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function DeleteDataTindakanPasien($id){
        try {
            $data_tindakan_pasien = DataTindakanPasien::find($id);
            $data_tindakan_pasien->delete();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

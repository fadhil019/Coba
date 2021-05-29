<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;
use App\Periode;

class DataKeuanganPasien extends Model
{
    protected $table = "data_keuangan_pasien";
    protected $primaryKey = "id_data_keuangan_pasien";

    public function SelectDataKeuanganPasien(){
        $data_keuangan_pasien = DB::table('data_keuangan_pasien')
        ->join('periode', 'periode.id_periode', '=', 'data_keuangan_pasien.id_periode')
        ->orderby('data_keuangan_pasien.id_data_keuangan_pasien', 'ASC')
        ->paginate(10);
        return $data_keuangan_pasien;
    }

    public function CreateDataKeuanganPasien(Request $request) {
        try {
            $this->no_sep_keuangan_pasien = $request->no_sep_keuangan_pasien;
            $this->nominal_uang = $request->nominal_uang;
            $this->id_periode = $request->id_periode;
            $this->created_at = now();
            $this->updated_at = now();
            $this->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdateDataKeuanganPasien(Request $request, $id) {
        try {
            $data_keuangan_pasien = DataKeuanganPasien::find($id);
            $data_keuangan_pasien->no_sep_keuangan_pasien = $request->no_sep_keuangan_pasien;
            $data_keuangan_pasien->nominal_uang = $request->nominal_uang;
            $data_keuangan_pasien->id_periode = $request->id_periode;
            $data_keuangan_pasien->updated_at = now();
            $data_keuangan_pasien->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function DeleteDataKeuanganPasien($id){
        try {
            $data_keuangan_pasien = DataKeuanganPasien::find($id);
            $data_keuangan_pasien->delete();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;
use App\Periode;
use App\Ruangan;

class Dokter extends Model
{
    protected $table = "dokter";
    protected $primaryKey = "id_dokter";

    public function SelectDokter($bagian = ""){
        $data_dokter = DB::table('dokter')
        ->join('ruangan', 'ruangan.id_ruangan', '=', 'dokter.id_ruangan')
        ->leftjoin('kategori_tindakan', 'kategori_tindakan.id_kategori_tindakan', '=', 'dokter.id_kategori_tindakan');

        if($bagian != "") {
            $data_dokter = $data_dokter->where('bagian', 'Spesialis');
        }
        $data_dokter = $data_dokter->orderby('dokter.id_dokter', 'ASC')->get();
        // dd($data_dokter);
        return $data_dokter;
    }

    public function CreateDokter(Request $request) {
        try {
            $this->nama_dokter = $request->nama_dokter;
            $this->bagian = $request->bagian;
            $this->id_kategori_tindakan = $request->id_kategori_tindakan;
            $this->id_ruangan = $request->id_ruangan;
            $this->id_users = Auth::user()->id_users;
            $this->created_at = now();
            $this->updated_at = now();
            $this->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdateDokter(Request $request, $id) {
        try {
            $data_dokter = Dokter::find($id);
            $data_dokter->nama_dokter = $request->nama_dokter;
            $data_dokter->bagian = $request->bagian;
            $data_dokter->id_kategori_tindakan = $request->id_kategori_tindakan;
            $data_dokter->id_ruangan = $request->id_ruangan;
            $data_dokter->id_users = Auth::user()->id_users;
            $data_dokter->updated_at = now();
            $data_dokter->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function DeleteDokter($id){
        try {
            $data_dokter = Dokter::find($id);
            $data_dokter->delete();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

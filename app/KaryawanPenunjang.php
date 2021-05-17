<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;

class KaryawanPenunjang extends Model
{
    protected $table = "karyawan_penunjang";
    protected $primaryKey = "id_karyawan_penunjang";

    public function SelectKaryawanPenunjang(){
        $data_karyawan_penunjang = DB::table('karyawan_penunjang')
        ->select('*', 'kategori_tindakan.nama as nama_kategori', 'karyawan_penunjang.nama as nama_karyawan')
        ->join('kategori_tindakan', 'kategori_tindakan.id_kategori_tindakan', '=', 'karyawan_penunjang.bagian')
        ->orderby('karyawan_penunjang.id_karyawan_penunjang', 'ASC')
        ->get();
        return $data_karyawan_penunjang;
    }

    public function CreateKaryawanPenunjang(Request $request) {
        try {
            $this->nama = $request->nama;
            $this->jabatan = $request->jabatan;
            $this->bagian = $request->bagian;
            $this->id_users = Auth::user()->id_users;
            $this->created_at = now();
            $this->updated_at = now();
            $this->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdateKaryawanPenunjang(Request $request, $id) {
        try {
            $data_karyawan_penunjang = KaryawanPenunjang::find($id);
            $data_karyawan_penunjang->nama = $request->nama;
            $data_karyawan_penunjang->jabatan = $request->jabatan;
            $data_karyawan_penunjang->bagian = $request->bagian;
            $data_karyawan_penunjang->updated_at = now();
            $data_karyawan_penunjang->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function DeleteKaryawanPenunjang($id){
        try {
            $data_karyawan_penunjang = KaryawanPenunjang::find($id);
            $data_karyawan_penunjang->delete();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function SelectPointKaryawanPenunjang($id_periode){
        $data_karyawan_penunjang = DB::table('karyawan_penunjang')
        ->select('*', 'karyawan_penunjang.id_karyawan_penunjang as id_karyawan_penunjang')
        ->join('point_karyawan', 'point_karyawan.id_karyawan_penunjang', '=', 'karyawan_penunjang.id_karyawan_penunjang')
        ->join('periode', 'periode.id_periode', '=', 'point_karyawan.id_periode')
        ->where('periode.id_periode', '=', $id_periode)
        ->orderby('karyawan_penunjang.id_karyawan_penunjang', 'ASC')
        ->get();
        return $data_karyawan_penunjang;
    }

    public function GenerateKaryawanPenunjangPoint($id) {
        try {
            $data_karyawan_penunjang = DB::table('karyawan_penunjang')
            ->orderby('karyawan_penunjang.id_karyawan_penunjang', 'ASC')
            ->get();

            foreach($data_karyawan_penunjang as $val)
            {
                $generate = new PointKaryawan();
                $generate->kredential = 0;
                $generate->unit = 0;
                $generate->posisi = 0;
                $generate->performa = 0;
                $generate->disiplin = 0;
                $generate->komplain = 0;
                $generate->pm = 0;
                $generate->id_periode = $id;
                $generate->id_karyawan_penunjang = $val->id_karyawan_penunjang;
                $generate->created_at = now();
                $generate->updated_at = now();
                $generate->save();
            }

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdatePointKaryawanPenunjang(Request $request, $id) {
        try {
                $update_point_karyawan = PointKaryawan::find($id);
                $update_point_karyawan->kredential = $request->kredential;
                $update_point_karyawan->unit = $request->unit;
                $update_point_karyawan->posisi = $request->posisi;
                $update_point_karyawan->performa = $request->performa;
                $update_point_karyawan->disiplin = $request->disiplin;
                $update_point_karyawan->komplain = $request->komplain;
                $update_point_karyawan->pm = $request->pm;
                $update_point_karyawan->id_periode = $request->id_periode;
                $update_point_karyawan->id_karyawan_penunjang = $request->id_karyawan_penunjang;
                $update_point_karyawan->created_at = now();
                $update_point_karyawan->updated_at = now();
                $update_point_karyawan->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;

class KaryawanAdmin extends Model
{
    protected $table = "karyawan_admin";
    protected $primaryKey = "id_karyawan_admin";

    public function SelectKaryawanAdmin(){
        $data_karyawan_admin = DB::table('karyawan_admin')
        ->orderby('karyawan_admin.id_karyawan_admin', 'ASC')
        ->get();
        return $data_karyawan_admin;
    }

    public function CreateKaryawanAdmin(Request $request) {
        try {
            $this->nama = $request->nama;
            $this->jabatan = $request->jabatan;
            $this->bagian = $request->bagian;
            // $this->id_users = Auth::user()->id_users;
            $this->created_at = now();
            $this->updated_at = now();
            $this->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdateKaryawanAdmin(Request $request, $id) {
        try {
            $data_karyawan_admin = KaryawanAdmin::find($id);
            $data_karyawan_admin->nama = $request->nama;
            $data_karyawan_admin->jabatan = $request->jabatan;
            $data_karyawan_admin->bagian = $request->bagian;
            $data_karyawan_admin->updated_at = now();
            $data_karyawan_admin->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function DeleteKaryawanAdmin($id){
        try {
            $data_karyawan_admin = KaryawanAdmin::find($id);
            $data_karyawan_admin->delete();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function SelectPointKaryawanAdmin($id_periode){
        $data_karyawan_admin = DB::table('karyawan_admin')
        ->select('*', 'karyawan_admin.id_karyawan_admin as id_karyawan_admin')
        ->join('point_karyawan', 'point_karyawan.id_karyawan_admin', '=', 'karyawan_admin.id_karyawan_admin')
        ->join('periode', 'periode.id_periode', '=', 'point_karyawan.id_periode')
        ->where('periode.id_periode', '=', $id_periode)
        ->orderby('karyawan_admin.id_karyawan_admin', 'ASC')
        ->get();
        // dd($data_karyawan_admin);
        return $data_karyawan_admin;
    }

    public function GenerateKaryawanAdminPoint($id) {
        try {
            $data_karyawan_admin = DB::table('karyawan_admin')
            ->orderby('karyawan_admin.id_karyawan_admin', 'ASC')
            ->get();

            foreach($data_karyawan_admin as $val)
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
                $generate->id_karyawan_admin = $val->id_karyawan_admin;
                $generate->created_at = now();
                $generate->updated_at = now();
                $generate->save();
            }

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdatePointKaryawanAdmin(Request $request, $id) {
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
                $update_point_karyawan->id_karyawan_admin = $request->id_karyawan_admin;
                $update_point_karyawan->created_at = now();
                $update_point_karyawan->updated_at = now();
                $update_point_karyawan->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

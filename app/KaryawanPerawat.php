<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;
use App\DaftarRuangKelas;

class KaryawanPerawat extends Model
{
    protected $table = "karyawan_perawat";
    protected $primaryKey = "id_karyawan_perawat";

    public function SelectKaryawanPerawat(){
        $data_karyawan_perawat = DB::table('karyawan_perawat')
        ->join('users', 'users.id_users', '=', 'karyawan_perawat.id_users')
        ->join('ruangan', 'ruangan.id_ruangan', '=', 'karyawan_perawat.id_ruangan')
        ->select('*', 'karyawan_perawat.id_users as id_users')
        ->orderby('karyawan_perawat.id_karyawan_perawat', 'ASC')
        ->get();
        return $data_karyawan_perawat;
    }

    public function ShowKaryawanPerawat(){
        $data_karyawan_perawat = DB::table('karyawan_perawat')
        ->join('users', 'users.id_users', '=', 'karyawan_perawat.id_users')
        ->join('ruangan', 'ruangan.id_ruangan', '=', 'karyawan_perawat.id_ruangan')
        ->select('*', 'karyawan_perawat.id_users as id_users')
        ->orderby('karyawan_perawat.id_karyawan_perawat', 'ASC')
        ->get();
        return $data_karyawan_perawat;
    }

    public function CreateKaryawanPerawat(Request $request) {
        try {
            $this->nama = $request->nama;
            $this->jabatan = $request->jabatan;
            $this->id_users = Auth::user()->id_users;
            $this->id_ruangan = $request->id_ruangan;
            $this->created_at = now();
            $this->updated_at = now();
            $this->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdateKaryawanPerawat(Request $request, $id) {
        try {
            $data_karyawan_perawat = KaryawanPerawat::find($id);
            $data_karyawan_perawat->nama = $request->nama;
            $data_karyawan_perawat->jabatan = $request->jabatan;
            $data_karyawan_perawat->id_users = Auth::user()->id_users;
            $data_karyawan_perawat->id_ruangan = $request->id_ruangan;
            $data_karyawan_perawat->updated_at = now();
            $data_karyawan_perawat->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function DeleteKaryawanPerawat($id){
        try {
            $data_karyawan_perawat = KaryawanPerawat::find($id);
            $data_karyawan_perawat->delete();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function SelectPointKaryawanPerawat($id_periode){
        $data_karyawan_perawat = DB::table('karyawan_perawat')
        ->select('*', 'karyawan_perawat.id_karyawan_perawat as id_karyawan_perawat')
        ->join('point_karyawan', 'point_karyawan.id_karyawan_perawat', '=', 'karyawan_perawat.id_karyawan_perawat')
        ->join('periode', 'periode.id_periode', '=', 'point_karyawan.id_periode')
        ->where('periode.id_periode', '=', $id_periode)
        ->orderby('karyawan_perawat.id_karyawan_perawat', 'ASC')
        ->get();
        return $data_karyawan_perawat;
    }

    public function GenerateKaryawanPerawatPoint($id) {
        try {
            $data_karyawan_perawat = DB::table('karyawan_perawat')
            ->orderby('karyawan_perawat.id_karyawan_perawat', 'ASC')
            ->get();

            foreach($data_karyawan_perawat as $val)
            {
                $cek_karyawan = DB::table('point_karyawan')
                ->where('id_periode', '=', $id)
                ->where('id_karyawan_perawat', '=', $val->id_karyawan_perawat)
                ->get();
                if(count($cek_karyawan) == 0) {
                    $generate = new PointKaryawan();
                    $generate->kredential = 0;
                    $generate->unit = 0;
                    $generate->posisi = 0;
                    $generate->performa = 0;
                    $generate->disiplin = 0;
                    $generate->komplain = 0;
                    $generate->pm = 0;
                    $generate->id_periode = $id;
                    $generate->id_karyawan_perawat = $val->id_karyawan_perawat;
                    $generate->created_at = now();
                    $generate->updated_at = now();
                    $generate->save();
                }
            }

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdatePointKaryawanPerawat(Request $request, $id) {
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
                $update_point_karyawan->id_karyawan_perawat = $request->id_karyawan_perawat;
                $update_point_karyawan->created_at = now();
                $update_point_karyawan->updated_at = now();
                $update_point_karyawan->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

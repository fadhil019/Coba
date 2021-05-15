<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

class Periode extends Model
{
    protected $table = "periode";
    protected $primaryKey = "id_periode";

    public function SelectPeriode(){
        $data_periode = DB::table('periode')
        ->join('users', 'users.id_users', '=', 'periode.id_users')
        ->orderby('periode.id_periode', 'ASC')
        ->get();
        return $data_periode;
    }

    public function ShowPeriode($id){
        $data_periode = DB::table('periode')
        ->where('id_periode', '=', $id)
        ->orderby('periode.id_periode', 'ASC')
        ->first();
        return $data_periode;
    }

    public function SelectPeriodeDESC(){
        $data_periode = DB::table('periode')
        ->join('users', 'users.id_users', '=', 'periode.id_users')
        ->orderby('periode.id_periode', 'DESC')
        ->get();
        return $data_periode;
    }

    public function CreatePeriode(Request $request) {
        try {
            $this->bulan = $request->bulan;
            $this->tahun = $request->tahun;
            $this->id_users = Auth::user()->id_users;
            $this->created_at = now();
            $this->updated_at = now();
            $this->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdatePeriode(Request $request, $id) {
        try {
            $data_periode = Periode::find($id);
            $data_periode->bulan = $request->bulan;
            $data_periode->tahun = $request->tahun;
            $data_periode->id_users = Auth::user()->id_users;
            $data_periode->updated_at = now();
            $data_periode->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function DeletePeriode($id){
        try {
            $data_periode = Periode::find($id);
            $data_periode->delete();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

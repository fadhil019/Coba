<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;
use App\Periode;

class KategoriTindakan extends Model
{
    protected $table = "kategori_tindakan";
    protected $primaryKey = "id_kategori_tindakan";

    public function SelectKategoriTindakan(){
        $kategori_tindakan = DB::table('kategori_tindakan')
        ->join('users', 'users.id_users', '=', 'kategori_tindakan.id_users')
        ->orderby('kategori_tindakan.id_kategori_tindakan', 'ASC')
        ->get();
        return $kategori_tindakan;
    }

    public function ShowKategoriTindakan($id){
        $kategori_tindakan = DB::table('kategori_tindakan')
        ->join('users', 'users.id_users', '=', 'kategori_tindakan.id_users')
        ->where('kategori_tindakan.id_kategori_tindakan', '=', $id)
        ->first();
        return $kategori_tindakan;
    }

    public function CreateKategoriTindakan(Request $request) {
        try {
            $kt = DB::table('kategori_tindakan')
                ->where('nama', '=', $request->nama)
                ->first();
            if ($kt == null) {
            $this->nama = $request->nama;
            $this->kategori_data = $request->kategori_data;
            $this->tahapan_proses = $request->tahapan_proses;
            $this->id_users = Auth::user()->id_users;
            $this->created_at = now();
            $this->updated_at = now();
            $this->save();
            return 'success';
            }
            else{
                return 'tidaksuccess';
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdateKategoriTindakan(Request $request, $id) {
        try {
            $kategori_tindakan = KategoriTindakan::find($id);
            $kategori_tindakan->nama = $request->nama;
            $kategori_tindakan->kategori_data = $request->kategori_data;
            $kategori_tindakan->tahapan_proses = $request->tahapan_proses;
            $kategori_tindakan->id_users = Auth::user()->id_users;
            $kategori_tindakan->updated_at = now();
            $kategori_tindakan->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function DeleteKategoriTindakan($id){
        try {
            $kategori_tindakan = KategoriTindakan::find($id);
            $kategori_tindakan->delete();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

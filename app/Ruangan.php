<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;
use App\Periode;

class Ruangan extends Model
{
    protected $table = "ruangan";
    protected $primaryKey = "id_ruangan";

    public function SelectRuangan($kategori_ruangan = ""){
        if($kategori_ruangan == "") {
            $ruangan = DB::table('ruangan')
            ->join('users', 'users.id_users', '=', 'ruangan.id_users')
            ->orderby('ruangan.id_ruangan', 'ASC')
            ->get();
            return $ruangan;
        } else {
            $ruangan = DB::table('ruangan')
            ->join('users', 'users.id_users', '=', 'ruangan.id_users')
            ->where('kategori_ruangan', '=', $kategori_ruangan)
            ->orderby('ruangan.id_ruangan', 'ASC')
            ->get();
            return $ruangan;
        }
    }

    public function ShowRuangan($id_ruangan){
        $ruangan = DB::table('ruangan')
        ->where('id_ruangan', '=', $id_ruangan)
        ->first();
        return $ruangan;
    }

    public function CreateRuangan(Request $request) {
        try {
            $ruangans = DB::table('ruangan')
                ->where('nama_ruangan', '=', $request->nama_ruangan)
                ->first();
            if ($ruangans == null) {
            $this->nama_ruangan = $request->nama_ruangan;
            $this->kategori_ruangan = $request->kategori_ruangan;
            $this->id_users = Auth::user()->id_users;
            $this->created_at = now();
            $this->updated_at = now();
            $this->save();

            return 'success';
            }
            else
            {
                return 'tidak success';
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdateRuangan(Request $request, $id) {
        try {
            $ruangan = Ruangan::find($id);
            $ruangan->nama_ruangan = $request->nama_ruangan;
            $ruangan->kategori_ruangan = $request->kategori_ruangan;
            $ruangan->id_users = Auth::user()->id_users;
            $ruangan->updated_at = now();
            $ruangan->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function DeleteRuangan($id){
        try {
            $ruangan = Ruangan::find($id);
            $ruangan->delete();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

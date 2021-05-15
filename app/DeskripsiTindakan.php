<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;
use App\Periode;

class DeskripsiTindakan extends Model
{
    protected $table = "deskripsi_tindakan";
    protected $primaryKey = "id_deskripsi_tindakan";

    public function SelectDeskripsiTindakan(){
        $deskripsi_tindakan = DB::table('deskripsi_tindakan')
        ->leftjoin('kategori_tindakan', 'kategori_tindakan.id_kategori_tindakan', '=', 'deskripsi_tindakan.id_kategori_tindakan')
        ->orderby('deskripsi_tindakan.id_deskripsi_tindakan', 'ASC')
        ->get();
        return $deskripsi_tindakan;
    }

    public function ShowDeskripsiTindakan($id){
        $deskripsi_tindakan = DB::table('deskripsi_tindakan')
        ->where('id_deskripsi_tindakan', $id)
        ->get();
        return $deskripsi_tindakan;
    }

    public function CreateDeskripsiTindakan(Request $request) {
        try {
            $this->deskripsi_tindakan = $request->deskripsi_tindakan;
            $this->id_kategori_tindakan = $request->id_kategori_tindakan;
            $this->created_at = now();
            $this->updated_at = now();
            $this->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdateDeskripsiTindakan(Request $request, $id) {
        try {
            $deskripsi_tindakan = DeskripsiTindakan::find($id);
            $deskripsi_tindakan->deskripsi_tindakan = $request->deskripsi_tindakan;
            $deskripsi_tindakan->id_kategori_tindakan = $request->id_kategori_tindakan;
            $deskripsi_tindakan->updated_at = now();
            $deskripsi_tindakan->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function DeleteDeskripsiTindakan($id){
        try {
            $deskripsi_tindakan = DeskripsiTindakan::find($id);
            $deskripsi_tindakan->delete();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

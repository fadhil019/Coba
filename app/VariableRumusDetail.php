<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

class VariableRumusDetail extends Model
{
    protected $table = "variable_rumus_detail";
    protected $primaryKey = "id_variable_rumus_detail";

    public function SelectVariableRumusDetail($id){
        $data_variable_rummus_detail = DB::table('variable_rumus_detail')
        ->join('kategori_tindakan', 'kategori_tindakan.id_kategori_tindakan', '=', 'variable_rumus_detail.id_kategori_tindakan')
        ->where('variable_rumus_detail.id_variable_rumus', '=', $id)
        ->orderby('variable_rumus_detail.id_variable_rumus_detail', 'ASC')
        ->get();
        return $data_variable_rummus_detail;
    }

    public function CreateVariableRumusDetail(Request $request) {
        try {
            $this->id_kategori_tindakan = $request->id_kategori_tindakan_detail;
            $this->id_variable_rumus = $request->id_variable_rumus;
            $this->nilai = $request->nilai;
            $this->created_at = now();
            $this->updated_at = now();
            $this->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdateVariableRumusDetail(Request $request, $id) {
        try {
            $update_variable_rumus_detail = VariableRumusDetail::find($id);
            $update_variable_rumus_detail->id_kategori_tindakan = $request->id_kategori_tindakan_detail;
            $update_variable_rumus_detail->id_variable_rumus = $request->id_variable_rumus;
            $update_variable_rumus_detail->nilai = $request->nilai;
            $update_variable_rumus_detail->created_at = now();
            $update_variable_rumus_detail->updated_at = now();
            $update_variable_rumus_detail->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function DeleteVariableRumusDetail($id){
        try {
            $data_variable_rumus_detail = VariableRumusDetail::find($id);
            $data_variable_rumus_detail->delete();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}

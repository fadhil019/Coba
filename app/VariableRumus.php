<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

class VariableRumus extends Model
{
    protected $table = "variable_rumus";
    protected $primaryKey = "id_variable_rumus";

    public function SelectVariableRumus(){
        $data_variable_rumus = DB::table('variable_rumus')
        ->get();
        $hasil = [];
        foreach($data_variable_rumus as $row){
            $hasil[$row->nama_variabel] = $row->rumus;
        }
        return $hasil;
    }

    public function ShowVariableRumus($id){
        $data_variable_rumus = DB::table('variable_rumus')
        ->where('id_kategori_tindakan', '=', $id)
        ->first();
        return $data_variable_rumus;
    }

    public function CreateUpdateVariableRumus(Request $request) {
        try {
            $data_variable_rumus = DB::table('variable_rumus')
            ->where('nama_variabel', '=', $request->nama_variabel)
            ->first();
            if(isset($data_variable_rumus))
            {
                // $create_variable_rumus_detail = new VariableRumusDetail();
                // $create_variable_rumus_details = $create_variable_rumus_detail->CreateVariableRumusDetail($request);
                $update_rumus = VariableRumus::find($data_variable_rumus->id_variable_rumus);
                $update_rumus->id_kategori_tindakan = $request->id_kategori_tindakan;
                $update_rumus->nama_variabel = $request->nama_variabel;
                $update_rumus->rumus = $request->rumus;
                $update_rumus->updated_at = now();
                $update_rumus->save();
            }
            else
            {
                $this->id_kategori_tindakan = $request->id_kategori_tindakan;
                $this->nama_variabel = $request->nama_variabel;
                $this->rumus = $request->rumus;
                $this->created_at = now();
                $this->updated_at = now();
                $this->save();
            }
            

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

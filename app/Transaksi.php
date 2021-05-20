<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

class Transaksi extends Model
{
    protected $table = "transaksi";
    protected $primaryKey = "id_transaksi";

    // PINDAH KE MODEL TRANSAKSI

    public function UpdateDataPasienDPJP(Request $request, $id) {
        try {
            $data_pasien = Transaksi::find($id);
            $data_pasien->id_dokter_dpjp = $request->id_dokter_dpjp;
            $data_pasien->updated_at = now();
            $data_pasien->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

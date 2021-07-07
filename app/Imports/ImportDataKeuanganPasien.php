<?php

namespace App\Imports;

use DB;

use App\DataKeuanganPasien;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

use Session;

class ImportDataKeuanganPasien implements ToCollection, WithStartRow
{
	/**
     * @return int
     */
    public function startRow(): int
    {
        return 3;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $flag=0;
        foreach($collection as $row)
        {
        	$no_sep = $row[1];
        	$nominal = $row[2];
            $data_uang = DB::table('data_keuangan_pasien')
                ->where('no_sep_keuangan_pasien', '=', $no_sep)
                ->first();
            $cek_nominal = is_numeric($nominal);
            if ($no_sep!="" && $cek_nominal == 1 && $data_uang == null) {
                $data_keuangan_pasien = new DataKeuanganPasien();
                $data_keuangan_pasien->no_sep_keuangan_pasien = $no_sep;
                $data_keuangan_pasien->nominal_uang = $nominal;
                $data_keuangan_pasien->id_periode = session('id_periode');
                $data_keuangan_pasien->save();
                
            }
            elseif ($data_uang != null && $no_sep=="" && $cek_nominal == 0) {
                
                $flag = 1;
            }
        }
        if ($flag == 0) {
            return "success";
        }
        else
        {
            return "tidak";
        }
    }
}

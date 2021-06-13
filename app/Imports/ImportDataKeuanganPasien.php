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
        foreach($collection as $row)
        {
        	$no_sep = $row[1];
        	$nominal = $row[2];
            if ($no_sep!="") {
                $data_keuangan_pasien = new DataKeuanganPasien();
                $data_keuangan_pasien->no_sep_keuangan_pasien = $no_sep;
                $data_keuangan_pasien->nominal_uang = $nominal;
                $data_keuangan_pasien->id_periode = session('id_periode');
                $data_keuangan_pasien->save();
            }
        }
    }
}

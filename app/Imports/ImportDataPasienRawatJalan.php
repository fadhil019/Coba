<?php

namespace App\Imports;

use DB;

use App\DataPasien;
use App\DataTindakanPasien;
use App\DeskripsiTindakan;
use App\Dokter;
use App\KaryawanPerawat;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

use Session;
use Auth;

class ImportDataPasienRawatJalan implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 4;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $id_data_pasien = 0;
        foreach($collection as $row)
        {
        	$user_kasir = $row[1];
        	$tgl_masuk = $row[2];
        	$tgl_keluar = $row[3];
        	$no_rm = $row[4];
        	$nama_pasien = $row[5];
        	$penjamin = $row[6];
        	$no_sep = $row[7];
        	$reg_type = 'Rawat Jalan';
        	$nama_dokter_perawat = $row[9];
        	$ruangan = $row[10];
        	$deskripsi_tindakan = $row[11];
        	$qty = $row[12];
        	$jp = $row[13];

			if (strpos($nama_dokter_perawat, "dr") !== false) {
				$bagian = "";
				if (strpos($nama_dokter_perawat, "sp") !== false || strpos($nama_dokter_perawat, "Sp") !== false) {
					$bagian = "Spesialis";
				} else {
					$bagian = "Umum";
				}

				$dokter = DB::table('dokter')->where('nama_dokter', $nama_dokter_perawat)->first();
				if($dokter == null) {
					$dokter = new Dokter();
					$dokter->nama_dokter = $nama_dokter_perawat;
					$dokter->bagian = $bagian;
					$dokter->id_users = Auth::user()->id_users;
					$dokter->id_ruangan = session('id_ruangan');
					$dokter->save();
				}
			} else {
				if($nama_dokter_perawat != "-" && $nama_dokter_perawat != "") {
					$karyawan_perawat = DB::table('karyawan_perawat')->where('nama', $nama_dokter_perawat)->first();
					if($karyawan_perawat == null) {
						$karyawan_perawat = new KaryawanPerawat();
						$karyawan_perawat->nama = $nama_dokter_perawat;
						$karyawan_perawat->jabatan = "Karyawan";
						$karyawan_perawat->id_users = Auth::user()->id_users;
						$karyawan_perawat->id_ruangan = session('id_ruangan');
						$karyawan_perawat->save();
					}
				}
			}

        	if($row[0] != "") {
	        	$data_pasien = new DataPasien();
	        	$data_pasien->no_sep = $no_sep;
	        	$data_pasien->user_kasir = $user_kasir;
	        	$data_pasien->tgl_masuk = $tgl_masuk;
	        	$data_pasien->tgl_keluar = $tgl_keluar;
	        	$data_pasien->no_rm = $no_rm;
	        	$data_pasien->nama_pasien = $nama_pasien;
	        	$data_pasien->penjamin = $penjamin;
	        	$data_pasien->reg_type = $reg_type;
	        	$data_pasien->nama_dokter_perawat = $nama_dokter_perawat;
	        	$data_pasien->kategori_ruangan = $ruangan;
	        	$data_pasien->deskripsi_tindakan = $deskripsi_tindakan;
	        	$data_pasien->jp = $jp;
	        	$data_pasien->id_users = Auth::user()->id_users;
	        	$data_pasien->id_periode = session('id_periode');
	        	$data_pasien->id_ruangan = session('id_ruangan');
	        	$data_pasien->save();

	        	$id_data_pasien = $data_pasien->id_data_pasien;
        	} else {
        		if($jp !== 0) {
        			$data_deskripsi_tindakan = DeskripsiTindakan::where('deskripsi_tindakan', '=', $deskripsi_tindakan)->first();
        			if($data_deskripsi_tindakan == null) {
        				$data_deskripsi_tindakan = new DeskripsiTindakan();
        				$data_deskripsi_tindakan->deskripsi_tindakan = $deskripsi_tindakan;
        				$data_deskripsi_tindakan->save();
        			} 

        			$data_tindakan_pasien = new DataTindakanPasien();
        			$data_tindakan_pasien->jp = $jp;
	        		$data_tindakan_pasien->nama_dokter_perawat = $nama_dokter_perawat;
	        		$data_tindakan_pasien->id_data_pasien = $id_data_pasien;
	        		$data_tindakan_pasien->id_deskripsi_tindakan = $data_deskripsi_tindakan->id_deskripsi_tindakan;
	        		$data_tindakan_pasien->save();
        		}
        	}
        }
    }
}

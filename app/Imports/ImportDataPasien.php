<?php

namespace App\Imports;

use DB;

use App\DataPasien;
use App\DataTindakanPasien;
use App\DeskripsiTindakan;
use App\Dokter;
use App\KaryawanPerawat;
use App\Transaksi;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

use Session;
use Auth;

class ImportDataPasien implements ToCollection, WithStartRow
{
	/**
     * @return int
     */
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
    	$id_transaksi = 0;
        foreach($collection as $row)
        {
        	$user_kasir = $row[1];
        	$tgl_masuk = $row[2];
        	$tgl_keluar = $row[3];
        	$no_rm = $row[4];
        	$nama_pasien = $row[5];
        	$penjamin = $row[6];
        	$no_sep = $row[7];
        	$reg_type = $row[8];
        	$nama_dokter_perawat = $row[9];
        	$kategori_ruangan = $row[10];
        	$deskripsi_tindakan = $row[11];
        	$jp = $row[13];

        	$sep_pasien = DB::table('data_keuangan_pasien')
			->where('no_sep_keuangan_pasien', $no_sep)
			->where('id_periode', session('id_periode'))
			->first();
			if($sep_pasien != null && $sep_pasien != "") {
				$pasien = DB::table('data_pasien')->where('nama_pasien', $nama_pasien)->first();
				if($pasien == null) {
					$pasien = new DataPasien();
					$pasien->nama_pasien = $nama_pasien;
					$pasien->penjamin = $penjamin;
					$pasien->save();
				}
				$id_data_pasien = $pasien->id_data_pasien;
	
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
					$transaksi = new Transaksi();
					$transaksi->id_data_pasien = $id_data_pasien;
					$transaksi->no_sep = $no_sep;
					$transaksi->reg_type = $reg_type;
					$transaksi->id_users = Auth::user()->id_users;
					$transaksi->id_periode = session('id_periode');
					$transaksi->id_ruangan = session('id_ruangan');
					$transaksi->save();
	
					$id_transaksi = $transaksi->id_transaksi;
	
					$data_deskripsi_tindakan = DeskripsiTindakan::where('deskripsi_tindakan', '=', $deskripsi_tindakan)->first();
					if($data_deskripsi_tindakan == null) {
						$data_deskripsi_tindakan = new DeskripsiTindakan();
						$data_deskripsi_tindakan->deskripsi_tindakan = $deskripsi_tindakan;
						$data_deskripsi_tindakan->save();
					} 
	
					$data_tindakan_pasien = new DataTindakanPasien();
					$data_tindakan_pasien->jp = $jp;
					$data_tindakan_pasien->nama_dokter_perawat = $nama_dokter_perawat;
					$data_tindakan_pasien->id_transaksi = $id_transaksi;
					$data_tindakan_pasien->id_deskripsi_tindakan = $data_deskripsi_tindakan->id_deskripsi_tindakan;
					$data_tindakan_pasien->save();
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
						$data_tindakan_pasien->id_transaksi = $id_transaksi;
						$data_tindakan_pasien->id_deskripsi_tindakan = $data_deskripsi_tindakan->id_deskripsi_tindakan;
						$data_tindakan_pasien->save();
					}
				}
			}
        }
    }
}

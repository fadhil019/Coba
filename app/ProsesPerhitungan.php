<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;

class ProsesPerhitungan extends Model
{
    protected $table = "proses_perhitungan";
    protected $primaryKey = "id_proses_perhitungan";

    // GIZI PASIEN
    public function ShowGiziPasien($id_transaksi) {
        try {
            $data_kategori_gizi = DB::table('kategori_tindakan')
            ->where('nama', '=', 'GIZI')
            ->first();
            if(isset($data_kategori_gizi))
            {
                $data_gizi_pasien = DB::table('proses_perhitungan')
                ->where('id_transaksi', '=', $id_transaksi)
                ->where('id_kategori_tindakan', '=', $data_kategori_gizi->id_kategori_tindakan)
                ->where('proses', '=', 'Ke 1')
                ->first();
            }
            return $data_gizi_pasien;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function CreateGiziPasien(Request $request) {
        try {
            $data_kategori_gizi = DB::table('kategori_tindakan')
            ->where('nama', '=', 'GIZI')
            ->first();
            if(isset($data_kategori_gizi))
            {
                $data_gizi_pasien = DB::table('proses_perhitungan')
                ->where('id_transaksi', '=', $request->id_transaksi)
                ->where('id_kategori_tindakan', '=', $data_kategori_gizi->id_kategori_tindakan)
                ->where('proses', '=', 'Ke 1')
                ->first();
                // dd($data_gizi_pasien);
                if(isset($data_gizi_pasien))
                {
                    $update_data_gizi_pasien = ProsesPerhitungan::find($data_gizi_pasien->id_proses_perhitungan);
                    $update_data_gizi_pasien->jumlah_jp = $request->jumlah_jp;
                    $update_data_gizi_pasien->updated_at = now();
                    $update_data_gizi_pasien->save();
                }
                else
                {
                    $this->ket_kategori = 'GIZI';
                    $this->proses = 'Ke 1';
                    $this->jumlah_jp = $request->jumlah_jp;
                    $this->id_data_pasien = $request->id_data_pasien;
                    $this->id_transaksi = $request->id_transaksi;
                    $this->id_ruangan = $request->id_ruangan;
                    $this->id_kategori_tindakan = $data_kategori_gizi->id_kategori_tindakan;
                    $this->created_at = now();
                    $this->updated_at = now();
                    $this->save();
                }
            }
            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // ADM PASIEN
    public function ShowAdmPasien($id_transaksi) {
        try {
            $data_adm_pasien = DB::table('proses_perhitungan')
            ->where('id_transaksi', '=', $id_transaksi)
            ->where('ket_kategori', '=', 'ADM')
            ->where('proses', '=', 'Ke 1')
            ->first();

            return $data_adm_pasien;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function CreateAdmPasien(Request $request) {
        try {
            $data_adm_pasien = DB::table('proses_perhitungan')
            ->where('id_transaksi', '=', $request->id_transaksi)
            ->where('ket_kategori', '=', 'ADM')
            ->where('proses', '=', 'Ke 1')
            ->first();
            // dd($data_adm_pasien);
            if(isset($data_adm_pasien))
            {
                $update_data_adm_pasien = ProsesPerhitungan::find($data_adm_pasien->id_proses_perhitungan);
                $update_data_adm_pasien->jumlah_jp = $request->jumlah_jp;
                $update_data_adm_pasien->updated_at = now();
                $update_data_adm_pasien->save();
            }
            else
            {
                $this->ket_kategori = 'ADM';
                $this->proses = 'Ke 1';
                $this->jumlah_jp = $request->jumlah_jp;
                $this->id_data_pasien = $request->id_data_pasien;
                $this->id_transaksi = $request->id_transaksi;
                $this->id_ruangan = $request->id_ruangan;
                $this->created_at = now();
                $this->updated_at = now();
                $this->save();
            }

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // VISITE PASIEN
    public function ShowVisitePasien($id_transaksi) {
        try {
            $data_visite_pasien = DB::table('proses_perhitungan')
            ->join('dokter', 'dokter.id_dokter', '=', 'proses_perhitungan.id_dokter')
            ->where('id_transaksi', '=', $id_transaksi)
            ->where('ket_kategori', '=', 'VISITE')
            ->where('proses', '=', 'Ke 1')
            ->get();

            return $data_visite_pasien;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function CreateVisitePasien(Request $request) {
        try {
                $this->ket_kategori = 'VISITE';
                $this->proses = 'Ke 1';
                $this->jumlah_jp = $request->jumlah_jp;
                $this->id_data_pasien = $request->id_data_pasien;
                $this->id_transaksi = $request->id_transaksi;
                $this->id_dokter = $request->id_dokter;
                $this->id_ruangan = $request->id_ruangan;
                $this->created_at = now();
                $this->updated_at = now();
                $this->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function UpdateVisitePasien(Request $request) {
        try {
                $update_visite_pasien = ProsesPerhitungan::find($id);
                $update_visite_pasien->jumlah_jp = $request->jumlah_jp;
                $update_visite_pasien->updated_at = now();
                $update_visite_pasien->save();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function DeleteVisitePasien($id) {
        try {
            $delete_visite_pasien = ProsesPerhitungan::find($id);
            $delete_visite_pasien->delete();

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function ShowProsesPerhitunganRawatInap($id_periode, $id_ruangan){
        $data_pasien = new DataPasien();
        $data_pasiens = $data_pasien->SelectDataPasienRawatInap($id_periode, $id_ruangan);
        $hasil = [];
        foreach($data_pasiens as $row) {
            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $row->id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'ADM')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['adm']['adm'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $row_data_proses_perhitungan->jumlah_jp;
            }

            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $row->id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'GIZI')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['gizi']['gizi'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }  
            
            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $row->id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'PERAWAT IGD')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['perawat_igd'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }  
            
            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $row->id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'PERAWAT ICCU')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['perawat_iccu'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }  
            
            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $row->id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'PERAWAT RPP')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['perawat_rpp'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }  

            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $row->id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'KATEGORI TINDAKAN')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['hasil_kategori_tindakan'][$row_data_proses_perhitungan->id_kategori_tindakan] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }  

            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $row->id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'DOKTER')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['dokter'][$row_data_proses_perhitungan->id_dokter] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }  

            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $row->id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'VISITE')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['visite'][$row_data_proses_perhitungan->id_dokter] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }  
        }
        // dd($hasil);
        return $hasil;
    }

    public function ShowDetailProsesPerhitunganRawatInap($id_periode, $id_ruangan, $id_data_pasien){
        $hasil = [];
        $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'ADM')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['adm']['adm'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $row_data_proses_perhitungan->jumlah_jp;
            }

            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'GIZI')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['gizi']['gizi'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }  
            
            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'PERAWAT IGD')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['perawat_igd'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }  
            
            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'PERAWAT ICCU')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['perawat_iccu'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }  
            
            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'PERAWAT RPP')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['perawat_rpp'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }  

            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->join('kategori_tindakan', 'kategori_tindakan.id_kategori_tindakan', '=', 'proses_perhitungan.id_kategori_tindakan')
            ->where('data_pasien.id_data_pasien', '=', $id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'KATEGORI TINDAKAN')
            ->get();
            $tmp_ke_1 = 0;
            $tmp_ke_2 = 0;
            $tmp_ke_3 = 0;
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 1') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['hasil_kategori_tindakan'][$tmp_ke_1]['nama_kategori'] = $data_proses_perhitungan[$i]->nama;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['hasil_kategori_tindakan'][$tmp_ke_1]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_ke_1++;
                }
            }
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 2') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['hasil_kategori_tindakan'][$tmp_ke_2]['nama_kategori'] = $data_proses_perhitungan[$i]->nama;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['hasil_kategori_tindakan'][$tmp_ke_2]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_ke_2++;
                }
            }
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 3') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['hasil_kategori_tindakan'][$tmp_ke_3]['nama_kategori'] = $data_proses_perhitungan[$i]->nama;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['hasil_kategori_tindakan'][$tmp_ke_3]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_ke_3++;
                }
            }
            
            
            // foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                
            // }  

            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->join('dokter', 'dokter.id_dokter', '=', 'proses_perhitungan.id_dokter')
            ->where('data_pasien.id_data_pasien', '=', $id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'DOKTER')
            ->get();
            // $tmp_dokter = 0;
            // for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
            //     $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter]['nama_dokter'] = $data_proses_perhitungan[$i]->nama_dokter;
            //     $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
            //     $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
            //     $tmp_dokter++;
            // }
            $tmp_dokter_ke_1 = 0;
            $tmp_dokter_ke_2 = 0;
            $tmp_dokter_ke_3 = 0;
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 1') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter_ke_1]['nama_dokter'] = $data_proses_perhitungan[$i]->nama_dokter;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter_ke_1]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_dokter_ke_1++;
                }
            }
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 2') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter_ke_2]['nama_dokter'] = $data_proses_perhitungan[$i]->nama_dokter;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter_ke_2]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_dokter_ke_2++;
                }
            }
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 3') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter_ke_3]['nama_dokter'] = $data_proses_perhitungan[$i]->nama_dokter;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter_ke_3]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_dokter_ke_3++;
                }
            }
            // foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
            //     $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['dokter']['nama_dokter'] = $row_data_proses_perhitungan->nama_dokter;
            //     $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['dokter']['jumlah_jp'] = $row_data_proses_perhitungan->jumlah_jp;
            //     $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            // }  

            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->join('dokter', 'dokter.id_dokter', '=', 'proses_perhitungan.id_dokter')
            ->where('data_pasien.id_data_pasien', '=', $id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'VISITE')
            ->get();
            $tmp_visite_ke_1 = 0;
            $tmp_visite_ke_2 = 0;
            $tmp_visite_ke_3 = 0;
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 1') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['visite'][$tmp_visite_ke_1]['nama_dokter'] = $data_proses_perhitungan[$i]->nama_dokter;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['visite'][$tmp_visite_ke_1]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_visite_ke_1++;
                }
            }
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 2') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['visite'][$tmp_visite_ke_2]['nama_dokter'] = $data_proses_perhitungan[$i]->nama_dokter;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['visite'][$tmp_visite_ke_2]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_visite_ke_2++;
                }
            }
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 3') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['visite'][$tmp_visite_ke_3]['nama_dokter'] = $data_proses_perhitungan[$i]->nama_dokter;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['visite'][$tmp_visite_ke_3]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_visite_ke_3++;
                }
            }
            // $tmp_visite = 0;
            // for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
            //     $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['visite'][$tmp_visite]['nama_dokter'] = $data_proses_perhitungan[$i]->nama_dokter;
            //     $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['visite'][$tmp_visite]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
            //     $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
            //     $tmp_visite++;
            // }
            // foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
            //     $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['visite']['nama_dokter'] = $row_data_proses_perhitungan->nama_dokter;
            //     $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['visite']['jumlah_jp'] = $row_data_proses_perhitungan->jumlah_jp;
            //     $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            // }  
            // dd($hasil);
        return $hasil;
    }

    public function ShowProsesPerhitunganRawatJalan($id_periode, $id_ruangan){
        $data_pasien = new DataPasien();
        $data_pasiens = $data_pasien->SelectDataPasienRawatJalan($id_periode, $id_ruangan);
        $hasil = [];
        foreach($data_pasiens as $row) {

            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $row->id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'ADM')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['adm']['adm'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $row_data_proses_perhitungan->jumlah_jp;
            } 
            
            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $row->id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'TINDAKAN')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['hasil_tindakan'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            } 

            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $row->id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'KATEGORI TINDAKAN')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['hasil_kategori_tindakan'][$row_data_proses_perhitungan->id_kategori_tindakan] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }  

            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $row->id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'DOKTER')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['dokter'][$row_data_proses_perhitungan->id_dokter] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$row->id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }
        }
        // dd($hasil);
        return $hasil;
    }

    public function ShowDetailProsesPerhitunganRawatJalan($id_periode, $id_ruangan, $id_data_pasien){
        $hasil = [];
        $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'ADM')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['adm']['adm'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $row_data_proses_perhitungan->jumlah_jp;
            }
            
            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->where('data_pasien.id_data_pasien', '=', $id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'TINDAKAN')
            ->get();
            foreach($data_proses_perhitungan as $row_data_proses_perhitungan) {
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['hasil_tindakan'] = $row_data_proses_perhitungan->jumlah_jp;
                $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] = $hasil[$id_data_pasien][$row_data_proses_perhitungan->proses]['total'] + $row_data_proses_perhitungan->jumlah_jp;
            }   

            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->join('kategori_tindakan', 'kategori_tindakan.id_kategori_tindakan', '=', 'proses_perhitungan.id_kategori_tindakan')
            ->where('data_pasien.id_data_pasien', '=', $id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'KATEGORI TINDAKAN')
            ->get();
            $tmp_ke_1 = 0;
            $tmp_ke_2 = 0;
            $tmp_ke_3 = 0;
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 1') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['hasil_kategori_tindakan'][$tmp_ke_1]['nama_kategori'] = $data_proses_perhitungan[$i]->nama;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['hasil_kategori_tindakan'][$tmp_ke_1]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_ke_1++;
                }
            }
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 2') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['hasil_kategori_tindakan'][$tmp_ke_2]['nama_kategori'] = $data_proses_perhitungan[$i]->nama;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['hasil_kategori_tindakan'][$tmp_ke_2]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_ke_2++;
                }
            }
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 3') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['hasil_kategori_tindakan'][$tmp_ke_3]['nama_kategori'] = $data_proses_perhitungan[$i]->nama;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['hasil_kategori_tindakan'][$tmp_ke_3]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_ke_3++;
                }
            }

            $data_proses_perhitungan = DB::table('proses_perhitungan')
            ->join('data_pasien', 'data_pasien.id_data_pasien', '=', 'proses_perhitungan.id_data_pasien')
            ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
            ->join('dokter', 'dokter.id_dokter', '=', 'proses_perhitungan.id_dokter')
            ->where('data_pasien.id_data_pasien', '=', $id_data_pasien)
            ->where('proses_perhitungan.id_ruangan', '=', $id_ruangan)
            ->where('transaksi.id_periode', '=', $id_periode)
            ->where('proses_perhitungan.ket_kategori', '=', 'DOKTER')
            ->get();

            $tmp_dokter_ke_1 = 0;
            $tmp_dokter_ke_2 = 0;
            $tmp_dokter_ke_3 = 0;
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 1') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter_ke_1]['nama_dokter'] = $data_proses_perhitungan[$i]->nama_dokter;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter_ke_1]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_dokter_ke_1++;
                }
            }
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 2') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter_ke_2]['nama_dokter'] = $data_proses_perhitungan[$i]->nama_dokter;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter_ke_2]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_dokter_ke_2++;
                }
            }
            for ($i=0; $i < count($data_proses_perhitungan); $i++) { 
                if($data_proses_perhitungan[$i]->proses == 'Ke 3') {
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter_ke_3]['nama_dokter'] = $data_proses_perhitungan[$i]->nama_dokter;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['dokter'][$tmp_dokter_ke_3]['jumlah_jp'] = $data_proses_perhitungan[$i]->jumlah_jp;
                    $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] = $hasil[$id_data_pasien][$data_proses_perhitungan[$i]->proses]['total'] + $data_proses_perhitungan[$i]->jumlah_jp;
                    $tmp_dokter_ke_3++;
                }
            } 

            // dd($hasil);
        return $hasil;
    }
}

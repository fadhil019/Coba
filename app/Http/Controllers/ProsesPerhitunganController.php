<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\KategoriTindakan;
use App\DataPasien;
use App\DataTindakanPasien;
use App\DeskripsiTindakan;
use App\ProsesPerhitungan;
use App\Dokter;
use App\Periode;
use App\Ruangan;


use DB;

class ProsesPerhitunganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Tampilan perhitungan admin ruangan
    public function periode__p_pasien_rawat_inap()
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->SelectPeriodeDESC();

        return view('pasien.p_rawat_inap_ar.periode_p_rawat_inap', compact('data_periodes'));
    }

    public function ruangan_p_pasien_rawat_inap($id_periode)
    {
        $data_ruangan = new Ruangan();
        $data_ruangans = $data_ruangan->SelectRuangan();

        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        return view('pasien.p_rawat_inap_ar.ruangan_p_rawat_inap', compact('data_ruangans', 'data_periodes'));
    }

    // Tampilan perhitungan rawat jalan kolektif data
    public function periode__p_pasien_rawat_jalan()
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->SelectPeriodeDESC();

        return view('pasien.p_rawat_jalan_kd.periode_p_rawat_jalan', compact('data_periodes'));
    }

    public function ruangan_p_pasien_rawat_jalan($id_periode)
    {
        $data_ruangan = new Ruangan();
        $data_ruangans = $data_ruangan->SelectRuangan();

        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        return view('pasien.p_rawat_jalan_kd.ruangan_p_rawat_jalan', compact('data_ruangans', 'data_periodes'));
    }

    // tampilan untuk data tindakan pasien
    public function create_data_gizi_pasien(Request $request)
    {
        $create_gizi_pasien = new ProsesPerhitungan();
        $create_gizi_pasiens = $create_gizi_pasien->CreateGiziPasien($request);
        if($create_gizi_pasiens == 'success')
        {
            return back()->with('alert-success','Data gizi pasien berhasil diperbarui!');
        }
        else
        {
            return back()->with('alert-failed', 'Data gizi pasien tidak berhasil diperbarui. Silahkan hubungi admin sistem!');
        }
    }

    public function create_data_adm_pasien(Request $request)
    {
        $create_adm_pasien = new ProsesPerhitungan();
        $create_adm_pasiens = $create_adm_pasien->CreateAdmPasien($request);
        if($create_adm_pasiens == 'success')
        {
            return back()->with('alert-success','Data ADM pasien berhasil diperbarui!');
        }
        else
        {
            return back()->with('alert-failed', 'Data ADM pasien tidak berhasil diperbarui. Silahkan hubungi admin sistem!');
        }
    }

    public function create_data_visite_pasien(Request $request)
    {
        $create_adm_pasien = new ProsesPerhitungan();
        $create_adm_pasiens = $create_adm_pasien->CreateVisitePasien($request);
        if($create_adm_pasiens == 'success')
        {
            return back()->with('alert-success','Data visite pasien berhasil ditambah!');
        }
        else
        {
            return back()->with('alert-failed', 'Data visite pasien tidak berhasil ditambah. Silahkan hubungi admin sistem!');
        }
    }

    public function update_data_visite_pasien(Request $request, $id)
    {
        $update_adm_pasien = new ProsesPerhitungan();
        $update_adm_pasiens = $update_adm_pasien->UpdateVisitePasien($request, $id);
        if($update_adm_pasiens == 'success')
        {
            return back()->with('alert-success','Data visite pasien berhasil diperbarui!');
        }
        else
        {
            return back()->with('alert-failed', 'Data visite pasien tidak berhasil diperbarui. Silahkan hubungi admin sistem!');
        }
    }

    public function delete_data_visite_pasien($id)
    {
        $delete_adm_pasien = new ProsesPerhitungan();
        $delete_adm_pasiens = $delete_adm_pasien->DeleteVisitePasien($id);
        if($delete_adm_pasiens == 'success')
        {
            return back()->with('alert-success','Data visite pasien berhasil dihapus!');
        }
        else
        {
            return back()->with('alert-failed', 'Data visite pasien tidak berhasil dihapus. Silahkan hubungi admin sistem!');
        }
    }

    public function cek_proses_perhitungan_rawat_inap($id_periode, $id_ruangan) {
        try {
            $data_pasien = new DataPasien();
            $data_pasiens = $data_pasien->SelectDataPasienRawatInap($id_periode, $id_ruangan);

            foreach($data_pasiens as $row) {
                $cek_data_proses_perhitungan = DB::table('proses_perhitungan')
                ->where('id_transaksi', '=', $row->id_transaksi)
                ->where('id_ruangan', '=', $id_ruangan)
                ->get();
                if (isset($cek_data_proses_perhitungan)) {

                    $proses1 = DB::delete('delete from proses_perhitungan where id_ruangan = '.$id_ruangan.' and id_transaksi = '.$row->id_transaksi.' and ket_kategori not in ("gizi", "adm", "visite") ');

                    $proses2 = DB::delete('delete from proses_perhitungan where id_ruangan = '.$id_ruangan.' and id_transaksi = '.$row->id_transaksi.' and proses not in ("ke 1") ');
                }
                else
                {
                }
        } 

        $hasil = $this->proses_perhitungan_rawat_inap($id_periode, $id_ruangan); 

        if ($hasil == "sukses") {

            return redirect('show_proses_perhitungan_rawat_inap/'.$id_periode.'/'.$id_ruangan)->with('alert-success', 'Proses perhitungan telah berhasil!'); 
        }
        else
        {
            foreach($data_pasiens as $row) {
                $cek_data_proses_perhitungan = DB::table('proses_perhitungan')
                ->where('id_transaksi', '=', $row->id_transaksi)
                ->where('id_ruangan', '=', $id_ruangan)
                ->get();
                if (isset($cek_data_proses_perhitungan)) {

                    $proses1 = DB::delete('delete from proses_perhitungan where id_ruangan = '.$id_ruangan.' and id_transaksi = '.$row->id_transaksi.' and ket_kategori not in ("gizi", "adm", "visite") ');

                    $proses2 = DB::delete('delete from proses_perhitungan where id_ruangan = '.$id_ruangan.' and id_transaksi = '.$row->id_transaksi.' and proses not in ("ke 1") ');
                }
                else
                {

                }
            } 
            // dd('tidak');
            // return redirect('show_proses_perhitungan_rawat_inap/'.$id_periode.'/'.$id_ruangan)->with('alert-error', 'Proses perhitungan gagal, karena ada ketidak samaan antara perhitungan ke 3 dan ke 4 pada pasien " '.$data_pasien_rj[0]->nama_pasien.' "!');

            return back()->with('alert-failed', 'MAAF PROSES PERHITUNGAN TIDAK DAPAT DI PROSES. PERMASALAHAN BERADA PADA RUMUS YANG DIPAKAI TIDAK BENAR');
        }
        
            
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    public function cek_proses_perhitungan_rawat_jalan($id_periode, $id_ruangan) {
        try {
            $data_pasien = new DataPasien();
            $data_pasiens = $data_pasien->SelectDataPasienRawatJalan($id_periode, $id_ruangan);

            foreach($data_pasiens as $row) {
                $cek_data_proses_perhitungan = DB::table('proses_perhitungan')
                ->where('id_transaksi', '=', $row->id_transaksi)
                ->where('id_ruangan', '=', $id_ruangan)
                ->get();

                if (isset($cek_data_proses_perhitungan)) {

                    $proses1 = DB::delete('delete from proses_perhitungan where id_ruangan = '.$id_ruangan.' and id_transaksi = '.$row->id_transaksi);
                }
                else
                {
                }
            } 
        $hasil = $this->proses_perhitungan_rawat_jalan($id_periode, $id_ruangan);  


        if ($hasil == "sukses") {

            return redirect('show_proses_perhitungan_rawat_jalan/'.$id_periode.'/'.$id_ruangan)->with('alert-success', 'Proses perhitungan telah berhasil!');
        }
        else
        {
            foreach($data_pasiens as $row) {
                 $cek_data_proses_perhitungan = DB::table('proses_perhitungan')
                ->where('id_transaksi', '=', $row->id_transaksi)
                ->where('id_ruangan', '=', $id_ruangan)
                ->get();

                if (isset($cek_data_proses_perhitungan)) {

                    $proses1 = DB::delete('delete from proses_perhitungan where id_ruangan = '.$id_ruangan.' and id_transaksi = '.$row->id_transaksi);
                }
                else
                {
                }
            } 
            // dd('tidak');
            // return redirect('show_proses_perhitungan_rawat_inap/'.$id_periode.'/'.$id_ruangan)->with('alert-error', 'Proses perhitungan gagal, karena ada ketidak samaan antara perhitungan ke 3 dan ke 4 pada pasien " '.$data_pasien_rj[0]->nama_pasien.' "!');

            return back()->with('alert-failed', 'MAAF PROSES PERHITUNGAN TIDAK DAPAT DI PROSES. PERMASALAHAN BERADA PADA RUMUS YANG DIPAKAI TIDAK BENAR');
        }

        
        if ($hasil = "sukses") {
            
        }
        
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function proses_perhitungan_rawat_inap($id_periode, $id_ruangan) {
        try {
            $data_kategori_tindakan = new KategoriTindakan();
            $data_kategori_tindakans = $data_kategori_tindakan->SelectKategoriTindakan();

            $data_dokter = new Dokter();
            $data_dokters = $data_dokter->SelectDokter();

            $data_pasien = new DataPasien();
            $data_pasiens = $data_pasien->SelectDataPasienRawatInap($id_periode, $id_ruangan);

            $hasil = [];

            $proses_perhitungan = new ProsesPerhitungan;

            $flags=0;

            foreach($data_pasiens as $row) {

                $biaya_adm = $proses_perhitungan->ShowAdmPasien($row->id_transaksi);
                if($biaya_adm == null) {
                    $hasil[$row->id_transaksi]['Ke 1']['adm']['adm'] = 0;
                } else {
                    $hasil[$row->id_transaksi]['Ke 1']['adm']['adm'] = $biaya_adm->jumlah_jp;
                }
                $hasil[$row->id_transaksi]['Ke 1']['total'] = $hasil[$row->id_transaksi]['Ke 1']['adm']['adm'];

                $data_tindakan_pasien = new DataTindakanPasien();
                $data_tindakan_pasiens = $data_tindakan_pasien->SelectDataTindakanPasien($row->id_transaksi);
                //dd($data_tindakan_pasiens);
                foreach ($data_tindakan_pasiens as $row_dtp) {
                    if($row_dtp->deskripsi_tindakan == "Administrasi Pasien IGD") {
                        $dokter = DB::table('dokter')->where('nama_dokter', '=', $row_dtp->nama_dokter_perawat)->first();

                        $biaya_dokter = 40000;

                        $hasil[$row->id_transaksi]['Ke 1']['dokter'][$dokter->id_dokter] = $biaya_dokter;
                        $hasil[$row->id_transaksi]['Ke 1']['total'] += $hasil[$row->id_transaksi]['Ke 1']['dokter'][$dokter->id_dokter];
                    } else {
                        $karyawan_perawats = DB::table('karyawan_perawat')
                            ->join('ruangan', 'karyawan_perawat.id_ruangan', '=', 'ruangan.id_ruangan')
                            ->where('karyawan_perawat.nama', '=', $row_dtp->nama_dokter_perawat)
                            ->first();
                        //dd($row_dtp->id_kategori_tindakan);
                        if($karyawan_perawats == null) {
                            // kategori tindakan lainnya
                            // $hasil[$row->id_transaksi]['Ke 1']['detail_kategori_tindakan'][$row_dtp->id_kategori_tindakan] = $row_dtp->jp;

                            if(!isset($hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan])) {
                                if($row_dtp->id_kategori_tindakan != "" || $row_dtp->id_kategori_tindakan != null)
                                {
                                    $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan] = $row_dtp->jp;
                                    $hasil[$row->id_transaksi]['Ke 1']['total'] += $row_dtp->jp;
                                }else{}
                                
                            } else {
                                if($row_dtp->id_kategori_tindakan != "" || $row_dtp->id_kategori_tindakan != null)
                                {
                                    $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan] += $row_dtp->jp;
                                    $hasil[$row->id_transaksi]['Ke 1']['total'] += $row_dtp->jp;
                                }else{}
                                
                            }   
                        } else {
                            $index = 'perawat_' . $karyawan_perawats->nama_ruangan;
                            if(!isset($hasil[$row->id_transaksi]['Ke 1'][$index])) {
                                $hasil[$row->id_transaksi]['Ke 1'][$index] = $row_dtp->jp;
                                $hasil[$row->id_transaksi]['Ke 1']['total'] += $row_dtp->jp;
                            } else {
                                $hasil[$row->id_transaksi]['Ke 1'][$index] += $row_dtp->jp;
                                $hasil[$row->id_transaksi]['Ke 1']['total'] += $row_dtp->jp;
                            }
                        }
                    }
                }
                $coba=[];
                $kategori_buangan = DB::table('kategori_tindakan')->get();
                $jj=0;
                foreach ($kategori_buangan as $valuess) {
                    if (!isset($hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$valuess->id_kategori_tindakan]) && $valuess->nama != "GIZI") {
                         $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$valuess->id_kategori_tindakan] = 0;
                    }
                }
                
                //dd($hasil);
                $ruangans = DB::table('ruangan')
                    ->where('kategori_ruangan', '=', 'Rawat Inap' )
                    ->orwhere('kategori_ruangan', '=', 'IGD' )
                    ->get();

                foreach($ruangans as $ruangan) {
                    $index = 'perawat_' . $ruangan->nama_ruangan;
                    if(!isset($hasil[$row->id_transaksi]['Ke 1'][$index])) {
                        $hasil[$row->id_transaksi]['Ke 1'][$index] = 0;
                    }
                }

                $biaya_gizi = $proses_perhitungan->ShowGiziPasien($row->id_transaksi);
                if($biaya_gizi == null) {
                    $hasil[$row->id_transaksi]['Ke 1']['gizi']['gizi'] = 0;
                } else {
                    $hasil[$row->id_transaksi]['Ke 1']['gizi']['gizi'] = $biaya_gizi->jumlah_jp;
                }
                $hasil[$row->id_transaksi]['Ke 1']['total'] += $hasil[$row->id_transaksi]['Ke 1']['gizi']['gizi'];

                $data_visite_pasien = DB::table('proses_perhitungan')
                ->join('dokter', 'dokter.id_dokter', '=', 'proses_perhitungan.id_dokter')
                ->where('id_transaksi', '=', $row->id_transaksi)
                ->where('ket_kategori', '=', 'VISITE')
                ->where('proses', '=', 'Ke 1')
                ->get();

                foreach($data_visite_pasien as $row_visite) {
                    $hasil[$row->id_transaksi]['Ke 1']['visite'][$row_visite->id_dokter] = $row_visite->jumlah_jp;
                    $hasil[$row->id_transaksi]['Ke 1']['total'] += $hasil[$row->id_transaksi]['Ke 1']['visite'][$row_visite->id_dokter];
                }
                




                // PENYIMPANAN DATA
                // proses ke 1
                $tmp_total_ke_1 = 0;
                // $proses_perhitungan = new ProsesPerhitungan();
                // $proses_perhitungan->ket_kategori = 'ADM';
                // $proses_perhitungan->proses = 'Ke 1';
                // $proses_perhitungan->jumlah_jp = $hasil[$row->id_transaksi]['Ke 1']['adm']['adm'];
                // $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                // $proses_perhitungan->id_transaksi = $row->id_transaksi;
                // $proses_perhitungan->id_ruangan = $id_ruangan;
                // $proses_perhitungan->created_at = now();
                // $proses_perhitungan->updated_at = now();
                // $proses_perhitungan->save();

                // $proses_perhitungan = new ProsesPerhitungan();
                // $proses_perhitungan->ket_kategori = 'GIZI';
                // $proses_perhitungan->proses = 'Ke 1';
                // $proses_perhitungan->jumlah_jp = $hasil[$row->id_transaksi]['Ke 1']['gizi']['gizi'];
                // $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                // $proses_perhitungan->id_transaksi = $row->id_transaksi;
                // $proses_perhitungan->id_ruangan = $id_ruangan;
                // $proses_perhitungan->created_at = now();
                // $proses_perhitungan->updated_at = now();
                // $proses_perhitungan->save();

                foreach($ruangans as $ruangan) {
                    $index = 'perawat_' . $ruangan->nama_ruangan;

                    $proses_perhitungan = new ProsesPerhitungan();
                    $proses_perhitungan->ket_kategori = 'PERAWAT ' . $ruangan->nama_ruangan;
                    $proses_perhitungan->proses = 'Ke 1';
                    $proses_perhitungan->jumlah_jp = $hasil[$row->id_transaksi]['Ke 1'][$index];
                    $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                    $proses_perhitungan->id_transaksi = $row->id_transaksi;
                    $proses_perhitungan->id_ruangan = $id_ruangan;
                    $proses_perhitungan->created_at = now();
                    $proses_perhitungan->updated_at = now();
                    $proses_perhitungan->save();
                }

                if(isset($hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'])) {
                    foreach($hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                        if(ucfirst($hasil_1) != null && ucfirst($hasil_1) != "")
                        {
                            $k_tindakan = DB::table('kategori_tindakan')->where('id_kategori_tindakan', ucfirst($hasil_1))->first();

                            if($k_tindakan->tahapan_proses == "Semua" || $k_tindakan->tahapan_proses == "Proses 3") {
                                $proses_perhitungan = new ProsesPerhitungan();
                                $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                                $proses_perhitungan->proses = 'Ke 1';
                                $proses_perhitungan->jumlah_jp = $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                                $proses_perhitungan->id_transaksi = $row->id_transaksi;
                                $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                                $proses_perhitungan->id_ruangan = $id_ruangan;
                                $proses_perhitungan->created_at = now();
                                $proses_perhitungan->updated_at = now();
                                $proses_perhitungan->save();
                            }

                        } else {
                            $proses_perhitungan = new ProsesPerhitungan();
                            $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                            $proses_perhitungan->proses = 'Ke 1';
                            $proses_perhitungan->jumlah_jp = $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                            $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                            $proses_perhitungan->id_transaksi = $row->id_transaksi;
                            $proses_perhitungan->id_ruangan = $id_ruangan;
                            $proses_perhitungan->created_at = now();
                            $proses_perhitungan->updated_at = now();
                            $proses_perhitungan->save();
                        }
                    }
                }
                
                if(isset($hasil[$row->id_transaksi]['Ke 1']['dokter'])) {
                    foreach($hasil[$row->id_transaksi]['Ke 1']['dokter'] as $hasil_1 => $val) {
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'DOKTER';
                        $proses_perhitungan->proses = 'Ke 1';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_transaksi]['Ke 1']['dokter'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_transaksi = $row->id_transaksi;
                        $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }
                
                // if(isset($hasil[$row->id_transaksi]['Ke 1']['visite'])) {
                //     foreach($hasil[$row->id_transaksi]['Ke 1']['visite'] as $hasil_1 => $val) {
                //         $proses_perhitungan = new ProsesPerhitungan();
                //         $proses_perhitungan->ket_kategori = 'VISITE';
                //         $proses_perhitungan->proses = 'Ke 1';
                //         $proses_perhitungan->jumlah_jp = $hasil[$row->id_transaksi]['Ke 1']['visite'][ucfirst($hasil_1)];
                //         $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                //         $proses_perhitungan->id_transaksi = $row->id_transaksi;
                //         $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                //         $proses_perhitungan->id_ruangan = $id_ruangan;
                //         $proses_perhitungan->created_at = now();
                //         $proses_perhitungan->updated_at = now();
                //         $proses_perhitungan->save();
                //     }
                // }

                // proses ke 2
                $tmp_total_ke_2 = 0;
                if($hasil[$row->id_transaksi]['Ke 1']['adm']['adm'] == 0 || $hasil[$row->id_transaksi]['Ke 1']['total'] == 0 )
                {
                    $hasil[$row->id_transaksi]['Ke 2']['adm']['adm'] = 0;
                $tmp_total_ke_2 += 0;
                }
                else
                {
                    $hasil[$row->id_transaksi]['Ke 2']['adm']['adm'] = $hasil[$row->id_transaksi]['Ke 1']['adm']['adm'] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                    $tmp_total_ke_2 += $hasil[$row->id_transaksi]['Ke 1']['adm']['adm'] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                }
                
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'ADM';
                $proses_perhitungan->proses = 'Ke 2';
                $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 2']['adm']['adm'],6);
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_transaksi = $row->id_transaksi;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                if($hasil[$row->id_transaksi]['Ke 1']['gizi']['gizi'] == 0 || $hasil[$row->id_transaksi]['Ke 1']['total'] == 0 )
                {
                    $hasil[$row->id_transaksi]['Ke 2']['gizi']['gizi'] = 0;
                    $tmp_total_ke_2 += 0;
                }
                else
                {
                    $hasil[$row->id_transaksi]['Ke 2']['gizi']['gizi'] = $hasil[$row->id_transaksi]['Ke 1']['gizi']['gizi'] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                    $tmp_total_ke_2 += $hasil[$row->id_transaksi]['Ke 1']['gizi']['gizi'] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                }
                
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'GIZI';
                $proses_perhitungan->proses = 'Ke 2';
                $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 2']['gizi']['gizi'],6);
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_transaksi = $row->id_transaksi;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                foreach($ruangans as $ruangan) {
                    $index = 'perawat_' . $ruangan->nama_ruangan;

                    if($hasil[$row->id_transaksi]['Ke 1'][$index] == 0 || $hasil[$row->id_transaksi]['Ke 1']['total'] == 0 )
                    {
                        $hasil[$row->id_transaksi]['Ke 2'][$index] = 0;
                        $tmp_total_ke_2 += 0;
                    }
                    else
                    {
                        $hasil[$row->id_transaksi]['Ke 2'][$index] = $hasil[$row->id_transaksi]['Ke 1'][$index] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                        $tmp_total_ke_2 += $hasil[$row->id_transaksi]['Ke 1'][$index] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                    }

                    $proses_perhitungan = new ProsesPerhitungan();
                    $proses_perhitungan->ket_kategori = 'PERAWAT ' . $ruangan->nama_ruangan;
                    $proses_perhitungan->proses = 'Ke 2';
                    $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 2'][$index],6);
                    $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                    $proses_perhitungan->id_transaksi = $row->id_transaksi;
                    $proses_perhitungan->id_ruangan = $id_ruangan;
                    $proses_perhitungan->created_at = now();
                    $proses_perhitungan->updated_at = now();
                    $proses_perhitungan->save();
                }

                // foreach($hasil[$row->id_transaksi]['Ke 1']['detail_kategori_tindakan'] as $hasil_1 => $val) {
                //     $hasil[$row->id_transaksi]['Ke 2']['detail_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 1']['detail_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                //     $tmp_total_ke_2 += $hasil[$row->id_transaksi]['Ke 1']['detail_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                // }

                if(isset($hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'])) {
                    foreach($hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                        if(ucfirst($hasil_1) != null && ucfirst($hasil_1) != "")
                        {
                            $k_tindakan = DB::table('kategori_tindakan')->where('id_kategori_tindakan', ucfirst($hasil_1))->first();
                            if($k_tindakan->tahapan_proses == "Semua" || $k_tindakan->tahapan_proses == "Proses 3") {
                                $hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                                $tmp_total_ke_2 += $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                                $proses_perhitungan = new ProsesPerhitungan();
                                $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                                $proses_perhitungan->proses = 'Ke 2';
                                $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)],6);
                                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                                $proses_perhitungan->id_transaksi = $row->id_transaksi;
                                $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                                $proses_perhitungan->id_ruangan = $id_ruangan;
                                $proses_perhitungan->created_at = now();
                                $proses_perhitungan->updated_at = now();
                                $proses_perhitungan->save();
                            }
                        } else {
                            $hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                            $tmp_total_ke_2 += $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                            $proses_perhitungan = new ProsesPerhitungan();
                            $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                            $proses_perhitungan->proses = 'Ke 2';
                            $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)],6);
                            $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                            $proses_perhitungan->id_transaksi = $row->id_transaksi;
                            $proses_perhitungan->id_ruangan = $id_ruangan;
                            $proses_perhitungan->created_at = now();
                            $proses_perhitungan->updated_at = now();
                            $proses_perhitungan->save();
                        }
                        
                    }
                }
 
                if(isset($hasil[$row->id_transaksi]['Ke 1']['dokter'])) {
                    foreach($hasil[$row->id_transaksi]['Ke 1']['dokter'] as $hasil_1 => $val) {
                        $hasil[$row->id_transaksi]['Ke 2']['dokter'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 1']['dokter'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                        $tmp_total_ke_2 += $hasil[$row->id_transaksi]['Ke 1']['dokter'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'DOKTER';
                        $proses_perhitungan->proses = 'Ke 2';
                        $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 2']['dokter'][ucfirst($hasil_1)],6);
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_transaksi = $row->id_transaksi;
                        $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }

                if(isset($hasil[$row->id_transaksi]['Ke 1']['visite'])) {
                    foreach($hasil[$row->id_transaksi]['Ke 1']['visite'] as $hasil_1 => $val) {
                        $hasil[$row->id_transaksi]['Ke 2']['visite'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 1']['visite'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                        $tmp_total_ke_2 += $hasil[$row->id_transaksi]['Ke 1']['visite'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                        $proses_perhitungan = new ProsesPerhitungan();
                        // $proses_perhitungan->ket_kategori = 'visite';
                        $proses_perhitungan->ket_kategori = 'VISITE';
                        $proses_perhitungan->proses = 'Ke 2';
                        $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 2']['visite'][ucfirst($hasil_1)],6);
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_transaksi = $row->id_transaksi;
                        $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }
                
                $hasil[$row->id_transaksi]['Ke 2']['total'] = $tmp_total_ke_2;
                // proses ke 3
                $data_value_keuangan = DB::table('data_keuangan_pasien')
                ->where('no_sep_keuangan_pasien', '=', $row->no_sep)
                ->first();
                $tmp_total_ke_3 = 0;
                //$hasil[$row->id_transaksi]['Ke 3']['total_nominal']=$data_value_keuangan->nominal_uang;
                //dd($hasil[$row->id_transaksi]['Ke 3']['nominal_keuangan']);
                $hasil[$row->id_transaksi]['Ke 3']['adm']['adm'] = $hasil[$row->id_transaksi]['Ke 2']['adm']['adm'] * $data_value_keuangan->nominal_uang;
                $tmp_total_ke_3 += $hasil[$row->id_transaksi]['Ke 2']['adm']['adm'] * $data_value_keuangan->nominal_uang;
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'ADM';
                $proses_perhitungan->proses = 'Ke 3';
                $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 3']['adm']['adm']);
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_transaksi = $row->id_transaksi;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $hasil[$row->id_transaksi]['Ke 3']['gizi']['gizi'] = $hasil[$row->id_transaksi]['Ke 2']['gizi']['gizi'] * $data_value_keuangan->nominal_uang;
                $tmp_total_ke_3 += $hasil[$row->id_transaksi]['Ke 2']['gizi']['gizi'] * $data_value_keuangan->nominal_uang;
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'GIZI';
                $proses_perhitungan->proses = 'Ke 3';
                $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 3']['gizi']['gizi']);
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_transaksi = $row->id_transaksi;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                foreach($ruangans as $ruangan) {
                    $index = 'perawat_' . $ruangan->nama_ruangan;

                    $hasil[$row->id_transaksi]['Ke 3'][$index] = $hasil[$row->id_transaksi]['Ke 2'][$index] * $data_value_keuangan->nominal_uang;
                    $tmp_total_ke_3 += $hasil[$row->id_transaksi]['Ke 2'][$index] * $data_value_keuangan->nominal_uang;

                    $proses_perhitungan = new ProsesPerhitungan();
                    $proses_perhitungan->ket_kategori = 'PERAWAT ' . $ruangan->nama_ruangan;
                    $proses_perhitungan->proses = 'Ke 3';
                    $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 3'][$index]);
                    $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                    $proses_perhitungan->id_transaksi = $row->id_transaksi;
                    $proses_perhitungan->id_ruangan = $id_ruangan;
                    $proses_perhitungan->created_at = now();
                    $proses_perhitungan->updated_at = now();
                    $proses_perhitungan->save();
                }

                // foreach($hasil[$row->id_transaksi]['Ke 2']['detail_kategori_tindakan'] as $hasil_1 => $val) {
                //     $hasil[$row->id_transaksi]['Ke 3']['detail_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 2']['detail_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                //     $tmp_total_ke_3 += $hasil[$row->id_transaksi]['Ke 2']['detail_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                // }

                if(isset($hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'])) {
                    foreach($hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                        if(ucfirst($hasil_1) != null && ucfirst($hasil_1) != "")
                        {
                            $k_tindakan = DB::table('kategori_tindakan')->where('id_kategori_tindakan', ucfirst($hasil_1))->first();
                            if($k_tindakan->tahapan_proses == "Semua" || $k_tindakan->tahapan_proses == "Proses 3") {
                                $hasil[$row->id_transaksi]['Ke 3']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                                $tmp_total_ke_3 += $hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                                $proses_perhitungan = new ProsesPerhitungan();
                                $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                                $proses_perhitungan->proses = 'Ke 3';
                                $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 3']['hasil_kategori_tindakan'][ucfirst($hasil_1)]);
                                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                                $proses_perhitungan->id_transaksi = $row->id_transaksi;
                                $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                                $proses_perhitungan->id_ruangan = $id_ruangan;
                                $proses_perhitungan->created_at = now();
                                $proses_perhitungan->updated_at = now();
                                $proses_perhitungan->save();
                            }
                        } else {
                            $hasil[$row->id_transaksi]['Ke 3']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                            $tmp_total_ke_3 += $hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                            $proses_perhitungan = new ProsesPerhitungan();
                            $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                            $proses_perhitungan->proses = 'Ke 3';
                            $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 3']['hasil_kategori_tindakan'][ucfirst($hasil_1)]);
                            $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                            $proses_perhitungan->id_transaksi = $row->id_transaksi;
                            $proses_perhitungan->id_ruangan = $id_ruangan;
                            $proses_perhitungan->created_at = now();
                            $proses_perhitungan->updated_at = now();
                            $proses_perhitungan->save();
                        }
                        
                    }
                }
                
                if(isset($hasil[$row->id_transaksi]['Ke 2']['dokter'])) {
                    foreach($hasil[$row->id_transaksi]['Ke 2']['dokter'] as $hasil_1 => $val) {
                        $hasil[$row->id_transaksi]['Ke 3']['dokter'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 2']['dokter'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                        $tmp_total_ke_3 += $hasil[$row->id_transaksi]['Ke 2']['dokter'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'DOKTER';
                        $proses_perhitungan->proses = 'Ke 3';
                        $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 3']['dokter'][ucfirst($hasil_1)]);
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_transaksi = $row->id_transaksi;
                        $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }

                if(isset($hasil[$row->id_transaksi]['Ke 1']['visite'])) {
                    foreach($hasil[$row->id_transaksi]['Ke 2']['visite'] as $hasil_1 => $val) {
                        $hasil[$row->id_transaksi]['Ke 3']['visite'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 2']['visite'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                        $tmp_total_ke_3 += $hasil[$row->id_transaksi]['Ke 2']['visite'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                    }
                    $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'VISITE';
                        $proses_perhitungan->proses = 'Ke 3';
                        $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 3']['visite'][ucfirst($hasil_1)]);
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_transaksi = $row->id_transaksi;
                        $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                }
                $hasil[$row->id_transaksi]['Ke 3']['total'] = $tmp_total_ke_3;

                // list variable rumus 
                $list_variable['ADM'][] = "adm|adm";
                $list_variable['GIZI'][] = "gizi|gizi";

                $ruangans = DB::table('ruangan')
                    ->where('kategori_ruangan', '=', 'Rawat Inap' )
                    ->orwhere('kategori_ruangan', '=', 'IGD' )
                    ->get();

                foreach($ruangans as $ruangan) {
                    $list_variable['PERAWAT ' . strtoupper($ruangan->nama_ruangan)][] = "perawat_" . $ruangan->nama_ruangan;
                }
                
                
                // foreach($hasil[$row->id_transaksi]['Ke 3']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                //     $data_kategori_tindakan = new KategoriTindakan();
                //     $data_kategori_tindakans = $data_kategori_tindakan->ShowKategoriTindakan(ucfirst($hasil_1));

                //     if($data_kategori_tindakans != null) {
                //         $list_variable[$data_kategori_tindakans->nama][] = "hasil_kategori_tindakan|" . $data_kategori_tindakans->nama;
                //     }
                // }

                $kat_semua = DB::table('kategori_tindakan')
                    ->whereNotIn('nama',  ['GIZI'])
                    ->where('tahapan_proses', '=', 'Semua')
                    ->orwhere('tahapan_proses', '=', 'Proses 4')
                    ->get();

                // $kat_semua = DB::table('select * FROM kategori_tindakan where tahapan_proses in ("Semua","Proses 4") and nama not in ("gizi") ')->get();
                //dd($kat_semua);
                foreach($kat_semua as $hasil_1) {
                    $data_kategori_tindakan = new KategoriTindakan();
                    $data_kategori_tindakans = $data_kategori_tindakan->ShowKategoriTindakan($hasil_1->id_kategori_tindakan);

                    if($data_kategori_tindakans != null) {
                        $list_variable[$data_kategori_tindakans->nama][] = "hasil_kategori_tindakan|" . $data_kategori_tindakans->nama;
                    }
                }
                //dd($list_variable);
                if(isset($hasil[$row->id_transaksi]['Ke 3']['dokter'])) {
                    foreach($hasil[$row->id_transaksi]['Ke 3']['dokter'] as $hasil_1 => $val) {
                        $list_variable["DOKTER IGD"][] = "dokter|" . $hasil_1;
                    }
                } else {
                    $list_variable["DOKTER IGD"][] = "dokter|0";
                }
                
                if(isset($hasil[$row->id_transaksi]['Ke 3']['visite'])) {
                    foreach($hasil[$row->id_transaksi]['Ke 3']['visite'] as $hasil_1 => $val) {
                        $list_variable["DOKTER VISITE"][] = "visite|" . $hasil_1;
                    }
                } else {
                    $list_variable["DOKTER VISITE"][] = "visite|0";
                }
                //dd($list_variable);

                // proses ke 4
                $tmp_total_ke_4 = 0;

                $hasil[$row->id_transaksi]['Ke 4']['adm']['adm'] = $this->hitung_rumus($hasil[$row->id_transaksi]['Ke 3'], $list_variable, "ADM");
                $tmp_total_ke_4 += $hasil[$row->id_transaksi]['Ke 4']['adm']['adm'];
                
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'ADM';
                $proses_perhitungan->proses = 'Ke 4';
                $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 4']['adm']['adm']);
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_transaksi = $row->id_transaksi;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $data_kategori_gizi = DB::table('kategori_tindakan')
                ->where('nama', '=', 'GIZI')
                ->first();

                $hasil[$row->id_transaksi]['Ke 4']['gizi']['gizi'] = $this->hitung_rumus($hasil[$row->id_transaksi]['Ke 3'], $list_variable, "GIZI");
                $tmp_total_ke_4 += $hasil[$row->id_transaksi]['Ke 4']['gizi']['gizi'];
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'GIZI';
                $proses_perhitungan->proses = 'Ke 4';
                $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 4']['gizi']['gizi']);
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_kategori_tindakan = $data_kategori_gizi->id_kategori_tindakan;
                $proses_perhitungan->id_transaksi = $row->id_transaksi;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                foreach($ruangans as $ruangan) {
                    $index = 'perawat_' . $ruangan->nama_ruangan;
                    $index2 = 'PERAWAT '.$ruangan->nama_ruangan;

                    $hasil[$row->id_transaksi]['Ke 4'][$index] = $this->hitung_rumus($hasil[$row->id_transaksi]['Ke 3'], $list_variable, $index2);
                    $tmp_total_ke_4 += $hasil[$row->id_transaksi]['Ke 4'][$index];

                    $proses_perhitungan = new ProsesPerhitungan();
                    $proses_perhitungan->ket_kategori = 'PERAWAT ' . $ruangan->nama_ruangan;
                    $proses_perhitungan->proses = 'Ke 4';
                    $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 4'][$index]);
                    $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                    $proses_perhitungan->id_transaksi = $row->id_transaksi;
                    $proses_perhitungan->id_ruangan = $id_ruangan;
                    $proses_perhitungan->created_at = now();
                    $proses_perhitungan->updated_at = now();
                    $proses_perhitungan->save();
                }

                // foreach($hasil[$row->id_transaksi]['Ke 3']['detail_kategori_tindakan'] as $hasil_1 => $val) {
                //     $data_kategori_tindakan = new KategoriTindakan();
                //     $data_kategori_tindakans = $data_kategori_tindakan->ShowKategoriTindakan(ucfirst($hasil_1));

                //     $hasil[$row->id_transaksi]['Ke 4']['detail_kategori_tindakan'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_transaksi]['Ke 3'], $list_variable, $data_kategori_tindakans->nama);
                //     $tmp_total_ke_4 += $hasil[$row->id_transaksi]['Ke 4']['detail_kategori_tindakan'][ucfirst($hasil_1)];
                // }

                foreach($kat_semua as $hasil_1) {
                    $data_kategori_tindakan = new KategoriTindakan();
                    $data_kategori_tindakans = $data_kategori_tindakan->ShowKategoriTindakan($hasil_1->id_kategori_tindakan);
                   

                    if($data_kategori_tindakans != null) {
                        if($data_kategori_tindakans->tahapan_proses != "Proses 3") {
                            $hasil[$row->id_transaksi]['Ke 4']['hasil_kategori_tindakan'][$hasil_1->id_kategori_tindakan] = $this->hitung_rumus($hasil[$row->id_transaksi]['Ke 3'], $list_variable, $data_kategori_tindakans->nama);
                            $tmp_total_ke_4 += $hasil[$row->id_transaksi]['Ke 4']['hasil_kategori_tindakan'][$hasil_1->id_kategori_tindakan];
                            $proses_perhitungan = new ProsesPerhitungan();
                            $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                            $proses_perhitungan->proses = 'Ke 4';
                            $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 4']['hasil_kategori_tindakan'][$hasil_1->id_kategori_tindakan]);
                            $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                            $proses_perhitungan->id_transaksi = $row->id_transaksi;
                            $proses_perhitungan->id_kategori_tindakan = $hasil_1->id_kategori_tindakan;
                            $proses_perhitungan->id_ruangan = $id_ruangan;
                            $proses_perhitungan->created_at = now();
                            $proses_perhitungan->updated_at = now();
                            $proses_perhitungan->save();
                            
                        }
                        else{
                        }
                    }
                }
                
                if(isset($hasil[$row->id_transaksi]['Ke 3']['dokter'])) {
                    foreach($hasil[$row->id_transaksi]['Ke 3']['dokter'] as $hasil_1 => $val) {
                        $hasil[$row->id_transaksi]['Ke 4']['dokter'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_transaksi]['Ke 3'], $list_variable, "DOKTER IGD");
                        $tmp_total_ke_4 += $hasil[$row->id_transaksi]['Ke 4']['dokter'][ucfirst($hasil_1)];
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'DOKTER';
                        $proses_perhitungan->proses = 'Ke 4';
                        $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 4']['dokter'][ucfirst($hasil_1)]);
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_transaksi = $row->id_transaksi;
                        $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }

                if(isset($hasil[$row->id_transaksi]['Ke 2']['visite'])) {
                    foreach($hasil[$row->id_transaksi]['Ke 3']['visite'] as $hasil_1 => $val) {
                        $hasil[$row->id_transaksi]['Ke 4']['visite'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_transaksi]['Ke 3'], $list_variable, "DOKTER VISITE");
                        $tmp_total_ke_4 += $hasil[$row->id_transaksi]['Ke 4']['visite'][ucfirst($hasil_1)];
                    }
                    $proses_perhitungan = new ProsesPerhitungan();
                    $proses_perhitungan->ket_kategori = 'VISITE';
                    $proses_perhitungan->proses = 'Ke 4';
                    $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 4']['visite'][ucfirst($hasil_1)]);
                    $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                    $proses_perhitungan->id_transaksi = $row->id_transaksi;
                    $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                    $proses_perhitungan->id_ruangan = $id_ruangan;
                    $proses_perhitungan->created_at = now();
                    $proses_perhitungan->updated_at = now();
                    $proses_perhitungan->save();
                }
                
                $hasil[$row->id_transaksi]['Ke 4']['total'] = $tmp_total_ke_4;
                // INI DIL PENGECEKANE -- Logikanya itu jadi nanti dia cek.. apakah pada transaksi seng ini proses ke 3 mbek 4.e sama ndak.. kalo ndak.. dia akan ngehapus semua.e kecuali ADM, GIZI sama VISITE selain proses ke 1, trus nanti dia akan ngasi alert error seoerti biasanya
                // if($hasil[$row->id_transaksi]['Ke 4']['total'] != $hasil[$row->id_transaksi]['Ke 3']['total']){
                //     $data_pasien_rj = DB::table('data_pasien')
                //     ->join('transaksi', 'transaksi.id_data_pasien', '=', 'data_pasien.id_data_pasien')
                //     ->where('transaksi.id_transaksi', '=', $row->id_transaksi)
                //     ->get();
                //     $delete_proses_part_1 = DB::select("DELETE FROM `proses_perhitungan` WHERE ket_kategori <> 'GIZI' AND ket_kategori <> 'ADM' AND ket_kategori <> 'VISITE'");
                //     $delete_proses_part_2 = DB::select("DELETE FROM `proses_perhitungan` WHERE proses <> 'Ke 1'");
                //     return redirect('show_proses_perhitungan_rawat_inap/'.$id_periode.'/'.$id_ruangan)->with('alert-error', 'Proses perhitungan gagal, karena ada ketidak samaan antara perhitungan ke 3 dan ke 4 pada pasien " '.$data_pasien_rj[0]->nama_pasien.' "!');
                // }
                // dd($hasil[$row->id_transaksi]['Ke 3']['total']);
                if(round($hasil[$row->id_transaksi]['Ke 4']['total']) != round($hasil[$row->id_transaksi]['Ke 3']['total']) ){
                    $flags = 1;
                }
                else{
                    $flags = 0;
                }

            }
            //dd($hasil);

            if($flags == 0)
            {
                return "sukses";
            }
            else
            {
                return "tidak sukses";
            }
            
            // return redirect('show_proses_perhitungan_rawat_inap/'.$id_periode.'/'.$id_ruangan)->with('alert-success', 'Proses perhitungan telah berhasil!');   
            //return "sukses";            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function hitung_rumus($hasil, $list_variable, $variable_kategori) {
        try {
            //cari terlebih dahulu rumusdaru variabel yang akan dilakukan proses perhitungna ke 4
        $rumus = DB::table('variable_rumus')->where("nama_variabel", "=", $variable_kategori)->first();
        //dd($rumus);
        if($rumus == null) {
            $hasil_perhitungan = 0;
        } else {

            //mengambil data rumus saya
            $rumus = $rumus->rumus;   
            //menghapus kurung kurng awal misal {{ LAB }} * 50% jadi LAB * 50%
            $rumus = str_replace("{{", "", $rumus);
            $rumus = str_replace("}}", "", $rumus);

            $hasil_perhitungan = 0;
            
            foreach($list_variable as $nama_variable => $value) {
                //dd($value);
                foreach($value as $val) {
                    if(strpos($rumus, $nama_variable) !== false) {
                        // ada
                        $index = explode("|", $val);
                        if(count($index) == 1) {
                            if(isset($hasil[$index[0]])) {
                                $rumus = str_replace(" " . $nama_variable . " ", $hasil[$index[0]], $rumus);
                            }
                        } else {
                            $kategori_tindakan = DB::table('kategori_tindakan')->where('nama', '=', $nama_variable)->first();
                            if($kategori_tindakan == null || $nama_variable == "GIZI") {
                                if(isset($hasil[$index[0]][$index[1]])) {
                                    $rumus = str_replace(" " . $nama_variable . " ", "(" . $hasil[$index[0]][$index[1]] . ")", $rumus);
                                }
                            } else {
                                if(isset($hasil[$index[0]][$kategori_tindakan->id_kategori_tindakan])) {
                                    $rumus = str_replace(" " . $nama_variable . " ", "(" . $hasil[$index[0]][$kategori_tindakan->id_kategori_tindakan] . ")", $rumus);
                                }
                            }
                        }
                    } else {
                        // tidak ada
                        if($nama_variable == "DOKTER IGD" || $nama_variable == "DOKTER VISITE" || $nama_variable == "DOKTER") {
                            $index = explode("|", $val);
                            if(isset($hasil[$index[0]][$index[1]])) {
                                $rumus = str_replace(" " . $nama_variable . " ", "(" . $hasil[$index[0]][$index[1]] . ")", $rumus);
                            }
                        }
                    }
                }
                //dd($nama_variable);
            }

            foreach($list_variable as $nama_variable => $value) {
                $rumus = str_replace(" " . $nama_variable . " ", "0", $rumus);
            }

            //dd($rumus);
            //ini proses penjumlahan
            $rumus = str_replace(" ", "", $rumus);
            $rumus = str_replace("*", " * ", $rumus);
            $rumus = str_replace("/", " / ", $rumus);
            $rumus = str_replace("+", " + ", $rumus);
            $rumus = str_replace("-", " - ", $rumus);
            $rumus = str_replace("%", " / 100", $rumus);

            //ini langsung memproses data yang ada di rumus
            $hasil_perhitungan = eval("return " . $rumus . ";");
            //dd($hasil_perhitungan);
        }

        return $hasil_perhitungan;
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }

    public function show_proses_perhitungan_rawat_inap($id_periode, $id_ruangan) {
        $data_kategori_tindakan = new KategoriTindakan();
        $data_kategori_tindakans = $data_kategori_tindakan->SelectKategoriTindakan();

        $data_dokter = new Dokter();
        $data_dokters = $data_dokter->SelectDokter();

        $hasi = new ProsesPerhitungan();
        $hasil = $hasi->ShowProsesPerhitunganRawatInap($id_periode, $id_ruangan); 

        $data_pasien = new DataPasien();
        $data_pasiens = $data_pasien->SelectDataPasienRawatInap($id_periode, $id_ruangan);

        $data_ruangan = new Ruangan();
        $data_ruangans = $data_ruangan->SelectRuangan();
        
        $id_periode = $id_periode;
        $id_ruangan = $id_ruangan;

        $cekproses = DB::table('proses_perhitungan')
        ->where('id_ruangan', '=', $id_ruangan)
        ->where('proses', '=', 'Ke 4')
        ->first();

        if($cekproses != null)
        {
            return view('proses_perhitungan.proses_perhitungan_rawat_inap', compact('hasil', 'data_pasiens', 'data_dokters', 'data_ruangans', 'data_kategori_tindakans', 'id_periode','id_ruangan'));  
        }
        else
        {
           return back()->with('alert-failed', 'Periode ini belum dilakukan proses perhitungan');
        }
    }

    public function show_detail_proses_perhitungan_rawat_inap($id_periode, $id_ruangan, $id_data_pasien) {
        $hasi = new ProsesPerhitungan();
        $hasil = $hasi->ShowDetailProsesPerhitunganRawatInap($id_periode, $id_ruangan, $id_data_pasien); 

        $data_pasien = new DataPasien();
        $data_pasiens = $data_pasien->ShowTindakanDataPasien($id_data_pasien);

        $data_ruangan = new Ruangan();
        $data_ruangans = $data_ruangan->SelectRuangan();
        
        $id_periode = $id_periode;
        $id_ruangan = $id_ruangan;

        return view('proses_perhitungan.show_proses_perhitungan_rawat_inap', compact('hasil', 'data_pasiens', 'data_ruangans', 'id_periode','id_ruangan'));
    }

    public function proses_perhitungan_rawat_jalan($id_periode, $id_ruangan) {
        $data_kategori_tindakan = new KategoriTindakan();
        $data_kategori_tindakans = $data_kategori_tindakan->SelectKategoriTindakan();

        $data_dokter = new Dokter();
        $data_dokters = $data_dokter->SelectDokter();

        // 
        $data_pasien = new DataPasien();
        $data_pasiens = $data_pasien->SelectDataPasienRawatJalan($id_periode, $id_ruangan);

        $hasil = [];
        $flags=0;
        $proses_perhitungan = new ProsesPerhitungan;

        foreach($data_pasiens as $row) {
            $biaya_adm = $proses_perhitungan->ShowAdmPasien($row->id_transaksi);
            if($biaya_adm == null) {
                $hasil[$row->id_transaksi]['Ke 1']['adm']['adm'] = 6000;
            } else {
                $hasil[$row->id_transaksi]['Ke 1']['adm']['adm'] = $biaya_adm->jumlah_jp;
            }
            $hasil[$row->id_transaksi]['Ke 1']['total'] = $hasil[$row->id_transaksi]['Ke 1']['adm']['adm'];

            $data_tindakan_pasien = new DataTindakanPasien();
            $data_tindakan_pasiens = $data_tindakan_pasien->SelectDataTindakanPasien($row->id_transaksi);

            $data_ruangan_pasien = DB::table('ruangan')
                ->where('id_ruangan', '=', $id_ruangan)
                ->first();
            $index = 'perawat_' . $data_ruangan_pasien->nama_ruangan;

            foreach ($data_tindakan_pasiens as $row_dtp) {
                $hasil[$row->id_transaksi]['Ke 1']['detail_tindakan'][$row_dtp->id_data_tindakan_pasien] = $row_dtp->jp;

                if($row_dtp->deskripsi_tindakan != "") {
                    if(strpos($row_dtp->deskripsi_tindakan, "Administrasi Pasien Rawat Jalan") !== false) {
                        $dokter = DB::table('dokter')->where('nama_dokter', '=', $row->nama_dokter_perawat)->first();

                        $biaya_dokter = 30000;

                        $hasil[$row->id_transaksi]['Ke 1']['dokter'][$dokter->id_dokter] = $biaya_dokter;
                        $hasil[$row->id_transaksi]['Ke 1']['total'] += $hasil[$row->id_transaksi]['Ke 1']['dokter'][$dokter->id_dokter];
                    } else {
                        if(strpos($row_dtp->deskripsi_tindakan, "Jasa") === false) {
                            $deskripsi_tindakan = new DeskripsiTindakan();
                            $deskripsi_tindakans = $deskripsi_tindakan->ShowDeskripsiTindakan($row_dtp->id_deskripsi_tindakan); 

                            if($deskripsi_tindakans != null) {
                                if($row_dtp->id_kategori_tindakan != null || $row_dtp->id_kategori_tindakan != "") {
                                    if(!isset($hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan])) {
                                        $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan] = $row_dtp->jp;
                                        $hasil[$row->id_transaksi]['Ke 1']['total'] += $row_dtp->jp;
                                    } else {
                                        $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan] += $row_dtp->jp;
                                        $hasil[$row->id_transaksi]['Ke 1']['total'] += $row_dtp->jp;
                                    }  
                                }
                                else
                                {
                                    if(!isset($hasil[$row->id_transaksi]['Ke 1'][$index])) {
                                    $hasil[$row->id_transaksi]['Ke 1'][$index] = $row_dtp->jp;
                                    $hasil[$row->id_transaksi]['Ke 1']['total'] += $row_dtp->jp;
                                    } else {
                                        $hasil[$row->id_transaksi]['Ke 1'][$index] += $row_dtp->jp;
                                        $hasil[$row->id_transaksi]['Ke 1']['total'] += $row_dtp->jp;
                                    }
                                }
                            } else {
                            }
                        } else {
                            $hasil[$row->id_transaksi]['Ke 1'][$index] = 0;
                            $hasil[$row->id_transaksi]['Ke 1']['total'] += 0;
                        }
                    }
                }
            }

            // proses ke 1
            $tmp_total_ke_1 = 0;
            $proses_perhitungan = new ProsesPerhitungan();
            $proses_perhitungan->ket_kategori = 'ADM';
            $proses_perhitungan->proses = 'Ke 1';
            $proses_perhitungan->jumlah_jp = $hasil[$row->id_transaksi]['Ke 1']['adm']['adm'];
            $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
            $proses_perhitungan->id_transaksi = $row->id_transaksi;
            $proses_perhitungan->id_ruangan = $id_ruangan;
            $proses_perhitungan->created_at = now();
            $proses_perhitungan->updated_at = now();
            $proses_perhitungan->save();

            // foreach($ruangans as $ruangan) {
            //         $index = 'perawat_' . $ruangan->nama_ruangan;

            //         $proses_perhitungan = new ProsesPerhitungan();
            //         $proses_perhitungan->ket_kategori = 'PERAWAT ' . $ruangan->nama_ruangan;
            //         $proses_perhitungan->proses = 'Ke 1';
            //         $proses_perhitungan->jumlah_jp = $hasil[$row->id_transaksi]['Ke 1'][$index];
            //         $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
            //         $proses_perhitungan->id_transaksi = $row->id_transaksi;
            //         $proses_perhitungan->id_ruangan = $id_ruangan;
            //         $proses_perhitungan->created_at = now();
            //         $proses_perhitungan->updated_at = now();
            //         $proses_perhitungan->save();
            // }

            $data_ruangan_pasien = DB::table('ruangan')
                ->where('id_ruangan', '=', $id_ruangan)
                ->first();
            $index = 'perawat_' . $data_ruangan_pasien->nama_ruangan;
            //dd($data_ruangan_pasien->nama_ruangan);
            if(isset($hasil[$row->id_transaksi]['Ke 1'][$index])) {
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT '.$data_ruangan_pasien->nama_ruangan;
                $proses_perhitungan->proses = 'Ke 1';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_transaksi]['Ke 1'][$index];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_transaksi = $row->id_transaksi;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();
            }
            
            if(isset($hasil[$row->id_transaksi]['Ke 1']['dokter'])) {
                // dd($row->id_data_pasien);
                foreach($hasil[$row->id_transaksi]['Ke 1']['dokter'] as $hasil_1 => $val) {
                    $proses_perhitungan = new ProsesPerhitungan();
                    $proses_perhitungan->ket_kategori = 'DOKTER';
                    $proses_perhitungan->proses = 'Ke 1';
                    $proses_perhitungan->jumlah_jp = $hasil[$row->id_transaksi]['Ke 1']['dokter'][ucfirst($hasil_1)];
                    $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                    $proses_perhitungan->id_transaksi = $row->id_transaksi;
                    $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                    $proses_perhitungan->id_ruangan = $id_ruangan;
                    $proses_perhitungan->created_at = now();
                    $proses_perhitungan->updated_at = now();
                    $proses_perhitungan->save();
                }
            }
            

            if(isset($hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'])) {
                foreach($hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                    $k_tindakan = DB::table('kategori_tindakan')->where('id_kategori_tindakan', ucfirst($hasil_1))->first();
                    if($k_tindakan->tahapan_proses == "Semua" || $k_tindakan->tahapan_proses == "Proses 3") {
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                        $proses_perhitungan->proses = 'Ke 1';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_transaksi = $row->id_transaksi;
                        $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }
            }

            // proses ke 2
            $tmp_total_ke_2 = 0;
            $hasil[$row->id_transaksi]['Ke 2']['adm']['adm'] = $hasil[$row->id_transaksi]['Ke 1']['adm']['adm'] / $hasil[$row->id_transaksi]['Ke 1']['total'];
            $tmp_total_ke_2 += $hasil[$row->id_transaksi]['Ke 1']['adm']['adm'] / $hasil[$row->id_transaksi]['Ke 1']['total'];
            $proses_perhitungan = new ProsesPerhitungan();
            $proses_perhitungan->ket_kategori = 'ADM';
            $proses_perhitungan->proses = 'Ke 2';
            $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 2']['adm']['adm'],6);
            $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
            $proses_perhitungan->id_transaksi = $row->id_transaksi;
            $proses_perhitungan->id_ruangan = $id_ruangan;
            $proses_perhitungan->created_at = now();
            $proses_perhitungan->updated_at = now();
            $proses_perhitungan->save();



            if(isset($hasil[$row->id_transaksi]['Ke 1'][$index])) {
                $hasil[$row->id_transaksi]['Ke 2'][$index] = $hasil[$row->id_transaksi]['Ke 1'][$index] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                $tmp_total_ke_2 += $hasil[$row->id_transaksi]['Ke 1'][$index] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT '.$data_ruangan_pasien->nama_ruangan;
                $proses_perhitungan->proses = 'Ke 2';
                $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 2'][$index],6);
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_transaksi = $row->id_transaksi;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();
            }
            
            if(isset($hasil[$row->id_transaksi]['Ke 1']['dokter'])) {
                foreach($hasil[$row->id_transaksi]['Ke 1']['dokter'] as $hasil_1 => $val) {
                    $hasil[$row->id_transaksi]['Ke 2']['dokter'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 1']['dokter'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                    $tmp_total_ke_2 += $hasil[$row->id_transaksi]['Ke 1']['dokter'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                    $proses_perhitungan = new ProsesPerhitungan();
                    $proses_perhitungan->ket_kategori = 'DOKTER';
                    $proses_perhitungan->proses = 'Ke 2';
                    $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 2']['dokter'][ucfirst($hasil_1)],6);
                    $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                    $proses_perhitungan->id_transaksi = $row->id_transaksi;
                    $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                    $proses_perhitungan->id_ruangan = $id_ruangan;
                    $proses_perhitungan->created_at = now();
                    $proses_perhitungan->updated_at = now();
                    $proses_perhitungan->save();
                }
            }

            if(isset($hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'])) {
                foreach($hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                    $k_tindakan = DB::table('kategori_tindakan')->where('id_kategori_tindakan', ucfirst($hasil_1))->first();
                    if($k_tindakan->tahapan_proses == "Semua" || $k_tindakan->tahapan_proses == "Proses 3") {
                        $hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                        $tmp_total_ke_2 += $hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_transaksi]['Ke 1']['total'];
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                        $proses_perhitungan->proses = 'Ke 2';
                        $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)],6);
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_transaksi = $row->id_transaksi;
                        $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }
            }

            $hasil[$row->id_transaksi]['Ke 2']['total'] = $tmp_total_ke_2;

            // proses ke 3
            $data_value_keuangan = DB::table('data_keuangan_pasien')
            ->where('no_sep_keuangan_pasien', '=', $row->no_sep)
            ->first();
            // // dd($data_value_keuangan->nominal_uang);
            
            // if($data_value_keuangan != null || $data_value_keuangan != "")
            // {
            //     $data_value_keuangan_nominal_uang = $data_value_keuangan->nominal_uang = 0;
            // }
            
            // dd($data_value_keuangan_nominal_uang);
            $tmp_total_ke_3 = 0;
            $hasil[$row->id_transaksi]['Ke 3']['adm']['adm'] = $hasil[$row->id_transaksi]['Ke 2']['adm']['adm'] * $data_value_keuangan->nominal_uang;
            $tmp_total_ke_3 += $hasil[$row->id_transaksi]['Ke 2']['adm']['adm'] * $data_value_keuangan->nominal_uang;
            $proses_perhitungan = new ProsesPerhitungan();
            $proses_perhitungan->ket_kategori = 'ADM';
            $proses_perhitungan->proses = 'Ke 3';
            $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 3']['adm']['adm']);
            $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
            $proses_perhitungan->id_transaksi = $row->id_transaksi;
            $proses_perhitungan->id_ruangan = $id_ruangan;
            $proses_perhitungan->created_at = now();
            $proses_perhitungan->updated_at = now();
            $proses_perhitungan->save();

            if(isset($hasil[$row->id_transaksi]['Ke 1'][$index])) {
                $hasil[$row->id_transaksi]['Ke 3'][$index] = $hasil[$row->id_transaksi]['Ke 2'][$index] * $data_value_keuangan->nominal_uang;
                $tmp_total_ke_3 += $hasil[$row->id_transaksi]['Ke 2'][$index] * $data_value_keuangan->nominal_uang;
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT '.$data_ruangan_pasien->nama_ruangan;
                $proses_perhitungan->proses = 'Ke 3';
                $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 3'][$index]);
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_transaksi = $row->id_transaksi;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();
            }
            
            if(isset($hasil[$row->id_transaksi]['Ke 2']['dokter'])) {
                foreach($hasil[$row->id_transaksi]['Ke 2']['dokter'] as $hasil_1 => $val) {
                    $hasil[$row->id_transaksi]['Ke 3']['dokter'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 2']['dokter'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                    $tmp_total_ke_3 += $hasil[$row->id_transaksi]['Ke 2']['dokter'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                    $proses_perhitungan = new ProsesPerhitungan();
                    $proses_perhitungan->ket_kategori = 'DOKTER';
                    $proses_perhitungan->proses = 'Ke 3';
                    $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 3']['dokter'][ucfirst($hasil_1)]);
                    $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                    $proses_perhitungan->id_transaksi = $row->id_transaksi;
                    $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                    $proses_perhitungan->id_ruangan = $id_ruangan;
                    $proses_perhitungan->created_at = now();
                    $proses_perhitungan->updated_at = now();
                    $proses_perhitungan->save();
                }
            }
        
            if(isset($hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'])) {
                foreach($hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                    $k_tindakan = DB::table('kategori_tindakan')->where('id_kategori_tindakan', ucfirst($hasil_1))->first();
                    if($k_tindakan->tahapan_proses == "Semua" || $k_tindakan->tahapan_proses == "Proses 3") {
                        $hasil[$row->id_transaksi]['Ke 3']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                        $tmp_total_ke_3 += $hasil[$row->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                        $proses_perhitungan->proses = 'Ke 3';
                        $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 3']['hasil_kategori_tindakan'][ucfirst($hasil_1)]);
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_transaksi = $row->id_transaksi;
                        $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }
            }           
            
            $hasil[$row->id_transaksi]['Ke 3']['total'] = $tmp_total_ke_3;

            // list variable rumus 
            $list_variable['ADM'][] = "adm|adm";
            $list_variable['PERAWAT ' .$data_ruangan_pasien->nama_ruangan][]  = "perawat_" .$data_ruangan_pasien->nama_ruangan;
            if(isset($hasil[$row->id_transaksi]['Ke 1']['hasil_kategori_tindakan'])) {
                foreach($hasil[$row->id_transaksi]['Ke 3']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                    $data_kategori_tindakan = new KategoriTindakan();
                    $data_kategori_tindakans = $data_kategori_tindakan->ShowKategoriTindakan(ucfirst($hasil_1));

                    if($data_kategori_tindakans != null) {
                        $list_variable[$data_kategori_tindakans->nama][] = "hasil_kategori_tindakan|" . $data_kategori_tindakans->nama;
                    }
                }
            }
                
            if(isset($hasil[$row->id_transaksi]['Ke 2']['dokter'])) {
                foreach($hasil[$row->id_transaksi]['Ke 3']['dokter'] as $hasil_1 => $val) {
                    $list_variable["DOKTER"][] = "dokter|" . $hasil_1;
                }
            }

            // proses ke 4
            $index2='PERAWAT ' .$data_ruangan_pasien->nama_ruangan;
            $tmp_total_ke_4 = 0;
            $hasil[$row->id_transaksi]['Ke 4']['adm']['adm'] = $this->hitung_rumus($hasil[$row->id_transaksi]['Ke 3'], $list_variable, "ADM");
            $tmp_total_ke_4 += $hasil[$row->id_transaksi]['Ke 4']['adm']['adm'];
            $proses_perhitungan = new ProsesPerhitungan();
            $proses_perhitungan->ket_kategori = 'ADM';
            $proses_perhitungan->proses = 'Ke 4';
            $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 4']['adm']['adm']);
            $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
            $proses_perhitungan->id_transaksi = $row->id_transaksi;
            $proses_perhitungan->id_ruangan = $id_ruangan;
            $proses_perhitungan->created_at = now();
            $proses_perhitungan->updated_at = now();
            $proses_perhitungan->save();
            
            if(isset($hasil[$row->id_transaksi]['Ke 3'][$index])) {
                $hasil[$row->id_transaksi]['Ke 4'][$index] = $this->hitung_rumus($hasil[$row->id_transaksi]['Ke 3'], $list_variable, $index2);
                $tmp_total_ke_4 += $hasil[$row->id_transaksi]['Ke 4'][$index];
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT '.$data_ruangan_pasien->nama_ruangan;
                $proses_perhitungan->proses = 'Ke 4';
                $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 4'][$index]);
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_transaksi = $row->id_transaksi;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();
            }
            
            if(isset($hasil[$row->id_transaksi]['Ke 3']['dokter'])) {
                foreach($hasil[$row->id_transaksi]['Ke 3']['dokter'] as $hasil_1 => $val) {
                    $hasil[$row->id_transaksi]['Ke 4']['dokter'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_transaksi]['Ke 3'], $list_variable, "DOKTER");
                    $tmp_total_ke_4 += $hasil[$row->id_transaksi]['Ke 4']['dokter'][ucfirst($hasil_1)];
                    $proses_perhitungan = new ProsesPerhitungan();
                    $proses_perhitungan->ket_kategori = 'DOKTER';
                    $proses_perhitungan->proses = 'Ke 4';
                    $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 4']['dokter'][ucfirst($hasil_1)]);
                    $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                    $proses_perhitungan->id_transaksi = $row->id_transaksi;
                    $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                    $proses_perhitungan->id_ruangan = $id_ruangan;
                    $proses_perhitungan->created_at = now();
                    $proses_perhitungan->updated_at = now();
                    $proses_perhitungan->save();
                }
            }
            

            if(isset($hasil[$row->id_transaksi]['Ke 3']['hasil_kategori_tindakan'])) {
                foreach($hasil[$row->id_transaksi]['Ke 3']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                    $data_kategori_tindakan = new KategoriTindakan();
                    $data_kategori_tindakans = $data_kategori_tindakan->ShowKategoriTindakan(ucfirst($hasil_1));

                    if($data_kategori_tindakans != null) {
                        if($data_kategori_tindakans->tahapan_proses != "Proses 3") {
                            $hasil[$row->id_transaksi]['Ke 4']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_transaksi]['Ke 3'], $list_variable, $data_kategori_tindakans->nama);
                            $tmp_total_ke_4 += $hasil[$row->id_transaksi]['Ke 4']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                            $proses_perhitungan = new ProsesPerhitungan();
                            $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                            $proses_perhitungan->proses = 'Ke 4';
                            $proses_perhitungan->jumlah_jp = round($hasil[$row->id_transaksi]['Ke 4']['hasil_kategori_tindakan'][ucfirst($hasil_1)]);
                            $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                            $proses_perhitungan->id_transaksi = $row->id_transaksi;
                            $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                            $proses_perhitungan->id_ruangan = $id_ruangan;
                            $proses_perhitungan->created_at = now();
                            $proses_perhitungan->updated_at = now();
                            $proses_perhitungan->save();
                        }
                    }
                }
            }           
            
            $hasil[$row->id_transaksi]['Ke 4']['total'] = $tmp_total_ke_4;
            if(round($hasil[$row->id_transaksi]['Ke 4']['total']) != round($hasil[$row->id_transaksi]['Ke 3']['total']) ){
                $flags = 1;
            }
            else{
                $flags = 0;
            }
             
        }

        if($flags == 0)
            {
                return "sukses";
            }
            else
            {
                return "tidak sukses";
            }

        // dd($hasil);

        //return redirect('show_proses_perhitungan_rawat_jalan/'.$id_periode.'/'.$id_ruangan)->with('alert-success', 'Proses perhitungan telah berhasil!');
    }

    public function show_proses_perhitungan_rawat_jalan($id_periode, $id_ruangan) {
        $data_kategori_tindakan = new KategoriTindakan();
        $data_kategori_tindakans = $data_kategori_tindakan->SelectKategoriTindakan();

        $data_dokter = new Dokter();
        $data_dokters = $data_dokter->SelectDokter();

        $hasi = new ProsesPerhitungan();
        $hasil = $hasi->ShowProsesPerhitunganRawatJalan($id_periode, $id_ruangan); 
        //dd($hasil);
        $data_pasien = new DataPasien();
        $data_pasiens = $data_pasien->SelectDataPasienRawatJalan($id_periode, $id_ruangan);
        
        $id_periode = $id_periode;
        $id_ruangan = $id_ruangan;

        $data_ruangan_pasien = DB::table('ruangan')
        ->where('id_ruangan', '=', $id_ruangan)
        ->first();

        $cekproses = DB::table('proses_perhitungan')
        ->where('id_ruangan', '=', $id_ruangan)
        ->first();

        if($cekproses != null)
        {
            return view('proses_perhitungan.proses_perhitungan_rawat_jalan', compact('hasil', 'data_pasiens', 'data_dokters', 'data_kategori_tindakans', 'id_periode','id_ruangan','data_ruangan_pasien')); 
        }
        else
        {
           return back()->with('alert-failed', 'Periode ini belum dilakukan proses perhitungan');
        }

        
    }

    public function show_detail_proses_perhitungan_rawat_jalan($id_periode, $id_ruangan, $id_data_pasien) {
        $hasi = new ProsesPerhitungan();
        $hasil = $hasi->ShowDetailProsesPerhitunganRawatJalan($id_periode, $id_ruangan, $id_data_pasien); 

        $data_pasien = new DataPasien();
        $data_pasiens = $data_pasien->ShowTindakanDataPasien($id_data_pasien);
        
        $id_periode = $id_periode;
        $id_ruangan = $id_ruangan;

        $data_ruangan_pasien = DB::table('ruangan')
        ->where('id_ruangan', '=', $id_ruangan)
        ->first();
        // $index = 'PERAWAT ' . $data_ruangan_pasien->nama_ruangan;
        // dd($hasil[$data_pasiens[0]->id_transaksi]['Ke 1'][$index]);
        return view('proses_perhitungan.show_proses_perhitungan_rawat_jalan', compact('hasil', 'data_pasiens', 'id_periode','id_ruangan','data_ruangan_pasien'));
    }
}

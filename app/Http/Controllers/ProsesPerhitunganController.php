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

            foreach($data_pasiens as $row) {
                $biaya_adm = $proses_perhitungan->ShowAdmPasien($row->id_data_pasien);
                if($biaya_adm == null) {
                    $hasil[$row->id_data_pasien]['Ke 1']['adm']['adm'] = 0;
                } else {
                    $hasil[$row->id_data_pasien]['Ke 1']['adm']['adm'] = $biaya_adm->jumlah_jp;
                }
                $hasil[$row->id_data_pasien]['Ke 1']['total'] = $hasil[$row->id_data_pasien]['Ke 1']['adm']['adm'];

                $data_tindakan_pasien = new DataTindakanPasien();
                $data_tindakan_pasiens = $data_tindakan_pasien->SelectDataTindakanPasien($row->id_transaksi);
                
                foreach ($data_tindakan_pasiens as $row_dtp) {
                    if($row_dtp->deskripsi_tindakan == "Administrasi Pasien IGD") {
                        $dokter = DB::table('dokter')->where('nama_dokter', '=', $row_dtp->nama_dokter_perawat)->first();

                        $biaya_dokter = 40000;

                        $hasil[$row->id_data_pasien]['Ke 1']['dokter'][$dokter->id_dokter] = $biaya_dokter;
                        $hasil[$row->id_data_pasien]['Ke 1']['total'] += $hasil[$row->id_data_pasien]['Ke 1']['dokter'][$dokter->id_dokter];
                    } else {
                        $karyawan_perawats = DB::table('karyawan_perawat')
                            ->join('ruangan', 'karyawan_perawat.id_ruangan', '=', 'ruangan.id_ruangan')
                            ->where('karyawan_perawat.nama', '=', $row_dtp->nama_dokter_perawat)
                            ->where('ruangan.kategori_ruangan', '=', 'IGD')
                            ->first();

                        if($karyawan_perawats != null) {
                            // perawat igd
                            if(!isset($hasil[$row->id_data_pasien]['Ke 1']['perawat_igd'])) {
                                $hasil[$row->id_data_pasien]['Ke 1']['perawat_igd'] = $row_dtp->jp;
                                $hasil[$row->id_data_pasien]['Ke 1']['total'] += $row_dtp->jp;
                            } else {
                                $hasil[$row->id_data_pasien]['Ke 1']['perawat_igd'] += $row_dtp->jp;
                                $hasil[$row->id_data_pasien]['Ke 1']['total'] += $row_dtp->jp;
                            }
                        } else {
                            $karyawan_perawats = DB::table('karyawan_perawat')
                                ->join('ruangan', 'karyawan_perawat.id_ruangan', '=', 'ruangan.id_ruangan')
                                ->where('karyawan_perawat.nama', '=', $row_dtp->nama_dokter_perawat)
                                ->where('ruangan.nama_ruangan', '=', 'ICCU')
                                ->first();

                            if($karyawan_perawats != null) {
                                // perawat iccu
                                if(!isset($hasil[$row->id_data_pasien]['Ke 1']['perawat_iccu'])) {
                                    $hasil[$row->id_data_pasien]['Ke 1']['perawat_iccu'] = $row_dtp->jp;
                                    $hasil[$row->id_data_pasien]['Ke 1']['total'] += $row_dtp->jp;
                                } else {
                                    $hasil[$row->id_data_pasien]['Ke 1']['perawat_iccu'] += $row_dtp->jp;
                                    $hasil[$row->id_data_pasien]['Ke 1']['total'] += $row_dtp->jp;
                                }
                            } else {
                                $karyawan_perawats = DB::table('karyawan_perawat')
                                    ->join('ruangan', 'karyawan_perawat.id_ruangan', '=', 'ruangan.id_ruangan')
                                    ->where('karyawan_perawat.nama', '=', $row_dtp->nama_dokter_perawat)
                                    ->where('ruangan.kategori_ruangan', '=', 'RPP')
                                    ->first();

                                if($karyawan_perawats != null) {
                                    // perawat rpp
                                    if(!isset($hasil[$row->id_data_pasien]['Ke 1']['perawat_rpp'])) {
                                        $hasil[$row->id_data_pasien]['Ke 1']['perawat_rpp'] = $row_dtp->jp;
                                        $hasil[$row->id_data_pasien]['Ke 1']['total'] += $row_dtp->jp;
                                    } else {
                                        $hasil[$row->id_data_pasien]['Ke 1']['perawat_rpp'] += $row_dtp->jp;
                                        $hasil[$row->id_data_pasien]['Ke 1']['total'] += $row_dtp->jp;
                                    }
                                } else {
                                    // kategori tindakan lainnya
                                    $hasil[$row->id_data_pasien]['Ke 1']['detail_kategori_tindakan'][$row_dtp->id_kategori_tindakan] = $row_dtp->jp;

                                    if(!isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan])) {
                                        $hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan] = $row_dtp->jp;
                                        $hasil[$row->id_data_pasien]['Ke 1']['total'] += $row_dtp->jp;
                                    } else {
                                        $hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan] += $row_dtp->jp;
                                        $hasil[$row->id_data_pasien]['Ke 1']['total'] += $row_dtp->jp;
                                    }    
                                }
                            } 
                        }
                    }
                }

                if(!isset($hasil[$row->id_data_pasien]['Ke 1']['perawat_igd'])) {
                    $hasil[$row->id_data_pasien]['Ke 1']['perawat_igd'] = 0;
                }

                if(!isset($hasil[$row->id_data_pasien]['Ke 1']['perawat_iccu'])) {
                    $hasil[$row->id_data_pasien]['Ke 1']['perawat_iccu'] = 0;
                }

                if(!isset($hasil[$row->id_data_pasien]['Ke 1']['perawat_rpp'])) {
                    $hasil[$row->id_data_pasien]['Ke 1']['perawat_rpp'] = 0;
                }

                $biaya_gizi = $proses_perhitungan->ShowGiziPasien($row->id_data_pasien);
                if($biaya_gizi == null) {
                    $hasil[$row->id_data_pasien]['Ke 1']['gizi']['gizi'] = 0;
                } else {
                    $hasil[$row->id_data_pasien]['Ke 1']['gizi']['gizi'] = $biaya_gizi->jumlah_jp;
                }
                $hasil[$row->id_data_pasien]['Ke 1']['total'] += $hasil[$row->id_data_pasien]['Ke 1']['gizi']['gizi'];

                $data_visite_pasien = DB::table('proses_perhitungan')
                ->join('dokter', 'dokter.id_dokter', '=', 'proses_perhitungan.id_dokter')
                ->where('id_data_pasien', '=', $row->id_data_pasien)
                ->where('ket_kategori', '=', 'VISITE')
                ->where('proses', '=', 'Ke 1')
                ->get();

                foreach($data_visite_pasien as $row_visite) {
                    $hasil[$row->id_data_pasien]['Ke 1']['visite'][$row_visite->id_dokter] = $row_visite->jumlah_jp;
                    $hasil[$row->id_data_pasien]['Ke 1']['total'] += $hasil[$row->id_data_pasien]['Ke 1']['visite'][$row_visite->id_dokter];
                }
                
                // proses ke 1
                $tmp_total_ke_1 = 0;
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'ADM';
                $proses_perhitungan->proses = 'Ke 1';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 1']['adm']['adm'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'GIZI';
                $proses_perhitungan->proses = 'Ke 1';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 1']['gizi']['gizi'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT IGD';
                $proses_perhitungan->proses = 'Ke 1';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 1']['perawat_igd'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT ICCU';
                $proses_perhitungan->proses = 'Ke 1';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 1']['perawat_iccu'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT RPP';
                $proses_perhitungan->proses = 'Ke 1';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 1']['perawat_rpp'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                if(isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'])) {
                    foreach($hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                        $proses_perhitungan->proses = 'Ke 1';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        if(ucfirst($hasil_1) != null && ucfirst($hasil_1) != "")
                        {
                            $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                        }
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }
                
                if(isset($hasil[$row->id_data_pasien]['Ke 1']['dokter'])) {
                    foreach($hasil[$row->id_data_pasien]['Ke 1']['dokter'] as $hasil_1 => $val) {
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'DOKTER';
                        $proses_perhitungan->proses = 'Ke 1';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 1']['dokter'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }

                if(isset($hasil[$row->id_data_pasien]['Ke 1']['visite'])) {
                    foreach($hasil[$row->id_data_pasien]['Ke 1']['visite'] as $hasil_1 => $val) {
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'VISITE';
                        $proses_perhitungan->proses = 'Ke 1';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 1']['visite'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }

                // proses ke 2
                $tmp_total_ke_2 = 0;
                if($hasil[$row->id_data_pasien]['Ke 1']['adm']['adm'] == 0 || $hasil[$row->id_data_pasien]['Ke 1']['total'] == 0 )
                {
                    $hasil[$row->id_data_pasien]['Ke 2']['adm']['adm'] = 0;
                $tmp_total_ke_2 += 0;
                }
                else
                {
                    $hasil[$row->id_data_pasien]['Ke 2']['adm']['adm'] = $hasil[$row->id_data_pasien]['Ke 1']['adm']['adm'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                    $tmp_total_ke_2 += $hasil[$row->id_data_pasien]['Ke 1']['adm']['adm'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                }
                
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'ADM';
                $proses_perhitungan->proses = 'Ke 2';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 2']['adm']['adm'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                if($hasil[$row->id_data_pasien]['Ke 1']['gizi']['gizi'] == 0 || $hasil[$row->id_data_pasien]['Ke 1']['total'] == 0 )
                {
                    $hasil[$row->id_data_pasien]['Ke 2']['gizi']['gizi'] = 0;
                    $tmp_total_ke_2 += 0;
                }
                else
                {
                    $hasil[$row->id_data_pasien]['Ke 2']['gizi']['gizi'] = $hasil[$row->id_data_pasien]['Ke 1']['gizi']['gizi'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                    $tmp_total_ke_2 += $hasil[$row->id_data_pasien]['Ke 1']['gizi']['gizi'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                }
                
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'GIZI';
                $proses_perhitungan->proses = 'Ke 2';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 2']['gizi']['gizi'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                if($hasil[$row->id_data_pasien]['Ke 1']['perawat_igd'] == 0 || $hasil[$row->id_data_pasien]['Ke 1']['total'] == 0 )
                {
                    $hasil[$row->id_data_pasien]['Ke 2']['perawat_igd'] = 0;
                    $tmp_total_ke_2 += 0;
                }
                else
                {
                    $hasil[$row->id_data_pasien]['Ke 2']['perawat_igd'] = $hasil[$row->id_data_pasien]['Ke 1']['perawat_igd'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                    $tmp_total_ke_2 += $hasil[$row->id_data_pasien]['Ke 1']['perawat_igd'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                }
                
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT IGD';
                $proses_perhitungan->proses = 'Ke 2';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 2']['perawat_igd'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                if($hasil[$row->id_data_pasien]['Ke 1']['perawat_iccu'] == 0 || $hasil[$row->id_data_pasien]['Ke 1']['total'] == 0 )
                {
                    $hasil[$row->id_data_pasien]['Ke 2']['perawat_iccu'] = 0;
                    $tmp_total_ke_2 += 0;
                }
                else
                {
                    $hasil[$row->id_data_pasien]['Ke 2']['perawat_iccu'] = $hasil[$row->id_data_pasien]['Ke 1']['perawat_iccu'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                    $tmp_total_ke_2 += $hasil[$row->id_data_pasien]['Ke 1']['perawat_iccu'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                }
                
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT ICCU';
                $proses_perhitungan->proses = 'Ke 2';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 2']['perawat_iccu'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                if($hasil[$row->id_data_pasien]['Ke 1']['perawat_rpp'] == 0 || $hasil[$row->id_data_pasien]['Ke 1']['total'] == 0 )
                {
                    $hasil[$row->id_data_pasien]['Ke 2']['perawat_rpp'] = 0;
                    $tmp_total_ke_2 += 0;
                }
                else
                {
                    $hasil[$row->id_data_pasien]['Ke 2']['perawat_rpp'] = $hasil[$row->id_data_pasien]['Ke 1']['perawat_rpp'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                    $tmp_total_ke_2 += $hasil[$row->id_data_pasien]['Ke 1']['perawat_rpp'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                }
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT RPP';
                $proses_perhitungan->proses = 'Ke 2';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 2']['perawat_rpp'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                // foreach($hasil[$row->id_data_pasien]['Ke 1']['detail_kategori_tindakan'] as $hasil_1 => $val) {
                //     $hasil[$row->id_data_pasien]['Ke 2']['detail_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_data_pasien]['Ke 1']['detail_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                //     $tmp_total_ke_2 += $hasil[$row->id_data_pasien]['Ke 1']['detail_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                // }

                if(isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'])) {
                    foreach($hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                        $hasil[$row->id_data_pasien]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                        $tmp_total_ke_2 += $hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                        $proses_perhitungan->proses = 'Ke 2';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        if(ucfirst($hasil_1) != null && ucfirst($hasil_1) != "")
                        {
                            $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                        }
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }
 
                if(isset($hasil[$row->id_data_pasien]['Ke 1']['dokter'])) {
                    foreach($hasil[$row->id_data_pasien]['Ke 1']['dokter'] as $hasil_1 => $val) {
                        $hasil[$row->id_data_pasien]['Ke 2']['dokter'][ucfirst($hasil_1)] = $hasil[$row->id_data_pasien]['Ke 1']['dokter'][ucfirst($hasil_1)] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                        $tmp_total_ke_2 += $hasil[$row->id_data_pasien]['Ke 1']['dokter'][ucfirst($hasil_1)] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'DOKTER';
                        $proses_perhitungan->proses = 'Ke 2';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 2']['dokter'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }

                if(isset($hasil[$row->id_data_pasien]['Ke 1']['visite'])) {
                    foreach($hasil[$row->id_data_pasien]['Ke 1']['visite'] as $hasil_1 => $val) {
                        $hasil[$row->id_data_pasien]['Ke 2']['visite'][ucfirst($hasil_1)] = $hasil[$row->id_data_pasien]['Ke 1']['visite'][ucfirst($hasil_1)] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                        $tmp_total_ke_2 += $hasil[$row->id_data_pasien]['Ke 1']['visite'][ucfirst($hasil_1)] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'VISITE';
                        $proses_perhitungan->proses = 'Ke 2';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 2']['visite'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }
                $hasil[$row->id_data_pasien]['Ke 2']['total'] = $tmp_total_ke_2;

                // proses ke 3
                $data_value_keuangan = DB::table('data_keuangan_pasien')
                ->where('no_sep_keuangan_pasien', '=', $row->no_sep)
                ->first();
                $tmp_total_ke_3 = 0;
                $hasil[$row->id_data_pasien]['Ke 3']['adm']['adm'] = $hasil[$row->id_data_pasien]['Ke 2']['adm']['adm'] * $data_value_keuangan->nominal_uang;
                $tmp_total_ke_3 += $hasil[$row->id_data_pasien]['Ke 2']['adm']['adm'] * $data_value_keuangan->nominal_uang;
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'ADM';
                $proses_perhitungan->proses = 'Ke 3';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 3']['adm']['adm'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $hasil[$row->id_data_pasien]['Ke 3']['gizi']['gizi'] = $hasil[$row->id_data_pasien]['Ke 2']['gizi']['gizi'] * $data_value_keuangan->nominal_uang;
                $tmp_total_ke_3 += $hasil[$row->id_data_pasien]['Ke 2']['gizi']['gizi'] * $data_value_keuangan->nominal_uang;
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'GIZI';
                $proses_perhitungan->proses = 'Ke 3';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 3']['gizi']['gizi'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $hasil[$row->id_data_pasien]['Ke 3']['perawat_igd'] = $hasil[$row->id_data_pasien]['Ke 2']['perawat_igd'] * $data_value_keuangan->nominal_uang;
                $tmp_total_ke_3 += $hasil[$row->id_data_pasien]['Ke 2']['perawat_igd'] * $data_value_keuangan->nominal_uang;
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT IGD';
                $proses_perhitungan->proses = 'Ke 3';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 3']['perawat_igd'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $hasil[$row->id_data_pasien]['Ke 3']['perawat_iccu'] = $hasil[$row->id_data_pasien]['Ke 2']['perawat_iccu'] * $data_value_keuangan->nominal_uang;
                $tmp_total_ke_3 += $hasil[$row->id_data_pasien]['Ke 2']['perawat_iccu'] * $data_value_keuangan->nominal_uang;
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT ICCU';
                $proses_perhitungan->proses = 'Ke 3';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 3']['perawat_iccu'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $hasil[$row->id_data_pasien]['Ke 3']['perawat_rpp'] = $hasil[$row->id_data_pasien]['Ke 2']['perawat_rpp'] * $data_value_keuangan->nominal_uang;
                $tmp_total_ke_3 += $hasil[$row->id_data_pasien]['Ke 2']['perawat_rpp'] * $data_value_keuangan->nominal_uang;
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT RPP';
                $proses_perhitungan->proses = 'Ke 3';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 3']['perawat_rpp'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                // foreach($hasil[$row->id_data_pasien]['Ke 2']['detail_kategori_tindakan'] as $hasil_1 => $val) {
                //     $hasil[$row->id_data_pasien]['Ke 3']['detail_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_data_pasien]['Ke 2']['detail_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                //     $tmp_total_ke_3 += $hasil[$row->id_data_pasien]['Ke 2']['detail_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                // }

                if(isset($hasil[$row->id_data_pasien]['Ke 2']['hasil_kategori_tindakan'])) {
                    foreach($hasil[$row->id_data_pasien]['Ke 2']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                        $hasil[$row->id_data_pasien]['Ke 3']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_data_pasien]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                        $tmp_total_ke_3 += $hasil[$row->id_data_pasien]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                        $proses_perhitungan->proses = 'Ke 3';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 3']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        if(ucfirst($hasil_1) != null && ucfirst($hasil_1) != "")
                        {
                            $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                        }
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }
                
                if(isset($hasil[$row->id_data_pasien]['Ke 2']['dokter'])) {
                    foreach($hasil[$row->id_data_pasien]['Ke 2']['dokter'] as $hasil_1 => $val) {
                        $hasil[$row->id_data_pasien]['Ke 3']['dokter'][ucfirst($hasil_1)] = $hasil[$row->id_data_pasien]['Ke 2']['dokter'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                        $tmp_total_ke_3 += $hasil[$row->id_data_pasien]['Ke 2']['dokter'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'DOKTER';
                        $proses_perhitungan->proses = 'Ke 3';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 3']['dokter'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }

                if(isset($hasil[$row->id_data_pasien]['Ke 1']['visite'])) {
                    foreach($hasil[$row->id_data_pasien]['Ke 2']['visite'] as $hasil_1 => $val) {
                        $hasil[$row->id_data_pasien]['Ke 3']['visite'][ucfirst($hasil_1)] = $hasil[$row->id_data_pasien]['Ke 2']['visite'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                        $tmp_total_ke_3 += $hasil[$row->id_data_pasien]['Ke 2']['visite'][ucfirst($hasil_1)] * $data_value_keuangan->nominal_uang;
                    }
                    $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'VISITE';
                        $proses_perhitungan->proses = 'Ke 3';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 3']['visite'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                }
                $hasil[$row->id_data_pasien]['Ke 3']['total'] = $tmp_total_ke_3;

                // list variable rumus 
                $list_variable['ADM'] = "adm|adm";
                $list_variable['GIZI'] = "gizi|gizi";
                $list_variable['PERAWAT IGD'] = "perawat_igd";
                $list_variable['PERAWAT ICCU'] = "perawat_iccu";
                $list_variable['PERAWAT RPP'] = "perawat_rpp";
                foreach($hasil[$row->id_data_pasien]['Ke 3']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                    $data_kategori_tindakan = new KategoriTindakan();
                    $data_kategori_tindakans = $data_kategori_tindakan->ShowKategoriTindakan(ucfirst($hasil_1));

                    if($data_kategori_tindakans != null) {
                        $list_variable[$data_kategori_tindakans->nama] = "hasil_kategori_tindakan|" . $data_kategori_tindakans->nama;
                    }
                }
                
                if(isset($hasil[$row->id_data_pasien]['Ke 2']['dokter'])) {
                    foreach($hasil[$row->id_data_pasien]['Ke 3']['dokter'] as $hasil_1 => $val) {
                        $list_variable["DOKTER IGD"] = "dokter|" . $hasil_1;
                    }
                }
                
                if(isset($hasil[$row->id_data_pasien]['Ke 3']['visite'])) {
                    foreach($hasil[$row->id_data_pasien]['Ke 3']['visite'] as $hasil_1 => $val) {
                        $list_variable["DOKTER VISITE"] = "visite|" . $hasil_1;
                    }
                }

                // proses ke 4
                $data_value_keuangan = DB::table('data_keuangan_pasien')
                ->where('no_sep_keuangan_pasien', '=', $row->no_sep)
                ->first();
                $tmp_total_ke_4 = 0;

                $hasil[$row->id_data_pasien]['Ke 4']['adm']['adm'] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "ADM");
                $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 3']['adm']['adm'];
                
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'ADM';
                $proses_perhitungan->proses = 'Ke 4';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['adm']['adm'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $hasil[$row->id_data_pasien]['Ke 4']['gizi']['gizi'] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "GIZI");
                $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 3']['gizi']['gizi'];
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'GIZI';
                $proses_perhitungan->proses = 'Ke 4';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['gizi']['gizi'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $hasil[$row->id_data_pasien]['Ke 4']['perawat_igd'] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "PERAWAT IGD");
                $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 3']['perawat_igd'];
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT IGD';
                $proses_perhitungan->proses = 'Ke 4';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['perawat_igd'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $hasil[$row->id_data_pasien]['Ke 4']['perawat_iccu'] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "PERAWAT ICCU");
                $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['perawat_iccu'];
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT ICCU';
                $proses_perhitungan->proses = 'Ke 4';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['perawat_iccu'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                $hasil[$row->id_data_pasien]['Ke 4']['perawat_rpp'] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "PERAWAT RPP");
                $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['perawat_rpp'];
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'PERAWAT RPP';
                $proses_perhitungan->proses = 'Ke 4';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['perawat_rpp'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();

                // foreach($hasil[$row->id_data_pasien]['Ke 3']['detail_kategori_tindakan'] as $hasil_1 => $val) {
                //     $data_kategori_tindakan = new KategoriTindakan();
                //     $data_kategori_tindakans = $data_kategori_tindakan->ShowKategoriTindakan(ucfirst($hasil_1));

                //     $hasil[$row->id_data_pasien]['Ke 4']['detail_kategori_tindakan'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, $data_kategori_tindakans->nama);
                //     $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['detail_kategori_tindakan'][ucfirst($hasil_1)];
                // }

                foreach($hasil[$row->id_data_pasien]['Ke 3']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                    $data_kategori_tindakan = new KategoriTindakan();
                    $data_kategori_tindakans = $data_kategori_tindakan->ShowKategoriTindakan(ucfirst($hasil_1));

                    if($data_kategori_tindakans != null) {
                        $hasil[$row->id_data_pasien]['Ke 4']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, $data_kategori_tindakans->nama);
                        $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                        $proses_perhitungan->proses = 'Ke 4';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }
                
                if(isset($hasil[$row->id_data_pasien]['Ke 3']['dokter'])) {
                    foreach($hasil[$row->id_data_pasien]['Ke 3']['dokter'] as $hasil_1 => $val) {
                        $hasil[$row->id_data_pasien]['Ke 4']['dokter'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "DOKTER IGD");
                        $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['dokter'][ucfirst($hasil_1)];
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'DOKTER';
                        $proses_perhitungan->proses = 'Ke 4';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['dokter'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }

                if(isset($hasil[$row->id_data_pasien]['Ke 2']['visite'])) {
                    foreach($hasil[$row->id_data_pasien]['Ke 3']['visite'] as $hasil_1 => $val) {
                        $hasil[$row->id_data_pasien]['Ke 4']['visite'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "DOKTER VISITE");
                        $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['visite'][ucfirst($hasil_1)];
                    }
                    $proses_perhitungan = new ProsesPerhitungan();
                    $proses_perhitungan->ket_kategori = 'VISITE';
                    $proses_perhitungan->proses = 'Ke 4';
                    $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['visite'][ucfirst($hasil_1)];
                    $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                    $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                    $proses_perhitungan->id_ruangan = $id_ruangan;
                    $proses_perhitungan->created_at = now();
                    $proses_perhitungan->updated_at = now();
                    $proses_perhitungan->save();
                }
                $hasil[$row->id_data_pasien]['Ke 4']['total'] = $tmp_total_ke_4;
            }
            
            return redirect('show_proses_perhitungan_rawat_inap/'.$id_periode.'/'.$id_ruangan)->with('alert-success', 'Proses perhitungan telah berhasil!');               
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function hitung_rumus($hasil, $list_variable, $variable_kategori) {
        $rumus = DB::table('variable_rumus')->where("nama_variabel", "=", $variable_kategori)->first();
        if($rumus == null) {
            $hasil_perhitungan = 2222222;
        } else {
            $rumus = $rumus->rumus;

            $rumus = str_replace("{{", "", $rumus);
            $rumus = str_replace("}}", "", $rumus);

            $hasil_perhitungan = 0;
            foreach($list_variable as $nama_variable => $value) {
                if(strpos($rumus, $nama_variable) !== false) {
                    // ada
                    $index = explode("|", $value);
                    if(count($index) == 1) {
                        $rumus = str_replace($nama_variable, $hasil[$index[0]], $rumus);
                    } else {
                        // $rumus = str_replace($nama_variable, $hasil[$index[0]][$index[1]], $rumus);
                    }
                    break;
                } else {
                    // tidak ada
                    if($variable_kategori == "DOKTER IGD" || $variable_kategori == "DOKTER VISITE" || $variable_kategori == "DOKTER") {
                        $index = explode("|", $value);
                        // if(count($index) == 1) {
                        //     dd($variable_kategori);                        
                        //     dd($list_variable);
                        //     dd($value);
                        // }
                        $rumus = str_replace($nama_variable, $hasil[$index[0]][$index[1]], $rumus);
                        break;
                    }
                }
            }

            $hasil_perhitungan = 111111;
            // $hasil_perhitungan = eval('return (' . $rumus . ');');
        }

        return $hasil_perhitungan;
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
        
        $id_periode = $id_periode;
        $id_ruangan = $id_ruangan;

        return view('proses_perhitungan.proses_perhitungan_rawat_inap', compact('hasil', 'data_pasiens', 'data_dokters', 'data_kategori_tindakans', 'id_periode','id_ruangan'));
    }

    public function show_detail_proses_perhitungan_rawat_inap($id_periode, $id_ruangan, $id_data_pasien) {
        $hasi = new ProsesPerhitungan();
        $hasil = $hasi->ShowDetailProsesPerhitunganRawatInap($id_periode, $id_ruangan, $id_data_pasien); 

        $data_pasien = new DataPasien();
        $data_pasiens = $data_pasien->ShowTindakanDataPasien($id_data_pasien);
        
        $id_periode = $id_periode;
        $id_ruangan = $id_ruangan;

        return view('proses_perhitungan.show_proses_perhitungan_rawat_inap', compact('hasil', 'data_pasiens', 'id_periode','id_ruangan'));
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

        $proses_perhitungan = new ProsesPerhitungan;

        foreach($data_pasiens as $row) {
            $biaya_adm = $proses_perhitungan->ShowAdmPasien($row->id_data_pasien);
            if($biaya_adm == null) {
                $hasil[$row->id_data_pasien]['Ke 1']['adm']['adm'] = 6000;
            } else {
                $hasil[$row->id_data_pasien]['Ke 1']['adm']['adm'] = $biaya_adm->jumlah_jp;
            }
            $hasil[$row->id_data_pasien]['Ke 1']['total'] = $hasil[$row->id_data_pasien]['Ke 1']['adm']['adm'];

            $data_tindakan_pasien = new DataTindakanPasien();
            $data_tindakan_pasiens = $data_tindakan_pasien->SelectDataTindakanPasien($row->id_data_pasien);

            foreach ($data_tindakan_pasiens as $row_dtp) {
                $hasil[$row->id_data_pasien]['Ke 1']['detail_tindakan'][$row_dtp->id_data_tindakan_pasien] = $row_dtp->jp;

                if($row_dtp->deskripsi_tindakan != "") {
                    if(strpos($row_dtp->deskripsi_tindakan, "Administrasi Pasien Rawat Jalan") !== false) {
                        $dokter = DB::table('dokter')->where('nama_dokter', '=', $row->nama_dokter_perawat)->first();

                        $biaya_dokter = 30000;

                        $hasil[$row->id_data_pasien]['Ke 1']['dokter'][$dokter->id_dokter] = $biaya_dokter;
                        $hasil[$row->id_data_pasien]['Ke 1']['total'] += $hasil[$row->id_data_pasien]['Ke 1']['dokter'][$dokter->id_dokter];
                    } else {
                        if(strpos($row_dtp->deskripsi_tindakan, "Jasa") === false) {
                            $deskripsi_tindakan = new DeskripsiTindakan();
                            $deskripsi_tindakans = $deskripsi_tindakan->ShowDeskripsiTindakan($row_dtp->id_deskripsi_tindakan); 

                            if($deskripsi_tindakans == null) {
                                if(!isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_tindakan'])) {
                                    $hasil[$row->id_data_pasien]['Ke 1']['hasil_tindakan'] = $row_dtp->jp;
                                    $hasil[$row->id_data_pasien]['Ke 1']['total'] += $row_dtp->jp;
                                } else {
                                    $hasil[$row->id_data_pasien]['Ke 1']['hasil_tindakan'] += $row_dtp->jp;
                                    $hasil[$row->id_data_pasien]['Ke 1']['total'] += $row_dtp->jp;
                                }
                            } else {
                                if($row_dtp->id_kategori_tindakan != null || $row_dtp->id_kategori_tindakan != "") {
                                    if(!isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan])) {
                                        $hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan] = $row_dtp->jp;
                                        $hasil[$row->id_data_pasien]['Ke 1']['total'] += $row_dtp->jp;
                                    } else {
                                        $hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan] += $row_dtp->jp;
                                        $hasil[$row->id_data_pasien]['Ke 1']['total'] += $row_dtp->jp;
                                    }  
                                }
                            }
                        } else {
                            $hasil[$row->id_data_pasien]['Ke 1']['hasil_tindakan'] = 0;
                            $hasil[$row->id_data_pasien]['Ke 1']['total'] += 0;
                        }
                    }
                }
            }

            // proses ke 1
            $tmp_total_ke_1 = 0;
            $proses_perhitungan = new ProsesPerhitungan();
            $proses_perhitungan->ket_kategori = 'ADM';
            $proses_perhitungan->proses = 'Ke 1';
            $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 1']['adm']['adm'];
            $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
            $proses_perhitungan->id_ruangan = $id_ruangan;
            $proses_perhitungan->created_at = now();
            $proses_perhitungan->updated_at = now();
            $proses_perhitungan->save();

            if(isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_tindakan'])) {
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'TINDAKAN';
                $proses_perhitungan->proses = 'Ke 1';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 1']['hasil_tindakan'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();
            }
            
            if(!isset($hasil[$row->id_data_pasien]['Ke 1']['dokter'])) {
                // dd($row->id_data_pasien);
            }
            foreach($hasil[$row->id_data_pasien]['Ke 1']['dokter'] as $hasil_1 => $val) {
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'DOKTER';
                $proses_perhitungan->proses = 'Ke 1';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 1']['dokter'][ucfirst($hasil_1)];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();
            }

            if(isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'])) {
                foreach($hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                    $proses_perhitungan = new ProsesPerhitungan();
                    $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                    $proses_perhitungan->proses = 'Ke 1';
                    $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                    $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                    $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                    $proses_perhitungan->id_ruangan = $id_ruangan;
                    $proses_perhitungan->created_at = now();
                    $proses_perhitungan->updated_at = now();
                    $proses_perhitungan->save();
                }
            }

            // proses ke 2
            $tmp_total_ke_2 = 0;
            $hasil[$row->id_data_pasien]['Ke 2']['adm']['adm'] = $hasil[$row->id_data_pasien]['Ke 1']['adm']['adm'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
            $tmp_total_ke_2 += $hasil[$row->id_data_pasien]['Ke 1']['adm']['adm'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
            $proses_perhitungan = new ProsesPerhitungan();
            $proses_perhitungan->ket_kategori = 'ADM';
            $proses_perhitungan->proses = 'Ke 2';
            $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 2']['adm']['adm'];
            $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
            $proses_perhitungan->id_ruangan = $id_ruangan;
            $proses_perhitungan->created_at = now();
            $proses_perhitungan->updated_at = now();
            $proses_perhitungan->save();

            if(isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_tindakan'])) {
                $hasil[$row->id_data_pasien]['Ke 2']['hasil_tindakan'] = $hasil[$row->id_data_pasien]['Ke 1']['hasil_tindakan'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                $tmp_total_ke_2 += $hasil[$row->id_data_pasien]['Ke 1']['hasil_tindakan'] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'TINDAKAN';
                $proses_perhitungan->proses = 'Ke 2';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 2']['hasil_tindakan'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();
            }
            
            foreach($hasil[$row->id_data_pasien]['Ke 1']['dokter'] as $hasil_1 => $val) {
                $hasil[$row->id_data_pasien]['Ke 2']['dokter'][ucfirst($hasil_1)] = $hasil[$row->id_data_pasien]['Ke 1']['dokter'][ucfirst($hasil_1)] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                $tmp_total_ke_2 += $hasil[$row->id_data_pasien]['Ke 1']['dokter'][ucfirst($hasil_1)] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'DOKTER';
                $proses_perhitungan->proses = 'Ke 2';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 2']['dokter'][ucfirst($hasil_1)];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();
            }

            if(isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'])) {
                foreach($hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                    $hasil[$row->id_data_pasien]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                    $tmp_total_ke_2 += $hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][ucfirst($hasil_1)] / $hasil[$row->id_data_pasien]['Ke 1']['total'];
                    $proses_perhitungan = new ProsesPerhitungan();
                    $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                    $proses_perhitungan->proses = 'Ke 2';
                    $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                    $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                    $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                    $proses_perhitungan->id_ruangan = $id_ruangan;
                    $proses_perhitungan->created_at = now();
                    $proses_perhitungan->updated_at = now();
                    $proses_perhitungan->save();
                }
            }

            $hasil[$row->id_data_pasien]['Ke 2']['total'] = $tmp_total_ke_2;

            // proses ke 3
            $data_value_keuangan_nominal_uang = 0;
            // $data_value_keuangan = DB::table('data_keuangan_pasien')
            // ->where('no_sep_keuangan_pasien', '=', 1)
            // ->first();
            // // dd($data_value_keuangan->nominal_uang);
            
            // if($data_value_keuangan != null || $data_value_keuangan != "")
            // {
            //     $data_value_keuangan_nominal_uang = $data_value_keuangan->nominal_uang = 0;
            // }
            
            // dd($data_value_keuangan_nominal_uang);
            $tmp_total_ke_3 = 0;
            $hasil[$row->id_data_pasien]['Ke 3']['adm']['adm'] = $hasil[$row->id_data_pasien]['Ke 2']['adm']['adm'] * $data_value_keuangan_nominal_uang;
            $tmp_total_ke_3 += $hasil[$row->id_data_pasien]['Ke 2']['adm']['adm'] * $data_value_keuangan_nominal_uang;
            $proses_perhitungan = new ProsesPerhitungan();
            $proses_perhitungan->ket_kategori = 'ADM';
            $proses_perhitungan->proses = 'Ke 3';
            $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 3']['adm']['adm'];
            $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
            $proses_perhitungan->id_ruangan = $id_ruangan;
            $proses_perhitungan->created_at = now();
            $proses_perhitungan->updated_at = now();
            $proses_perhitungan->save();

            if(isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_tindakan'])) {
                $hasil[$row->id_data_pasien]['Ke 3']['hasil_tindakan'] = $hasil[$row->id_data_pasien]['Ke 2']['hasil_tindakan'] * $data_value_keuangan_nominal_uang;
                $tmp_total_ke_3 += $hasil[$row->id_data_pasien]['Ke 2']['hasil_tindakan'] * $data_value_keuangan_nominal_uang;
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'TINDAKAN';
                $proses_perhitungan->proses = 'Ke 3';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 3']['hasil_tindakan'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();
            }
            
            foreach($hasil[$row->id_data_pasien]['Ke 2']['dokter'] as $hasil_1 => $val) {
                $hasil[$row->id_data_pasien]['Ke 3']['dokter'][ucfirst($hasil_1)] = $hasil[$row->id_data_pasien]['Ke 2']['dokter'][ucfirst($hasil_1)] * $data_value_keuangan_nominal_uang;
                $tmp_total_ke_3 += $hasil[$row->id_data_pasien]['Ke 2']['dokter'][ucfirst($hasil_1)] * $data_value_keuangan_nominal_uang;
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'DOKTER';
                $proses_perhitungan->proses = 'Ke 3';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 3']['dokter'][ucfirst($hasil_1)];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();
            }

            if(isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'])) {
                foreach($hasil[$row->id_data_pasien]['Ke 2']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                    $hasil[$row->id_data_pasien]['Ke 3']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $hasil[$row->id_data_pasien]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan_nominal_uang;
                    $tmp_total_ke_3 += $hasil[$row->id_data_pasien]['Ke 2']['hasil_kategori_tindakan'][ucfirst($hasil_1)] * $data_value_keuangan_nominal_uang;
                    $proses_perhitungan = new ProsesPerhitungan();
                    $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                    $proses_perhitungan->proses = 'Ke 3';
                    $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 3']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                    $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                    $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                    $proses_perhitungan->id_ruangan = $id_ruangan;
                    $proses_perhitungan->created_at = now();
                    $proses_perhitungan->updated_at = now();
                    $proses_perhitungan->save();
                }
            }           
            
            $hasil[$row->id_data_pasien]['Ke 3']['total'] = $tmp_total_ke_3;

            // list variable rumus 
            $list_variable['ADM'] = "adm|adm";
            $list_variable['ADM'] = "hasil_tindakan|hasil_tindakan";
            if(isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'])) {
                foreach($hasil[$row->id_data_pasien]['Ke 3']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                    $data_kategori_tindakan = new KategoriTindakan();
                    $data_kategori_tindakans = $data_kategori_tindakan->ShowKategoriTindakan(ucfirst($hasil_1));

                    if($data_kategori_tindakans != null) {
                        $list_variable[$data_kategori_tindakans->nama] = "hasil_kategori_tindakan|" . $data_kategori_tindakans->nama;
                    }
                }
            }
                
            if(isset($hasil[$row->id_data_pasien]['Ke 2']['dokter'])) {
                foreach($hasil[$row->id_data_pasien]['Ke 3']['dokter'] as $hasil_1 => $val) {
                    $list_variable["DOKTER"] = "dokter|" . $hasil_1;
                }
            }

            // proses ke 4
            $tmp_total_ke_4 = 0;
            $hasil[$row->id_data_pasien]['Ke 4']['adm']['adm'] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "ADM");
            $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['adm']['adm'];
            $proses_perhitungan = new ProsesPerhitungan();
            $proses_perhitungan->ket_kategori = 'ADM';
            $proses_perhitungan->proses = 'Ke 4';
            $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['adm']['adm'];
            $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
            $proses_perhitungan->id_ruangan = $id_ruangan;
            $proses_perhitungan->created_at = now();
            $proses_perhitungan->updated_at = now();
            $proses_perhitungan->save();

            if(isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_tindakan'])) {
                $hasil[$row->id_data_pasien]['Ke 4']['hasil_tindakan'] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "HASIL TINDAKAN");
                $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['hasil_tindakan'];
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'TINDAKAN';
                $proses_perhitungan->proses = 'Ke 4';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['hasil_tindakan'];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();
            }
            
            foreach($hasil[$row->id_data_pasien]['Ke 3']['dokter'] as $hasil_1 => $val) {
                $hasil[$row->id_data_pasien]['Ke 4']['dokter'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "DOKTER");
                $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['dokter'][ucfirst($hasil_1)];
                $proses_perhitungan = new ProsesPerhitungan();
                $proses_perhitungan->ket_kategori = 'DOKTER';
                $proses_perhitungan->proses = 'Ke 4';
                $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['dokter'][ucfirst($hasil_1)];
                $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                $proses_perhitungan->id_dokter = ucfirst($hasil_1);
                $proses_perhitungan->id_ruangan = $id_ruangan;
                $proses_perhitungan->created_at = now();
                $proses_perhitungan->updated_at = now();
                $proses_perhitungan->save();
            }

            if(isset($hasil[$row->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'])) {
                foreach($hasil[$row->id_data_pasien]['Ke 3']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
                    $data_kategori_tindakan = new KategoriTindakan();
                    $data_kategori_tindakans = $data_kategori_tindakan->ShowKategoriTindakan(ucfirst($hasil_1));

                    if($data_kategori_tindakans != null) {
                        $hasil[$row->id_data_pasien]['Ke 4']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, $data_kategori_tindakans->nama);
                        $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                        $proses_perhitungan = new ProsesPerhitungan();
                        $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
                        $proses_perhitungan->proses = 'Ke 4';
                        $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
                        $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
                        $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
                        $proses_perhitungan->id_ruangan = $id_ruangan;
                        $proses_perhitungan->created_at = now();
                        $proses_perhitungan->updated_at = now();
                        $proses_perhitungan->save();
                    }
                }
            }           
            
            $hasil[$row->id_data_pasien]['Ke 4']['total'] = $tmp_total_ke_4;
             
        }

        // proses ke 4

        // $data_value_keuangan = DB::table('data_keuangan_pasien')
        // ->where('no_sep_keuangan_pasien', '=', $row->no_sep)
        // ->first();
        // $tmp_total_ke_4 = 0;

        // $hasil[$row->id_data_pasien]['Ke 4']['adm']['adm'] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "ADM");
        // $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 3']['adm']['adm'];
        
        // $proses_perhitungan = new ProsesPerhitungan();
        // $proses_perhitungan->ket_kategori = 'ADM';
        // $proses_perhitungan->proses = 'Ke 4';
        // $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['adm']['adm'];
        // $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
        // $proses_perhitungan->id_ruangan = $id_ruangan;
        // $proses_perhitungan->created_at = now();
        // $proses_perhitungan->updated_at = now();
        // $proses_perhitungan->save();

        // $hasil[$row->id_data_pasien]['Ke 4']['gizi']['gizi'] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "GIZI");
        // $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 3']['gizi']['gizi'];
        // $proses_perhitungan = new ProsesPerhitungan();
        // $proses_perhitungan->ket_kategori = 'GIZI';
        // $proses_perhitungan->proses = 'Ke 4';
        // $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['gizi']['gizi'];
        // $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
        // $proses_perhitungan->id_ruangan = $id_ruangan;
        // $proses_perhitungan->created_at = now();
        // $proses_perhitungan->updated_at = now();
        // $proses_perhitungan->save();

        // $hasil[$row->id_data_pasien]['Ke 4']['perawat_igd'] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "PERAWAT IGD");
        // $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 3']['perawat_igd'];
        // $proses_perhitungan = new ProsesPerhitungan();
        // $proses_perhitungan->ket_kategori = 'PERAWAT IGD';
        // $proses_perhitungan->proses = 'Ke 4';
        // $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['perawat_igd'];
        // $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
        // $proses_perhitungan->id_ruangan = $id_ruangan;
        // $proses_perhitungan->created_at = now();
        // $proses_perhitungan->updated_at = now();
        // $proses_perhitungan->save();

        // $hasil[$row->id_data_pasien]['Ke 4']['perawat_iccu'] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "PERAWAT ICCU");
        // $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['perawat_iccu'];
        // $proses_perhitungan = new ProsesPerhitungan();
        // $proses_perhitungan->ket_kategori = 'PERAWAT ICCU';
        // $proses_perhitungan->proses = 'Ke 4';
        // $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['perawat_iccu'];
        // $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
        // $proses_perhitungan->id_ruangan = $id_ruangan;
        // $proses_perhitungan->created_at = now();
        // $proses_perhitungan->updated_at = now();
        // $proses_perhitungan->save();

        // $hasil[$row->id_data_pasien]['Ke 4']['perawat_rpp'] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "PERAWAT RPP");
        // $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['perawat_rpp'];
        // $proses_perhitungan = new ProsesPerhitungan();
        // $proses_perhitungan->ket_kategori = 'PERAWAT RPP';
        // $proses_perhitungan->proses = 'Ke 4';
        // $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['perawat_rpp'];
        // $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
        // $proses_perhitungan->id_ruangan = $id_ruangan;
        // $proses_perhitungan->created_at = now();
        // $proses_perhitungan->updated_at = now();
        // $proses_perhitungan->save();

        // // foreach($hasil[$row->id_data_pasien]['Ke 3']['detail_kategori_tindakan'] as $hasil_1 => $val) {
        // //     $data_kategori_tindakan = new KategoriTindakan();
        // //     $data_kategori_tindakans = $data_kategori_tindakan->ShowKategoriTindakan(ucfirst($hasil_1));

        // //     $hasil[$row->id_data_pasien]['Ke 4']['detail_kategori_tindakan'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, $data_kategori_tindakans->nama);
        // //     $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['detail_kategori_tindakan'][ucfirst($hasil_1)];
        // // }

        // foreach($hasil[$row->id_data_pasien]['Ke 3']['hasil_kategori_tindakan'] as $hasil_1 => $val) {
        //     $data_kategori_tindakan = new KategoriTindakan();
        //     $data_kategori_tindakans = $data_kategori_tindakan->ShowKategoriTindakan(ucfirst($hasil_1));

        //     if($data_kategori_tindakans != null) {
        //         $hasil[$row->id_data_pasien]['Ke 4']['hasil_kategori_tindakan'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, $data_kategori_tindakans->nama);
        //         $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
        //         $proses_perhitungan = new ProsesPerhitungan();
        //         $proses_perhitungan->ket_kategori = 'KATEGORI TINDAKAN';
        //         $proses_perhitungan->proses = 'Ke 4';
        //         $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['hasil_kategori_tindakan'][ucfirst($hasil_1)];
        //         $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
        //         $proses_perhitungan->id_kategori_tindakan = ucfirst($hasil_1);
        //         $proses_perhitungan->id_ruangan = $id_ruangan;
        //         $proses_perhitungan->created_at = now();
        //         $proses_perhitungan->updated_at = now();
        //         $proses_perhitungan->save();
        //     }
        // }
        
        // if(isset($hasil[$row->id_data_pasien]['Ke 3']['dokter'])) {
        //     foreach($hasil[$row->id_data_pasien]['Ke 3']['dokter'] as $hasil_1 => $val) {
        //         $hasil[$row->id_data_pasien]['Ke 4']['dokter'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "DOKTER IGD");
        //         $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['dokter'][ucfirst($hasil_1)];
        //         $proses_perhitungan = new ProsesPerhitungan();
        //         $proses_perhitungan->ket_kategori = 'DOKTER';
        //         $proses_perhitungan->proses = 'Ke 4';
        //         $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['dokter'][ucfirst($hasil_1)];
        //         $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
        //         $proses_perhitungan->id_dokter = ucfirst($hasil_1);
        //         $proses_perhitungan->id_ruangan = $id_ruangan;
        //         $proses_perhitungan->created_at = now();
        //         $proses_perhitungan->updated_at = now();
        //         $proses_perhitungan->save();
        //     }
        // }

        // if(isset($hasil[$row->id_data_pasien]['Ke 2']['visite'])) {
        //     foreach($hasil[$row->id_data_pasien]['Ke 3']['visite'] as $hasil_1 => $val) {
        //         $hasil[$row->id_data_pasien]['Ke 4']['visite'][ucfirst($hasil_1)] = $this->hitung_rumus($hasil[$row->id_data_pasien]['Ke 3'], $list_variable, "DOKTER VISITE");
        //         $tmp_total_ke_4 += $hasil[$row->id_data_pasien]['Ke 4']['visite'][ucfirst($hasil_1)];
        //     }
        //     $proses_perhitungan = new ProsesPerhitungan();
        //     $proses_perhitungan->ket_kategori = 'VISITE';
        //     $proses_perhitungan->proses = 'Ke 4';
        //     $proses_perhitungan->jumlah_jp = $hasil[$row->id_data_pasien]['Ke 4']['visite'][ucfirst($hasil_1)];
        //     $proses_perhitungan->id_data_pasien = $row->id_data_pasien;
        //     $proses_perhitungan->id_dokter = ucfirst($hasil_1);
        //     $proses_perhitungan->id_ruangan = $id_ruangan;
        //     $proses_perhitungan->created_at = now();
        //     $proses_perhitungan->updated_at = now();
        //     $proses_perhitungan->save();
        // }
        // $hasil[$row->id_data_pasien]['Ke 4']['total'] = $tmp_total_ke_4;
        // dd($hasil);

        return redirect('show_proses_perhitungan_rawat_jalan/'.$id_periode.'/'.$id_ruangan)->with('alert-success', 'Proses perhitungan telah berhasil!');
    }

    public function show_proses_perhitungan_rawat_jalan($id_periode, $id_ruangan) {
        $data_kategori_tindakan = new KategoriTindakan();
        $data_kategori_tindakans = $data_kategori_tindakan->SelectKategoriTindakan();

        $data_dokter = new Dokter();
        $data_dokters = $data_dokter->SelectDokter();

        $hasi = new ProsesPerhitungan();
        $hasil = $hasi->ShowProsesPerhitunganRawatJalan($id_periode, $id_ruangan); 

        $data_pasien = new DataPasien();
        $data_pasiens = $data_pasien->SelectDataPasienRawatJalan($id_periode, $id_ruangan);
        
        $id_periode = $id_periode;
        $id_ruangan = $id_ruangan;

        return view('proses_perhitungan.proses_perhitungan_rawat_jalan', compact('hasil', 'data_pasiens', 'data_dokters', 'data_kategori_tindakans', 'id_periode','id_ruangan'));
    }

    public function show_detail_proses_perhitungan_rawat_jalan($id_periode, $id_ruangan, $id_data_pasien) {
        $hasi = new ProsesPerhitungan();
        $hasil = $hasi->ShowDetailProsesPerhitunganRawatInap($id_periode, $id_ruangan, $id_data_pasien); 

        $data_pasien = new DataPasien();
        $data_pasiens = $data_pasien->ShowTindakanDataPasien($id_data_pasien);
        
        $id_periode = $id_periode;
        $id_ruangan = $id_ruangan;

        return view('proses_perhitungan.show_proses_perhitungan_rawat_jalan', compact('hasil', 'data_pasiens', 'id_periode','id_ruangan'));
    }
}
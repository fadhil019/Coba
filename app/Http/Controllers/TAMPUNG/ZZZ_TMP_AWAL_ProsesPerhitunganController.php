<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\KategoriTindakan;
use App\DataPasien;
use App\DataTindakanPasien;
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

    public function proses_perhitungan_1($id_periode, $id_ruangan, $reg_type) {
        $data_kategori_tindakan = new KategoriTindakan();
        $data_kategori_tindakans = $data_kategori_tindakan->SelectKategoriTindakan();

        $data_dokter = new Dokter();
        $data_dokters = $data_dokter->SelectDokter();

        // 

        $data_pasien = new DataPasien();
        if($reg_type == "RAWAT JALAN") {
            $data_pasiens = $data_pasien->SelectDataPasienRawatJalan($id_periode, $id_ruangan);
        } else {
            $data_pasiens = $data_pasien->SelectDataPasienRawatInap($id_periode, $id_ruangan);
        }

        $hasil = [];

        $proses_perhitungan = new ProsesPerhitungan;

        foreach($data_pasiens as $row) {
            $biaya_adm = $proses_perhitungan->ShowAdmPasien($row->id_data_pasien);
            // if($reg_type == "RAWAT JALAN") {
            //     $hasil[$row->id_data_pasien]['dpjp'] = '-';
            // } else {
            //     $hasil[$row->id_data_pasien]['dpjp'] = $row->nama_dokter;
            // }
            if($biaya_adm == null) {
                $hasil[$row->id_data_pasien]['adm']['adm'] = 0;
            } else {
                $hasil[$row->id_data_pasien]['adm']['adm'] = $biaya_adm->jumlah_jp;
            }
            $hasil[$row->id_data_pasien]['total'] = $hasil[$row->id_data_pasien]['adm']['adm'];

            $data_tindakan_pasien = new DataTindakanPasien();
            $data_tindakan_pasiens = $data_tindakan_pasien->SelectDataTindakanPasien($row->id_data_pasien);

            foreach ($data_tindakan_pasiens as $row_dtp) {
                $karyawan_perawats = DB::table('karyawan_perawat')
                    ->join('ruangan', 'karyawan_perawat.id_ruangan', '=', 'ruangan.id_ruangan')
                    ->where('karyawan_perawat.nama', '=', $row_dtp->nama_dokter_perawat)
                    ->where('ruangan.kategori_ruangan', '=', 'IGD')
                    ->first();

                if($karyawan_perawats != null) {
                    // perawat igd
                    if(!isset($hasil[$row->id_data_pasien]['perawat_igd'])) {
                        $hasil[$row->id_data_pasien]['perawat_igd'] = $row_dtp->jp;
                    } else {
                        $hasil[$row->id_data_pasien]['perawat_igd'] += $row_dtp->jp;
                    }
                } else {
                    // kategori tindakan lainnya
                    $hasil[$row->id_data_pasien]['detail_kategori_tindakan'][$row_dtp->id_kategori_tindakan] = $row_dtp->jp;

                    if(!isset($hasil[$row->id_data_pasien]['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan])) {
                        $hasil[$row->id_data_pasien]['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan] = $row_dtp->jp;
                    } else {
                        $hasil[$row->id_data_pasien]['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan] += $row_dtp->jp;
                    }    
                }
            }

            if(!isset($hasil[$row->id_data_pasien]['perawat_igd'])) {
                $hasil[$row->id_data_pasien]['perawat_igd'] = 0;
            }
            // $hasil[$row->id_data_pasien]['total'] += $hasil[$row->id_data_pasien]['hasil_kategori_tindakan'][$row_dtp->id_kategori_tindakan];
            // $hasil[$row->id_data_pasien]['total'] += $hasil[$row->id_data_pasien]['perawat_igd'];

            $biaya_gizi = $proses_perhitungan->ShowGiziPasien($row->id_data_pasien);
            if($biaya_gizi == null) {
                $hasil[$row->id_data_pasien]['gizi']['gizi'] = 0;
            } else {
                $hasil[$row->id_data_pasien]['gizi']['gizi'] = $biaya_gizi->jumlah_jp;
            }
            $hasil[$row->id_data_pasien]['total'] += $hasil[$row->id_data_pasien]['gizi']['gizi'];

            $dokter = DB::table('dokter')->where('nama_dokter', '=', $row->nama_dokter_perawat)->first();

            $biaya_dokter = 0;
            if($row->deskripsi_tindakan == "Administrasi Pasien IGD") {
                $biaya_dokter = 40000;
            } else {
                $biaya_dokter = 0;
            }

            $hasil[$row->id_data_pasien]['dokter'][$dokter->id_dokter] = $biaya_dokter;
            $hasil[$row->id_data_pasien]['total'] += $hasil[$row->id_data_pasien]['dokter'][$dokter->id_dokter];

            $data_visite_pasien = DB::table('proses_perhitungan')
            ->join('dokter', 'dokter.id_dokter', '=', 'proses_perhitungan.id_dokter')
            ->where('id_data_pasien', '=', $row->id_data_pasien)
            ->where('ket_kategori', '=', 'VISITE')
            ->where('proses', '=', 'Ke 1')
            ->get();

            foreach($data_visite_pasien as $row_visite) {
                $hasil[$row->id_data_pasien]['visite'][$row_visite->id_dokter] = $row_visite->jumlah_jp;
                $hasil[$row->id_data_pasien]['total'] += $hasil[$row->id_data_pasien]['visite'][$row_visite->id_dokter];
            }
        }
        // dd($data_pasiens);
        return view('proses_perhitungan.proses_perhitungan_1', compact('hasil', 'data_pasiens', 'data_dokters', 'data_kategori_tindakans'));
    }
}

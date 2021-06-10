<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Periode;
use App\DataPasien;
use App\DataTindakanPasien;
use App\DeskripsiTindakan;
use App\Dokter;
use App\Ruangan;
use App\ProsesPerhitungan;
use App\Transaksi;

use App\Imports\ImportDataPasien;
use App\Imports\ImportDataPasienRawatJalan;
use Maatwebsite\Excel\Facades\Excel;

use Session;

class DataPasienController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        session(['id_periode' => $request->id_periode]);
        session(['id_ruangan' => $request->id_ruangan]);

        $file = $request->file('excel_data_pasien');
 
        $nama_file = rand() . "_" . $file->getClientOriginalName();
 
        $file->move('excel',$nama_file);

        // Excel::import(new ImportDataPasien, public_path('excel/'.$nama_file));
        Excel::import(new ImportDataPasien, public_path('excel/'.$nama_file));

        $import_data_pasien_rawat_inap = 'success';
        if($import_data_pasien_rawat_inap == 'success')
        {
            return back()->with('alert-success','Data pasien berhasil diunggah!');
        }
        else
        {
            return back()->with('alert-failed', 'Data pasien tidak berhasil diunggah. Silahkan hubungi admin sistem!');
        }
    }

    public function importRj(Request $request)
    {
        session(['id_periode' => $request->id_periode]);
        session(['id_ruangan' => $request->id_ruangan]);

        $file = $request->file('excel_data_pasien');
 
        $nama_file = rand() . "_" . $file->getClientOriginalName();
 
        $file->move('excel',$nama_file);

        // Excel::import(new ImportDataPasien, public_path('excel/'.$nama_file));
        Excel::import(new ImportDataPasienRawatJalan, public_path('excel/'.$nama_file));

        $import_data_pasien_rawat_inap = 'success';
        if($import_data_pasien_rawat_inap == 'success')
        {
            return back()->with('alert-success','Data pasien berhasil diunggah!');
        }
        else
        {
            return back()->with('alert-failed', 'Data pasien tidak berhasil diunggah. Silahkan hubungi admin sistem!');
        }
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
        $update_data_pasien_dpjp = new Transaksi();
        $update_data_pasien_dpjps = $update_data_pasien_dpjp->UpdateDataPasienDPJP($request, $id);
        if($update_data_pasien_dpjps == 'success')
        {
            return back()->with('alert-success','Data dpjp pasien berhasil ditambahkan!');
        }
        else
        {
            return back()->with('alert-failed', 'Data dpjp pasien tidak berhasil ditambahkan. Silahkan hubungi admin sistem!');
        }
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

    // RAWAT INAP
        public function periode_pasien_rawat_inap()
        {
            $data_periode = new Periode();
            $data_periodes = $data_periode->SelectPeriodeDESC();

            return view('pasien.periode_rawat_inap', compact('data_periodes'));
        }

        public function ruangan_pasien_rawat_inap($id_periode)
        {
            $data_ruangan = new Ruangan();
            $data_ruangans = $data_ruangan->SelectRuangan();

            $data_periode = new Periode();
            $data_periodes = $data_periode->ShowPeriode($id_periode);

            return view('pasien.ruangan_rawat_inap', compact('data_ruangans', 'data_periodes'));
        }

        public function data_pasien_rawat_inap($id_periode, $id_ruangan)
        {
            $data_periode = new Periode();
            $data_periodes = $data_periode->SelectPeriode();

            $data_pasien_rawat_inap = new DataPasien();
            $data_pasien_rawat_inaps = $data_pasien_rawat_inap->SelectDataPasienRawatInap($id_periode, $id_ruangan);

            $data_dokter = new Dokter();
            $data_dokters = $data_dokter->SelectDokter();

            $data_ruangan = new Ruangan();
            $data_ruangans = $data_ruangan->SelectRuangan("Rawat inap");

            $show_ruangan = new Ruangan();
            $show_ruangans = $show_ruangan->ShowRuangan($id_ruangan);

            $show_periode = new Periode();
            $show_periodes = $show_periode->ShowPeriode($id_periode);

            $hasi = new ProsesPerhitungan();
            $hasil = $hasi->ShowProsesPerhitunganRawatInap($id_periode, $id_ruangan);

            // dd($hasil);
            return view('pasien.rawat_inap', compact('data_periodes', 'data_pasien_rawat_inaps', 'data_dokters', 'data_ruangans', 'show_ruangans', 'show_periodes', 'hasil'));
        }

        public function data_pasien_rawat_inap_tindakan($id)
        {
            $data_pasien_rawat_inap = new DataPasien();
            $data_pasien_rawat_inaps = $data_pasien_rawat_inap->ShowDataPasien($id);

            $data_tindakan_pasien = new DataTindakanPasien();
            $data_tindakan_pasiens = $data_tindakan_pasien->SelectDataTindakanPasien($id);

            $data_deskripsi_tindakan = new DeskripsiTindakan();
            $data_deskripsi_tindakans = $data_deskripsi_tindakan->SelectDeskripsiTindakan();

            return view('pasien.rawat_inap_tindakan', compact('data_pasien_rawat_inaps', 'data_tindakan_pasiens', 'data_deskripsi_tindakans'));
        }

        public function data_pasien_rawat_inap_tambah_tindakan($id, $id_ruangan)
        {
            $data_pasien_rawat_inap = new DataPasien();
            $data_pasien_rawat_inaps = $data_pasien_rawat_inap->ShowTindakanDataPasien($id);
            
            $data_tindakan_pasien = new DataTindakanPasien();
            $data_tindakan_pasiens = $data_tindakan_pasien->SelectDataTindakanPasien($id);
            // dd($data_tindakan_pasiens);
            $data_dokter = new Dokter();
            $data_dokters = $data_dokter->SelectDokter("Spesialis");

            $data_deskripsi_tindakan = new DeskripsiTindakan();
            $data_deskripsi_tindakans = $data_deskripsi_tindakan->SelectDeskripsiTindakan();

            $show_gizi_pasien = new ProsesPerhitungan();
            $show_gizi_pasiens = $show_gizi_pasien->ShowGiziPasien($id);

            $show_adm_pasien = new ProsesPerhitungan();
            $show_adm_pasiens = $show_adm_pasien->ShowAdmPasien($id);

            $show_visite_pasien = new ProsesPerhitungan();
            $show_visite_pasiens = $show_visite_pasien->ShowVisitePasien($id);
            
            $id_ruangan = $id_ruangan;

            return view('pasien.rawat_inap_tambah_tindakan', compact('data_pasien_rawat_inaps', 'data_tindakan_pasiens', 'data_deskripsi_tindakans', 'data_dokters', 'show_gizi_pasiens', 'show_adm_pasiens', 'show_visite_pasiens', 'id_ruangan'));
        }
    // END RAWAT INAP
    

    public function periode_pasien_rawat_jalan()
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->SelectPeriodeDESC();

        return view('pasien.periode_rawat_jalan', compact('data_periodes'));
    }

    public function ruangan_pasien_rawat_jalan($id_periode)
    {
        $data_ruangan = new Ruangan();
        $data_ruangans = $data_ruangan->SelectRuangan();

        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        return view('pasien.ruangan_rawat_jalan', compact('data_ruangans', 'data_periodes'));
    }
    
    public function data_pasien_rawat_jalan($id_periode, $id_ruangan)
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->SelectPeriode();

        $data_pasien_rawat_jalan = new DataPasien();
        $data_pasien_rawat_jalans = $data_pasien_rawat_jalan->SelectDataPasienRawatJalan($id_periode, $id_ruangan);

        $data_ruangan = new Ruangan();
        $data_ruangans = $data_ruangan->SelectRuangan("Rawat jalan");

        $show_ruangan = new Ruangan();
        $show_ruangans = $show_ruangan->ShowRuangan($id_ruangan);

        $show_periode = new Periode();
        $show_periodes = $show_periode->ShowPeriode($id_periode);

        $hasi = new ProsesPerhitungan();
        $hasil = $hasi->ShowProsesPerhitunganRawatJalan($id_periode, $id_ruangan);
        // dd($hasil);
        return view('pasien.rawat_jalan', compact('hasil', 'data_periodes', 'data_pasien_rawat_jalans', 'data_ruangans', 'show_ruangans', 'show_periodes'));
    }

    public function data_pasien_rawat_jalan_tindakan($id)
    {
        $data_pasien_rawat_jalan = new DataPasien();
        $data_pasien_rawat_jalans = $data_pasien_rawat_jalan->ShowDataPasien($id);

        $data_tindakan_pasien = new DataTindakanPasien();
        $data_tindakan_pasiens = $data_tindakan_pasien->SelectDataTindakanPasien($id);

        $data_deskripsi_tindakan = new DeskripsiTindakan();
        $data_deskripsi_tindakans = $data_deskripsi_tindakan->SelectDeskripsiTindakan();

        return view('pasien.rawat_jalan_tindakan', compact('data_pasien_rawat_jalans', 'data_tindakan_pasiens', 'data_deskripsi_tindakans'));
    }

}

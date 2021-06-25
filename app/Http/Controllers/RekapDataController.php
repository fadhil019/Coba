<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Periode;
use App\RekapData;

class RekapDataController extends Controller
{
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

    public function periode_rekap_data()
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->SelectPeriodeDESC();

        return view('rekap_data.periode_rekap_data', compact('data_periodes'));
    }

    public function daftar_rekap_data($id_periode)
    {
        $rekap_data_kategori_tindakans=array(); 
        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        $rekap_data_dokter = new RekapData();
        $rekap_data_dokters = $rekap_data_dokter->SelectRekapDataDokterPerPeriode($id_periode);

        $rekap_data_kategori_tindakan = new RekapData();
        $rekap_data_kategori_tindakans = $rekap_data_kategori_tindakan->SelectRekapDataKategoriTindakanPerPeriode($id_periode);
        // $i=0;
        // foreach ($rekap_data_kategori_tindakans as  $value) {
        //     $i ++;
        // }
        $rekap_data_ruangan = new RekapData();
        $rekap_data_ruangans = $rekap_data_ruangan->SelectRekapDataRuanganPerPeriode($id_periode);

        $rekap_data_admin_remu = new RekapData();
        $rekap_data_admin_remus = $rekap_data_admin_remu->SelectRekapDataAdminRemuPerPeriode($id_periode);

        $rekap_data_jtl = new RekapData();
        $rekap_data_jtls = $rekap_data_jtl->tampungJTL($id_periode);
        //dd($i);
        //dd($rekap_data_kategori_tindakans[3]['nama_kategori_tindakan']);
        return view('rekap_data.daftar_rekap_data', compact('data_periodes', 'rekap_data_dokters', 'rekap_data_kategori_tindakans', 'rekap_data_ruangans', 'rekap_data_admin_remus', 'rekap_data_jtls'));
    }

    public function detail_rekap_data_dokter($id_periode, $id_karyawan)
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        $rekap_data_dokter = new RekapData();
        $rekap_data_dokters = $rekap_data_dokter->DetailRekapDataDokterPerPeriode($id_periode, $id_karyawan);

        return view('rekap_data.detail_rekap_data_dokter', compact('data_periodes', 'rekap_data_dokters'));
    }

    public function detail_rekap_data_kategoritindakan($id_periode, $id_kt, $nama_kategori)
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        $rekap_data_kategori_tindakan = new RekapData();
        $rekap_data_kategori_tindakans = $rekap_data_kategori_tindakan->DetailRekapDataKategoriTindakanPerPeriode($id_periode, $id_kt);

        $rekap_data_jtl = new RekapData();
        $rekap_data_jtls = $rekap_data_jtl->tampungJTL($id_periode);
        //dd($rekap_data_kategori_tindakans);
        return view('rekap_data.detail_rekap_data_kategori_tindakan', compact('data_periodes', 'rekap_data_kategori_tindakans', 'nama_kategori', 'rekap_data_jtls'));
    }

    public function detail_rekap_data_ruangan($id_periode, $id_ruangan)
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        $rekap_data_ruangan = new RekapData();
        $rekap_data_ruangans = $rekap_data_ruangan->DetailRekapDataRuanganPerPeriode($id_periode, $id_ruangan);

        $rekap_data_jtl = new RekapData();
        $rekap_data_jtls = $rekap_data_jtl->tampungJTL($id_periode);

        return view('rekap_data.detail_rekap_data_ruangan', compact('data_periodes', 'rekap_data_ruangans', 'rekap_data_jtls'));
    }

    public function detail_rekap_data_admin($id_periode, $nama_kategori)
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        $rekap_data_admin_remu = new RekapData();
        $rekap_data_admin_remus = $rekap_data_admin_remu->DetailRekapDataAdminPerPeriode($id_periode, $nama_kategori);

        $rekap_data_jtl = new RekapData();
        $rekap_data_jtls = $rekap_data_jtl->tampungJTL($id_periode);
        //dd($rekap_data_admin_remus);
        return view('rekap_data.detail_rekap_data_admin', compact('data_periodes', 'rekap_data_admin_remus', 'nama_kategori' , 'rekap_data_jtls'));
    }

    public function cetak_pdf($id_periode, $nama_kategori)
    {
        
    }
}

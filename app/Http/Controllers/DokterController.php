<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Dokter;
use App\Ruangan;
use App\KategoriTindakan;

class DokterController extends Controller
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
        $data_dokter = new Dokter();
        $data_dokters = $data_dokter->SelectDokter();

        $data_ruangan = new Ruangan();
        $data_ruangans = $data_ruangan->SelectRuangan();

        $data_kategori_tindakan = new KategoriTindakan();
        $data_kategori_tindakans = $data_kategori_tindakan->SelectKategoriTindakanDokter();

        $data_bagians = ['Umum', 'Spesialis'];
        return view('dokter.index', compact('data_dokters', 'data_ruangans', 'data_bagians', 'data_kategori_tindakans'));
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
        $create_dokter = new Dokter();
        $create_dokters = $create_dokter->CreateDokter($request);
        if($create_dokters == 'success')
        {
            return back()->with('alert-success','Dokter berhasil dibuat!');
        }
        else
        {
            return back()->with('alert-failed', 'Dokter tidak berhasil dibuat. Silahkan hubungi admin sistem!');
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
        $update_dokter = new Dokter();
        $update_dokters = $update_dokter->UpdateDokter($request, $id);
        if($update_dokters == 'success')
        {
            return back()->with('alert-success','Dokter berhasil diubah!');
        }
        else
        {
            return back()->with('alert-failed', 'Dokter tidak berhasil diubah. Silahkan hubungi admin sistem!');
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
        $delete_dokter = new Dokter();
        $delete_dokters = $delete_dokter->DeleteDokter($id);
        if($delete_dokters == 'success')
        {
            return back()->with('alert-success','Dokter berhasil dihapus!');
        }
        else
        {
            return back()->with('alert-failed', 'Dokter tidak berhasil dihapus. Silahkan hubungi admin sistem!');
        }
    }
}

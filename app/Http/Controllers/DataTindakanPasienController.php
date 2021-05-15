<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataPasien;
use App\DataTindakanPasien;

class DataTindakanPasienController extends Controller
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
        $create_data_tindakan_pasien = new DataTindakanPasien();
        $create_data_tindakan_pasiens = $create_data_tindakan_pasien->CreateDataTindakanPasien($request);
        if($create_data_tindakan_pasiens == 'success')
        {
            return back()->with('alert-success','Data tindakan pasien berhasil dibuat!');
        }
        else
        {
            return back()->with('alert-failed', 'Data tindakan pasien tidak berhasil dibuat. Silahkan hubungi admin sistem!');
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
        $update_data_tindakan_pasien = new DataTindakanPasien();
        $update_data_tindakan_pasiens = $update_data_tindakan_pasien->UpdateDataTindakanPasien($request, $id);
        if($update_data_tindakan_pasiens == 'success')
        {
            return back()->with('alert-success','Data tindakan pasien berhasil diubah!');
        }
        else
        {
            return back()->with('alert-failed', 'Data tindakan pasien tidak berhasil diubah. Silahkan hubungi admin sistem!');
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
        $delete_data_tindakan_pasien = new DataTindakanPasien();
        $delete_data_tindakan_pasiens = $delete_data_tindakan_pasien->DeleteDataTindakanPasien($id);
        if($delete_data_tindakan_pasiens == 'success')
        {
            return back()->with('alert-success','Data tindakan pasien berhasil dihapus!');
        }
        else
        {
            return back()->with('alert-failed', 'Data tindakan pasien tidak berhasil dihapus. Silahkan hubungi admin sistem!');
        }
    }
}

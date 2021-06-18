<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\KategoriTindakan;
use App\VariableRumus;
use App\VariableRumusDetail;

class VariableRumusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kategori_tindakan = new KategoriTindakan();
        $data_kategori_tindakans = $data_kategori_tindakan->SelectKategoriTindakan();

        $show_varieble_rumus = new VariableRumus();
        $show_varieble_rumuss = $show_varieble_rumus->SelectVariableRumus();

        $variable_kategori = ["ADM", "KOMDIK", "DOKTER IGD", "DOKTER VISITE"];

        $data_ruangan = new Ruangan();
        $data_ruangans = $data_ruangan->SelectRuangan();

        foreach($data_ruangans as $row) {
            $variable_kategori[] = "PERAWAT " . $row->nama_ruangan;
        }

        return view('variable_rumus.index', compact('data_kategori_tindakans', 'show_varieble_rumuss', 'variable_kategori'));
    }

    public function daftar_rumus_kategori($id)
    {
        $data_kategori_tindakan = new KategoriTindakan();
        $data_kategori_tindakans = $data_kategori_tindakan->SelectKategoriTindakan();

        $show_data_kategori_tindakan = new KategoriTindakan();
        $show_data_kategori_tindakans = $show_data_kategori_tindakan->ShowKategoriTindakan($id);

        $show_varieble_rumus = new VariableRumus();
        $show_varieble_rumuss = $show_varieble_rumus->ShowVariableRumus($id);

        $show_varieble_rumus_detail = new VariableRumusDetail();
        $show_varieble_rumus_details = $show_varieble_rumus_detail->SelectVariableRumusDetail($id);

        return view('variable_rumus.detail', compact('data_kategori_tindakans', 'show_data_kategori_tindakans', 'show_varieble_rumuss', 'show_varieble_rumus_details'));
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
        $create_variable_rumus = new VariableRumus();
        $create_variable_rumuss = $create_variable_rumus->CreateUpdateVariableRumus($request);
        if($create_variable_rumuss == 'success')
        {
            return back()->with('alert-success','Variable rumus berhasil disimpan!');
        }
        else
        {
            return back()->with('alert-failed', 'Variable rumus tidak berhasil disimpan. Silahkan hubungi admin sistem!');
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
}

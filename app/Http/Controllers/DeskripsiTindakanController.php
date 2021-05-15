<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\KategoriTindakan;
use App\DeskripsiTindakan;

class DeskripsiTindakanController extends Controller
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
        $data_deskripsi_tindakan = new DeskripsiTindakan();
        $data_deskripsi_tindakans = $data_deskripsi_tindakan->SelectDeskripsiTindakan();

        $data_kategori_tindakan = new KategoriTindakan();
        $data_kategori_tindakans = $data_kategori_tindakan->SelectKategoriTindakan();
        return view('deskripsi_tindakan.index', compact('data_deskripsi_tindakans', 'data_kategori_tindakans'));
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
        $create_deskripsi_tindakan = new DeskripsiTindakan();
        $create_deskripsi_tindakans = $create_deskripsi_tindakan->CreateDeskripsiTindakan($request);
        if($create_deskripsi_tindakans == 'success')
        {
            return back()->with('alert-success','Deskripsi tindakan berhasil dibuat!');
        }
        else
        {
            return back()->with('alert-failed', 'Deskripsi tindakan tidak berhasil dibuat. Silahkan hubungi admin sistem!');
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
        $update_deskripsi_tindakan = new DeskripsiTindakan();
        $update_deskripsi_tindakans = $update_deskripsi_tindakan->UpdateDeskripsiTindakan($request, $id);
        if($update_deskripsi_tindakans == 'success')
        {
            return back()->with('alert-success','Deskripsi tindakan berhasil diubah!');
        }
        else
        {
            return back()->with('alert-failed', 'Deskripsi tindakan tidak berhasil diubah. Silahkan hubungi admin sistem!');
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
        $delete_deskripsi_tindakan = new DeskripsiTindakan();
        $delete_deskripsi_tindakans = $delete_deskripsi_tindakan->DeleteDeskripsiTindakan($id);
        if($delete_deskripsi_tindakans == 'success')
        {
            return back()->with('alert-success','Deskripsi tindakan berhasil dihapus!');
        }
        else
        {
            return back()->with('alert-failed', 'Deskripsi tindakan tidak berhasil dihapus. Silahkan hubungi admin sistem!');
        }
    }
}

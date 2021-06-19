<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\KategoriTindakan;

class KategoriTindakanController extends Controller
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
        $data_kategori_tindakan = new KategoriTindakan();
        $data_kategori_tindakans = $data_kategori_tindakan->SelectKategoriTindakan();

        $data_user = new User();
        $data_users = $data_user->SelectUser();

        $data_kategori_datas = ['Penunjang', 'Tindakan khusus dokter'];
        $data_prosess = ['Semua', 'Proses 3', 'Proses 4'];
        return view('kategori_tindakan.index', compact('data_kategori_tindakans', 'data_users', 'data_kategori_datas', 'data_prosess'));
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
        $create_kategori_tindakan = new KategoriTindakan();
        $create_kategori_tindakans = $create_kategori_tindakan->CreateKategoriTindakan($request);
        if($create_kategori_tindakans == 'success')
        {
            return back()->with('alert-success','Daftar kategori berhasil dibuat!');
        }
        else
        {
            return back()->with('alert-failed', 'Daftar kategori sudah ada!');
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
        $update_kategori_tindakan = new KategoriTindakan();
        $update_kategori_tindakans = $update_kategori_tindakan->UpdateKategoriTindakan($request, $id);
        if($update_kategori_tindakans == 'success')
        {
            return back()->with('alert-success','Daftar kategori berhasil diubah!');
        }
        else
        {
            return back()->with('alert-failed', 'Daftar kategori tidak berhasil diubah. Silahkan hubungi admin sistem!');
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
        $delete_kategori_tindakan = new KategoriTindakan();
        $delete_kategori_tindakans = $delete_kategori_tindakan->DeleteKategoriTindakan($id);
        if($delete_kategori_tindakans == 'success')
        {
            return back()->with('alert-success','Daftar kategori berhasil dihapus!');
        }
        else
        {
            return back()->with('alert-failed', 'Daftar kategori tidak berhasil dihapus. Silahkan hubungi admin sistem!');
        }
    }
}

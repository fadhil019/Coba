<?php

namespace App\Http\Controllers;

use App\Ruangan;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RuanganController extends Controller
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
        $data_ruangan = new Ruangan();
        $data_ruangans = $data_ruangan->SelectRuangan();

        $data_user = new User();
        $data_users = $data_user->SelectUser();

        $data_kategori_ruangans = ['Rawat inap', 'Rawat jalan', 'IGD'];
        return view('ruangan.index', compact('data_ruangans', 'data_users', 'data_kategori_ruangans'));
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
        $create_ruangan = new Ruangan();
        $create_ruangans = $create_ruangan->CreateRuangan($request);
        if($create_ruangans == 'success')
        {
            return back()->with('alert-success','Ruang kelas berhasil dibuat!');
        }
        else
        {
            return back()->with('alert-failed', 'Ruang kelas sudah ada!');
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
        $update_ruangan = new Ruangan();
        $update_ruangans = $update_ruangan->UpdateRuangan($request, $id);
        if($update_ruangans == 'success')
        {
            return back()->with('alert-success','Ruang kelas berhasil diubah!');
        }
        else
        {
            return back()->with('alert-failed', 'Ruang kelas tidak berhasil diubah. Silahkan hubungi admin sistem!');
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
        $delete_ruangan = new Ruangan();
        $delete_ruangans = $delete_ruangan->DeleteRuangan($id);
        if($delete_ruangans == 'success')
        {
            return back()->with('alert-success','Ruang kelas berhasil dihapus!');
        }
        else
        {
            return back()->with('alert-failed', 'Ruang kelas tidak berhasil dihapus. Silahkan hubungi admin sistem!');
        }
    }
}

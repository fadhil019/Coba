<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Ruangan;
use App\KaryawanPerawat;
use App\Periode;

class KaryawanPerawatController extends Controller
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
        $data_karyawan_perawat = new KaryawanPerawat();
        $data_karyawan_perawats = $data_karyawan_perawat->SelectKaryawanPerawat();

        $data_ruangan = new Ruangan();
        $data_ruangans = $data_ruangan->SelectRuangan();

        $data_user = new User();
        $data_users = $data_user->SelectUser();

        $data_jabatans = ['Kepala', 'Wakil', 'Karyawan'];
        return view('karyawan_perawat.index', compact('data_karyawan_perawats', 'data_ruangans', 'data_jabatans', 'data_users'));
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
        $create_karyawan_perawat = new KaryawanPerawat();
        $create_karyawan_perawats = $create_karyawan_perawat->CreateKaryawanPerawat($request);
        if($create_karyawan_perawats == 'success')
        {
            return back()->with('alert-success','Karyawan perawat berhasil dibuat!');
        }
        else
        {
            return back()->with('alert-failed', 'Karyawan perawat tidak berhasil dibuat. Silahkan hubungi admin sistem!');
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
        $update_karyawan_perawat = new KaryawanPerawat();
        $update_karyawan_perawats = $update_karyawan_perawat->UpdateKaryawanPerawat($request, $id);
        if($update_karyawan_perawats == 'success')
        {
            return back()->with('alert-success','Karyawan perawat berhasil diubah!');
        }
        else
        {
            return back()->with('alert-failed', 'Karyawan perawat tidak berhasil diubah. Silahkan hubungi admin sistem!');
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
        $delete_karyawan_perawat = new KaryawanPerawat();
        $delete_karyawan_perawats = $delete_karyawan_perawat->DeleteKaryawanPerawat($id);
        if($delete_karyawan_perawats == 'success')
        {
            return back()->with('alert-success','Karyawan perawat berhasil dihapus!');
        }
        else
        {
            return back()->with('alert-failed', 'Karyawan perawat tidak berhasil dihapus. Silahkan hubungi admin sistem!');
        }
    }

    public function index_point()
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->SelectPeriodeDESC();

        return view('karyawan_perawat.point.index', compact('data_periodes'));
    }

    public function index_point_karyawan($id_periode)
    {
        $data_karyawan_perawat = new KaryawanPerawat();
        $data_karyawan_perawats = $data_karyawan_perawat->SelectPointKaryawanPerawat($id_periode);

        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        return view('karyawan_perawat.point.point', compact('data_karyawan_perawats', 'data_periodes'));
    }

    public function generate_data_karyawan_perawat($id)
    {
        $generate_data_point_karyawan = new KaryawanPerawat();
        $generate_data_point_karyawans = $generate_data_point_karyawan->GenerateKaryawanPerawatPoint($id);
        if($generate_data_point_karyawans == 'success')
        {
            return back()->with('alert-success','Data karyawan berhasil ditambahkan!');
        }
        else
        {
            return back()->with('alert-failed', 'Data karyawan tidak berhasil ditambahkan. Silahkan hubungi admin sistem!');
        }
    }

    public function update_point_karyawan_perawat(Request $request, $id)
    {
        $update_point_karyawan_perawat = new KaryawanPerawat();
        $update_point_karyawan_perawats = $update_point_karyawan_perawat->UpdatePointKaryawanPerawat($request, $id);
        if($update_point_karyawan_perawats == 'success')
        {
            return back()->with('alert-success','Data point karyawan berhasil diperbarui!');
        }
        else
        {
            return back()->with('alert-failed', 'Data point karyawan tidak berhasil diperbarui. Silahkan hubungi admin sistem!');
        }
    }
}

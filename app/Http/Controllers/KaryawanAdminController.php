<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\KaryawanAdmin;
use App\Periode;

class KaryawanAdminController extends Controller
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
        $data_karyawan_admin = new KaryawanAdmin();
        $data_karyawan_admins = $data_karyawan_admin->SelectKaryawanAdmin();

        $data_bagians = ['Admin rekam medis', 'Admin umum', 'Struktural'];
        $data_jabatans = ['Kepala', 'Wakil', 'Karyawan'];
        return view('karyawan_admin.index', compact('data_karyawan_admins', 'data_bagians', 'data_jabatans'));
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
        $create_karyawan_admin = new KaryawanAdmin();
        $create_karyawan_admins = $create_karyawan_admin->CreateKaryawanAdmin($request);
        if($create_karyawan_admins == 'success')
        {
            return back()->with('alert-success','Karyawan admin berhasil dibuat!');
        }
        else
        {
            return back()->with('alert-failed', 'Karyawan admin tidak berhasil dibuat. Silahkan hubungi admin sistem!');
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
        $update_karyawan_admin = new KaryawanAdmin();
        $update_karyawan_admins = $update_karyawan_admin->UpdateKaryawanAdmin($request, $id);
        if($update_karyawan_admins == 'success')
        {
            return back()->with('alert-success','Karyawan admin berhasil diubah!');
        }
        else
        {
            return back()->with('alert-failed', 'Karyawan admin tidak berhasil diubah. Silahkan hubungi admin sistem!');
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
        $delete_karyawan_admin = new KaryawanAdmin();
        $delete_karyawan_admins = $delete_karyawan_admin->DeleteKaryawanAdmin($id);
        if($delete_karyawan_admins == 'success')
        {
            return back()->with('alert-success','Karyawan admin berhasil dihapus!');
        }
        else
        {
            return back()->with('alert-failed', 'Karyawan admin tidak berhasil dihapus. Silahkan hubungi admin sistem!');
        }
    }

    public function index_point()
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->SelectPeriodeDESC();

        return view('karyawan_admin.point.index', compact('data_periodes'));
    }

    public function index_point_karyawan($id_periode)
    {
        $data_karyawan_admin = new KaryawanAdmin();
        $data_karyawan_admins = $data_karyawan_admin->SelectPointKaryawanAdmin($id_periode);

        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        return view('karyawan_admin.point.point', compact('data_karyawan_admins', 'data_periodes'));
    }

    public function generate_data_karyawan_admin($id)
    {
        $generate_data_point_karyawan = new KaryawanAdmin();
        $generate_data_point_karyawans = $generate_data_point_karyawan->GenerateKaryawanAdminPoint($id);
        if($generate_data_point_karyawans == 'success')
        {
            return back()->with('alert-success','Data karyawan berhasil ditambahkan!');
        }
        else
        {
            return back()->with('alert-failed', 'Data karyawan tidak berhasil ditambahkan. Silahkan hubungi admin sistem!');
        }
    }

    public function update_point_karyawan_admin(Request $request, $id)
    {
        $update_point_karyawan_admin = new KaryawanAdmin();
        $update_point_karyawan_admins = $update_point_karyawan_admin->UpdatePointKaryawanAdmin($request, $id);
        if($update_point_karyawan_admins == 'success')
        {
            return back()->with('alert-success','Data point karyawan berhasil diperbarui!');
        }
        else
        {
            return back()->with('alert-failed', 'Data point karyawan tidak berhasil diperbarui. Silahkan hubungi admin sistem!');
        }
    }
}

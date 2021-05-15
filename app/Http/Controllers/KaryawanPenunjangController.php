<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\KaryawanPenunjang;
use App\KategoriTindakan;
use App\Periode;

class KaryawanPenunjangController extends Controller
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
        $data_karyawan_penunjang = new KaryawanPenunjang();
        $data_karyawan_penunjangs = $data_karyawan_penunjang->SelectKaryawanPenunjang();

        $data_kategori_tindakan = new KategoriTindakan();
        $data_kategori_tindakans = $data_kategori_tindakan->SelectKategoriTindakan();

        $data_jabatans = ['Kepala', 'Wakil', 'Karyawan'];
        return view('karyawan_penunjang.index', compact('data_karyawan_penunjangs', 'data_jabatans', 'data_kategori_tindakans'));
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
        $create_karyawan_penunjang = new KaryawanPenunjang();
        $create_karyawan_penunjangs = $create_karyawan_penunjang->CreateKaryawanPenunjang($request);
        if($create_karyawan_penunjangs == 'success')
        {
            return back()->with('alert-success','Karyawan penunjang berhasil dibuat!');
        }
        else
        {
            return back()->with('alert-failed', 'Karyawan penunjang tidak berhasil dibuat. Silahkan hubungi admin sistem!');
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
        $update_karyawan_penunjang = new KaryawanPenunjang();
        $update_karyawan_penunjangs = $update_karyawan_penunjang->UpdateKaryawanPenunjang($request, $id);
        if($update_karyawan_penunjangs == 'success')
        {
            return back()->with('alert-success','Karyawan penunjang berhasil diubah!');
        }
        else
        {
            return back()->with('alert-failed', 'Karyawan penunjang tidak berhasil diubah. Silahkan hubungi admin sistem!');
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
        $delete_karyawan_penunjang = new KaryawanPenunjang();
        $delete_karyawan_penunjangs = $delete_karyawan_penunjang->DeleteKaryawanPenunjang($id);
        if($delete_karyawan_penunjangs == 'success')
        {
            return back()->with('alert-success','Karyawan penunjang berhasil dihapus!');
        }
        else
        {
            return back()->with('alert-failed', 'Karyawan penunjang tidak berhasil dihapus. Silahkan hubungi admin sistem!');
        }
    }

    public function index_point()
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->SelectPeriodeDESC();

        return view('karyawan_penunjang.point.index', compact('data_periodes'));
    }

    public function index_point_karyawan($id_periode)
    {
        $data_karyawan_penunjang = new KaryawanPenunjang();
        $data_karyawan_penunjangs = $data_karyawan_penunjang->SelectPointKaryawanPenunjang($id_periode);

        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        return view('karyawan_penunjang.point.point', compact('data_karyawan_penunjangs', 'data_periodes'));
    }

    public function generate_data_karyawan_penunjang($id)
    {
        $generate_data_point_karyawan = new KaryawanPenunjang();
        $generate_data_point_karyawans = $generate_data_point_karyawan->GenerateKaryawanPenunjangPoint($id);
        if($generate_data_point_karyawans == 'success')
        {
            return back()->with('alert-success','Data karyawan berhasil ditambahkan!');
        }
        else
        {
            return back()->with('alert-failed', 'Data karyawan tidak berhasil ditambahkan. Silahkan hubungi admin sistem!');
        }
    }

    public function update_point_karyawan_penunjang(Request $request, $id)
    {
        $update_point_karyawan_penunjang = new KaryawanPenunjang();
        $update_point_karyawan_penunjangs = $update_point_karyawan_penunjang->UpdatePointKaryawanPenunjang($request, $id);
        if($update_point_karyawan_penunjangs == 'success')
        {
            return back()->with('alert-success','Data point karyawan berhasil diperbarui!');
        }
        else
        {
            return back()->with('alert-failed', 'Data point karyawan tidak berhasil diperbarui. Silahkan hubungi admin sistem!');
        }
    }
}

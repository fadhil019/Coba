<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Periode;
use App\Dashboard;

class DashboardController extends Controller
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
    
    public function daftar_dashboard($tahun)
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->SelectTahunPeriode();

        $data_dashboard = new Dashboard();
        $data_dashboards = $data_dashboard->SelectDashboard($tahun);
        
        
        $tahun = $tahun;
        return view('dashboard.index', compact('data_periodes', 'tahun', 'data_dashboards'));
    }

    public function dashboard_pilih_tahun(Request $request)
    {
        return redirect('daftar_dashboard/'.$request->dashboard_tahun)->with('alert-success', 'Menampilkan data pada tahun '.$request->dashboard_tahun.' !');
    }
}

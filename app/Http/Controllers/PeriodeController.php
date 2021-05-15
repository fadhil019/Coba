<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Periode;

class PeriodeController extends Controller
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
        $data_periode = new Periode();
        $data_periodes = $data_periode->SelectPeriodeDESC();

        $data_user = new User();
        $data_users = $data_user->SelectUser();
        return view('periode.index', compact('data_periodes', 'data_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create_periode = new Periode();
        $create_periodes = $create_periode->CreatePeriode($request);
        if($create_periodes == 'success')
        {
            return back()->with('alert-success','Periode berhasil dibuat!');
        }
        else
        {
            return back()->with('alert-failed', 'Periode tidak berhasil dibuat. Silahkan hubungi admin sistem!');
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
        $update_periode = new Periode();
        $update_periodes = $update_periode->UpdatePeriode($request, $id);
        if($update_periodes == 'success')
        {
            return back()->with('alert-success','Periode berhasil diubah!');
        }
        else
        {
            return back()->with('alert-failed', 'Periode tidak berhasil diubah. Silahkan hubungi admin sistem!');
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
        $delete_periode = new Periode();
        $delete_periodes = $delete_periode->DeletePeriode($id);
        if($delete_periodes == 'success')
        {
            return back()->with('alert-success','Periode berhasil dihapus!');
        }
        else
        {
            return back()->with('alert-failed', 'Periode tidak berhasil dihapus. Silahkan hubungi admin sistem!');
        }
    }
}

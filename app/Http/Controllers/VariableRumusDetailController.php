<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\KategoriTindakan;
use App\VariableRumus;
use App\VariableRumusDetail;

class VariableRumusDetailController extends Controller
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
        $update_variable_rumus_detail = new VariableRumusDetail();
        $update_variable_rumus_details = $update_variable_rumus_detail->UpdateVariableRumusDetail($request, $id);
        if($update_variable_rumus_details == 'success')
        {
            return back()->with('alert-success','Variable rumus berhasil disimpan!');
        }
        else
        {
            return back()->with('alert-failed', 'Variable rumus tidak berhasil disimpan. Silahkan hubungi admin sistem!');
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
        $delete_variable_rumus_detail = new VariableRumusDetail();
        $delete_variable_rumus_details = $delete_variable_rumus_detail->DeleteVariableRumusDetail($id);
        if($delete_variable_rumus_details == 'success')
        {
            return back()->with('alert-success','Variable rumus berhasil disimpan!');
        }
        else
        {
            return back()->with('alert-failed', 'Variable rumus tidak berhasil disimpan. Silahkan hubungi admin sistem!');
        }
    }
}

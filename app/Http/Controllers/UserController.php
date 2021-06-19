<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_user = new User();
        $data_users = $data_user->SelectUser();

        $data_bagians = ['Admin sistem', 'Admin remunerasi', 'Admin ruangan', 'Kolektif data', 'Manajemen remunerasi', 'Penunjang remunerasi', 'Perawat remunerasi'];
        return view('user.index', compact('data_users', 'data_bagians'));
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
        $create_user = new User();
        $create_users = $create_user->InsertUser($request);
        if($create_users == 'success')
        {
            return back()->with('alert-success','User berhasil dibuat!');
        }
        else
        {
            return back()->with('alert-failed', 'User tidak berhasil dibuat. Silahkan hubungi admin sistem!');
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
        $update_user = new User();
        $update_users = $update_user->UpdateUser($request, $id);
        if($update_users == 'success')
        {
            return back()->with('alert-success','User berhasil diubah!');
        }
        else
        {
            return back()->with('alert-failed', 'User tidak berhasil diubah. Silahkan hubungi admin sistem!');
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
        $delete_user = new User();
        $delete_users = $delete_user->DeleteUser($id);
        if($delete_users == 'success')
        {
            return back()->with('alert-success','User berhasil dihapus!');
        }
        else
        {
            return back()->with('alert-failed', 'User tidak berhasil dihapus. Silahkan hubungi admin sistem!');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Periode;
use App\DataKeuanganPasien;
use App\Imports\ImportDataKeuanganPasien;
use Maatwebsite\Excel\Facades\Excel;

use File;
use Response;
use Illuminate\Support\Facades\Storage;

use Session;

class DataKeuanganPasienController extends Controller
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

        $data_keuangan_pasien = new DataKeuanganPasien();
        $data_keuangan_pasiens = $data_keuangan_pasien->SelectDataKeuanganPasien();
        return view('data_keuangan_pasien.index', compact('data_periodes', 'data_keuangan_pasiens'));
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
        $create_data_keuangan_pasien = new DataKeuanganPasien();
        $create_data_keuangan_pasiens = $create_data_keuangan_pasien->CreateDataKeuanganPasien($request);
        if($create_data_keuangan_pasiens == 'success')
        {
            return back()->with('alert-success','Data keuangan pasien berhasil dibuat!');
        }
        else
        {
            return back()->with('alert-failed', 'Data keuangan pasien tidak berhasil dibuat. Silahkan hubungi admin sistem!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $periode = $request->id_periode;
        if ($periode == null) {
            return back()->with('alert-failed', 'Periode belum ada');
        }
        else
        {
            session(['id_periode' => $request->id_periode]);

            $file = $request->file('excel_data_keuangan_pasien');
        
            $nama_file = rand() . "_" . $file->getClientOriginalName();
 
            $file->move('excel',$nama_file);

       

            $import_data_keuangan_pasiens =  Excel::import(new ImportDataKeuanganPasien, public_path('excel/'.$nama_file));
            //dd($import_data_keuangan_pasiens);
            //$import_data_keuangan_pasiens = 'success';
            if($import_data_keuangan_pasiens == 'success')
            {
                return back()->with('alert-success','Terimakasih');
            }
            else
            {
                return back()->with('alert-failed', 'Data ada yang tidak tersimpan atau format excel salah');
            }
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
        $update_data_keuangan_pasien = new DataKeuanganPasien();
        $update_data_keuangan_pasiens = $update_data_keuangan_pasien->UpdateDataKeuanganPasien($request, $id);
        if($update_data_keuangan_pasiens == 'success')
        {
            return back()->with('alert-success','Data keuangan pasien berhasil diubah!');
        }
        else
        {
            return back()->with('alert-failed', 'Data keuangan pasien tidak berhasil diubah. Silahkan hubungi admin sistem!');
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
        $delete_data_keuangan_pasien = new DataKeuanganPasien();
        $delete_data_keuangan_pasiens = $delete_data_keuangan_pasien->DeleteDataKeuanganPasien($id);
        if($delete_data_keuangan_pasiens == 'success')
        {
            return back()->with('alert-success','Data keuangan pasien berhasil dihapus!');
        }
        else
        {
            return back()->with('alert-failed', 'Data keuangan pasien tidak berhasil dihapus. Silahkan hubungi admin sistem!');
        }
    }

     public function downloadformat()
    {
       // $file = "FORMAT_EXCEL_KEUANGAN.xlsx";
        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        //     $writer->save('FORMAT_EXCEL_KEUANGAN.xlsx');
        //     header('Content-Type: application/vnd.ms-excel');
        //     header('Content-Disposition: attachment; filename="FORMAT_EXCEL_KEUANGAN.xlsx"');
        //     $writer->save("php://output");
        //     exit;
        $file="FORMAT_EXCEL_KEUANGAN.xlsx";
        return Response::download($file);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProsesJPAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $hasil = [];
        $id_periode = 12;

        $data_penunjangs = DB::table('proses_perhitungan')
            ->join('transaksi', 'transaksi.id_transaksi', '=', 'proses_perhitungan.id_transaksi')
            ->where('transaksi.id_periode', $id_periode)
            ->where('proses_perhitungan.proses', 'Ke 4')
            ->where('proses_perhitungan.ket_kategori', 'ADM')
            ->select('*', DB::raw('SUM(proses_perhitungan.jumlah_jp) as total'))
            ->groupBy('proses_perhitungan.ket_kategori')
            ->get();

        foreach($data_penunjangs as $row) {
            $hasil['ADM']['JASPEL'] = $row->total;
            $hasil['ADM']['PM'] = ($row->total * 0.4) * 0.12;
            $hasil['ADM']['IKU'] = ($row->total * 0.4) * 0.48;
            $hasil['ADM']['IKI'] = ($row->total * 0.4) * 0.40;
        }

        $data_keuangan_pasien = DB::table('data_keuangan_pasien')
            ->where('id_periode', $id_periode)
            ->select('*', DB::raw('SUM(nominal_uang) as total'))
            ->groupBy('id_periode')
            ->get();

        foreach($data_penunjangs as $row) {
            $hasil['STRUKTURAL']['JASPEL'] = $row->total * 0.1;
            $hasil['STRUKTURAL']['PM'] = (($row->total * 0.1) * 0.4) * 0.12;
            $hasil['STRUKTURAL']['IKU'] = (($row->total * 0.1) * 0.4) * 0.48;
            $hasil['STRUKTURAL']['IKI'] = (($row->total * 0.1) * 0.4) * 0.40;
        }

        foreach($data_penunjangs as $row) {
            $hasil['UMUM']['JASPEL'] = $row->total * 0.05;
            $hasil['UMUM']['PM'] = (($row->total * 0.05) * 0.4) * 0.12;
            $hasil['UMUM']['IKU'] = (($row->total * 0.05) * 0.4) * 0.48;
            $hasil['UMUM']['IKI'] = (($row->total * 0.05) * 0.4) * 0.40;
        }

        $hasil_final = [];
        $penunjangs = DB::table('karyawan_admin')
            ->join('point_karyawan', 'karyawan_admin.id_karyawan_admin', 'karyawan_admin.id_karyawan_admin')
            ->get();

        $total_iki = 0;
        $total_iku = 0;
        $total_pm = 0;

        foreach($penunjangs as $row) {
            $hasil_final[$row->id_karyawan_admin]['ID'] = $row->id_karyawan_admin;
            $hasil_final[$row->id_karyawan_admin]['NAMA'] = $row->nama;
            $hasil_final[$row->id_karyawan_admin]['BAGIAN'] = $row->bagian;
            $hasil_final[$row->id_karyawan_admin]['KREDENTIAL'] = $row->kredential;
            $hasil_final[$row->id_karyawan_admin]['UNIT'] = $row->unit;
            $hasil_final[$row->id_karyawan_admin]['POSISI'] = $row->posisi;
            $hasil_final[$row->id_karyawan_admin]['IKU'] = $row->kredential + $row->unit + $row->posisi;            
            $hasil_final[$row->id_karyawan_admin]['PERFORMA'] = $row->performa;
            $hasil_final[$row->id_karyawan_admin]['DISIPIN'] = $row->disiplin;
            $hasil_final[$row->id_karyawan_admin]['KOMPLAIN'] = $row->komplain;
            $hasil_final[$row->id_karyawan_admin]['IKI'] = $row->performa + $row->disiplin + $row->komplain;        
            $hasil_final[$row->id_karyawan_admin]['PM'] = $row->pm;

            $total_iku += $hasil_final[$row->id_karyawan_admin]['IKU'];
            $total_iki += $hasil_final[$row->id_karyawan_admin]['IKI'];
            $total_pm += $hasil_final[$row->id_karyawan_admin]['PM'];
        }

        foreach($hasil_final as $row) {
            $index = "ADM";
            if($row['BAGIAN'] == "Struktural") {
                $index = "STRUKTURAL";
            }

            $hasil_final[$row['ID']]['UANG IKU'] = $row['IKU'] / $total_iku * $hasil[$index]['IKU'];
            $hasil_final[$row['ID']]['UANG IKI'] = $row['IKI'] / $total_iki * $hasil[$index]['IKI'];
            $hasil_final[$row['ID']]['UANG PM'] = $row['PM'] / $total_pm * $hasil[$index]['PM'];   
        }

        dd($hasil_final);
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
}

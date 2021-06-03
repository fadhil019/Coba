<?php

namespace App\Http\Controllers;

use App\ProsesJPPerawat;
use Illuminate\Http\Request;
use DB;

class ProsesJPPerawatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // proses upah 1

        $hasil = [];
        $id_periode = 12;

        $ruangans = DB::table('ruangan')
            ->leftjoin('proses_perhitungan', 'ruangan.id_ruangan', '=', 'proses_perhitungan.id_ruangan')
            ->join('transaksi', 'transaksi.id_transaksi', '=', 'proses_perhitungan.id_transaksi')
            ->where('transaksi.id_periode', $id_periode)
            ->where('proses_perhitungan.proses', 'Ke 4')
            ->select('*', DB::raw('SUM(proses_perhitungan.jumlah_jp) as total'))
            ->groupBy('ruangan.id_ruangan')
            ->get();

        foreach($ruangans as $row) {
            $hasil[$row->nama_ruangan]['JASPEL'] = $row->total;
            $hasil[$row->nama_ruangan]['PM'] = ($row->total * 0.4) * 0.12;
            $hasil[$row->nama_ruangan]['IKU'] = ($row->total * 0.4) * 0.48;
            $hasil[$row->nama_ruangan]['IKI'] = ($row->total * 0.4) * 0.40;
        }

        $hasil_final = [];
        $perawats = DB::table('karyawan_perawat')
            ->leftjoin('ruangan', 'ruangan.id_ruangan', '=', 'karyawan_perawat.id_ruangan')
            ->join('point_karyawan', 'karyawan_perawat.id_karyawan_perawat', 'karyawan_perawat.id_karyawan_perawat')
            ->get();

        $total_iki = 0;
        $total_iku = 0;
        $total_pm = 0;

        foreach($perawats as $row) {
            $hasil_final[$row->id_karyawan_perawat]['ID'] = $row->id_karyawan_perawat;
            $hasil_final[$row->id_karyawan_perawat]['NAMA'] = $row->nama;
            $hasil_final[$row->id_karyawan_perawat]['RUANG'] = $row->nama_ruangan;
            $hasil_final[$row->id_karyawan_perawat]['KREDENTIAL'] = $row->kredential;
            $hasil_final[$row->id_karyawan_perawat]['UNIT'] = $row->unit;
            $hasil_final[$row->id_karyawan_perawat]['POSISI'] = $row->posisi;
            $hasil_final[$row->id_karyawan_perawat]['IKU'] = $row->kredential + $row->unit + $row->posisi;            
            $hasil_final[$row->id_karyawan_perawat]['PERFORMA'] = $row->performa;
            $hasil_final[$row->id_karyawan_perawat]['DISIPIN'] = $row->disiplin;
            $hasil_final[$row->id_karyawan_perawat]['KOMPLAIN'] = $row->komplain;
            $hasil_final[$row->id_karyawan_perawat]['IKI'] = $row->performa + $row->disiplin + $row->komplain;        
            $hasil_final[$row->id_karyawan_perawat]['PM'] = $row->pm;

            $total_iku += $hasil_final[$row->id_karyawan_perawat]['IKU'];
            $total_iki += $hasil_final[$row->id_karyawan_perawat]['IKI'];
            $total_pm += $hasil_final[$row->id_karyawan_perawat]['PM'];
        }

        foreach($hasil_final as $row) {
            if(isset($hasil[$row['RUANG']])) {
                $hasil_final[$row['ID']]['UANG IKU'] = $row['IKU'] / $total_iku * $hasil[$row['RUANG']]['IKU'];
                $hasil_final[$row['ID']]['UANG IKI'] = $row['IKI'] / $total_iki * $hasil[$row['RUANG']]['IKI'];
                $hasil_final[$row['ID']]['UANG PM'] = $row['PM'] / $total_pm * $hasil[$row['RUANG']]['PM'];   
            } else {
                $hasil_final[$row['ID']]['UANG IKU'] = 0;
                $hasil_final[$row['ID']]['UANG IKI'] = 0;
                $hasil_final[$row['ID']]['UANG PM'] = 0;
            }
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
        // proses upah 2

        $hasil = [];
        $id_periode = 12;

        $ruangans = DB::table('ruangan')
            ->leftjoin('proses_perhitungan', 'ruangan.id_ruangan', '=', 'proses_perhitungan.id_ruangan')
            ->join('transaksi', 'transaksi.id_transaksi', '=', 'proses_perhitungan.id_transaksi')
            ->where('transaksi.id_periode', $id_periode)
            ->where('proses_perhitungan.proses', 'Ke 4')
            ->select('*', DB::raw('SUM(proses_perhitungan.jumlah_jp) as total'))
            ->groupBy('ruangan.id_ruangan')
            ->get();

        foreach($ruangans as $row) {
            $hasil[$row->nama_ruangan]['JASPEL'] = $row->total;
            $hasil[$row->nama_ruangan]['PM'] = ($row->total * 0.6) * 0.12;
            $hasil[$row->nama_ruangan]['IKU'] = ($row->total * 0.6) * 0.48;
            $hasil[$row->nama_ruangan]['IKI'] = ($row->total * 0.6) * 0.40;
        }

        $hasil_final = [];
        $perawats = DB::table('karyawan_perawat')
            ->leftjoin('ruangan', 'ruangan.id_ruangan', '=', 'karyawan_perawat.id_ruangan')
            ->join('point_karyawan', 'karyawan_perawat.id_karyawan_perawat', 'karyawan_perawat.id_karyawan_perawat')
            ->get();

        $total_iki = 0;
        $total_iku = 0;
        $total_pm = 0;

        foreach($perawats as $row) {
            $hasil_final[$row->id_karyawan_perawat]['ID'] = $row->id_karyawan_perawat;
            $hasil_final[$row->id_karyawan_perawat]['NAMA'] = $row->nama;
            $hasil_final[$row->id_karyawan_perawat]['RUANG'] = $row->nama_ruangan;
            $hasil_final[$row->id_karyawan_perawat]['KREDENTIAL'] = $row->kredential;
            $hasil_final[$row->id_karyawan_perawat]['UNIT'] = $row->unit;
            $hasil_final[$row->id_karyawan_perawat]['POSISI'] = $row->posisi;
            $hasil_final[$row->id_karyawan_perawat]['IKU'] = $row->kredential + $row->unit + $row->posisi;            
            $hasil_final[$row->id_karyawan_perawat]['PERFORMA'] = $row->performa;
            $hasil_final[$row->id_karyawan_perawat]['DISIPIN'] = $row->disiplin;
            $hasil_final[$row->id_karyawan_perawat]['KOMPLAIN'] = $row->komplain;
            $hasil_final[$row->id_karyawan_perawat]['IKI'] = $row->performa + $row->disiplin + $row->komplain;        
            $hasil_final[$row->id_karyawan_perawat]['PM'] = $row->pm;

            $total_iku += $hasil_final[$row->id_karyawan_perawat]['IKU'];
            $total_iki += $hasil_final[$row->id_karyawan_perawat]['IKI'];
            $total_pm += $hasil_final[$row->id_karyawan_perawat]['PM'];
        }

        foreach($hasil_final as $row) {
            if(isset($hasil[$row['RUANG']])) {
                $hasil_final[$row['ID']]['UANG IKU'] = $row['IKU'] / $total_iku * $hasil[$row['RUANG']]['IKU'];
                $hasil_final[$row['ID']]['UANG IKI'] = $row['IKI'] / $total_iki * $hasil[$row['RUANG']]['IKI'];
                $hasil_final[$row['ID']]['UANG PM'] = $row['PM'] / $total_pm * $hasil[$row['RUANG']]['PM'];   
            } else {
                $hasil_final[$row['ID']]['UANG IKU'] = 0;
                $hasil_final[$row['ID']]['UANG IKI'] = 0;
                $hasil_final[$row['ID']]['UANG PM'] = 0;
            }
        }

        dd($hasil_final);
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
     * @param  \App\ProsesJPPerawat  $prosesJPPerawat
     * @return \Illuminate\Http\Response
     */
    public function show(ProsesJPPerawat $prosesJPPerawat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProsesJPPerawat  $prosesJPPerawat
     * @return \Illuminate\Http\Response
     */
    public function edit(ProsesJPPerawat $prosesJPPerawat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProsesJPPerawat  $prosesJPPerawat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProsesJPPerawat $prosesJPPerawat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProsesJPPerawat  $prosesJPPerawat
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProsesJPPerawat $prosesJPPerawat)
    {
        //
    }
}

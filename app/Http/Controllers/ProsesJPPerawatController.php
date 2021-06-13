<?php

namespace App\Http\Controllers;

use App\ProsesJPPerawat;
use App\Periode;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // proses upah 2

        $hasil2 = [];
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
            $hasil2[$row->nama_ruangan]['JASPEL'] = $row->total;
            $hasil2[$row->nama_ruangan]['PM'] = ($row->total * 0.6) * 0.12;
            $hasil2[$row->nama_ruangan]['IKU'] = ($row->total * 0.6) * 0.48;
            $hasil2[$row->nama_ruangan]['IKI'] = ($row->total * 0.6) * 0.40;
        }

        $hasil2_final = [];
        $perawats = DB::table('karyawan_perawat')
            ->leftjoin('ruangan', 'ruangan.id_ruangan', '=', 'karyawan_perawat.id_ruangan')
            ->join('point_karyawan', 'karyawan_perawat.id_karyawan_perawat', 'karyawan_perawat.id_karyawan_perawat')
            ->get();

        $total_iki = 0;
        $total_iku = 0;
        $total_pm = 0;

        foreach($perawats as $row) {
            $hasil2_final[$row->id_karyawan_perawat]['ID'] = $row->id_karyawan_perawat;
            $hasil2_final[$row->id_karyawan_perawat]['NAMA'] = $row->nama;
            $hasil2_final[$row->id_karyawan_perawat]['RUANG'] = $row->nama_ruangan;
            $hasil2_final[$row->id_karyawan_perawat]['KREDENTIAL'] = $row->kredential;
            $hasil2_final[$row->id_karyawan_perawat]['UNIT'] = $row->unit;
            $hasil2_final[$row->id_karyawan_perawat]['POSISI'] = $row->posisi;
            $hasil2_final[$row->id_karyawan_perawat]['IKU'] = $row->kredential + $row->unit + $row->posisi;            
            $hasil2_final[$row->id_karyawan_perawat]['PERFORMA'] = $row->performa;
            $hasil2_final[$row->id_karyawan_perawat]['DISIPIN'] = $row->disiplin;
            $hasil2_final[$row->id_karyawan_perawat]['KOMPLAIN'] = $row->komplain;
            $hasil2_final[$row->id_karyawan_perawat]['IKI'] = $row->performa + $row->disiplin + $row->komplain;        
            $hasil2_final[$row->id_karyawan_perawat]['PM'] = $row->pm;

            $total_iku += $hasil2_final[$row->id_karyawan_perawat]['IKU'];
            $total_iki += $hasil2_final[$row->id_karyawan_perawat]['IKI'];
            $total_pm += $hasil2_final[$row->id_karyawan_perawat]['PM'];
        }

        foreach($hasil2_final as $row) {
            if(isset($hasil2[$row['RUANG']])) {
                $hasil2_final[$row['ID']]['UANG IKU'] = $row['IKU'] / $total_iku * $hasil2[$row['RUANG']]['IKU'];
                $hasil2_final[$row['ID']]['UANG IKI'] = $row['IKI'] / $total_iki * $hasil2[$row['RUANG']]['IKI'];
                $hasil2_final[$row['ID']]['UANG PM'] = $row['PM'] / $total_pm * $hasil2[$row['RUANG']]['PM'];   
            } else {
                $hasil2_final[$row['ID']]['UANG IKU'] = 0;
                $hasil2_final[$row['ID']]['UANG IKI'] = 0;
                $hasil2_final[$row['ID']]['UANG PM'] = 0;
            }
        }

        dd($hasil2_final);
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

    // public function proses_upah_perawat($id_periode, $kategori_ruangan)
    public function proses_upah_perawat($id_periode)
    {
        $hasil1 = [];
        $hasil2 = [];
        $rekap_data = new RekapData();
        $rekap_datas = $rekap_data->tampungJTL($id_periode);
        $ruangans = DB::table('ruangan')
            ->leftjoin('proses_perhitungan', 'ruangan.id_ruangan', '=', 'proses_perhitungan.id_ruangan')
            ->join('transaksi', 'transaksi.id_transaksi', '=', 'proses_perhitungan.id_transaksi')
            ->where('transaksi.id_periode', $id_periode)
            ->where('proses_perhitungan.proses', 'Ke 4')
            ->select('*', DB::raw('SUM(proses_perhitungan.jumlah_jp) as total'))
            ->groupBy('ruangan.id_ruangan')
            ->get();

        foreach($ruangans as $row) {
            if($row->kategori_ruangan == "Rawat Jalan") {
                $hasil1[$row->nama_ruangan]['JASPEL'] = $row->total + $rekap_datas['JTL'][0]['upah_jasa'];
                $hasil1[$row->nama_ruangan]['PM'] = 0;
                $hasil1[$row->nama_ruangan]['IKU'] = ($row->total * 0.4) * 0.6;
                $hasil1[$row->nama_ruangan]['IKI'] = ($row->total * 0.4) * 0.4;
            } else {
                $hasil1[$row->nama_ruangan]['JASPEL'] = $row->total + $rekap_datas['JTL'][0]['upah_jasa'];
                $hasil1[$row->nama_ruangan]['PM'] = ($row->total * 0.4) * 0.12;
                $hasil1[$row->nama_ruangan]['IKU'] = ($row->total * 0.4) * 0.48;
                $hasil1[$row->nama_ruangan]['IKI'] = ($row->total * 0.4) * 0.40;
            }
                
            $hasil2[$row->nama_ruangan]['JASPEL'] = $row->total + $rekap_datas['JTL'][0]['upah_jasa'];
            $hasil2[$row->nama_ruangan]['PM'] = ($row->total * 0.6) * 0.12;
            $hasil2[$row->nama_ruangan]['IKU'] = ($row->total * 0.6) * 0.48;
            $hasil2[$row->nama_ruangan]['IKI'] = ($row->total * 0.6) * 0.40;   
        }

        $hasil1_final = [];
        $hasil2_final = [];
        $perawats = DB::table('karyawan_perawat')
            ->leftjoin('ruangan', 'ruangan.id_ruangan', '=', 'karyawan_perawat.id_ruangan')
            ->join('point_karyawan', 'point_karyawan.id_karyawan_perawat', 'karyawan_perawat.id_karyawan_perawat')
            ->get();

        $total1_iki = 0;
        $total1_iku = 0;
        $total1_pm = 0;

        $total2_iki = 0;
        $total2_iku = 0;
        $total2_pm = 0;
        foreach($perawats as $row) {
            $hasil1_final[$row->id_karyawan_perawat]['ID'] = $row->id_karyawan_perawat;
            $hasil1_final[$row->id_karyawan_perawat]['NAMA'] = $row->nama;
            $hasil1_final[$row->id_karyawan_perawat]['ID_RUANG'] = $row->id_ruangan;
            $hasil1_final[$row->id_karyawan_perawat]['RUANG'] = $row->nama_ruangan;
            $hasil1_final[$row->id_karyawan_perawat]['KREDENTIAL'] = $row->kredential;
            $hasil1_final[$row->id_karyawan_perawat]['UNIT'] = $row->unit;
            $hasil1_final[$row->id_karyawan_perawat]['POSISI'] = $row->posisi;
            $hasil1_final[$row->id_karyawan_perawat]['IKU'] = $row->kredential + $row->unit + $row->posisi;            
            $hasil1_final[$row->id_karyawan_perawat]['PERFORMA'] = $row->performa;
            $hasil1_final[$row->id_karyawan_perawat]['DISIPIN'] = $row->disiplin;
            $hasil1_final[$row->id_karyawan_perawat]['KOMPLAIN'] = $row->komplain;
            $hasil1_final[$row->id_karyawan_perawat]['IKI'] = $row->performa + $row->disiplin + $row->komplain;        
            $hasil1_final[$row->id_karyawan_perawat]['PM'] = $row->pm;

            $total1_iku += $hasil1_final[$row->id_karyawan_perawat]['IKU'];
            $total1_iki += $hasil1_final[$row->id_karyawan_perawat]['IKI'];
            $total1_pm += $hasil1_final[$row->id_karyawan_perawat]['PM'];

            $hasil2_final[$row->id_karyawan_perawat]['ID'] = $row->id_karyawan_perawat;
            $hasil2_final[$row->id_karyawan_perawat]['NAMA'] = $row->nama;
            $hasil2_final[$row->id_karyawan_perawat]['ID_RUANG'] = $row->id_ruangan;
            $hasil2_final[$row->id_karyawan_perawat]['RUANG'] = $row->nama_ruangan;
            $hasil2_final[$row->id_karyawan_perawat]['KREDENTIAL'] = $row->kredential;
            $hasil2_final[$row->id_karyawan_perawat]['UNIT'] = $row->unit;
            $hasil2_final[$row->id_karyawan_perawat]['POSISI'] = $row->posisi;
            $hasil2_final[$row->id_karyawan_perawat]['IKU'] = $row->kredential + $row->unit + $row->posisi;            
            $hasil2_final[$row->id_karyawan_perawat]['PERFORMA'] = $row->performa;
            $hasil2_final[$row->id_karyawan_perawat]['DISIPIN'] = $row->disiplin;
            $hasil2_final[$row->id_karyawan_perawat]['KOMPLAIN'] = $row->komplain;
            $hasil2_final[$row->id_karyawan_perawat]['IKI'] = $row->performa + $row->disiplin + $row->komplain;        
            $hasil2_final[$row->id_karyawan_perawat]['PM'] = $row->pm;

            $total2_iku += $hasil2_final[$row->id_karyawan_perawat]['IKU'];
            $total2_iki += $hasil2_final[$row->id_karyawan_perawat]['IKI'];
            $total2_pm += $hasil2_final[$row->id_karyawan_perawat]['PM'];
        }

        foreach($hasil1_final as $row) {
            if(isset($hasil1[$row['RUANG']])) {
                $hasil1_final[$row['ID']]['UANG IKU'] = $row['IKU'] / $total1_iku * $hasil1[$row['RUANG']]['IKU'];
                $hasil1_final[$row['ID']]['UANG IKI'] = $row['IKI'] / $total1_iki * $hasil1[$row['RUANG']]['IKI'];
                $hasil1_final[$row['ID']]['UANG PM'] = $row['PM'] / $total1_pm * $hasil1[$row['RUANG']]['PM'];   
            } else {
                $hasil1_final[$row['ID']]['UANG IKU'] = 0;
                $hasil1_final[$row['ID']]['UANG IKI'] = 0;
                $hasil1_final[$row['ID']]['UANG PM'] = 0;
            }
        }

        foreach($hasil2_final as $row) {
            if(isset($hasil2[$row['RUANG']])) {
                $hasil2_final[$row['ID']]['UANG IKU'] = $row['IKU'] / $total2_iku * $hasil2[$row['RUANG']]['IKU'];
                $hasil2_final[$row['ID']]['UANG IKI'] = $row['IKI'] / $total2_iki * $hasil2[$row['RUANG']]['IKI'];
                $hasil2_final[$row['ID']]['UANG PM'] = $row['PM'] / $total2_pm * $hasil2[$row['RUANG']]['PM'];   
            } else {
                $hasil2_final[$row['ID']]['UANG IKU'] = 0;
                $hasil2_final[$row['ID']]['UANG IKI'] = 0;
                $hasil2_final[$row['ID']]['UANG PM'] = 0;
            }
        }

        foreach($hasil1_final as $row) {
            $proses_hitung_jp_perawat = new ProsesJPPerawat();
            $proses_hitung_jp_perawat->iku = $hasil1_final[$row['ID']]['UANG IKU'];
            $proses_hitung_jp_perawat->iki = $hasil1_final[$row['ID']]['UANG IKI'];
            $proses_hitung_jp_perawat->pm = $hasil1_final[$row['ID']]['UANG PM'];
            $proses_hitung_jp_perawat->tahapan = 1;
            $proses_hitung_jp_perawat->id_periode = $id_periode;
            $proses_hitung_jp_perawat->id_ruangan = $hasil1_final[$row['ID']]['ID_RUANG'];
            $proses_hitung_jp_perawat->id_karyawan_perawat = $hasil1_final[$row['ID']]['ID'];
            $proses_hitung_jp_perawat->created_at = now();
            $proses_hitung_jp_perawat->updated_at = now();
            $proses_hitung_jp_perawat->save();
        }
        foreach($hasil2_final as $row) {
            $proses_hitung_jp_perawat = new ProsesJPPerawat();
            $proses_hitung_jp_perawat->iku = $hasil2_final[$row['ID']]['UANG IKU'];
            $proses_hitung_jp_perawat->iki = $hasil2_final[$row['ID']]['UANG IKI'];
            $proses_hitung_jp_perawat->pm = $hasil2_final[$row['ID']]['UANG PM'];
            $proses_hitung_jp_perawat->tahapan = 2;
            $proses_hitung_jp_perawat->id_periode = $id_periode;
            $proses_hitung_jp_perawat->id_ruangan = $hasil2_final[$row['ID']]['ID_RUANG'];
            $proses_hitung_jp_perawat->id_karyawan_perawat = $hasil2_final[$row['ID']]['ID'];
            $proses_hitung_jp_perawat->created_at = now();
            $proses_hitung_jp_perawat->updated_at = now();
            $proses_hitung_jp_perawat->save();
        }
        // dd($hasil1_final);
        return redirect('daftar_upah_karyawan_perawat/'.$id_periode)->with('alert-success', 'Proses perhitungan telah berhasil!'); 
    }

    public function index_upah()
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->SelectPeriodeDESC();

        return view('karyawan_perawat.upah.index', compact('data_periodes'));
    }

    public function daftar_upah_karyawan_perawat($id_periode)
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        $data_upah_perawat = new ProsesJPPerawat();
        $data_upah_perawats = $data_upah_perawat->SelectDaftarUpahPerawat($id_periode);

        return view('karyawan_perawat.upah.upah', compact('data_upah_perawats', 'data_periodes'));
    }

    public function detail_upah_karyawan_perawat($id_periode, $id_karyawan_perawat)
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        $data_upah_perawat = new ProsesJPPerawat();
        $data_upah_perawats = $data_upah_perawat->SelectDetailUpahPerawat($id_periode, $id_karyawan_perawat);

        return view('karyawan_perawat.upah.upah_detail', compact('data_upah_perawats', 'data_periodes'));
    }
}

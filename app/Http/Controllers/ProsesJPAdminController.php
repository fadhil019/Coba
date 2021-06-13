<?php

namespace App\Http\Controllers;

use App\ProsesJPAdmin;
use App\Periode;
use App\Rekapdata;

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

        // $hasil = [];
        // $id_periode = 14;

        // $data_admins = DB::table('proses_perhitungan')
        //     ->join('transaksi', 'transaksi.id_transaksi', '=', 'proses_perhitungan.id_transaksi')
        //     ->where('transaksi.id_periode', $id_periode)
        //     ->where('proses_perhitungan.proses', 'Ke 4')
        //     ->where('proses_perhitungan.ket_kategori', 'ADM')
        //     ->select('*', DB::raw('SUM(proses_perhitungan.jumlah_jp) as total'))
        //     ->groupBy('proses_perhitungan.ket_kategori')
        //     ->get();

        // foreach($data_admins as $row) {
        //     $hasil['ADM']['JASPEL'] = $row->total;
        //     $hasil['ADM']['PM'] = $row->total * 0.1;
        //     $hasil['ADM']['IKU'] = $row->total * 0.5;
        //     $hasil['ADM']['IKI'] = $row->total * 0.4;
        // }

        // $data_keuangan_pasien = DB::table('data_keuangan_pasien')
        //     ->where('id_periode', $id_periode)
        //     ->select('*', DB::raw('SUM(nominal_uang) as total'))
        //     ->groupBy('id_periode')
        //     ->get();

        // foreach($data_keuangan_pasien as $row) {
        //     $hasil['STRUKTURAL']['JASPEL'] = $row->total * 0.1;
        //     $hasil['STRUKTURAL']['PM'] = $hasil['STRUKTURAL']['JASPEL'] * 0.1;
        //     $hasil['STRUKTURAL']['IKU'] = $hasil['STRUKTURAL']['JASPEL'] * 0.5;
        //     $hasil['STRUKTURAL']['IKI'] = $hasil['STRUKTURAL']['JASPEL'] * 0.4;
        // }

        // foreach($data_keuangan_pasien as $row) {
        //     $hasil['UMUM']['JASPEL'] = $row->total * 0.05;
        //     $hasil['UMUM']['PM'] = $hasil['UMUM']['JASPEL'] * 0.1;
        //     $hasil['UMUM']['IKU'] = $hasil['UMUM']['JASPEL'] * 0.5;
        //     $hasil['UMUM']['IKI'] = $hasil['UMUM']['JASPEL'] * 0.4;
        // }

        // $hasil_final = [];
        // $admins = DB::table('karyawan_admin')
        //     ->join('point_karyawan', 'point_karyawan.id_karyawan_admin', 'karyawan_admin.id_karyawan_admin')
        //     ->get();

        // $total_iki = 0;
        // $total_iku = 0;
        // $total_pm = 0;

        // foreach($admins as $row) {
        //     $hasil_final[$row->id_karyawan_admin]['ID'] = $row->id_karyawan_admin;
        //     $hasil_final[$row->id_karyawan_admin]['NAMA'] = $row->nama;
        //     $hasil_final[$row->id_karyawan_admin]['BAGIAN'] = $row->bagian;
        //     $hasil_final[$row->id_karyawan_admin]['KREDENTIAL'] = $row->kredential;
        //     $hasil_final[$row->id_karyawan_admin]['UNIT'] = $row->unit;
        //     $hasil_final[$row->id_karyawan_admin]['POSISI'] = $row->posisi;
        //     $hasil_final[$row->id_karyawan_admin]['IKU'] = $row->kredential + $row->unit + $row->posisi;            
        //     $hasil_final[$row->id_karyawan_admin]['PERFORMA'] = $row->performa;
        //     $hasil_final[$row->id_karyawan_admin]['DISIPIN'] = $row->disiplin;
        //     $hasil_final[$row->id_karyawan_admin]['KOMPLAIN'] = $row->komplain;
        //     $hasil_final[$row->id_karyawan_admin]['IKI'] = $row->performa + $row->disiplin + $row->komplain;        
        //     $hasil_final[$row->id_karyawan_admin]['PM'] = $row->pm;

        //     $total_iku += $hasil_final[$row->id_karyawan_admin]['IKU'];
        //     $total_iki += $hasil_final[$row->id_karyawan_admin]['IKI'];
        //     $total_pm += $hasil_final[$row->id_karyawan_admin]['PM'];
        // }

        // foreach($hasil_final as $row) {
        //     $index = "ADM";
        //     if($row['BAGIAN'] == "Struktural") {
        //         $index = "STRUKTURAL";
        //     } else if($row['BAGIAN'] == "ADM") {
        //         $index = "ADM";
        //     } else {
        //         $index = "UMUM";
        //     }

        //     if($row['IKU'] != 0) {
        //         $hasil_final[$row['ID']]['UANG IKU'] = $row['IKU'] / $total_iku * $hasil[$index]['IKU'];
        //     } 
        //     else {
        //         $hasil_final[$row['ID']]['UANG IKU'] = 0;
        //     }

        //     if($row['IKI'] != 0) {
        //         $hasil_final[$row['ID']]['UANG IKI'] = $row['IKI'] / $total_iki * $hasil[$index]['IKI'];
        //     } 
        //     else {
        //         $hasil_final[$row['ID']]['UANG IKI'] = 0;
        //     }

        //     if($row['PM'] != 0) {
        //         $hasil_final[$row['ID']]['UANG PM'] = $row['PM'] / $total_pm * $hasil[$index]['PM'];   
        //     } 
        //     else {
        //         $hasil_final[$row['ID']]['UANG PM'] = 0;
        //     }
            
        // }

        // foreach($hasil_final as $row) {
        //     $proses_hitung_jp_admin = new ProsesJPAdmin();
        //     $proses_hitung_jp_admin->iku = $hasil_final[$row['ID']]['UANG IKU'];
        //     $proses_hitung_jp_admin->iki = $hasil_final[$row['ID']]['UANG IKI'];
        //     $proses_hitung_jp_admin->pm = $hasil_final[$row['ID']]['UANG PM'];
        //     $proses_hitung_jp_admin->id_periode = $id_periode;
        //     $proses_hitung_jp_admin->id_karyawan_admin = $hasil_final[$row['ID']]['ID'];
        //     $proses_hitung_jp_admin->created_at = now();
        //     $proses_hitung_jp_admin->updated_at = now();
        //     $proses_hitung_jp_admin->save();
        // }

        // dd($hasil_final);
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

    public function proses_upah_admin($id_periode)
    {
        //

        $hasil = [];
        // $id_periode = 14;
        $rekap_data = new RekapData();
        $rekap_datas = $rekap_data->tampungJTL($id_periode);

        $data_admins = DB::table('proses_perhitungan')
            ->join('transaksi', 'transaksi.id_transaksi', '=', 'proses_perhitungan.id_transaksi')
            ->where('transaksi.id_periode', $id_periode)
            ->where('proses_perhitungan.proses', 'Ke 4')
            ->where('proses_perhitungan.ket_kategori', 'ADM')
            ->select('*', DB::raw('SUM(proses_perhitungan.jumlah_jp) as total'))
            ->groupBy('proses_perhitungan.ket_kategori')
            ->get();

        foreach($data_admins as $row) {
            $hasil['ADM']['JASPEL'] = $row->total + $rekap_datas['JTL'][0]['upah_jasa'];
            $hasil['ADM']['PM'] = $hasil['ADM']['JASPEL'] * 0.1;
            $hasil['ADM']['IKU'] = $hasil['ADM']['JASPEL'] * 0.5;
            $hasil['ADM']['IKI'] = $hasil['ADM']['JASPEL'] * 0.4;
        }

        $data_keuangan_pasien = DB::table('data_keuangan_pasien')
            ->where('id_periode', $id_periode)
            ->select('*', DB::raw('SUM(nominal_uang) as total'))
            ->groupBy('id_periode')
            ->get();

        foreach($data_keuangan_pasien as $row) {
            $hasil['STRUKTURAL']['JASPEL'] = $row->total * 0.1 + $rekap_datas['JTL'][0]['upah_jasa'];
            $hasil['STRUKTURAL']['PM'] = $hasil['STRUKTURAL']['JASPEL'] * 0.1;
            $hasil['STRUKTURAL']['IKU'] = $hasil['STRUKTURAL']['JASPEL'] * 0.5;
            $hasil['STRUKTURAL']['IKI'] = $hasil['STRUKTURAL']['JASPEL'] * 0.4;
        }

        foreach($data_keuangan_pasien as $row) {
            $hasil['UMUM']['JASPEL'] = $row->total * 0.05 + $rekap_datas['JTL'][0]['upah_jasa'];
            $hasil['UMUM']['PM'] = $hasil['UMUM']['JASPEL'] * 0.1;
            $hasil['UMUM']['IKU'] = $hasil['UMUM']['JASPEL'] * 0.5;
            $hasil['UMUM']['IKI'] = $hasil['UMUM']['JASPEL'] * 0.4;
        }

        $hasil_final = [];
        $admins = DB::table('karyawan_admin')
            ->join('point_karyawan', 'point_karyawan.id_karyawan_admin', 'karyawan_admin.id_karyawan_admin')
            ->get();

        $total_iki = 0;
        $total_iku = 0;
        $total_pm = 0;

        foreach($admins as $row) {
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

            if($row['IKU'] != 0) {
                $hasil_final[$row['ID']]['UANG IKU'] = $row['IKU'] / $total_iku * $hasil[$index]['IKU'];
            } 
            else {
                $hasil_final[$row['ID']]['UANG IKU'] = 0;
            }

            if($row['IKI'] != 0) {
                $hasil_final[$row['ID']]['UANG IKI'] = $row['IKI'] / $total_iki * $hasil[$index]['IKI'];
            } 
            else {
                $hasil_final[$row['ID']]['UANG IKI'] = 0;
            }

            if($row['PM'] != 0) {
                $hasil_final[$row['ID']]['UANG PM'] = $row['PM'] / $total_pm * $hasil[$index]['PM'];   
            } 
            else {
                $hasil_final[$row['ID']]['UANG PM'] = 0;
            }
            
        }

        foreach($hasil_final as $row) {
            $proses_hitung_jp_admin = new ProsesJPAdmin();
            $proses_hitung_jp_admin->iku = $hasil_final[$row['ID']]['UANG IKU'];
            $proses_hitung_jp_admin->iki = $hasil_final[$row['ID']]['UANG IKI'];
            $proses_hitung_jp_admin->pm = $hasil_final[$row['ID']]['UANG PM'];
            $proses_hitung_jp_admin->id_periode = $id_periode;
            $proses_hitung_jp_admin->id_karyawan_admin = $hasil_final[$row['ID']]['ID'];
            $proses_hitung_jp_admin->created_at = now();
            $proses_hitung_jp_admin->updated_at = now();
            $proses_hitung_jp_admin->save();
        }

        // dd($hasil_final);
        return redirect('daftar_upah_karyawan_admin/'.$id_periode)->with('alert-success', 'Proses perhitungan telah berhasil!');
    }

    public function index_upah()
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->SelectPeriodeDESC();

        return view('karyawan_admin.upah.index', compact('data_periodes'));
    }

    public function daftar_upah_karyawan_admin($id_periode)
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        $data_upah_admin = new ProsesJPadmin();
        $data_upah_admins = $data_upah_admin->SelectDaftarUpahadmin($id_periode);

        return view('karyawan_admin.upah.upah', compact('data_upah_admins', 'data_periodes'));
    }

    public function detail_upah_karyawan_admin($id_periode, $id_karyawan_admin)
    {
        $data_periode = new Periode();
        $data_periodes = $data_periode->ShowPeriode($id_periode);

        $data_upah_admin = new ProsesJPAdmin();
        $data_upah_admins = $data_upah_admin->SelectDetailUpahAdmin($id_periode, $id_karyawan_admin);

        return view('karyawan_admin.upah.upah_detail', compact('data_upah_admins', 'data_periodes'));
    }
}

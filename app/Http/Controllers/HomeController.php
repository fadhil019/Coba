<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Session;
use DB;

use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
        // $note_all = new Note();
        // $note_alls = $note_all->SelectCartHome();
        // $note_cek_selesai = new Note();
        // $note_cek_selesais = $note_cek_selesai->SelectPembayaranCekHome();
        // $match_enemy_cek = new MatchEnemy();
        // $match_enemy_ceks = $match_enemy_cek->CheckLawanTandingExp();
        
        // if(isset(Auth::user()->user_role))
        // {
        //     $sport_field = new SportField();
        //     $sport_fields = $sport_field->SelectLapanganOlahragaHomePerUser();
        //     $match_enemy = new MatchEnemy();
        //     $match_enemys = $match_enemy->SelectLawanTanding(Auth::user()->user_id);
        //     if(Auth::user()->user_role == "Admin")
        //     {
        //         $content = new ContentHome();
        //         $contents = $content->SelectContent();

        //         $sf_vendor_request = new SFVendorRequest();
        //         $notif = $sf_vendor_request->SelectVendorRequestHome();

                
        //         return view('home', compact('contents', 'sport_fields', 'notif', 'match_enemys'));
        //     }
        //     else
        //     {
        //         $content = new ContentHome();
        //         $contents = $content->SelectContent();
                
        //         $notif = [];
        //         $recommendation = new UserSportLike();
        //         $recommendations = $recommendation->SelectRekomendasiHome();
        //         return view('home', compact('contents', 'sport_fields', 'notif', 'recommendations', 'match_enemys'));
        //     }
        // }
        // else
        // {
        //     $match_enemy = new MatchEnemy();
        //     $match_enemys = $match_enemy->SelectLawanTandingSemua();

        //     // $note_all = new Note();
        //     // $note_alls = $note_all->SelectNotaHome();

        //     $content = new ContentHome();
        //     $contents = $content->SelectContent();

        //     $sport_field = new SportField();
        //     $sport_fields = $sport_field->SelectLapanganOlahragaHome();
        //     // dd($sport_fields);
        //     return view('home', compact('contents', 'sport_fields', 'match_enemys'));
        // }
    }

    // public function pencarian(Request $request)
    // {
    //     $sportfield = new SportField();
    //     $sportfields = $sportfield->SearchLapangan($request);

    //     return view('search', compact('sportfields'));
    // }

    // public function notif_persewaan()
    // {
    //     $note_all = new Note();
    //     $note_alls = $note_all->SelectNotaHome();
    // }

    // public function notif_pembayaran()
    // {
    //     $note_pembayaran = new Note();
    //     $note_pembayarans = $note_pembayaran->SelectCartHome();
    // }

    // public function video_promosi()
    // {
    //     return view('video_promosi');
    // }

    // public function template_tf()
    // {
    //     return view('template_tf');
    // }
}

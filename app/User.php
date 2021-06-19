<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Mail;

use DB;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'id_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'nama_user', 'bagian', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function SelectUser(){
        $data_user = User::All();
        return $data_user;
    }

    public function ShowUser($id){
        $user = DB::table('users')
        ->join('city', 'city.city_id', '=', 'users.city_id')
        ->where('users.user_id', '=', $id)
        ->first();
        return $user;
    }

    public function InsertUser(Request $request) {
        try {
            $this->username = $request->username;
            $this->nama_user = $request->nama_user;
            $this->bagian = $request->bagian;
            $this->password = Hash::make($request->password);
            $this->created_at = now();
            $this->updated_at = now();
            $this->save();

            return 'success';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }       
    }

    public function UpdateUser(Request $request, $id) {
        try {
            $user = User::find($id);
            $user->username = $request->username;
            $user->nama_user = $request->nama_user;
            $user->bagian = $request->bagian;
            $user->updated_at = now();
            if($request->password != "") {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return 'success';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function DeleteUser($id){     
        try {
            $user = User::find($id);
            $user->delete();
            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // public function ResetPasswordUser(Request $request){
    //     try {
    //         $user_email_tmp = DB::table('users')
    //             ->where('users.email', '=', $request->email)
    //             ->first();
    //         $string = rand(100000000,999999999);
    //         if($user_email_tmp != null || $user_email_tmp != "") {
    //             $user = User::find($user_email_tmp->user_id);
    //             $user->password = Hash::make($string);
    //             $user->save();
    //             Mail::send('auth.passwords.email', ['pesan' => $string], function ($message) use ($request) {
    //                 $message->subject('Reset Password');
    //                 $message->from('sportcoy@admin.com', 'Admin Sport Coy');
    //                 $message->to($request->email, 'no-reply');
    //             });

    //             return 1;
    //         } else {
    //             return 2;
    //         }
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
}

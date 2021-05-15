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

    public function Selectpenyewa($status){
        $user = DB::table('users')
        ->where('user_role', '=', 'penyewa')
        ->where('users.user_status', '=', $status)
        ->get();
        return $user;
    }

    public function SelectPenyedia($status){
        $user = DB::table('users')
        ->where('user_role', '=', 'penyedia')
        ->where('users.user_status', '=', $status)
        ->get();
        return $user;
    }

    public function InsertUser(Request $request) {
        try {
            $this->username = $request->username;
            $this->user_name = $request->user_name;
            $this->user_phone = $request->user_phone;
            $this->email = $request->email;
            $this->user_address = $request->user_address;
            $this->user_sex = $request->user_sex;
            $this->user_role = $request->user_role;
            $this->user_status = 'Aktif';
            $this->password = Hash::make($request->password);
            $this->city_id = $request->city_id;
            if($request->user_photo != "")
            {
                $foto = $request->file('user_photo');
                $file_ext = $foto->getClientOriginalExtension();
                $file_name = $this->user_id . '_' . $request->username . '.' . $file_ext;
                $foto->move('images/user', $file_name);
                $this->user_photo = $file_name;
            }
            else
            {
                $this->user_photo = 'default.jpg';
            }
            $this->created_at = now();
            $this->updated_at = now();
            $this->save();

            $sport = new Sport();
            $sports = $sport->SelectOlahraga();
            for ($i=0; $i < count($sports); $i++) 
            { 
                $sport_like = new UserSportLike();
                $sport_like->user_id = $this->user_id;
                $sport_like->sport_id = $request->sport_id[$i];
                $sport_like->user_sport_like_value = $request->sport_value[$i];
                $sport_like->created_at = now();
                $sport_like->updated_at = now();
                $sport_like->save();
            }
            return 'success';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }       
    }

    public function UpdateUser(Request $request, $id) {
        try {
            $user = User::find($id);
            $user->user_name = $request->user_name;
            $user->user_phone = $request->user_phone;
            $user->email = $request->email;
            $user->user_address = $request->user_address;
            $user->user_sex = $request->user_sex;
            $user->city_id = $request->city_id;
            $user->updated_at = now();
            if($request->password != "") {
                $user->password = Hash::make($request->password);
            }
            $oldfoto = 'images/user/'.$user->user_photo;
            if($request->user_photo != "")
            {
                if ($user->user_photo == "default.jpg")
                {
                    $foto = $request->file('user_photo');
                    $file_ext = $foto->getClientOriginalExtension();
                    $file_name = $user->user_id . '_' . $user->username . '.' . $file_ext;
                    $foto->move('images/user', $file_name);
                    $user->user_photo = $file_name;
                }
                else
                { 
                    @unlink($oldfoto);
                    $foto = $request->file('user_photo');
                    $file_ext = $foto->getClientOriginalExtension();
                    $file_name = $user->user_id . '_' .$user->username . '.' . $file_ext;
                    $foto->move('images/user', $file_name);
                    $user->user_photo = $file_name;
                }
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
            $user->user_status = 'Off';
            $user->save();
            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function DeleteUserForever($id){     
        try {
            $user = User::find($id);
            $user->delete();
            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function ResetPasswordUser(Request $request){
        try {
            $user_email_tmp = DB::table('users')
                ->where('users.email', '=', $request->email)
                ->first();
            $string = rand(100000000,999999999);
            if($user_email_tmp != null || $user_email_tmp != "") {
                $user = User::find($user_email_tmp->user_id);
                $user->password = Hash::make($string);
                $user->save();
                Mail::send('auth.passwords.email', ['pesan' => $string], function ($message) use ($request) {
                    $message->subject('Reset Password');
                    $message->from('sportcoy@admin.com', 'Admin Sport Coy');
                    $message->to($request->email, 'no-reply');
                });

                return 1;
            } else {
                return 2;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

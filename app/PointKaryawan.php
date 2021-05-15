<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;

class PointKaryawan extends Model
{
    protected $table = "point_karyawan";
    protected $primaryKey = "id_point_karyawan";
}

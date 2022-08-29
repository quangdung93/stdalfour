<?php

namespace App\Http\Controllers\admin;

use Auth;
use DB;
use Cookie;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function getIndex() {
        $userAdId = Cookie::has('userAdId');
		if($userAdId){
            return view('admin.modules.dashboar.admin');
        }else {
            return redirect('dt-login');
        }
    }
}

<?php

namespace App\Http\Controllers\admin;

use DB;
use Cache;
use Cookie;
use Custom;
use Carbon\Carbon;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Http\Models\memberModel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
	public $memberModel;
	public function __construct(Request $request){                  
		$this->memberModel = new memberModel();    
    }
	
    public function getLogin() {
        $userAdId = Cookie::has('userAdId');
		if($userAdId){
			return redirect()->route('admin.index');
        }else {
            return view('admin.modules.login.login');
        }

    }
    public function postLogin(Request $request) {
        $inputDb = $request->all();
		$rulesInputVali = [
            'username'  => 'required',
            'password' => 'required',
        ];
		$msgErrorVali = array(
			'username.required' => Lang::get('member.err_username_empty'),        
			'password.required' => Lang::get('member.err_password_empty'), 
        );
		$validator = Validator::make($inputDb, $rulesInputVali, $msgErrorVali);
		if($validator->fails()){            
            return redirect()->back()->withInput($inputDb)->withErrors($validator);
        }else{
			$sl_user = $inputDb['username'];
            $sl_pass = md5($inputDb['password']);
			$arrWhere = array();           
            $arrWhere['whereGroupAnd'] = [
                array('username','=',$sl_user),
                array('password','=',$sl_pass)               
            ]; 
            $querySql = array(
               'where'  => $arrWhere,
               'limit'  => 1
            );
            $member = $this->memberModel->memberInforRecord($querySql);



			if(!empty($member)){
				if($member->enable == 0){
                    return redirect()->back()->with('warning',lang::get('member.err_author_disable'));
                    die();
                }
				Cookie::queue('userAdId', $member->iduser, 120);
				$expiresAt = Carbon::now()->addMinutes(120);
				Cache::put('user-is-online-' . $member->iduser, true, $expiresAt);
				session_set_cookie_params(0, '/', '.tuvu.com');
                setcookie("userImageId", $member->iduser, time() + 60 * 24 * 3600, '/', '.tuvu.com');
                return redirect()->route('admin.index')->with('sucsses', lang::get('member.success_author_login'));
			}else{
				return redirect()->back()->with('warning', lang::get('member.err_author_incorrect') );
			}
		}
    }
    public function getLogout() {
		Cache::forget('user-is-online-' . Cookie::get('userAdId'));
		Cookie::queue('userAdId', Cookie::get('userAdId'), -1);
		setcookie("userImageId", "", time() - 100, '/', '.tuvu.com');
        return redirect('dt-login');
    }
}
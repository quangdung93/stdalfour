<?php

namespace App\Helpers;
use DB;
use Storage;
use Cache;
use Route;
use Cookie;
use App\Http\Models\memberModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;

class Custom{
	
	public static function checkAuthUser(){
		$datauser = NULL;
		$userAdId = Cookie::has('userAdId');
		if($userAdId){
			$datauser = memberModel::where('iduser',Cookie::get('userAdId'))->first();
			return $datauser;
		}else{
			return redirect('dt-login', 301);
		}
	}
	public static function get_url_alias($loai){
		$getcat = DB::table('url_alias')->where('query',$loai)->first();
		if($getcat){
			return $getcat->keyword;
		}else{
			return '/';
		}
	}
	public static function product_price($priceFloat) {
		$symbol_thousand = '.';
		$decimal_place = 0;
		$price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
		return $price;
	}

	public static function isNonGoogleBot(){
		try {
			$agent = request()->server('HTTP_USER_AGENT');
			$isNonGoogle = true;
			if (strpos($agent, 'Chrome-Lighthouse') !== false) { // is Google bot
				$isNonGoogle = false;
			}

			return $isNonGoogle;
		} catch (\Exception $th) {
			return true;
		}
	}

	public static function convertAlias($cs) {
		$vietnamese = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ",
			"è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ",
			"ì", "í", "ị", "ỉ", "ĩ",
			"ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ",
			"ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
			"ỳ", "ý", "ỵ", "ỷ", "ỹ",
			"đ",
			"À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
			"È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
			"Ì", "Í", "Ị", "Ỉ", "Ĩ",
			"Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
			"Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
			"Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
			"Đ");
		$latin = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
			"e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
			"i", "i", "i", "i", "i",
			"o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
			"u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
			"y", "y", "y", "y", "y",
			"d",
			"A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A",
			"E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
			"I", "I", "I", "I", "I",
			"O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O",
			"U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
			"Y", "Y", "Y", "Y", "Y",
			"D");
		$csLatin = str_replace($vietnamese, $latin, $cs);
		return $csLatin;
	}
	public static function getFullUrl(){
		$s =( empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on")) ? "s" : "";
		$protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":" . $_SERVER["SERVER_PORT"]);
		$port = "";
		return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
	}
	public static function getIp(){
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
			if (array_key_exists($key, $_SERVER) === true){
				foreach (explode(',', $_SERVER[$key]) as $ip){
					$ip = trim($ip); // just to be safe
					if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
						return $ip;
					}
				}
			}
		}
	}
	public static function MoveFile($img, $filePath = 'uploads/product_image', $name_file = 'title-', $data_type_accept = array('gif','png' ,'jpg','bmp','jpeg','mp4', 'webm', 'svg'),$keep_original_name=true){
		if(!is_file($img)){
			return [
				"success"=>false,
				"message"=>"File lỗi"
			];
		}

		$ext = $img->getClientOriginalExtension();
		if(!in_array(strtolower($ext),$data_type_accept))
			return [
				"success"=>false,
				"message"=>"Định dạng file không hỗ trợ, định dạng cho phép: " . implode(',',$data_type_accept)
			];

		$filename = $name_file.time().".".$ext;

		if($img->move($filePath, $filename))
			return [
				"success"=>true,
				"file_name"=>$filename,
				"full_path"=>"$filePath/$filename"
			];

		return [
			"success"=>false,
			"message"=>"Lỗi không upload được file"
		];
	}
	public static function getStatus($stt,$trueText = 'Hoạt động',$falseText = 'Bị khóa'){
		if($stt)
		return '<i class="fa fa-circle" style="color: green;" title="'.$trueText.'" data-toggle="tooltip" data-placement="top"></i>';
		return '<i class="fa fa-circle" style="color: darkgray;" title="'.$falseText.'" data-toggle="tooltip" data-placement="top"></i>';
	}
	public static function build_sql_where($obj, $data){
        if (!empty($data['select'])) {
            $obj->select($data['select']);
        }
        if (!empty($data['where'])) {
            $extraType[0] = '';
            foreach ($data['where'] as $key => $val) {
                if (strstr($key, '-')) {
                    $extraType = explode('-', $key);
                }

                switch ($extraType[0]) {
                    case 'or':
                        $obj->orWhere(str_replace('or-', '', $key), $val);
                        break;
                    default:
                        if (is_array($val)) {
                            if ($key == 'whereGroup') {
                                $obj->Where(function ($query) use ($val) {
                                    foreach ($val as $ks => $vs) {
                                        if ($ks) {
                                            $query->orWhere($vs[0], $vs[1], $vs[2]);
                                        } else {
                                            $query->Where($vs[0], $vs[1], $vs[2]);
                                        }
                                    }
                                });
                            }
                            if ($key == 'whereGroupAnd') {
                                $obj->Where(function ($query) use ($val) {
                                    foreach ($val as $ks => $vs) {
                                        if (is_array($vs)) {
                                            if (in_array($vs[1], array('in', 'IN', 'In'))) {
                                                $query->WhereIn($vs[0], $vs[2]);
                                            } else if (in_array($vs[1], array('notin', 'NOTIN', 'NotIn'))) {
                                                $query->WhereNotIn($vs[0], $vs[2]);
                                            } else {
                                                $query->Where($vs[0], $vs[1], $vs[2]);
                                            }
                                        } else {
                                            $query->whereRaw($vs);
                                        }
                                    }
                                });
                            }
                            if ($key == 'whereIn') {
                                foreach ($val as $ks => $vs) {
                                    $obj->WhereIn($vs[0], $vs[1]);
                                }
                            }

                            if (!in_array($key, array('whereGroupAnd', 'whereGroup', 'whereIn'))) {
                                if (isset($val[1]))
                                    $obj->Where($val[0], $val[1], $val[2]);
                                else {
                                    $obj->Where($key, $val);
                                }
                            }
                        } else {
                            $obj->Where($key, $val);
                        }
                }
            }
        }
        if (!empty($data['groupby'])) {
            $obj->groupBy($data['groupby']);
        }
        if (!empty($data['orderby'])) {
            if (is_array($data['orderby']))
                $obj->orderby($data['orderby'][0], $data['orderby'][1]);
            else
                $obj->orderby($data['orderby']);
        }
    }
}
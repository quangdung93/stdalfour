<?php

namespace App\Http\Controllers\user;

use DB;
use Custom;
use SEO;
use Mail;
use SEOMeta;
use OpenGraph;
use Twitter;
use App\Http\Models\productModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
	public function getAllProductList(Request $request){
		
		$productcat = productModel::join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID');
		$productcat->where('product.STATUS',1);
		$productcat->orderBy('product.ID','DESC');
		$productcat = $productcat->paginate(12);
		$total = $productcat->total();
		//SEO
		SEO::setTitle('Mỹ phẩm làm đẹp với những thương hiệu hàng đầu');
		$theme = 'user.modules.product.listall';
		return view($theme, ['productcat' => $productcat, 'total' => $total]);
	}
	public function getDetail(Request $request){
		$geturl = $request->urlpost;
		if($geturl){
			$checkurl = DB::table('url_alias')->where('keyword',$geturl)->where('data_id',3)->orderBy('url_alias_id','DESC')->first();
			if($checkurl){
				$getquery = explode('=',$checkurl->query);
				if($getquery[0] == 'product_id'){
					$idpro = $getquery[1];
					$product = productModel::join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')->where('product.STATUS',1)->where('product.ID',$idpro)->first();
					$theme = 'user.modules.product.detail';
					return view($theme, ['product' => $product]);
				}
			}else{
				return abort(404);
			}
		}else{
			return abort(404);
		}
	}
}
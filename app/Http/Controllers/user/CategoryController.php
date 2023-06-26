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
		SEO::setTitle('Mua Sản Phẩm ST Dalfour Cam Kết 100% Chính Hãng ');
		SEO::setDescription('Mỹ phẩm ST Dalfour cam kết 100% hàng chính hãng. Ưu đãi giá tốt mỗi ngày. Miễn phí giao hàng nhanh toàn quốc. Dưỡng trắng da. Chống nắng. Đặt hàng ngay!');
		SEO::metatags('my pham, cham soc da, my pham nhat ban, my pham han quoc');
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

					$relatedProduct = productModel::join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')
										->where('product.STATUS',1)
										->where('product.ID', '!=', $idpro)
										->get();

					//SEO
					if($product->SEO_TITLE){
						SEOMeta::setTitle($product->SEO_TITLE);
						OpenGraph::setTitle($product->SEO_TITLE);
					}else{
						SEOMeta::setTitle($product->NAME);
						OpenGraph::setTitle($product->NAME);
					}
					if($product->SEO_DESCRIPTION){
						SEOMeta::setDescription($product->SEO_DESCRIPTION);
					}else{
						SEOMeta::setDescription($product->NAME);
					}
					if($product->SEO_KEYWORDS){
						SEOMeta::addKeyword($product->SEO_KEYWORDS);
					}else{
						SEOMeta::addKeyword($product->NAME);
					}
					OpenGraph::addProperty('type', 'article');
					OpenGraph::addProperty('locale', 'pt-br');
					OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
					OpenGraph::addImage(env('APP_URL').$product->SEO_IMAGE, ['height' => 476, 'width' => 249]);
					
					$theme = 'user.modules.product.detail';
					return view($theme, [
						'product' => $product,
						'relatedProduct' => $relatedProduct,
					]);
				}
			}else{
				return abort(404);
			}
		}else{
			return abort(404);
		}
	}
}
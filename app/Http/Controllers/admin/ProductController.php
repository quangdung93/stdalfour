<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\aliasModel;
use App\Http\Models\productModel;
use App\Http\Models\productcatModel;
use App\Http\Models\productimageModel;
use App\Http\Models\productdetailModel;
use App\Http\Models\catModel;
use Illuminate\Support\Str;
use Session;
use DB;
use Custom;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
	public function getList(Request $request){
		$keysearch = $request->keysearch ? $request->keysearch : '';
		$productnoibat = $request->productnoibat ? $request->productnoibat : 0;
		$productthuonghieu = $request->productthuonghieu ? $request->productthuonghieu : 0;
		$trangthai = $request->trangthai ? $request->trangthai : 0;
		$product = productModel::join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID');
		if(!empty($keysearch)){
			$keysearch = str_replace('+', ' ', $keysearch);
			$product->where('product_detail.NAME', 'LIKE', '%'.$keysearch.'%');
		}
		if($productthuonghieu != 0){
			$product->where('product.TRADEMARKID', $productthuonghieu);
		}
		if($productnoibat != 0){
			if($productnoibat == 1) $product->where('product.INSTOCK', 1);
			if($productnoibat == 2) $product->where('product.HOT', 1);
			if($productnoibat == 3) $product->where('product.SELLING', 1);
			if($productnoibat == 4) $product->where('product.SALEOFF', 1);
		}
		if($trangthai != 0){
			if($trangthai == 1) $product->where('product.STATUS', 1);
			if($trangthai == 2) $product->where('product.STATUS', 0);
		}
		$product->orderBy('ID','DESC');
		$product = $product->paginate(20);
		$count = $product->total();
		return view('admin.modules.product.list',['product' => $product, 'count' => $count, 'keysearch' => $keysearch, 'productnoibat' => $productnoibat, 'trangthai' => $trangthai, 'productthuonghieu' => $productthuonghieu]);
	}
	public function getAddProduct(){
		return view('admin.modules.product.add');
	}
	public function postAddProduct(Request $request){
		$this->validate($request, [
			'product_name'  => 'required',
			'txtImages'  => 'required'
		]);
		$gallery_list = $image_code = '';
		if ($request->listimage) {
			$image_code = $request->listimage;
			$gallery_list = join('|',$image_code);
		}
		//Thong tin khac
		$gift = $request->product_gift ? $request->product_gift : '';
		$giftimg = $request->product_giftimg ? $request->product_giftimg : '';
		$giftlink = $request->product_giftlink ? $request->product_giftlink : '';
		$bhanh = $request->product_bhanh ? $request->product_bhanh : '';
		$insert_data[] = array(
			'TRADEMARKID'  => $request->product_trademarkid,
			'MADE_IN'  => $request->product_manufactureid,
			'NHOMSANPHAM_ID' => $request->nhomsanpham_id ? $request->nhomsanpham_id : 0,
			'CHUCNANG_ID' => $request->chucnang_id ? $request->chucnang_id : 0,
			'LOAIDA_ID' => $request->loaida_id ? $request->loaida_id : 0,
			'SUDUNG_ID' => $request->sudung_id ? $request->sudung_id : 0,
			'DOTUOI_ID' => $request->dotuoi_id ? $request->dotuoi_id : 0,
			'IMAGE'  => $request->txtImages ? $request->txtImages : '',
			'URL'  => Str::slug($request->product_name),
			'STATUS'  => $request->product_status,
			'STATUS_SALE_NUMBER' => $request->pro_status_discount ? $request->pro_status_discount : 0,
			'SALE_NUMBER' => $request->pro_discount ? $request->pro_discount : 0,
			'HOT'  => $request->product_hot,
			'SELLING'  => $request->product_selling,
			'INSTOCK'  => $request->product_instock,
			'SALEOFF'  => $request->product_saleoff,
			'PRICE'  => $request->product_price,
			'DISCOUNT'  => $request->product_discount,
			'CUSTOM'  => 'a:4:{s:4:"gift";s:'.strlen($gift).':"'.$gift.'";s:7:"giftimg";s:'.strlen($giftimg).':"'.$giftimg.'";s:8:"giftlink";s:'.strlen($giftlink).':"'.$giftlink.'";s:5:"bhanh";s:'.strlen($bhanh).':"'.$bhanh.'";}'
		);
		if(!empty($insert_data)){
			DB::table('product')->insert($insert_data);
			$product_id = DB::getPdo()->lastInsertId();
			if($product_id){
				//Alias san pham
				$checkalias = aliasModel::where('keyword',Str::slug($request->product_name))->first();
				if($checkalias){
					$insert_data_ali[] = array(
						'query'  => 'product_id='.$product_id,
						'keyword' => Str::slug($request->product_name).'-'.$product_id,
						'data_id' => 3
					);
				}else{
					$insert_data_ali[] = array(
						'query'  => 'product_id='.$product_id,
						'keyword' => Str::slug($request->product_name),
						'data_id' => 3
					);
				}
				if(!empty($insert_data_ali)){
					aliasModel::insert($insert_data_ali);
				}
				//Danh muc san pham
				$newCat = $request->cat_list ? $request->cat_list : [];
				if($newCat){
					$insert_data_cat = array();
					foreach($newCat as $keycat => $add){
						$insert_data_cat[] = array(
							'CAT_ID'  => $add,
							'PRODUCTID' => $product_id
						);
						if($keycat == 0){
							DB::table('product')->where('ID',$product_id)->update(['CATEGORYID' => $add]);
						}
					}
					if(!empty($insert_data_cat)){
						productcatModel::insert($insert_data_cat);
					}
				}
				//Hinh anh lien quan
				if($gallery_list){
					$pic_thumb_array = explode('|', $gallery_list);
					if(count($pic_thumb_array) > 0){
						foreach ($pic_thumb_array as $pic_thumb_array_val){
							$insert_data_img = array();
							$insert_data_img[] = array(
								'PRODUCTID'  => $product_id,
								'BASE_URL' => $pic_thumb_array_val,
								'SORT' => 0
							);
							if(!empty($insert_data_img)){
								productimageModel::insert($insert_data_img);
							}
						}
					}
				}
				//Thong tin chi tiet
				$checkdetail = productdetailModel::where('PRODUCTID',$product_id)->first();
				if(!empty($checkdetail)){
					$productdetail = productdetailModel::find($product_id);
					$productdetail->NAME = $request->product_name ? $request->product_name : '';
					$productdetail->NAME_ASSCI = Custom::convertAlias($request->product_name);
					$productdetail->SUMMARY = $request->product_summary;
					$productdetail->ORIGIN = $request->product_origin;
					$productdetail->CONTENT = $request->product_content;
					$productdetail->SEO_TITLE = $request->product_seo_title;
					$productdetail->SEO_DESCRIPTION = $request->product_seo_description;
					$productdetail->SEO_KEYWORDS = $request->product_seo_keywords;
					$productdetail->SEO_IMAGE = $request->txtImagesFace;
					$productdetail->save();
				}else{
					$insert_data_detail[] = array(
						'PRODUCTID'  => $product_id,
						'LANGUAGEID' => 1,
						'NAME'  => $request->product_name ? $request->product_name : '',
						'NAME_ASSCI'  => Custom::convertAlias($request->product_name),
						'SUMMARY'  => $request->product_summary,
						'ORIGIN'  => $request->product_origin,
						'CONTENT'  => $request->product_content,
						'SEO_TITLE'  => $request->product_seo_title,
						'SEO_DESCRIPTION'  => $request->product_seo_description,
						'SEO_KEYWORDS'  => $request->product_seo_keywords,
						'SEO_IMAGE'  => $request->txtImagesFace
					);
					if(!empty($insert_data_detail)){
						DB::table('product_detail')->insert($insert_data_detail);
					}
				}
			}
		}
		return redirect()->route('admin.product.list')->with('success', 'Bạn đã thêm sản phẩm thành công');
	}
	public function getEditProduct(Request $request){
		$id = $request->id;
		$product = productModel::join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')->where('ID',$id)->first();
		$getprocat = DB::table('product_to_category')->join('category', 'product_to_category.CAT_ID', '=', 'category.ID')->join('category_detail', 'category.ID', '=', 'category_detail.CATEGORYID')->where('PRODUCTID',$id)->get();
		return view('admin.modules.product.edit', ['product' => $product, 'getprocat' => $getprocat]);
	}
	public function postEditProduct(Request $request){
		$this->validate($request, [
			'product_name'  => 'required',
			'txtImages'  => 'required'
		]);
		$id = $request->route('id');
		$product = productModel::find($id);
		$product->TRADEMARKID = $request->product_trademarkid;
		$product->MADE_IN = $request->product_made_in ? $request->product_made_in : 0;
		$product->NHOMSANPHAM_ID = $request->nhomsanpham_id ? $request->nhomsanpham_id : 0;
		$product->CHUCNANG_ID = $request->chucnang_id ? $request->chucnang_id : 0;
		$product->LOAIDA_ID = $request->loaida_id ? $request->loaida_id : 0;
		$product->SUDUNG_ID = $request->sudung_id ? $request->sudung_id : 0;
		$product->DOTUOI_ID = $request->dotuoi_id ? $request->dotuoi_id : 0;
		$product->STATUS_SALE_NUMBER = $request->pro_status_discount ? $request->pro_status_discount : 0;
		$product->SALE_NUMBER = $request->pro_discount ? $request->pro_discount : 0;
		$product->IMAGE = $request->txtImages ? $request->txtImages : '';
		$product->URL = Str::slug($request->product_name);
		$product->STATUS = $request->product_status;
		$product->HOT = $request->product_hot;
		$product->SELLING = $request->product_selling;
		$product->INSTOCK = $request->product_instock;
		$product->SALEOFF = $request->product_saleoff;
		$product->PRICE = $request->product_price;
		$product->DISCOUNT = $request->product_discount;
		$product->PRODUCT_VOLUME = $request->product_volume ? $request->product_volume : '';
		//Thong tin khac
		$gift = $request->product_gift ? $request->product_gift : '';
		$giftimg = $request->product_giftimg ? $request->product_giftimg : '';
		$giftlink = $request->product_giftlink ? $request->product_giftlink : '';
		$bhanh = $request->product_bhanh ? $request->product_bhanh : '';
		$product->CUSTOM = 'a:4:{s:4:"gift";s:'.strlen($gift).':"'.$gift.'";s:7:"giftimg";s:'.strlen($giftimg).':"'.$giftimg.'";s:8:"giftlink";s:'.strlen($giftlink).':"'.$giftlink.'";s:5:"bhanh";s:'.strlen($bhanh).':"'.$bhanh.'";}';
		$product->save();
		//Bang thong tin chi tiet
		$productdetail = productdetailModel::find($id);
		$productdetail->NAME = $request->product_name ? $request->product_name : '';
		$productdetail->NAME_ASSCI = Custom::convertAlias($request->product_name);
		$productdetail->SUMMARY = $request->product_summary;
		$productdetail->ORIGIN = $request->product_origin;
		$productdetail->CONTENT = $request->product_content;
		$productdetail->SEO_TITLE = $request->product_seo_title;
		$productdetail->SEO_DESCRIPTION = $request->product_seo_description;
		$productdetail->SEO_KEYWORDS = $request->product_seo_keywords;
		$productdetail->SEO_IMAGE = $request->txtImagesFace;
		$productdetail->save();
		//Alias san pham
		$checkalias = aliasModel::where('query','product_id='.$id)->first();
		if($checkalias && $request->product_slug){
			if($checkalias->keyword != $request->product_slug){
				$aliaspro = aliasModel::find($checkalias->url_alias_id);
				$aliaspro->keyword = $request->product_slug;
				$aliaspro->save();
			}
		}
		//Danh muc
		$getcat = productcatModel::where('PRODUCTID',$id)->get();
		$oldCat = array();
		if($getcat){
			foreach($getcat as $cat){
				$oldCat[] = $cat->CAT_ID;
			}
		}
		if($oldCat){
			$oldCat = join(',',$oldCat);
			$oldCat = explode(',',$oldCat);
		}
		$newCat = $request->cat_list ? $request->cat_list : [];
		$delCat = array_diff($oldCat, $newCat);
		$addCat = array_diff($newCat, $oldCat);
		if($delCat){
			foreach($delCat as $del){
				productcatModel::where('CAT_ID', $del)->where('PRODUCTID',$id)->delete();
			}
		}
		if($addCat){
			$insert_data_cat = array();
			foreach($addCat as $keycat => $add){
				$insert_data_cat[] = array(
					'CAT_ID'  => $add,
					'PRODUCTID' => $id
				);
				if($keycat == 0){
					DB::table('product')->where('ID',$id)->update(['CATEGORYID' => $add]);
				}
			}
			if(!empty($insert_data_cat)){
				productcatModel::insert($insert_data_cat);
			}
		}
		//Hinh anh lien quan
		$gallery_list = $image_code = '';
		if ($request->listimage) {
			$image_code = $request->listimage;
			$gallery_list = join('|',$image_code);
		}
		if($gallery_list){
			$pic_thumb_array = explode('|', $gallery_list);
			if(count($pic_thumb_array) > 0){
				productimageModel::where('PRODUCTID',$id)->delete();
				foreach ($pic_thumb_array as $pic_thumb_array_val){
					$insert_data_img = array();
					$insert_data_img[] = array(
						'PRODUCTID'  => $id,
						'BASE_URL' => $pic_thumb_array_val,
						'SORT' => 0
					);
					if(!empty($insert_data_img)){
						productimageModel::insert($insert_data_img);
					}
				}
			}
		}
		return redirect()->route('admin.product.list')->with('success', 'Bạn đã cập nhật sản phẩm thành công');
	}
	public function getDeleteProduct(Request $request){
		$id = $request->id;
		productModel::where('ID', $id)->delete();
		productcatModel::where('PRODUCTID', $id)->delete();
		productimageModel::where('PRODUCTID', $id)->delete();
		productdetailModel::where('PRODUCTID', $id)->delete();
		return redirect()->route('admin.product.list')->with('success', 'Bạn đã xóa sản phẩm thành công');
	}
	public function deleteAll(Request $request){
		$ids = $request->ids;
		$listProId = explode(",", $ids);
        foreach ($listProId as $proId) {
			if ($proId) {
				productModel::where('ID', $proId)->delete();
				productcatModel::where('PRODUCTID', $proId)->delete();
				productimageModel::where('PRODUCTID', $proId)->delete();
				productdetailModel::where('PRODUCTID', $proId)->delete();
            }
		}
		return response()->json(['success' => 'Đã xóa thành công']);
	}
	public function catFind(Request $request){
        $term = trim($request->q);
        if (empty($term)) {
            return \Response::json([]);
        }
        $category = catModel::join('category_detail', 'category.ID', '=', 'category_detail.CATEGORYID')->where('category_detail.NAME', 'LIKE', '%'.$term.'%')->get();
		$formatted_tags = [];
        foreach ($category as $cat) {
			$namecat = $cat->NAME;
			if($cat->PARENTID != 0){
				$catgetsub = DB::table('category')->join('category_detail', 'category.ID', '=', 'category_detail.CATEGORYID')->where('ID',$cat->PARENTID)->first();
				if($catgetsub){
					$namecat = $catgetsub->NAME .' > '.$cat->NAME;
					if($catgetsub->PARENTID != 0){
						$catgetsubsub = DB::table('category')->join('category_detail', 'category.ID', '=', 'category_detail.CATEGORYID')->where('ID',$catgetsub->PARENTID)->first();
						if($catgetsubsub){
							$namecat = $catgetsubsub->NAME .' > '.$catgetsub->NAME .' > '.$cat->NAME;
						}
						if($catgetsubsub->PARENTID != 0){
							$catgetsubsubsub = DB::table('category')->join('category_detail', 'category.ID', '=', 'category_detail.CATEGORYID')->where('ID',$catgetsubsub->PARENTID)->first();
							if($catgetsubsubsub){
								$namecat = $catgetsubsubsub->NAME .' > '.$catgetsubsub->NAME .' > '.$catgetsub->NAME .' > '.$cat->NAME;
							}
						}
					}
				}
			}
            $formatted_tags[] = ['id' => $cat->ID, 'text' => $namecat];
        }
        return \Response::json($formatted_tags);
    }
	public function proFind(Request $request){
        $term = trim($request->q);
        if (empty($term)) {
            return \Response::json([]);
        }
        $product = DB::table('product_detail')->where('NAME', 'LIKE', '%'.$term.'%')->get();
		$formatted_tags = [];
        foreach ($product as $pro) {
			$getprice = DB::table('product')->where('ID',$pro->PRODUCTID)->first();
			if($getprice){
				$namepro = $pro->NAME.' - Giá bán: '.number_format($getprice->PRICE).'đ';
			}else{
				$namepro = $pro->NAME;
			}
            $formatted_tags[] = ['id' => $pro->PRODUCTID, 'text' => $namepro];
        }
        return \Response::json($formatted_tags);
    }
	public function getUpPrice(Request $request){
		$pid = $request->pro_id;
		if($pid){
			DB::table('product')->where('ID',$pid)->update(['PRICE' => $request->price]);
			$countop = $request->countop;
			if($countop == 1){
				DB::table('products_option')->where('op_product_id',$pid)->update(['op_price' => $request->price]);
			}
		}
	}
	public function getUpDiscount(Request $request){
		$pid = $request->pro_id;
		if($pid){
			DB::table('product')->where('ID',$pid)->update(['DISCOUNT' => $request->price]);
			$countop = $request->countop;
			if($countop == 1){
				DB::table('products_option')->where('op_product_id',$pid)->update(['op_price_discount' => $request->price]);
			}
		}
	}
}
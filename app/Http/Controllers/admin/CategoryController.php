<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Constants\ConfigApp;
use App\Http\Models\catModel;
use App\Http\Models\aliasModel;
use App\Http\Models\catdetailModel;
use Illuminate\Support\Str;
use Session;
use DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
	public function getList(Request $request){
		$keysearch = $request->keysearch ? $request->keysearch : '';
		$category = catModel::join('category_detail', 'category.ID', '=', 'category_detail.CATEGORYID');
		
		if(!empty($keysearch)){
			$keysearch = str_replace('+', ' ', $keysearch);
			$category->where('category_detail.NAME', 'LIKE', '%'.$keysearch.'%');
		}
		$category->orderBy('ID','DESC');
		$category = $category->paginate(20);
		return view('admin.modules.category.list',['category' => $category, 'keysearch' => $keysearch]);
	}
	public function getAddCategory(){
		return view('admin.modules.category.add');
	}
	public function postAddCategory(Request $request){
		$this->validate($request, [
			'cat_name'  => 'required'
		]);
		$insert_data[] = array(
			'PARENTID'  => $request->cat_id,
			'URL'  => Str::slug($request->cat_name),
			'IMAGE'  => $request->txtImages ? $request->txtImages : '',
			'SORT'  => 0,
			'CUSTOM' => 'a:4:{s:8:"banner_1";s:0:"";s:6:"link_1";s:0:"";s:8:"banner_2";s:0:"";s:6:"link_2";s:0:"";}',
			'CHECK_1' => $request->cat_home,
			'STATUS'  => $request->cat_enabled
		);
		if(!empty($insert_data)){
			DB::table('category')->insert($insert_data);
			$cat_id = DB::getPdo()->lastInsertId();
			if($cat_id){
				$insert_data_detail[] = array(
					'LANGUAGEID'  => 1,
					'NAME'  => $request->cat_name,
					'TITLE' => $request->cat_name,
					'CATEGORYID' => $cat_id,
					'CONTENT'  => $request->cat_content ? $request->cat_content : '',
					'SUMMARY'  => $request->cat_des ? $request->cat_des : '',
					'SEO_TITLE'  => $request->cat_title_seo ? $request->cat_title_seo : '',
					'SEO_DESCRIPTION'  => $request->cat_des_seo ? $request->cat_des_seo : '',
					'SEO_KEYWORDS'  => $request->cat_key_seo ? $request->cat_key_seo : '',
					'SEO_IMAGE'  => $request->txtImagesSeo ? $request->txtImagesSeo : ''
				);
				if(!empty($insert_data_detail)){
					DB::table('category_detail')->insert($insert_data_detail);
				}
				//Alias danh muc
				$checkalias = aliasModel::where('keyword',Str::slug($request->cat_name))->first();
				if($checkalias){
					$insert_data_ali[] = array(
						'query'  => 'category_id='.$cat_id,
						'keyword' => Str::slug($request->cat_name).'-'.$cat_id
					);
				}else{
					$insert_data_ali[] = array(
						'query'  => 'category_id='.$cat_id,
						'keyword' => Str::slug($request->cat_name)
					);
				}
				if(!empty($insert_data_ali)){
					aliasModel::insert($insert_data_ali);
				}
			}
		}
		return back()->with('success', 'Bạn đã thêm danh mục thành công');
	}
	public function getEditCategory(Request $request){
		$id = $request->id;
		$category = catModel::join('category_detail', 'category.ID', '=', 'category_detail.CATEGORYID')->where('category.ID',$id)->first();
		return view('admin.modules.category.edit', ['category' => $category]);
	}
	public function postEditCategory(Request $request){
		$this->validate($request, [
			'cat_name'  => 'required'
		]);
		$id = $request->route('id');
		$cat = catModel::find($id);
		$cat->PARENTID = $request->cat_id;
		$cat->URL = Str::slug($request->cat_name);
		$cat->IMAGE = $request->txtImages ? $request->txtImages : '';
		$cat->STATUS = $request->cat_enabled;
		$cat->CHECK_1 = $request->cat_home;
		$cat->save();
		$catdetail = catdetailModel::find($id);
		$catdetail->NAME = $request->cat_name;
		$catdetail->CONTENT = $request->cat_content ? $request->cat_content : '';
		$catdetail->SUMMARY = $request->cat_des ? $request->cat_des : '';
		$catdetail->SEO_TITLE = $request->cat_title_seo ? $request->cat_title_seo : '';
		$catdetail->SEO_DESCRIPTION = $request->cat_des_seo ? $request->cat_des_seo : '';
		$catdetail->SEO_KEYWORDS = $request->cat_key_seo ? $request->cat_key_seo : '';
		$catdetail->SEO_IMAGE = $request->txtImagesSeo ? $request->txtImagesSeo : '';
		$catdetail->save();
		return back()->with('success', 'Bạn đã cập nhật danh mục thành công');
	}
	public function getDeleteCategory(Request $request){
		$id = $request->id;
		DB::table('category')->where('ID', $id)->delete();
		DB::table('category_detail')->where('CATEGORYID', $id)->delete();
		return redirect('dt-admin/category', 301);
	}
}
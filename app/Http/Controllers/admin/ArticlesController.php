<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Constants\ConfigApp;
use Illuminate\Support\Str;
use App\Http\Models\aliasModel;
use App\Http\Models\articlesModel;
use App\Http\Models\articlesdetailModel;
use Session;
use DB;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
	public function getList(){
		$articles = articlesModel::join('articles_detail', 'articles.ID', '=', 'articles_detail.ARTICLESID')->orderBy('ID','DESC')->paginate(20);
		return view('admin.modules.articles.list',['articles'=>$articles]);
	}
	public function getAddArticles(){
		return view('admin.modules.articles.add');
	}
	public function postAddArticles(Request $request){
		$this->validate($request, [
			'articles_name'  => 'required'
		]);
		$insert_data[] = array(
			'URL'  => Str::slug($request->articles_name),
			'IMAGE'  => $request->txtImages ? $request->txtImages : '',
			'DATETIME'  => date('Y-m-d H:i'),
			'SORT'  => 0,
			'CUSTOM'  => 'a:3:{s:4:"icon";s:0:"";s:4:"mota";s:0:"";s:4:"more";s:0:"";}',
			'CHECK_1'  => $request->articles_home,
			'STATUS'  => $request->articles_enabled
		);
		if(!empty($insert_data)){
			DB::table('articles')->insert($insert_data);
			$articles_id = DB::getPdo()->lastInsertId();
			if($articles_id){
				$insert_data_detail[] = array(
					'LANGUAGEID'  => 1,
					'NAME'  => $request->articles_name,
					'ARTICLESID' => $articles_id,
					'CONTENT'  => $request->articles_content ? $request->articles_content : '',
					'SUMMARY'  => $request->articles_des ? $request->articles_des : '',
					'SEO_TITLE'  => $request->articles_title_seo ? $request->articles_title_seo : '',
					'SEO_DESCRIPTION'  => $request->articles_des_seo ? $request->articles_des_seo : '',
					'SEO_KEYWORDS'  => $request->articles_key_seo ? $request->articles_key_seo : '',
					'SEO_IMAGE'  => $request->txtImagesSeo ? $request->txtImagesSeo : ''
				);
				if(!empty($insert_data_detail)){
					DB::table('articles_detail')->insert($insert_data_detail);
				}
				//Cat bai viet
				$insert_data_cat[] = array(
					'ARTICLESID'  => $articles_id,
					'ARTICLES_CATID' => $request->cat_id ? $request->cat_id : 1
				);
				if(!empty($insert_data_cat)){
					DB::table('articles_cat_articles')->insert($insert_data_cat);
				}
				//Alias bai viet
				$checkalias = aliasModel::where('keyword',Str::slug($request->articles_name))->first();
				if($checkalias){
					$insert_data_ali[] = array(
						'query'  => 'article_id='.$articles_id,
						'keyword' => Str::slug($request->articles_name).'-'.$articles_id
					);
				}else{
					$insert_data_ali[] = array(
						'query'  => 'article_id='.$articles_id,
						'keyword' => Str::slug($request->articles_name)
					);
				}
				if(!empty($insert_data_ali)){
					aliasModel::insert($insert_data_ali);
				}
			}
		}
		return back()->with('success', 'Bạn đã thêm term thành công');
	}
	public function getEditArticles(Request $request){
		$id = $request->id;
		$articles = articlesModel::join('articles_detail', 'articles.ID', '=', 'articles_detail.ARTICLESID')->join('articles_cat_articles', 'articles.ID', '=', 'articles_cat_articles.ARTICLESID')->where('ID',$id)->first();
		return view('admin.modules.articles.edit', ['articles' => $articles]);
	}
	public function postEditArticles(Request $request){
		$this->validate($request, [
			'articles_name'  => 'required'
		]);
		$id = $request->route('id');
		$articles = articlesModel::find($id);
		$articles->URL = Str::slug($request->articles_name);
		$articles->IMAGE = $request->txtImages ? $request->txtImages : '';
		$articles->STATUS = $request->articles_enabled;
		$articles->CHECK_1 = $request->articles_home;
		$articles->save();
		$articlesdetail = articlesdetailModel::find($id);
		$articlesdetail->NAME = $request->articles_name;
		$articlesdetail->CONTENT = $request->articles_content ? $request->articles_content : '';
		$articlesdetail->SUMMARY = $request->articles_des ? $request->articles_des : '';
		$articlesdetail->SEO_TITLE = $request->articles_title_seo ? $request->articles_title_seo : '';
		$articlesdetail->SEO_DESCRIPTION = $request->articles_des_seo ? $request->articles_des_seo : '';
		$articlesdetail->SEO_KEYWORDS = $request->articles_key_seo ? $request->articles_key_seo : '';
		$articlesdetail->SEO_IMAGE = $request->txtImagesSeo ? $request->txtImagesSeo : '';
		$articlesdetail->save();
		return back()->with('success', 'Bạn đã cập nhật bài viết thành công');
	}
	public function getDeleteTerm(Request $request){
		$id = $request->id;
		DB::table('term')->where('term_id', $id)->delete();
		return redirect('dt-admin/term', 301);
	}
}
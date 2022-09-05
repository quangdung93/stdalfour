<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\newsModel;
use App\Http\Models\aliasModel;
use App\Http\Models\newsdetailModel;
use Illuminate\Support\Str;
use Session;
use DB;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
	public function getList(Request $request){
		$keysearch = $request->keysearch ? $request->keysearch : '';
		$trangthai = $request->trangthai ? $request->trangthai : 0;
		$cat_id = $request->cat_id ? $request->cat_id : 0;
		$news = newsModel::join('news_detail', 'news.ID', '=', 'news_detail.NEWSID');
		if(!empty($keysearch)){
			$keysearch = str_replace('+', ' ', $keysearch);
			$news->where('news_detail.NAME', 'LIKE', '%'.$keysearch.'%');
		}
		if($trangthai != 0){
			if($trangthai == 1) $news->where('news.STATUS', 1);
			if($trangthai == 2) $news->where('news.STATUS', 0);
		}
		if($cat_id != 0){
			$news->where('news.CAT_ID', $cat_id);
		}
		$news->orderBy('ID','DESC');
		$news = $news->paginate(20);
		$total = $news->total();
		return view('admin.modules.news.list',['news'=>$news, 'total' => $total, 'keysearch' => $keysearch, 'trangthai' => $trangthai, 'cat_id' => $cat_id]);
	}
	public function getAddNews(){
		return view('admin.modules.news.add');
	}
	public function postAddNews(Request $request){
		$this->validate($request, [
			'news_name'  => 'required'
		]);
		$insert_data[] = array(
			'CAT_ID'  => $request->cat_id,
			'URL'  => Str::slug($request->news_name),
			'IMAGE'  => $request->txtImages ? $request->txtImages : '',
			'DATECREATE'  => date('Y-m-d H:i'),
			'SORT'  => 0,
			'TOTALVIEW' => 0,
			'MOSTVIEW' => 0,
			'STATUS'  => $request->news_enabled
		);
		if(!empty($insert_data)){
			DB::table('news')->insert($insert_data);
			$news_id = DB::getPdo()->lastInsertId();
			if($news_id){
				$insert_data_detail[] = array(
					'LANGUAGEID'  => 1,
					'NAME'  => $request->news_name,
					'NEWSID' => $news_id,
					'CONTENT'  => $request->news_content ? $request->news_content : '',
					'SUMMARY'  => $request->news_des ? $request->news_des : '',
					'SEO_TITLE'  => $request->news_title_seo ? $request->news_title_seo : '',
					'SEO_DESCRIPTION'  => $request->news_des_seo ? $request->news_des_seo : '',
					'SEO_KEYWORDS'  => $request->news_key_seo ? $request->news_key_seo : '',
					'SEO_IMAGE'  => $request->txtImagesSeo ? $request->txtImagesSeo : ''
				);
				if(!empty($insert_data_detail)){
					DB::table('news_detail')->insert($insert_data_detail);
				}
				//Alias tin tuc
				$checkalias = aliasModel::where('keyword',Str::slug($request->news_name))->first();
				if($checkalias){
					$insert_data_ali[] = array(
						'query'  => 'news_id='.$news_id,
						'keyword' => Str::slug($request->news_name).'-'.$news_id,
						'data_id' => 4
					);
				}else{
					$insert_data_ali[] = array(
						'query'  => 'news_id='.$news_id,
						'keyword' => Str::slug($request->news_name),
						'data_id' => 4
					);
				}
				if(!empty($insert_data_ali)){
					aliasModel::insert($insert_data_ali);
				}
			}
		}
		return back()->with('success', 'Bạn đã thêm tin tức thành công');
	}
	public function getEditNews(Request $request){
		$id = $request->id;
		$news = newsModel::join('news_detail', 'news.ID', '=', 'news_detail.NEWSID')->where('news.ID',$id)->first();
		return view('admin.modules.news.edit', ['news' => $news]);
	}
	public function postEditNews(Request $request){
		$this->validate($request, [
			'news_name'  => 'required'
		]);
		$id = $request->route('id');
		$news = newsModel::find($id);
		$news->CAT_ID = $request->cat_id;
		$news->URL = Str::slug($request->news_name);
		$news->IMAGE = $request->txtImages ? $request->txtImages : '';
		$news->STATUS = $request->news_enabled;
		$news->save();
		$newsdetail = newsdetailModel::find($id);
		$newsdetail->NAME = $request->news_name;
		$newsdetail->CONTENT = $request->news_content ? $request->news_content : '';
		$newsdetail->SUMMARY = $request->news_des ? $request->news_des : '';
		$newsdetail->SEO_TITLE = $request->news_title_seo ? $request->news_title_seo : '';
		$newsdetail->SEO_DESCRIPTION = $request->news_des_seo ? $request->news_des_seo : '';
		$newsdetail->SEO_KEYWORDS = $request->news_key_seo ? $request->news_key_seo : '';
		$newsdetail->SEO_IMAGE = $request->txtImagesSeo ? $request->txtImagesSeo : '';
		$newsdetail->save();
		return back()->with('success', 'Bạn đã cập nhật tin tức thành công');
	}
	public function getDeleteNews(Request $request){
		$id = $request->id;
		DB::table('news')->where('ID', $id)->delete();
		DB::table('news_detail')->where('NEWSID', $id)->delete();
		return redirect('dt-admin/news', 301);
	}
}
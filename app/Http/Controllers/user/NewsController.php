<?php

namespace App\Http\Controllers\user;

use DB;
use SEO;
use Auth;
use Custom;
use SEOMeta;
use Twitter;
use OpenGraph;
use Illuminate\Http\Request;
use App\Http\Models\productModel;
use App\Http\Models\articlesModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Cookie;

class NewsController extends Controller
{
	public function getNews(){
		$news = DB::table('news')->join('news_detail', 'news.ID', '=', 'news_detail.NEWSID')->where('news.STATUS',1)->orderBy('news.ID','DESC')->paginate(20);
		SEO::setTitle('Kiến Thức Làm Đẹp Dành Cho Phái Đẹp | ST Dalfour');
		SEO::setDescription('Tổng hợp các thông tin kiến thức, cẩm nang làm đẹp, kinh nghiệp chăm sóc da, chăm sóc sức khỏe. Review mỹ phẩm hot, xu hướng mới nhất…');
		SEO::metatags('my pham, cham soc da, my pham nhat ban, my pham han quoc');
		$theme = 'user.modules.news.listall';
		return view($theme, ['news' => $news]);
	}
	
	public function getDetail(Request $request){
		$geturl = $request->urlpost;
		if($geturl){
			$checkurl = DB::table('url_alias')->where('keyword',$geturl)->where('data_id',4)->orderBy('url_alias_id','DESC')->first();
			if($checkurl){
				$getquery = explode('=',$checkurl->query);
				if($getquery[0] == 'news_id'){
					$idnew = $getquery[1];
					$news = DB::table('news')
							->join('news_detail', 'news.ID', '=', 'news_detail.NEWSID')
							->leftJoin('users', 'news.POST_AUTHOR', '=', 'users.iduser')
							->where('news.STATUS',1)
							->where('news.ID',$idnew)
							->first();

					$category = DB::table('category_news')
								->join('category_news_detail', 'category_news.ID', '=', 'category_news_detail.CATEGORYID')
								->where('category_news.ID',$news->CAT_ID)
								->first();

					$relatedNews = DB::table('news')
						->join('news_detail', 'news.ID', '=', 'news_detail.NEWSID')
						->where('news.STATUS',1)
						->where('news.CAT_ID',$category->ID)
						->inRandomOrder()
						->limit(7)
						->get();

					$productcat = productModel::join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID');
					$productcat->where('product.STATUS',1);
					$products = $productcat->orderBy('product.ID','DESC')->limit(5)->get();
					
					if(empty($news)){
						return abort(404);
					}else{
						$urlNews = route('frontend.news.detail', ['urlpost' => Custom::get_url_alias('news_id='.$news->ID)]);
						if($urlNews != request()->url()){
							SEO::setCanonical($urlNews);
							return abort(404);
						}
					}
					//SEO
					if($news->SEO_TITLE){
						SEOMeta::setTitle($news->SEO_TITLE);
						OpenGraph::setTitle($news->SEO_TITLE);
					}else{
						SEOMeta::setTitle($news->NAME);
						OpenGraph::setTitle($news->NAME);
					}
					if($news->SEO_DESCRIPTION){
						SEOMeta::setDescription($news->SEO_DESCRIPTION);
					}else{
						SEOMeta::setDescription($news->NAME);
					}
					if($news->SEO_KEYWORDS){
						SEOMeta::addKeyword($news->SEO_KEYWORDS);
					}else{
						SEOMeta::addKeyword($news->NAME);
					}
					OpenGraph::addProperty('type', 'article');
					OpenGraph::addProperty('locale', 'pt-br');
					OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
					OpenGraph::addImage(env('APP_URL').$news->IMAGE, ['height' => 476, 'width' => 249]);
					$theme = 'user.modules.news.detail';
					return view($theme, [
						'news' => $news, 
						'category' => $category, 
						'relatedNews' => $relatedNews,
						'products' => $products,
					]);
				}else{
					return abort(404);
				}
			}else{
				return abort(404);
			}
		}else{
			return abort(404);
		}
	}
	
	public function getInfo(Request $request){
		$geturl = $request->urlpost;
		if($geturl){
			$checkurl = DB::table('url_alias')->where('keyword',$geturl)->where('data_id',0)->orderBy('url_alias_id','DESC')->first();
			if($checkurl){
				$getquery = explode('=',$checkurl->query);
				if($getquery[0] == 'article_id'){
					$idnew = $getquery[1];
					$newspage = articlesModel::join('articles_detail', 'articles.ID', '=', 'articles_detail.ARTICLESID')->where('articles.STATUS',1)->where('articles.ID',$idnew)->first();
					if(empty($newspage)){
						return abort(404);
					}
					//SEO
					if($newspage->SEO_TITLE){
						SEOMeta::setTitle($newspage->SEO_TITLE);
						OpenGraph::setTitle($newspage->SEO_TITLE);
					}else{
						SEOMeta::setTitle($newspage->NAME);
						OpenGraph::setTitle($newspage->NAME);
					}
					if($newspage->SEO_DESCRIPTION){
						SEOMeta::setDescription($newspage->SEO_DESCRIPTION);
					}else{
						SEOMeta::setDescription($newspage->NAME);
					}
					if($newspage->SEO_KEYWORDS){
						SEOMeta::addKeyword($newspage->SEO_KEYWORDS);
					}else{
						SEOMeta::addKeyword($newspage->NAME);
					}
					$theme = 'user.modules.news.infodetail';
					return view($theme, ['newspage' => $newspage, 'nofollow' => true]);
				}else{
					return abort(404);
				}
			}else{
				return abort(404);
			}
		}else{
			return abort(404);
		}
	}
}
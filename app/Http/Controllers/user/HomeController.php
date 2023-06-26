<?php

namespace App\Http\Controllers\user;

use SEO;
use SEOMeta;
use OpenGraph;
use Twitter;
use App\Http\Models\newsModel;
use App\Http\Models\productModel;
use App\Http\Models\settingModel;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function getHome()
    {
		$setting = settingModel::where('setting_id',1)->first();
		$news = newsModel::join('news_detail', 'news.ID', '=', 'news_detail.NEWSID')->where('news.STATUS',1)->orderBy('news.ID','DESC')->limit(10)->get();
		$tiktok = newsModel::join('news_detail', 'news.ID', '=', 'news_detail.NEWSID')->where('news.STATUS',1)->where('news.CAT_ID',2)->orderBy('news.ID','DESC')->limit(10)->get();
		$producthot = productModel::join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')->where('product.STATUS',1)->where('product.HOT',1)->orderBy('ID','DESC')->limit(5)->get();
		
		$products = productModel::join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')->get();
		//SEO
		SEO::setTitle('ST dalfour - Thương hiệu mỹ phẩm trắng da được tin dùng nhất Việt Nam');
		SEO::setDescription('ST Dalfour - thương hiệu mỹ phẩm đa dạng các sản phẩm làm sáng trắng da, chống nắng an toàn…Với phương châm lấy phụ nữ làm nhân vật trung tâm, mang đến những giải pháp chăm sóc da hoàn mỹ…');
		SEO::metatags('my pham, cham soc da, my pham nhat ban, my pham han quoc');
		$theme = 'user.index';
		return view($theme, [
			'producthot' => $producthot, 
			'news' => $news, 
			'tiktok' => $tiktok, 
			'products' => $products, 
			'setting' => $setting
		]);
    }
}

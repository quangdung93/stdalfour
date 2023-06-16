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
		$news = newsModel::join('news_detail', 'news.ID', '=', 'news_detail.NEWSID')->where('news.STATUS',1)->where('news.CAT_ID',1)->orderBy('news.ID','DESC')->limit(10)->get();
		$tiktok = newsModel::join('news_detail', 'news.ID', '=', 'news_detail.NEWSID')->where('news.STATUS',1)->where('news.CAT_ID',2)->orderBy('news.ID','DESC')->limit(10)->get();
		$producthot = productModel::join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')->where('product.STATUS',1)->where('product.HOT',1)->orderBy('ID','DESC')->limit(5)->get();
		
		$products = productModel::join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')->get();
		//SEO
		SEO::setTitle('Stdalfour.com.vn: Sứ Mệnh Làm Đẹp Cho Phụ Nữ Việt');
		SEO::setDescription('Stdalfour.com.vn: chuyên phân phối mỹ phẩm nhập khẩu giá tốt, mỹ phẩm làm đẹp chất lượng cao từ các thương hiệu nổi tiếng trên thế giới.');
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

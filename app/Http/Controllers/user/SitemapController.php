<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Models\catModel;
use App\Http\Models\newsModel;
use App\Http\Models\productModel;
use App\Http\Controllers\Controller;

class SitemapController extends Controller
{
    public function sitemap(Request $request, $type){
        $page = $request->get('page');
        $data = [];
        $totalCount = 0;
        if($type == 'post'){
            if($page){
                $limit = 500;
                $offset = (intval($page)-1) * $limit;
                $data = newsModel::where('STATUS', 1)->offset($offset)->limit($limit)->orderBy('DATECREATE')->get();
                if($data->count() == 0){
                    return abort('404');
                }
            }
            else{
                $data = newsModel::where('STATUS', 1)->get();
                $totalCount = (int)((count($data) / 500) + 1);
            }
        }
        elseif($type == 'category'){
            $data = catModel::all();
        }
        elseif($type == 'page'){
            $data = [
                'thong-tin/dai-ly',
                'thong-tin/gioi-thieu',
                'thong-tin/hinh-thuc-giao-hang',
                'thong-tin/hinh-thuc-thanh-toan',
                'thong-tin/chinh-sach-doi-tra',
                'thong-tin/chinh-sach-bao-mat',
                'thong-tin/chinh-sach-bien-tap'
            ];
        }
        // elseif($type == 'brand'){
        //     $data = ProductCategory::isBrand(true)->get();
        // }
        elseif($type == 'product'){
            if($page){
                $limit = 1000;
                $offset = (intval($page)-1) * $limit;
                $data = productModel::orderBy('POST_DATE')->offset($offset)->limit($limit)->get();
                if($data->count() == 0){
                    return abort('404');
                }
            }
            else{
                $data = productModel::all();
                $totalCount = (int)((count($data) / 1000) + 1);
            }
        }
        else{
            return abort('404');
        }
        
        return response()->view('user.partial.sitemap',
                compact(['totalCount','data','type']))
                ->header('Content-Type', 'text/xml');
    }
}

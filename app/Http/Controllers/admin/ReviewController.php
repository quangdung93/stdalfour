<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Models\reviewModel;
use App\Http\Models\commentsModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function listReview() {
		$review = commentsModel::where('binhluan_id','!=',0)->orderBy('binhluan_id','DESC')->paginate(20);
        return view('admin.modules.review.review', ['review' => $review]);
    }
	public function getDeleteReview(Request $request){
		$id = $request->id;
		DB::table('review')->where('review_id', $id)->delete();
		return redirect('dt-admin/review', 301);
	}
}
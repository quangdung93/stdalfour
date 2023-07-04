<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Models\reviewModel;
use App\Http\Models\commentsModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Rating;

class ReviewController extends Controller
{
    public function listReview() {
		$ratings = Rating::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('admin.modules.review.review', ['ratings' => $ratings]);
    }

	public function getEdit(Request $request){
		$id = $request->id;
		$rating = Rating::where('id', $id)->first();
		return view('admin.modules.review.edit', ['rating' => $rating]);
	}

	public function postEdit(Request $request, $id){
		$rating = Rating::where('id', $id)->first();

		$dataUpdate = [
			'name_user' => $request->name_user,
			'vote' => $request->vote,
			'comment' => $request->comment,
			'status' => $request->status,
		];

		if($request->hasFile('image')){
            $image = $request->file('image');
            $upload = $this->uploadImage('rating', $image);

            if($upload){
				$fileName = explode('/', $upload);
				$fileName = end($fileName);
				$imageStore = explode(',', $rating->images);
				array_push($imageStore, $fileName);
				$imageStore = array_values(array_filter($imageStore));
                $dataUpdate['images'] = implode(',', $imageStore);
            }
        }

		$rating->update($dataUpdate);

		return redirect('dt-admin/review/edit/'. $id);
	}

	public function postRemoveImage(Request $request){
		$image = $request->imageName;
		$rating = Rating::where('id', $request->id)->first();
		$imageStore = explode(',', $rating->images);

		if(in_array($image, $imageStore)){
			$temp = array_values(array_diff($imageStore, [$image]));
			$temp = implode(',', $temp);
			$rating->images = $temp;
			$rating->save();
		}

		return response()->json([
			'error' => 0,
			'message' => 'Xóa ảnh thành công!'
		]);
	}

	public function getDeleteReview(Request $request){
		$id = $request->id;
		Rating::where('id', $id)->delete();
		return redirect('dt-admin/review', 301);
	}
}
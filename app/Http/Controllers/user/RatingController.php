<?php

namespace App\Http\Controllers\user;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RatingReply;
use Illuminate\Support\Facades\Cookie;

class RatingController extends Controller
{
    public function __construct()
    {

    }

    public function createRatingAction(Request $request){
        $data = [
            'name_user' => $request->name,
            'comment' => $request->comment,
            'phone_user' => $request->phone,
            'images' => $request->images,
            'ip_request' => request()->ip(),
            'vote' => $request->vote,
            'product_id' => $request->product_id,
            'status' => 1
        ];

        $create = Rating::create($data);

        if($create){
            return response()->json([
                'error' => 0,
                'message' => 'Đánh giá sản phẩm thành công!',
                'data' => $create
            ]);
        }
        else{
            return response()->json([
                'error' => 1,
                'message' => 'Đánh giá sản phẩm thất bại!'
            ]);
        }
    }

    public function replyRating(Request $request){
        $data = [
            'rating_id' => $request->rating_id,
            'comment' => $request->comment,
            'created_by' => Cookie::get('userAdId') ?? ""
        ];

        $create = RatingReply::create($data);

        if($create){
            return response()->json([
                'error' => 0,
                'message' => 'Trả lời đánh giá thành công!',
                'data' => $create
            ]);
        }
        else{
            return response()->json([
                'error' => 1,
                'message' => 'Trả lời đánh giá thất bại!'
            ]);
        }
    }

    public function uploadImageAction(Request $request){
        if($request->hasFile('files')){
            $files = $request->file('files');
            $result = [];
            foreach ($files as $key => $file) {
                $image = $this->uploadImage('rating', $file);
                $result[] = $image;
            }

            if($result){
                return response()->json([
                    'error' => 0,
                    'data' => $result,
                    'message' => 'Upload thành công!'
                ]);
            }
        }

        return response()->json([
            'error' => 1,
            'message' => 'Upload thất bại!'
        ]);
    }
    
}

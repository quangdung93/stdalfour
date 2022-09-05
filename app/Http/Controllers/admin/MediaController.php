<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\mediaModel;
use App\Http\Models\productimageModel;
use Session;
use DB;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
	public function getList(){
		$media = DB::table('media')->paginate(20);
		return view('admin.modules.media.list',['media'=>$media]);
	}
	public function getAddMedia(){
		return view('admin.modules.media.add');
	}
	public function postAddMedia(Request $request){
		$filename = "";
		if ($request->hasFile('upload')) {
			$files = $request->file('upload');
			$extension = $files->getClientOriginalExtension();
			$filename =  'album-' . time() . '.' . $extension;
			$destinationPath = 'images/media';
			$files->move($destinationPath, $filename);
		}
		$insert_data[] = array(
			'media_image'  => $filename,
			'video'  => $request->video,
		);
		if(!empty($insert_data)){
			DB::table('media')->insert($insert_data);
		}
			return back()->with('success', 'Bạn đã thêm media thành công');
	}
	public function getEditMedia(Request $request){
		$id = $request->id;
		$media = DB::table('media')->where('media_id',$id)->first();
		return view('admin.modules.media.edit', ['media' => $media]);
	}
	public function postEditMedia(Request $request){
		$id = $request->route('id');
		$media = mediaModel::find($id);
		$media->video = $request->video;
		if ($request->hasFile('upload')) {
			$files = $request->file('upload');
			$extension = $files->getClientOriginalExtension();
			$filename = 'album-' . time() . '.' . $extension;
			$destinationPath = 'images/media';
			$files->move($destinationPath, $filename);
			if($filename){
				$media->media_image = $filename;
			}
		}
		$media->save();
		return back()->with('success', 'Bạn đã cập nhật media thành công');
	}
	public function getDeleteMedia(Request $request){
		$id = $request->id;
		DB::table('media')->where('media_id', $id)->delete();
		return redirect('dt-admin/media', 301);
	}
	public function postUpload(Request $request){
		$image_code = array();
		$html = '';
		$product_id = $request->product_id;
		if ($request->hasFile('image_file')) {
			$images = $request->file('image_file');
			foreach($images as $image){
				$new_name =   'image-'.rand() . '.' . $image->getClientOriginalExtension();
				$image->move('images/project', $new_name);
				$image_code[] = $new_name;
				$html .= "<div class='col-md-2 check-up-image'>
						<input type='hidden' name='listimage[]' value='$new_name'/>
						<img src='/images/project/$new_name' width='100%'>
						<span class='btn btn-danger deleteupload'><i class='fas fa-trash-alt'></i></span>
					</div>";
				if($product_id != 0){
					$insert_data_img = array();
					$insert_data_img[] = array(
						'PRODUCTID'  => $product_id,
						'BASE_URL' => '/images/project/'.$new_name,
						'SORT' => 0
					);
					if(!empty($insert_data_img)){
						productimageModel::insert($insert_data_img);
					}
				}
			}
		}
		echo $html;
	}
	public function postUploadServices(Request $request){
		$image_code = array();
		$html = '';
		if ($request->hasFile('image_file')) {
			$images = $request->file('image_file');
			foreach($images as $image){
				$new_name =   'image-'.rand() . '.' . $image->getClientOriginalExtension();
				$image->move('images/services', $new_name);
				$image_code[] = $new_name;
				$html .= "<div class='col-md-2 check-up-image'>
						<input type='hidden' name='listimage[]' value='$new_name'/>
						<img src='/images/services/$new_name' width='100%'>
						<span class='btn btn-danger deleteupload'><i class='fas fa-trash-alt'></i></span>
					</div>";
			}
		}
		echo $html;
	}
	public function checkDelimage(Request $request){
		$check = "error";
		$image_id = $request->image_id;
		if($image_id != 0){
			productimageModel::where('ID', $image_id)->delete();
			$check = "oke";
		}
		return $check;
	}
}
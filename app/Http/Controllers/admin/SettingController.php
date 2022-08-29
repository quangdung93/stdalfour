<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\settingModel;
use Session;
use DB;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
	public function getEditSetting(Request $request){
		$id = $request->id;
		$setting = settingModel::where('setting_id',$id)->first();
		return view('admin.modules.setting.edit', ['setting' => $setting]);
	}
	public function postEditSetting(Request $request){
		$id = $request->route('id');
		$setting = settingModel::find($id);
		$setting->link_facebook = $request->link_facebook;
		$setting->off_site = $request->off_site;
		$setting->link_play = $request->link_play;
		$setting->link_insta = $request->link_insta;
		$setting->hotline = $request->hotline;
		$setting->email = $request->email;
		$setting->footer_vi = $request->footer_vi;
		$setting->address_vi = $request->address_vi;
		$setting->link_twitter = $request->link_twitter;
		$setting->link_pinterest = $request->link_pinterest;
		$setting->send_email = $request->send_email;
		$setting->send_email_pass = $request->send_email_pass;
		$setting->custom_add_footer = $request->custom_add_footer ? $request->custom_add_footer : '';
		$setting->custom_add_header = $request->custom_add_header ? $request->custom_add_header : '';
		$newCat = $request->cat_list ? $request->cat_list : [];
		if($newCat){
			$setting->cat_list = join($newCat,',');
		}
		if ($request->hasFile('upload_logo')) {
			$files = $request->file('upload_logo');
			$extension = $files->getClientOriginalExtension();
			$filename = 'logo-' . time() . '.' . $extension;
			$destinationPath = 'images/setting';
			$files->move($destinationPath, $filename);
			if($filename){
				$setting->logo = $filename;
			}
		}
		if ($request->hasFile('upload_logo_light')) {
			$files = $request->file('upload_logo_light');
			$extension = $files->getClientOriginalExtension();
			$filename = 'logo-light-' . time() . '.' . $extension;
			$destinationPath = 'images/setting';
			$files->move($destinationPath, $filename);
			if($filename){
				$setting->logo_light = $filename;
			}
		}
		$gallery_list = $image_code = '';
		if ($request->listimage) {
			$image_code = $request->listimage;
			$gallery_list = join($image_code,'|');
		}
		if($gallery_list){
			$setting->about_gallery_list = $gallery_list;
		}
		$setting->save();
		return back()->with('success', 'Bạn đã cập nhật setting thành công');
	}
}
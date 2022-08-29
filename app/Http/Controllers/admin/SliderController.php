<?php

namespace App\Http\Controllers\admin;

use Custom;
use App\Http\Models\sliderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use File;
class SliderController extends Controller
{

    public function index()
    {
        $slider = sliderModel::orderByDesc("id")->get();
        return view('admin.modules.slider.list',compact('slider'));
    }

    public function create()
    {
        return view('admin.modules.slider.create');
    }

    public function store(Request $request)
    {
        set_time_limit(-1);
        $rules = [
            'title' => 'required',
        ];
        $messages = [
            'title.required' => 'Tiêu đề không để trống',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        if (empty($request->title))
            return redirect()->back()->withInput()->with('error','Tiêu đề Tiếng Việt hoặc Tiếng Anh không được trống');
        $slider = new sliderModel();
		
        if ($request->hasFile('image')){
            $result = Custom::MoveFile($request->file('image'),'images/slider',$name_file = str_slug($request->title.' vi ', '-'));
            if (!$result['success'])
                return redirect()->back()->withInput()->with('error',$result['message']);
            $slider->image = $result['file_name'];
        }
		if($request->hasFile('image_mobile')){
            $result_mobi = Custom::MoveFile($request->file('image_mobile'),'images/slider',$name_file = str_slug($request->title.' mb vi ', '-'));
            if (!$result_mobi['success'])
                return redirect()->back()->withInput()->with('error',$result_mobi['message']);
            $slider->image_mobile = $result_mobi['file_name'];
        }
        $slider->title = $request->title;
		$slider->text_one = $request->text_one;
        $slider->text_two = $request->text_two;
		$slider->text_right = $request->text_right;
		$slider->text_right_bot = $request->text_right_bot;
        $slider->slug = isset($request->slug)?$request->slug:str_slug($request->title, '-');
        $slider->position = $request->position;
		$slider->image_url = $request->image_url;
		$slider->text_url_right = $request->text_url_right;

        if ($slider->save())
            return back()->with('success', 'Bạn đã thêm slider thành công');
        return redirect()->back()->withInput()->with('error','Đã có lỗi khi thêm. Vui lòng thử lại');
    }

    public function edit($id)
    {
        $slider = sliderModel::find($id);
        return view('admin.modules.slider.edit',compact('slider'));
    }

    public function update(Request $request, $id)
    {
        set_time_limit(-1);
        $rules = [
            'title' => 'required'
        ];
        $messages = [
            'title.required' => 'Tiêu đề không để trống'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        if (empty($request->title))
            return redirect()->back()->withInput()->with('error','Tiêu đề Tiếng Việt hoặc Tiếng Anh không được trống');

        $slider = sliderModel::find($id);

        if ($request->hasFile('image')){
            $img_current = 'images/slider'."/".$slider->image;
            if(File::exists($img_current));
            File::delete($img_current);
            $result = Custom::MoveFile($request->file('image'),'images/slider',$name_file = str_slug($request->title.' vi ', '-'));
            if (!$result['success'])
                return redirect()->back()->withInput()->with('error',$result['message']);
            $slider->image = $result['file_name'];
        }
		if($request->hasFile('image_mobile')){
            $result_mobi = Custom::MoveFile($request->file('image_mobile'),'images/slider',$name_file = str_slug($request->title.' mb vi ', '-'));
            if (!$result_mobi['success'])
                return redirect()->back()->withInput()->with('error',$result_mobi['message']);
            $slider->image_mobile = $result_mobi['file_name'];
        }
        $slider->title = $request->title;
		$slider->text_one = $request->text_one;
        $slider->text_two = $request->text_two;
		$slider->text_right = $request->text_right;
		$slider->text_right_bot = $request->text_right_bot;
        $slider->slug = $slider->slug;
        $slider->position = $request->position;
        $slider->image_url = $request->image_url;
		$slider->text_url_right = $request->text_url_right;
		
        if ($slider->save())
		return back()->with('success', 'Cập nhật slider thành công');
        return redirect()->back()->withInput()->with('error','Đã có lỗi khi thêm. Vui lòng thử lại');
    }


    public function destroy($id)
    {
        $slider = sliderModel::find($id);
        $img_current = base_path() . 'images/slider'."/".$slider->image;
        if (File::exists($img_current)) {
            File::delete($img_current);
        }
        if ($slider->delete())
            return redirect(route('slider.list'))->with('success','Đã xóa thành công!');
        else
        {
            return redirect()->back()->withInput()->with('error','Đã có lỗi khi xóa. Vui lòng thử lại');
        }

    }
}

@extends('admin.main')
@section('title-admin','Cập nhật Slider Trang chủ')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Cập nhật Slider Trang chủ</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                       <li class="breadcrumb-item active">Cập nhật Slider Trang chủ</li>
                   </ol>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Cập nhật Slider Trang chủ</h4>
                </div>
				@if(Session::has('success'))
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						{!! Session::get('success') !!}
					</div>
				@endif
				@if(Session::has('error'))
					<div class="alert alert-danger" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						{!! Session::get('error') !!}
					</div>
				@endif
				@if ($errors->any())
					<div class="alert alert-danger" role="alert">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<form method="post" enctype="multipart/form-data" action="{{route('slider.update',['id'=>$slider->id])}}">
					<input name="_method" type="hidden" value="PUT">
					{{ csrf_field() }}
					<div class="form-body">
						<div class="card-body">
							<div class="row pt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Tiêu đề chính</label>
										<input name="title" type="text" id="title" class="form-control" value="{{ $slider->title }}" size="35" />
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Vị trí</label>
										<input name="position" type="number" id="position" value="{{ $slider->position }}" class="form-control" size="35" />
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row pt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Tiêu đề block 1</label>
										<input name="text_one" type="text" value="{{ $slider->text_one }}" id="text_one" class="form-control" size="35" />
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Text giới thiệu block 1</label>
										<input name="text_two" type="text" value="{{ $slider->text_two }}" id="text_two" class="form-control" size="35" />
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row pt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Tiêu đề block 2</label>
										<input name="text_right" type="text" value="{{ $slider->text_right }}" id="text_right" class="form-control" size="35" />
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Text giới thiệu block 2</label>
										<input name="text_right_bot" type="text" value="{{ $slider->text_right_bot }}" id="text_right_bot" class="form-control" size="35" />
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row pt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Text Block 3</label>
										<input name="text_url_right" type="text" id="text_url_right" value="{{ $slider->text_url_right }}" class="form-control" size="35" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Link Block 1</label>
										<input name="image_url" type="text" id="image_url" value="{{ $slider->image_url }}" class="form-control" size="35" />
									</div>
								</div>
							</div>
							<div class="row pt-3">
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label class="control-label">Hình nền slider (1920x566px)</label>
										<input type="file" name="image" class="form-control" />
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label class="control-label">Hình nền slider Mobile (685x485px)</label>
										<input type="file" name="image_mobile" class="form-control" />
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions">
                             <div class="card-body">
                                  <button type="submit" class="btn btn-success" name="ok"> <i class="fa fa-check"></i> Save</button>
                                  <a href="javascript:history.back()"><button type="button" class="btn btn-dark">Hủy bỏ</button></a>
                             </div>
                       </div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
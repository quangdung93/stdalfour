@extends('admin.main')
@section('title-admin','Cập nhật danh mục tin tức')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Cập nhật danh mục tin tức</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                       <li class="breadcrumb-item active">Cập nhật danh mục tin tức</li>
                   </ol>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Cập nhật danh mục tin tức</h4>
                </div>
				@if(count($errors) > 0)
				<div class="alert alert-danger">
					Upload Validation Error<br><br>
					<ul>
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			    @endif
			    @if($message = Session::get('success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>{{ $message }}</strong>
					</div>
				@endif
				<form method="post" enctype="multipart/form-data" action="{{ url('/dt-admin/category-news/sua/'.$categorynews->ID) }}">
					{{ csrf_field() }}
					<div class="form-body">
								<div class="card-body">
									<div class="row pt-3">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Tên tiêu đề</label>
												<input name="cat_name" type="text" id="cat_name" value="{{ $categorynews->NAME }}" class="form-control" size="35" />
											</div>
										</div>
										<div class="col-md-6">
											<label class="control-label">Chọn danh mục</label>
											@php
												$categorylist = DB::table('category_news')->join('category_detail', 'category_news.ID', '=', 'category_detail.CATEGORYID')->where('PARENTID',0)->get();
											@endphp
											<select name="cat_id" class="form-control">
												<option value="0">--- Danh mục gốc ---</option>
												@foreach($categorylist as $cat)
													<option value="{{ $cat->ID }}" @if($cat->CATEGORYID == $categorynews->PARENTID) selected @endif>{{ $cat->NAME }}</option>
													@php
														$catgetsub = DB::table('category_news')->join('category_detail', 'category_news.ID', '=', 'category_detail.CATEGORYID')->where('PARENTID',$cat->ID)->where('category_news.STATUS',1)->orderBy('category_news.SORT','ASC')->get();
													@endphp
													@if($catgetsub)
														@foreach($catgetsub as $key => $sub)
															<option value="{{ $sub->ID }}" @if($sub->CATEGORYID == $categorynews->PARENTID) selected @endif>{{ $cat->NAME.' > '.$sub->NAME }}</option>
															@php
																$catgetsubsubsub = DB::table('category_news')->join('category_detail', 'category_news.ID', '=', 'category_detail.CATEGORYID')->where('PARENTID',$sub->ID)->where('category_news.STATUS',1)->get();
															@endphp
															@if($catgetsubsubsub)
																@foreach($catgetsubsubsub as $subsub)
																	<option value="{{ $subsub->ID }}" @if($subsub->CATEGORYID == $categorynews->PARENTID) selected @endif>{{ $cat->NAME.' > '.$sub->NAME.' > '.$subsub->NAME }}</option>
																@endforeach
															@endif
														@endforeach
													@endif
												@endforeach
											</select>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label">Ảnh</label>
												<div style="display: flex;">
													<input id="linkimages" name="txtImages" value="{{ $categorynews->IMAGE }}" class="form-control" type="text">
													<span class="input-group-btn">
														<button class="btn btn-sm btn-default" type="button" id="btnimages" onclick="BrowseServerList('linkimages');" style="height: 38px;background: #9dc700;color: #fff;margin-left: 5px;">
															<i class="ace-icon glyphicon glyphicon-upload bigger-110"></i>
															Browser
														</button>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="row pt-3">
										<div class="col-md-6">
											<div class="form-group">
												<label>Trạng thái</label>
												<select name="cat_enabled" class="form-control">
													<option value="0" @if($categorynews->STATUS == 0) selected @endif>Khóa</option>
													<option value="1" @if($categorynews->STATUS == 1) selected @endif>Mở</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Hiện trang chủ</label>
												<select name="cat_home" class="form-control">
													<option value="0" @if($categorynews->CHECK_1 == 0) selected @endif>Ẩn</option>
													<option value="1" @if($categorynews->CHECK_1 == 1) selected @endif>Hiện</option>
												</select>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Nội dung tóm tắt</label>
												<textarea name="cat_des" class="form-control form-control-danger" id="cat_des" cols="30" rows="10" placeholder="Content">{{ $categorynews->SUMMARY }}</textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Nội dung</label>
												<textarea name="cat_content" class="form-control form-control-danger" id="cat_content" cols="30" rows="10" placeholder="Content">{{ $categorynews->CONTENT }}</textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<h4 class="card-title">SEO</h4>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Title</label>
												<textarea name="cat_title_seo" class="form-control form-control-danger" cols="30" rows="2" placeholder="Title">{{ $categorynews->SEO_TITLE }}</textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Description</label>
												<textarea name="cat_des_seo" class="form-control form-control-danger" cols="30" rows="2" placeholder="Description">{{ $categorynews->SEO_DESCRIPTION }}</textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Keywords</label>
												<textarea name="cat_key_seo" class="form-control form-control-danger" cols="30" rows="2" placeholder="Keywords">{{ $categorynews->SEO_KEYWORDS }}</textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label">Image</label>
												<div style="display: flex;">
													<input id="linkimagesseo" name="txtImagesSeo" value="{{ $categorynews->SEO_IMAGE }}" class="form-control" type="text">
													<span class="input-group-btn">
														<button class="btn btn-sm btn-default" type="button" id="btnimages" onclick="BrowseServerList('linkimagesseo');" style="height: 38px;background: #9dc700;color: #fff;margin-left: 5px;">
															<i class="ace-icon glyphicon glyphicon-upload bigger-110"></i>
															Browser
														</button>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							
						<div class="form-actions">
                             <div class="card-body">
                                  <button type="submit" class="btn btn-success" name="ok"> <i class="fa fa-check"></i> Save</button>
                                  <button type="button" class="btn btn-dark">Cancel</button>
                             </div>
                       </div>
					 </div>
				</form>
			</div>
		</div>
	</div>
@endsection
@section('admin-js')
	<script>
		$(document).ready(function(){
			CKEDITOR.replace('cat_content',{height: '400px'});
		});
	</script>
@endsection
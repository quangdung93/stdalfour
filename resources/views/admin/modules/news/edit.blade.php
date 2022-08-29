@extends('admin.main')
@section('title-admin','Cập nhật tin tức')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Cập nhật tin tức</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                       <li class="breadcrumb-item active">Cập nhật tin tức</li>
                   </ol>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Cập nhật tin tức</h4>
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
				<form method="post" enctype="multipart/form-data" action="{{ url('/dt-admin/news/sua/'.$news->ID) }}">
					{{ csrf_field() }}
					<div class="form-body">
								<div class="card-body">
									<div class="row pt-3">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Tên tin tức</label>
												<input name="news_name" type="text" id="news_name" value="{{ $news->NAME }}" class="form-control" size="35" />
											</div>
										</div>
										<div class="col-md-6">
											<label class="control-label">Chọn danh mục</label>
											@php
												$category = DB::table('category_news')->join('category_news_detail', 'category_news.ID', '=', 'category_news_detail.CATEGORYID')->get();
											@endphp
											<select name="cat_id" class="form-control">
												@foreach($category as $cat)
													<option value="{{ $cat->ID }}" @if($news->CAT_ID == $cat->ID) selected @endif>{{ $cat->NAME }}</option>
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
													<input id="linkimages" required name="txtImages" value="{{ $news->IMAGE }}" class="form-control" type="text">
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
												<select name="news_enabled" class="form-control">
													<option value="0" @if($news->STATUS == 0) selected @endif>Khóa</option>
													<option value="1" @if($news->STATUS == 1) selected @endif>Mở</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Hiện trang chủ</label>
												<select name="news_home" class="form-control">
													<option value="0" selected>Ẩn</option>
													<option value="1">Hiện</option>
												</select>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Mô tả</label>
												<textarea name="news_des" class="form-control form-control-danger" id="news_des" cols="30" rows="10" placeholder="Content">{{ $news->SUMMARY }}</textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Nội dung</label>
												<textarea name="news_content" class="form-control form-control-danger" id="news_content" cols="30" rows="10" placeholder="Content">{{ $news->CONTENT }}</textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<h4 class="card-title">SEO</h4>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Url</label>
												<input name="news_url" type="text" id="news_url" value="{{ $news->URL }}" class="form-control" size="35" />
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Title</label>
												<textarea name="news_title_seo" class="form-control form-control-danger" cols="30" rows="2" placeholder="Title">{{ $news->SEO_TITLE }}</textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Description</label>
												<textarea name="news_des_seo" class="form-control form-control-danger" cols="30" rows="2" placeholder="Description">{{ $news->SEO_DESCRIPTION }}</textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Keywords</label>
												<textarea name="news_key_seo" class="form-control form-control-danger" cols="30" rows="2" placeholder="Keywords">{{ $news->SEO_KEYWORDS }}</textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label">Image</label>
												<div style="display: flex;">
													<input id="linkimagesseo" name="txtImagesSeo" value="{{ $news->SEO_IMAGE }}" class="form-control" type="text">
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
			CKEDITOR.replace('news_content',{height: '400px', allowedContent: true});
		});
	</script>
@endsection
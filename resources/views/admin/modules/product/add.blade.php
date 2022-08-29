@extends('admin.main')
@section('title-admin','Thêm sản phẩm')
@section('content-admin')
	<link href="/backend/assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Thêm sản phẩm</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                       <li class="breadcrumb-item active">Thêm sản phẩm</li>
                   </ol>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Thêm sản phẩm</h4>
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
				<form method="post" enctype="multipart/form-data" action="{{ url('/dt-admin/product/them') }}" id="upload">
					{{ csrf_field() }}
					<div class="form-body">
						<div class="card-body">
							<div class="row pt-3">
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label">Tên sản phẩm</label>
										<input name="product_id" type="hidden" id="product_id" value="0" class="form-control" size="35" />
										<input name="product_name" type="text" id="product_name" class="form-control" size="35" />
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row pt-3">
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label">Ảnh</label>
										<div style="display: flex;">
											<input id="linkimages" required name="txtImages" class="form-control" type="text">
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
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Mô tả</label>
										<textarea name="product_summary" id="product_summary" class="form-control form-control-danger" cols="30" rows="5" placeholder="Content"></textarea>
									</div>
								</div>
							</div>
							<div class="row pt-3">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Nội dung thông tin</label>
										<textarea name="product_origin" id="product_origin" class="form-control form-control-danger" cols="30" rows="5" placeholder="Content"></textarea>
									</div>
								</div>
							</div>
							<div class="row pt-3">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Nội dung chi tiết</label>
										<textarea name="product_content" id="product_content" class="form-control form-control-danger" cols="30" rows="5" placeholder="Content"></textarea>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<h4 class="card-title">Thông tin sản phẩm</h4>
									<!-- Nav tabs -->
									<div class="vtabs customvtab">
										<ul class="nav nav-tabs tabs-vertical" role="tablist">
											<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home3" role="tab"><span><i class="ti-home"></i></span> <span class="hidden-xs-down">Thuộc tính</span> </a> </li>
											<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#hinhanh" role="tab"><span><i class="ti-image"></i></span> <span class="hidden-xs-down">Hình ảnh</span></a> </li>
											<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile3" role="tab"><span><i class="ti-user"></i></span> <span class="hidden-xs-down">Thông tin khác</span></a> </li>
											<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages3" role="tab"><span><i class="ti-email"></i></span> <span class="hidden-xs-down">SEO</span></a> </li>
										</ul>
										<!-- Tab panes -->
										<div class="tab-content top-padding-0">
											<div class="tab-pane active" id="home3" role="tabpanel">
												<div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<select id="cat_list" name="cat_list[]" class="form-control" multiple></select>
															</div>
														</div>
														<!--/span-->
													</div>
													<div class="row pt-3">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label">Tag</label>
																<input name="product_task_vi" type="text" id="product_task_vi" class="form-control" size="35" />
															</div>
														</div>
													</div>
													<div class="row pt-3">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">Giá bán</label>
																<input name="product_price" type="number" class="form-control" size="35" />
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">Giá giảm</label>
																<input name="product_discount" type="number" class="form-control" size="35" />
															</div>
														</div>
													</div>
													<div class="row pt-3">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">Trạng thái</label>
																<select name="product_status" class="form-control">
																	<option value="0">Ẩn</option>
																	<option value="1" selected>Hiện</option>
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">Còn hàng</label>
																<select name="product_instock" class="form-control">
																	<option value="0">Hết</option>
																	<option value="1" selected>Còn</option>
																</select>
															</div>
														</div>
													</div>
													<div class="row pt-3">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">Sản phẩm bán chạy</label>
																<select name="product_hot" class="form-control">
																	<option value="0">Ẩn</option>
																	<option value="1">Hiện</option>
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">Sản phẩm ưa chuộng</label>
																<select name="product_selling" class="form-control">
																	<option value="0">Ẩn</option>
																	<option value="1">Hiện</option>
																</select>
															</div>
														</div>
													</div>
													<div class="row pt-3">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">Nổi bật trang chủ</label>
																<select name="product_saleoff" class="form-control">
																	<option value="0">Ẩn</option>
																	<option value="1">Hiện</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="hinhanh" role="tabpanel">
												<div class="row pt-3">
													<div class="col-md-12">
														<div class="form-group">
															<label>Hình ảnh liên quan</label>
															<div class="previewPhoto">
																<div style="margin-bottom: 20px;">
																	<a href="javascript:void(0);" class="btn btn-success addAlbum" title="Thêm hình ảnh"><i class="fa fa-plus" aria-hidden="true"></i> Thêm hình ảnh</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="profile3" role="tabpanel">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label">Quà tặng</label>
															<input name="product_gift" type="text" id="product_gift" class="form-control" size="35" />
														</div>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<label class="control-label">Ảnh quà tặng</label>
															<div style="display: flex;">
																<input id="product_giftimg" name="product_giftimg" class="form-control" type="text">
																<span class="input-group-btn">
																	<button class="btn btn-sm btn-default" type="button" id="btnimages" onclick="BrowseServerList('product_giftimg');" style="height: 38px;background: #9dc700;color: #fff;margin-left: 5px;">
																		<i class="ace-icon glyphicon glyphicon-upload bigger-110"></i>
																		Browser
																	</button>
																</span>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label">Link quà tặng</label>
															<input name="product_giftlink" type="text" id="product_giftlink" class="form-control" size="35" />
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label">Bảo hành</label>
															<input name="product_bhanh" type="text" id="product_bhanh" class="form-control" size="35" />
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="messages3" role="tabpanel">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label">Title</label>
															<textarea name="product_seo_title" id="product_seo_title" class="form-control form-control-danger" cols="30" rows="2" placeholder="Content"></textarea>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label">Description</label>
															<textarea name="product_seo_description" id="product_seo_description" class="form-control form-control-danger" cols="30" rows="3" placeholder="Content"></textarea>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label">Keywords</label>
															<textarea name="product_seo_keywords" id="product_seo_keywords" class="form-control form-control-danger" cols="30" rows="2" placeholder="Content"></textarea>
														</div>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<label class="control-label">Image Share Facebook</label>
															<div style="display: flex;">
																<input id="linkimagesfac" name="txtImagesFace" class="form-control" type="text">
																<span class="input-group-btn">
																	<button class="btn btn-sm btn-default" type="button" id="btnimages" onclick="BrowseServerList('linkimagesfac');" style="height: 38px;background: #9dc700;color: #fff;margin-left: 5px;">
																		<i class="ace-icon glyphicon glyphicon-upload bigger-110"></i>
																		Browser
																	</button>
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions">
                            <div class="card-body" style="text-align: center;">
                                 <button type="submit" class="btn btn-success" name="ok"> <i class="fa fa-check"></i> Thêm sản phẩm</button>
                            </div>
                       </div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@section('admin-js')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<script>
		$('#cat_list').select2({
			placeholder: "Nhập tên danh mục",
			minimumInputLength: 2,
			ajax: {
				url: '/dt-admin/product/catfind',
				dataType: 'json',
				data: function (params) {
					return {
						q: $.trim(params.term)
					};
				},
				processResults: function (data) {
					return {
						results: data
					};
				},
				cache: true
			}
		});
		$(document).ready(function(){
			CKEDITOR.replace('product_content',{height: '600px', allowedContent: true});
			CKEDITOR.replace('product_origin',{height: '600px', allowedContent: true});
			var maxField = 60;
			var addButton = $('.addAlbum');
			var wrapper = ('.previewPhoto');
			var x = 1;
			$(addButton).click(function(){
				if(x < maxField){
					x++;
					var fieldHTML = '<div class="col-md-2 check-up-image"><a href="javascript:;" onclick="BrowseServerListAlbum('+ x + 2 +', '+ x + 1 +');"><img id="'+ x + 1 +'" style="width: 100%;" src="/backend/img/article.png"/></a><input type="hidden" name="listimage[]" id="'+ x + 2 +'" value=""/><a href="javascript:void(0);" class="btn btn-danger btn-circle remove_button" title="Xóa" style="margin-top: 10px;"><i class="fas fa-trash"></i></a></div>';
					$(this).closest(wrapper).append(fieldHTML);
				}else{
					alert('Đã úp quá 60 hình cho phép');
				}
			});
			$(wrapper).on('click', '.remove_button', function(e){
				e.preventDefault();
				$(this).parent('div').remove();
				x--;
			});
		});
	</script>
@endsection
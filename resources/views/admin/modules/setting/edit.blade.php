@extends('admin.main')
@section('title-admin','Cập nhật Setting')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Cập nhật Setting</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                       <li class="breadcrumb-item active">Cập nhật Setting</li>
                   </ol>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Cập nhật Setting</h4>
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
				<form method="post" enctype="multipart/form-data" action="{{ url('/dt-admin/setting/sua/'.$setting->setting_id) }}" id="upload">
					{{ csrf_field() }}
					<div class="form-body">
						<div class="card-body">
							<div class="row pt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label style="border: 1px solid #d3d3d3; padding: 10px;"><?php if($setting->logo) { ?><img src="/images/setting/<?=$setting->logo?>" style="width: 200px;"><?php } ?></label>
										<input type="file" name="upload_logo" id="upload_logo" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label style="border: 1px solid #d3d3d3; padding: 10px;"><?php if($setting->logo_light) { ?><img src="/images/setting/<?=$setting->logo_light?>" style="width: 200px;"><?php } ?></label>
										<input type="file" name="upload_logo_light" id="upload_logo_light" class="form-control">
									</div>
								</div>
							</div>
							<div class="row pt-3">
								<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Chọn danh mục sản phẩm hiển thị trang chủ</label>
												<select id="cat_list" name="cat_list[]" class="form-control" multiple>
													@if($setting->cat_list)
														@php
															$listid = explode(',',$setting->cat_list);
															$getprocat = DB::table('category')->join('category_detail', 'category.ID', '=', 'category_detail.CATEGORYID')->whereIn('category.ID',$listid)->get();
														@endphp
														@if($getprocat)
															@foreach($getprocat as $cat)
																<?php
																	$namecat = $cat->NAME;
																	if($cat->PARENTID != 0){
																		$catgetsub = DB::table('category')->join('category_detail', 'category.ID', '=', 'category_detail.CATEGORYID')->where('ID',$cat->PARENTID)->first();
																		if($catgetsub){
																			$namecat = $catgetsub->NAME .' > '.$cat->NAME;
																			if($catgetsub->PARENTID != 0){
																				$catgetsubsub = DB::table('category')->join('category_detail', 'category.ID', '=', 'category_detail.CATEGORYID')->where('ID',$catgetsub->PARENTID)->first();
																				if($catgetsubsub){
																					$namecat = $catgetsubsub->NAME .' > '.$catgetsub->NAME .' > '.$cat->NAME;
																				}
																				if($catgetsubsub->PARENTID != 0){
																					$catgetsubsubsub = DB::table('category')->join('category_detail', 'category.ID', '=', 'category_detail.CATEGORYID')->where('ID',$catgetsubsub->PARENTID)->first();
																					if($catgetsubsubsub){
																						$namecat = $catgetsubsubsub->NAME .' > '.$catgetsubsub->NAME .' > '.$catgetsub->NAME .' > '.$cat->NAME;
																					}
																				}
																			}
																		}
																	}
																?>
																<option value="{{ $cat->ID }}" selected="selected">{{ $namecat }}</option>
															@endforeach
														@endif
													@endif
												</select>
											</div>
								</div>
								<!--/span-->
							</div>
							<div class="row pt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label>Link facebook</label>
										<input name="link_facebook" type="text" id="link_facebook" value="<?=$setting->link_facebook?>" class="form-control" size="35" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Link Youtube</label>
										<input name="link_play" type="text" id="link_play" value="<?=$setting->link_play?>" class="form-control" size="35" />
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row pt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label>Link Instagram</label>
										<input name="link_insta" type="text" id="link_insta" value="<?=$setting->link_insta?>" class="form-control" size="35" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Link Twitter</label>
										<input name="link_twitter" type="text" id="link_twitter" value="<?=$setting->link_twitter?>" class="form-control" size="35" />
									</div>
								</div>
								<!--/span-->
						   </div>
							<div class="row pt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label>Link Pinterest</label>
										<input name="link_pinterest" type="text" id="link_pinterest" value="<?=$setting->link_pinterest?>" class="form-control" size="35" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Hotline</label>
										<input name="hotline" type="text" id="hotline" value="<?=$setting->hotline?>" class="form-control" size="35" />
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row pt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label>Email</label>
										<input name="email" type="text" id="email" value="<?=$setting->email?>" class="form-control" size="35" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Địa chỉ</label>
										<input name="address_vi" type="text" id="address_vi" value="<?=$setting->address_vi?>" class="form-control" size="35" />
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row pt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label>Email confirm đơn hàng</label>
										<input name="send_email" type="text" id="send_email" value="<?=$setting->send_email?>" class="form-control" size="35" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Pass</label>
										<input name="send_email_pass" type="password" id="send_email_pass" value="<?=$setting->send_email_pass?>" class="form-control" size="35" />
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row pt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label>On/Off Website</label>
										<select name="off_site" class="form-control">
											<option value="0" @if($setting->off_site == 0) selected @endif>On</option>
											<option value="1" @if($setting->off_site == 1) selected @endif>Off</option>
										</select>
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row pt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label>	Gallery</label>
										<div id="btselect">
											<span class="btn btn-success fileinput-button dz-clickable">
												<i class="fa fa-plus" aria-hidden="true"></i>
												<span>Thêm hình ảnh</span>
												<input id="image_file" type="file" name="image_file[]" multiple />
											</span>
										</div>
										<div style="display:none;padding:5px 10px" id="actionmsg">
											<span id="actionico"></span> &nbsp <i id="actionname"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="row pt-3">
								<div id="drawimageupload">
									@php
										$pic_thumb_array = explode('|', $setting->about_gallery_list);
									@endphp
									@if(count($pic_thumb_array) > 0)
										@foreach ($pic_thumb_array as $pic_thumb_array_val)
										<div class="col-md-2 check-up-image">
											<input type="hidden" name='listimage[]' value="{{ $pic_thumb_array_val }}"/>
											<img src="{{ '/images/services/'.$pic_thumb_array_val }}" width='100%'>
											<span class='btn btn-danger deleteupload'><i class='fas fa-trash-alt'></i></span>
										</div>
										@endforeach
									@endif
								</div>
							</div>
							<div class="row pt-3">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Footer</label>
										<textarea name="footer_vi" class="form-control form-control-danger" id="footer_vi" cols="30" rows="10" placeholder="Content"><?=$setting->footer_vi?></textarea>
									</div>
								</div>
							</div>
							<div class="row pt-3">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Thêm script trong head</label>
										<textarea name="custom_add_header" class="form-control form-control-danger" cols="30" rows="10" placeholder="Code hoặc mã nhúng"><?=$setting->custom_add_header?></textarea>
									</div>
								</div>
							</div>
							<div class="row pt-3">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Thêm script trong footer</label>
										<textarea name="custom_add_footer" class="form-control form-control-danger" cols="30" rows="10" placeholder="Code hoặc mã nhúng"><?=$setting->custom_add_footer?></textarea>
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
			CKEDITOR.replace('footer_vi');
			$("#image_file").change(function(){
				var count = $("#drawimageupload div").length;
				if(count >= 31){
					alert("Bạn chỉ upload tối đa 30 hình");
					return;
				}
				document.getElementById("actionmsg").className = "alert alert-warning";
				document.getElementById("actionico").className = "fa fa-refresh";
				document.getElementById("actionname").innerHTML = "Xin chờ, Đang upload hình...!";
				$("#actionmsg").show();
				$("#btselect").hide();
				$("#isnumberImage").val(count);
					var token = $('#token').val();
					var route =  "{{ url('/dt-admin/upload-services') }}";
					var form = $('#upload')[0];
					var formData = new FormData(form);
					//console.log(form);
					$.ajax({
						url: route,
						headers: {'X-CSRF-TOKEN': token},                          
						type: "POST",
						data: formData,
						enctype: 'multipart/form-data',
						processData: false,
						contentType: false,
						success:function(data){
							//console.log(data);
							$("#actionmsg").hide();
							$("#btselect").show();
							$("#drawimageupload").append(data);
						},
					});
			});
		});
		$("#drawimageupload").on('click', '.deleteupload', function(e){
			e.preventDefault();
			$(this).parent('div').remove();
		});
	</script>
@endsection
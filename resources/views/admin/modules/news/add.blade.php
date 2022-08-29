@extends('admin.main')
@section('title-admin','Thêm tin tức')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Thêm tin tức</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                       <li class="breadcrumb-item active">Thêm tin tức</li>
                   </ol>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Thêm tin tức</h4>
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
				<form method="post" enctype="multipart/form-data" action="{{ url('/dt-admin/news/them') }}">
					{{ csrf_field() }}
					<div class="form-body">
								<div class="card-body">
									<div class="row pt-3">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Tên tin tức</label>
												<input name="news_name" type="text" id="news_name" class="form-control" size="35" />
											</div>
										</div>
										<div class="col-md-6">
											<label class="control-label">Chọn danh mục</label>
											@php
												$category = DB::table('category_news')->join('category_news_detail', 'category_news.ID', '=', 'category_news_detail.CATEGORYID')->get();
											@endphp
											<select name="cat_id" class="form-control">
												@foreach($category as $cat)
													<option value="{{ $cat->ID }}">{{ $cat->NAME }}</option>
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
										<div class="col-md-6">
											<div class="form-group">
												<label>Trạng thái</label>
												<select name="news_enabled" class="form-control">
													<option value="0">Khóa</option>
													<option value="1" selected>Mở</option>
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
												<textarea name="news_des" class="form-control form-control-danger" id="news_des" cols="30" rows="10" placeholder="Content"></textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									@php
										$news_content = '<div class="style1 pb-5">';
										$news_content .= '<p>FOREO makes self-care simple, easy, and enjoyable - that’s our mission. Our products are effective and clinically tested, providing real results. We help you achieve your full beauty potential in record time and empower you to work on your well-being for years to come.</p>';
										$news_content .= '<p>Our story started in Sweden, but now our products are all over the world. They are adored by professionals, celebrities, and (most likely) you, so let us tell you what it’s all about.</p>';
										$news_content .= '<h3>How we became who we are</h3>';
										$news_content .= '<p>Life can be complicated. Self-care doesn’t have to be. When we came up with the world’s first soft silicone facial cleansing brush LUNA™, our goal was to help you. We wanted to make a self-care device that’s available to you anytime, anywhere. We wanted to make you feel good by solving your skincare problems. Ultimately, we wanted to save your time, so you could focus on other aspects of your life while feeling great about yourself.</p>';
										$news_content .= '<p>A decade later, we’re still doing the same. Because we know spas can be expensive and you don’t always have enough time to visit them. Your time is precious and your well-being matters. That’s why FOREO is for everyone, and we embedded that idea in our name.</p>';
										$news_content .= '<div class="row pt-5">';
										$news_content .= '<div class="col-lg-5">';
										$news_content .= '<div class="pe-5">';
										$news_content .= '<h3>“This world could be one”</h3>';
										$news_content .= ' <p>Inspired by Queen’s legendary song “Heaven For Everyone”, our founder Filip Sedić decided to implement Freddie Mercury’s message into the company. FOREO comes from “FOR EveryOne” and that illustrated our mission – to tear down labels while inspiring everyone to be themselves.</p>';
										$news_content .= '<p>Together with all the people, we want to make this world one and emphasize its beauty by following our dream of reinventing beauty with science & technology. Our values kept us innovative, passionate, and able to think fearlessly. As a result, we shaped the beauty-tech industry and made self-care more accessible and enjoyable.</p>';
										$news_content .= '</div>';
										$news_content .= '</div>';
										$news_content .= '<div class="col-lg-7"><img class="img-fluid" src="/img/intro/img1.jpg" alt=""></div>';
										$news_content .= '</div>';
										$news_content .= '<div class="row pt-5">';
										$news_content .= '<div class="col-lg-7"><img class="img-fluid" src="/img/intro/img2.jpg" alt=""></div>';
										$news_content .= '<div class="col-lg-5">';
										$news_content .= '<div class="ps-5">';
										$news_content .= '<h3>“This world could be one”</h3>';
										$news_content .= '<p>Inspired by Queen’s legendary song “Heaven For Everyone”, our founder Filip Sedić decided to implement Freddie Mercury’s message into the company. FOREO comes from “FOR EveryOne” and that illustrated our mission – to tear down labels while inspiring everyone to be themselves.</p>';
										$news_content .= '<p>Together with all the people, we want to make this world one and emphasize its beauty by following our dream of reinventing beauty with science & technology. Our values kept us innovative, passionate, and able to think fearlessly. As a result, we shaped the beauty-tech industry and made self-care more accessible and enjoyable.</p>';
										$news_content .= '</div>';
										$news_content .= '</div>';
										$news_content .= '</div>';
										$news_content .= '<div class="row pt-5">';
										$news_content .= '<div class="col-lg-5">';
										$news_content .= '<div class="pe-5">';
										$news_content .= '<h3>“This world could be one”</h3>';
										$news_content .= '<p>Inspired by Queen’s legendary song “Heaven For Everyone”, our founder Filip Sedić decided to implement Freddie Mercury’s message into the company. FOREO comes from “FOR EveryOne” and that illustrated our mission – to tear down labels while inspiring everyone to be themselves.</p>';
										$news_content .= '<p>Together with all the people, we want to make this world one and emphasize its beauty by following our dream of reinventing beauty with science & technology. Our values kept us innovative, passionate, and able to think fearlessly. As a result, we shaped the beauty-tech industry and made self-care more accessible and enjoyable.</p>';
										$news_content .= '</div>';
										$news_content .= '</div>';
										$news_content .= '<div class="col-lg-7"><img class="img-fluid" src="/img/intro/img3.jpg" alt=""></div>';
										$news_content .= '</div>';
										$news_content .= '</div>';
										$news_content .= '<div class="style2 pb-5">';
										$news_content .= '<div class="row pt-5">';
										$news_content .= '<h2>WHAT MAKES OUR PRODUCTS UNIQUE</h2>';
										$news_content .= '<h3>Research & development</h3>';
										$news_content .= '<p>Inspired by Queen’s legendary song “Heaven For Everyone”, our founder Filip Sedić decided to implement Freddie Mercury’s message into the company. FOREO comes from “FOR EveryOne” and that illustrated our mission – to tear down labels while inspiring everyone to be themselves.</p>';
										$news_content .= '<p>Together with all the people, we want to make this world one and emphasize its beauty by following our dream of reinventing beauty with science & technology. Our values kept us innovative, passionate, and able to think fearlessly. As a result, we shaped the beauty-tech industry and made self-care more accessible and enjoyable.</p><img class="img-fluid" src="/img/intro/img4.jpg" alt="">';
										$news_content .= '</div>';
										$news_content .= '</div>';
									@endphp
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Nội dung</label>
												<textarea name="news_content" class="form-control form-control-danger" id="news_content" cols="30" rows="10" placeholder="Content">{{ $news_content }}</textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<h4 class="card-title">SEO</h4>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Title</label>
												<textarea name="news_title_seo" class="form-control form-control-danger" cols="30" rows="2" placeholder="Title"></textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Description</label>
												<textarea name="news_des_seo" class="form-control form-control-danger" cols="30" rows="2" placeholder="Description"></textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Keywords</label>
												<textarea name="news_key_seo" class="form-control form-control-danger" cols="30" rows="2" placeholder="Keywords"></textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row pt-3">
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label">Image</label>
												<div style="display: flex;">
													<input id="linkimagesseo" name="txtImagesSeo" class="form-control" type="text">
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
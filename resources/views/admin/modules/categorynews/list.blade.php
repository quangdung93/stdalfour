@extends('admin.main')
@section('title-admin','Quản lý danh mục tin tức')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Quản lý danh mục tức</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Trang chủ</a></li>
                       <li class="breadcrumb-item active">Quản lý danh mục tức</li>
                   </ol>
				   <a href="{{ url('/dt-admin/category-news/them') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Thêm danh mục</a>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex">
                         <div>
                              <h5 class="card-title">Quản lý danh mục tin tức</h5>
                         </div>
                    </div>
					<div class="form-inline form-search">
						<form action="{{ route('admin.category.news.list') }}" method="GET" id="productlist">
							<div class="form-group">
								<label for="">Từ khóa </label>
								<input type="text" name="keysearch" value="{{ $keysearch }}" class="form-control" placeholder="Nhập tên danh mục">
							</div>
							<div class="form-group">
                                <button type="submit" class="btn btn-info">
                                     <i class="fas fa-search"></i> Tìm
                                </button>
                            </div>
						</form>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Tên</th>
									<th>Status</th>
									<th>Thao tác</th>
								</tr>
							</thead>
							<tbody>
								<?php if($categorynews != NULL){ ?>
									<?php $stt = 0; foreach($categorynews as $items){ $stt++; ?>
										<tr>
											<td class="text-center"><?=$items->ID?></td>
											<td>
												@php
													if($items->PARENTID != 0){
														$getCat = DB::table('category_news')->join('category_news_detail', 'category_news.ID', '=', 'category_news_detail.CATEGORYID')->where('category_news.ID',$items->PARENTID)->first();
														if($getCat){
															if($getCat->PARENTID != 0){
																$getCatRoot = DB::table('category_news')->join('category_news_detail', 'category_news.ID', '=', 'category_news_detail.CATEGORYID')->where('category_news.ID',$getCat->PARENTID)->first();
																if($getCatRoot){
																	echo $getCatRoot->NAME.' >> '.$getCat->NAME.' >> '.$items->NAME;
																}else{
																	echo $getCat->NAME.' >> '.$items->NAME;
																}
															}else{
																echo $getCat->NAME.' >> '.$items->NAME;
															}
														}
													}else{
														echo $items->NAME;
													}
												@endphp
												
											</td>
											<td>
												<?php if($items->STATUS == 1) { ?>
													<a href="javscript:void(0)">Active</a>
												<?php } else { ?>
													<a href="javscript:void(0)">Not active</a>
												<?php } ?>
											</td>
											<td class="text-nowrap check-home">
												<a href="/dt-admin/category-news/sua/<?=$items->ID?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
												<a href="/dt-admin/category-news/xoa/<?=$items->ID?>" onclick="return confirm('Bạn có muốn xóa nội dung này không ?');" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
											</td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						 </table>
						 {{ $categorynews->appends(Request::except('page'))->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@extends('admin.main')
@section('title-admin','Quản lý tin tức')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Quản lý tin tức ({{ $total }})</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Trang chủ</a></li>
                       <li class="breadcrumb-item active">Quản lý tin tức</li>
                   </ol>
				   <a href="{{ url('/dt-admin/news/them') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Thêm tin tức</a>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex">
                         <div>
                              <h5 class="card-title">Quản lý tin tức</h5>
                         </div>
                    </div>
					<div class="form-inline form-search">
						<form action="{{ route('admin.news.list') }}" method="GET" id="productlist">
							<div class="form-group">
								<label for="">Từ khóa </label>
								<input type="text" name="keysearch" value="{{ $keysearch }}" class="form-control" placeholder="Nhập tiêu đề">
							</div>
							<div class="form-group">
								<select name="cat_id" id="cat_id" class="form-control">
									<option value="0">Chọn danh mục</option>  
									@php
										$category = DB::table('category_news')->join('category_news_detail', 'category_news.ID', '=', 'category_news_detail.CATEGORYID')->get();
									@endphp
									@if($category)
										@foreach($category as $td)
											<option value="{{ $td->ID }}" @if($cat_id == $td->ID) selected @endif>{{ $td->NAME }}</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="form-group">
								<select name="trangthai" id="trangthai" class="form-control">
									<option value="0">Chọn....</option>  
									<option value="1" @if($trangthai == 1) selected @endif>Trạng thái bật</option>  
									<option value="2" @if($trangthai == 2) selected @endif>Trạng thái tắt</option>
								</select>
							</div>
							<div class="form-group">
                                <button type="submit" class="btn btn-info">
                                     <i class="fas fa-search"></i> Tìm
                                </button>
                            </div>
						</form>
					</div>
					<div class="table-responsive">
						<div>
							@include('admin.blocks.errors')
							@include('admin.blocks.sucsses')
							@include('admin.blocks.warning')
							<div id="thongbao-m"><div id="thongbao"></div></div>
						</div>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Ảnh</th>
									<th>Danh mục</th>
									<th>Tên</th>
									<th>Ngày tạo</th>
									<th>Người tạo</th>
									<th>Status</th>
									<th>Thao tác</th>
								</tr>
							</thead>
							<tbody>
								<?php if($news != NULL){ ?>
									<?php $stt = 0; foreach($news as $items){ $stt++; ?>
										<tr>
											<td class="text-center"><?=$stt?></td>
											<td>
												@if($items->IMAGE)
													<img src="<?=$items->IMAGE?>" height="60" />
												@endif
											</td>
											<td>
												@php
													$category = DB::table('category_news')->join('category_news_detail', 'category_news.ID', '=', 'category_news_detail.CATEGORYID')->where('category_news.ID',$items->CAT_ID)->first();
												@endphp
												@if($category)
													{{ $category->NAME }}
												@else
													Chưa chọn danh mục
												@endif
											</td>
											<td>
												{{ $items->NAME }}
											</td>
											<td>{{ \Carbon\Carbon::parse($items->DATECREATE)->format('d/m/Y') }}</td>
											<td>{{ $items->hoten }}</td>
											<td>
												<?php if($items->STATUS == 1) { ?>
													<a href="javscript:void(0)">Active</a>
												<?php } else { ?>
													<a href="javscript:void(0)">Not active</a>
												<?php } ?>
											</td>
											<td class="text-nowrap check-home">
												<a href="/dt-admin/news/sua/<?=$items->ID?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
												<a href="/dt-admin/news/xoa/<?=$items->ID?>" onclick="return confirm('Bạn có muốn xóa nội dung này không ?');" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
											</td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						 </table>
						 {{ $news->appends(Request::except('page'))->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
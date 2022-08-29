@extends('admin.main')
@section('title-admin','Quản lý trang đánh giá')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Danh sách đánh giá</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Trang chủ</a></li>
                       <li class="breadcrumb-item active">Danh sách đánh giá</li>
                   </ol>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex">
                         <div>
                              <h5 class="card-title">Danh sách đánh giá ({{ $review->total() }})</h5>
                         </div>
                    </div>
					
					<div class="table-responsive">
						<div>
							@include('admin.blocks.sucsses')
							@include('admin.blocks.warning')
							<div id="thongbao-m"><div id="thongbao"></div></div>
						</div>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center">STT</th>
									<th>Thông tin</th>
									<th>Nội dung tin nhắn</th>
									<th>Trạng thái</th>
									<th>Thao tác</th>
								</tr>
							</thead>
							<tbody>
								<?php if($review != NULL){ ?>
									<?php $stt = 0; foreach($review as $items){ $stt++; ?>
										<tr>
											<td class="text-center"><?=$stt?></td>
											<td>
												<p><span class="badge badge-success badge-pill"><?=$items->binhluan_name?></span></p>
												<p>Email/Phone: <?=$items->binhluan_email?></p>
												<p>Ngày gửi: <?=date('d/m/Y H:i',$items->binhluan_date)?></p>
											</td>
											<td>
												@php
													$product = DB::table('product')->join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')->where('product.STATUS',1)->where('product.ID',$items->binhluan_news_id)->first();
												@endphp
												@if($product)
													<p style="font-weight: 600;"><a href="{{ route('frontend.category.detail', ['urlpost' => get_url_alias('product_id='.$product->PRODUCTID)]) }}" target="_blank">{{ $product->NAME }}</a></p>
												@endif
												<p><?=$items->binhluan_mess?></p>
											</td>
											<td class="center">
												<img src="/backend/img/anhien_{{ $items->enable }}.png" class="anhien" value="{{ $items->binhluan_id }}" />
											</td>
											<td class="text-nowrap check-home">
												<a href="/dt-admin/review/xoa/<?=$items->binhluan_id?>" onclick="return confirm('Bạn có muốn xóa nội dung này không ?');" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
											</td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						 </table>
						  {{ $review->appends(Request::except('page'))->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
	@section('admin-js')
		<script>
			$(document).ready(function(){
				$("img.anhien").click(function(){
					review_id=$(this).attr("value");
					obj = this;
					$.ajax({
						url:"{{ route('anhien') }}",
						data: 'table=review&review_id='+ review_id,
						cache: false,
						success: function(data){
							if(data == 'error'){
								alert('Bạn không có quyền cập nhật trạng thái bình luận');
							}else{
								obj.src=data;
								$("#thongbao-m").slideDown();
								$("#thongbao").show().html("Cập nhật trạng thái bình luận thành công").fadeIn('fast'); 
								setTimeout('$("#thongbao-m").slideUp()', 1500);
							}
						}
					});
				});
			});
		</script>
	@endsection
@endsection
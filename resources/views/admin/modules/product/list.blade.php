@extends('admin.main')
@section('title-admin','Quản lý trang sản phẩm')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Sản phẩm</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Trang chủ</a></li>
                       <li class="breadcrumb-item active">Sản phẩm</li>
                   </ol>
				   <a href="{{ url('/dt-admin/product/them') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Thêm sản phẩm</a>
				   <a href="javascript:;" class="btn btn-primary" onclick="if(confirm('Bạn có chắc muốn xóa hết?')){ktxoatin()}" style="margin-left: 10px;"><i class="fa fa-check"></i> Xóa</a>
			  </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex">
                         <div>
                              <h5 class="card-title">Sản phẩm ({{ $count }})</h5>
                         </div>
                    </div>
					<div class="form-inline form-search">
						<form action="{{ route('admin.product.list') }}" method="GET" id="productlist">
							<div class="form-group">
								<label for="">Từ khóa </label>
								<input type="text" name="keysearch" value="{{ $keysearch }}" class="form-control" placeholder="Nhập tên sản phẩm">
							</div>
							<div class="form-group">
								<select name="productnoibat" id="productnoibat" class="form-control">
									<option value="0">Chọn....</option>  
									<option value="1" @if($productnoibat == 1) selected @endif>Còn hàng</option>  
									<option value="2" @if($productnoibat == 2) selected @endif>Sản phẩm bán chạy</option>
									<option value="3" @if($productnoibat == 3) selected @endif>Sản phẩm ưa chuộng</option>
									<option value="4" @if($productnoibat == 4) selected @endif>Nổi bật trang chủ</option>
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
									<th><input type="checkbox" id="checkedAll"></th>
									<th class="text-center">#</th>
									<th>Ảnh</th>
									<th>Tên</th>
									<th>Giá bán</th>
									<th>Giá giảm</th>
									<th>Trạng thái</th>
									<th>Chức năng</th>
								</tr>
							</thead>
							<tbody>
								<?php if($product != NULL){ ?>
									<?php $stt = 0; foreach($product as $items){ $stt++; ?>
										<tr>
											<td><input type="checkbox" class="checkSingle" data-id="{{ $items->ID }}"/></td>
											<td class="text-center">{{ $items->ID }}</td>
											<td>
												@if($items->IMAGE)
													<img src="<?=$items->IMAGE?>" height="60" />
												@endif
											</td>
											<td>
												<a href="{{ route('frontend.category.detail',['urlpost' => Custom::get_url_alias('product_id='.$items->ID)]) }}" target="_blank" style="color: inherit;"><?=$items->NAME?></a>
												@if($items->INSTOCK == 1)
													<div class="availability in-stock">Tình trạng: <span style="color: #5cb85c;">Còn hàng</span></div><!-- /.availability -->
												@else
													<div class="availability in-stock">Tình trạng: <span style="color: red;">Hết hàng</span></div><!-- /.availability -->
												@endif
												@php
													$getoption = DB::table('products_option')->where('op_product_id',$items->ID)->get();
												@endphp
												@if(count($getoption) > 0)
													<div class="table-responsive" style="margin-top: 15px;">
														<table class="table table-bordered" id="tblOption">
															<thead>
																<tr>
																	<th>Tên</th>
																	<th>Giá</th>
																	<th>Giá giảm</th>
																</tr>
															</thead>
															<tbody>
																@foreach($getoption as $op)
																	@if($op->op_pro_url)
																		<tr>
																			<td colspan="3">
																				{{ $op->op_pro_url }}
																			</td>
																		</tr>
																	@else
																		<tr>
																			<td>
																				<input type="text" class="form-control op-name" style="width: 120px;" value="{{$op->op_name}}" data-id="{{ $op->op_id }}" />
																			</td>
																			<td>
																				<input type="number" class="form-control op-price" style="width: 120px;" value="{{$op->op_price}}" data-id="{{ $op->op_id }}" />
																			</td>
																			<td>
																				<input type="number" class="form-control op-price-discount" style="width: 120px;" value="{{$op->op_price_discount}}" data-id="{{ $op->op_id }}" />
																			</td>
																		</tr>
																	@endif
																@endforeach
															</tbody>
														</table>
													</div>
												@endif
											</td>
											<td><input name="product_price" type="number" class="form-control product-price" style="width: 120px;" value="{{$items->PRICE}}" data-id="{{ $items->ID }}" data-op="{{ count($getoption) }}" /></td>
											<td><input name="product_price_discount" type="number" class="form-control product-price-discount" style="width: 120px;" value="{{$items->DISCOUNT}}" data-id="{{ $items->ID }}" data-op="{{ count($getoption) }}" /></td>
											<td class="center">
												<img src="/backend/img/anhien_{{ $items->STATUS }}.png" class="anhien" value="{{ $items->ID }}" />
											</td>
											<td class="text-nowrap check-home">
												<a href="/dt-admin/product/sua/<?=$items->ID?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
												<a href="/dt-admin/product/xoa/<?=$items->ID?>" onclick="return confirm('Bạn có muốn xóa nội dung này không ?');" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
											</td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						 </table>
						 {{ $product->appends(Request::except('page'))->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
	@section('admin-js')
	<script>
		function ktxoatin(){
            var allVals = [];
            var CSRF_TOKEN = '{{ csrf_token() }}';
            $(".checkSingle:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            if(allVals.length <=0) {
                alert("Bạn chưa chọn sản phẩm nào.");
            } else {
                var join_selected_values = allVals.join(",");
                url ="{{ route('delete.product.all') }}";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {'ids':join_selected_values, _token: CSRF_TOKEN},
                    success: function(data){
                        alert(data.success);
                        location.reload();
                    }
                });
            }
        }
		$(document).ready(function(){
			$("input.product-price").keyup(function () {
				var ID = $(this).data("id");
				var countop = $(this).data("op");
				var price = $(this).val();
				$.ajax({
					url: "{{ route('update.price.ad') }}",
					type: "post",
					data: {
						pro_id: ID,
						price: price,
						countop: countop,
						_token: "{{ csrf_token() }}"
					},
					dataType: 'json',
					success: function (result) {
						location.reload();
					}
				});
			});
			$("input.product-price-discount").keyup(function () {
				var ID = $(this).data("id");
				var countop = $(this).data("op");
				var price = $(this).val();
				$.ajax({
					url: "{{ route('update.discount.ad') }}",
					type: "post",
					data: {
						pro_id: ID,
						price: price,
						countop: countop,
						_token: "{{ csrf_token() }}"
					},
					dataType: 'json',
					success: function (result) {
						location.reload();
					}
				});
			});
			$("img.anhien").click(function(){
				pro_id=$(this).attr("value");
				obj = this;
				$.ajax({
					url:"{{ route('anhien') }}",
					data: 'table=product&pro_id='+ pro_id,
					cache: false,
					success: function(data){
						if(data == 'error'){
							alert('Bạn không có quyền cập nhật trạng thái sản phẩm');
						}else{
							obj.src=data;
							$("#thongbao-m").slideDown();
							$("#thongbao").show().html("Cập nhật trạng thái sản phẩm thành công").fadeIn('fast'); 
							setTimeout('$("#thongbao-m").slideUp()', 1500);
						}
					}
				});
			});
			$("#checkedAll").change(function(){
				if(this.checked){
					$(".checkSingle").each(function(){
					this.checked=true;
				})
				} else{
					$(".checkSingle").each(function(){
						this.checked=false;
					})
				}
			});
			$(".checkSingle").click(function () {
				if ($(this).is(":checked")){
					var isAllChecked = 0;
					$(".checkSingle").each(function(){
						if(!this.checked)
						isAllChecked = 1;
					})
					if(isAllChecked == 0){ $("#checkedAll").prop("checked", true); }
				} else {
					$("#checkedAll").prop("checked", false);
				}
			});
		});
	</script>
	@endsection
@endsection
@extends('admin.main')
@section('title-admin','Cập nhật đơn hàng')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Cập nhật đơn hàng</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                       <li class="breadcrumb-item active">Cập nhật đơn hàng</li>
                   </ol>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Cập nhật đơn hàng</h4>
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
				<form method="post" enctype="multipart/form-data" action="{{ url('/dt-admin/order/sua/'.$order->ID) }}" id="upload">
					{{ csrf_field() }}
					<div class="form-body">
						<div class="card-body">
							<div class="row pt-3">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Tên người đặt hàng</label>
										<input name="order_buyer" type="text" id="event_name" value="{{ $order->BUYER }}" class="form-control" size="35" />
									</div>
									<div class="form-group">
										<label class="control-label">Email</label>
										<input name="order_email" type="text" value="{{ $order->EMAIL }}" class="form-control" size="35" />
									</div>
									<div class="form-group">
										<label class="control-label">Địa chỉ</label>
										<input name="order_address" type="text" value="{{ $order->ADDRESS }}" class="form-control" size="35" />
									</div>
									<div class="form-group">
										<label class="control-label">Tỉnh/ Thành phố</label>
										<select name="province_id" class="form-control" id="province_id">
											<option value="0">Chọn tỉnh thành</option>
											@php
												$gettinh = DB::table('province')->orderBy('name','ASC')->get();
											@endphp
											@if($gettinh)
												@foreach($gettinh as $tinh)
													<option value="{{ $tinh->provinceid }}" @if($tinh->provinceid == $order->province_id) selected @endif>{{ $tinh->type.' '.$tinh->name }}</option>
												@endforeach
											@endif
										</select>
									</div>
									<div class="form-group">
										<label class="control-label">Quận/ Huyện</label>
										<select name="district_id" class="form-control" id="district_id">
											@if($order->province_id)
												<option value="0">Chọn quận huyện</option>
												@php
													$getquan = DB::table('district')->where('provinceid',$order->province_id)->orderBy('name','ASC')->get();
												@endphp
												@if($getquan)
													@foreach($getquan as $quan)
														<option value="{{ $quan->districtid }}" @if($quan->districtid == $order->district_id) selected @endif>{{ $quan->type.' '.$quan->name }}</option>
													@endforeach
												@endif
											@else
												<option value="0">Chọn quận huyện</option>
											@endif
										</select>
									</div>
									<div class="form-group">
										<label class="control-label">Điện thoại</label>
										<input name="order_phone" type="text" value="{{ $order->PHONE }}" class="form-control" size="35" />
									</div>
									<div class="form-group">
										<label class="control-label">Ngày đặt mua</label>
										<input name="order_date" type="text" value="{{ $order->DATECREATE }}" class="form-control" size="35" disabled />
									</div>
									<div class="form-group">
										<label class="control-label">Hình thức thanh toán</label>
										<select name="order_pay" class="form-control">
											<option value="1" @if($order->PAYMENTTERMS == 1) selected @endif>Thanh toán khi nhận hàng</option>
											<option value="2" @if($order->PAYMENTTERMS == 2) selected @endif>Thanh toán thẻ ATM nội địa</option>
											<option value="3" @if($order->PAYMENTTERMS == 3) selected @endif>Thanh toán qua ngân hàng</option>
											<option value="4" @if($order->PAYMENTTERMS == 4) selected @endif>Chuyển khoản qua ngân hàng</option>
										</select>
									</div>
									<div class="form-group">
										<label class="control-label">Phương thức vận chuyển</label>
										<select name="order_method" class="form-control">
											<option value="0">Chọn phương thức vận chuyển</option>
											<option value="1" @if($order->shipping_method == 1) selected @endif>Tiêu chuẩn</option>
											<option value="2" @if($order->shipping_method == 2) selected @endif>Nhanh</option>
										</select>
									</div>
									<div class="form-group">
										<label class="control-label">Ghi Chú</label>
										<textarea name="order_note" class="form-control form-control-danger" cols="30" rows="4" placeholder="Content">{{ $order->NOTE }}</textarea>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-success" name="ok"> <i class="fa fa-check"></i> Cập nhật</button>
									</div>
								</div>
								<div class="col-md-8">
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th class="text-center">#</th>
													<th>Tên SP</th>
													<th>Số lượng</th>
													<th>Đơn giá</th>
													<th>Giá giảm</th>
													<th>Thành tiền</th>
													<th>Thao tác</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$checklist = DB::table('order_detail')->where('ORDERID',$order->ID)->orderBy('ID','DESC')->get();
													$tongtien = 0;
												?>
												<?php if($checklist != NULL){ ?>
													<?php $stt = 0; foreach($checklist as $items){ $stt++; ?>
														<?php
															$getpro = DB::table('product')->join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')->where('product.ID',$items->PRODUCTID)->first();
														?>
														<?php if($getpro) { ?>
														<?php
															$giasp = $items->PRICE;
															if($items->DISCOUNT){
																$giasp = $items->DISCOUNT;
															}
															$tongtien = $tongtien + ($items->QUANTITY*$giasp);
															$checkoption = DB::table('products_option')->where('op_product_id',$items->PRODUCTID)->where('op_price',$items->PRICE)->first();
														?>
														<tr>
															<td class="text-center"><?=$stt?></td>
															<td>
																{{ $getpro->NAME }} @if($checkoption) {{ $checkoption->op_name }} @endif
															</td>
															<td>{{ $items->QUANTITY }}</td>
															<td>{{ number_format($items->PRICE) }}đ</td>
															<td>
																{{ number_format($giasp) }}đ
																@if($items->DISCOUNT_VAL > 0)
																	<br>Giảm {{$items->DISCOUNT_VAL}}%
																@endif
															</td>
															<td><b>{{ number_format($items->QUANTITY*$giasp) }}đ</b></td>
															<td>
																<a href="javascript:;" onclick="return delGetPro({{ $items->ID }});" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
															</td>
														</tr>
														<?php } ?>
													<?php } ?>
												<?php } ?>
											</tbody>
										 </table>
									</div>
									<div class="form-group">
										Tổng số sản phẩm : {{ $checklist->count() }} - Tổng tiền : {{ number_format($tongtien) }} Đ<br>
										Phí vận chuyển : + {{ number_format($order->shipping_total) }} Đ<br>
										Tổng cộng : <b>{{ number_format($tongtien+$order->shipping_total) }}</b> Đ
									</div>
									<div class="form-group">
										<label class="control-label">Chọn sản phẩm</label>
										<select id="pro_list" name="pro_list" class="form-control"></select>
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Số lượng</label>
												<input name="pro_list_quantity" type="number" id="pro_list_quantity" class="form-control" size="35" />
											</div>
										</div>
									</div>
									<div class="form-actions">
										<a href="javascript:;" class="btn btn-success" onclick="addOrderPro({{ $order->ID }});"> <i class="fa fa-plus"></i> Thêm sản phẩm</a>
									</div>
									<div class="table-responsive pt-3">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th class="text-center">STT</th>
													<th>Tình trạng</th>
													<th>Lời nhắn</th>
													<th>Ngày thêm</th>
												</tr>
											</thead>
											<tbody>
												@php
													$gethis = DB::table('order_history')->where('order_id',$order->ID)->orderBy('order_history_id','DESC')->get();
													$stthis = 0;
												@endphp
												@if($gethis)
													@foreach($gethis as $his)
													<?php
														$stthis++;
														$getsta = DB::table('order_status')->where('order_status_id',$his->order_status_id)->first();
													?>
													<tr>
														<td class="text-center"><?=$stthis?></td>
														<td><?php if($getsta) echo $getsta->name;?></td>
														<td><?=$his->comment?></td>
														<td><?=$his->date_added?></td>
													</tr>
													@endforeach
												@endif
											</tbody>
										</table>
									</div>
									<div class="row pt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Trạng thái</label>
												@php
													$getstalist = DB::table('order_status')->get();
												@endphp
												<select name="order_note_s" id="order_note_s" class="form-control">
													@foreach($getstalist as $list)
														<option value="{{ $list->order_status_id }}">{{ $list->name }}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<label class="control-label">Ghi Chú</label>
												<textarea name="order_note_ss" id="order_note_ss" class="form-control form-control-danger" cols="30" rows="4" placeholder="Content"></textarea>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<a href="javascript:;" class="btn btn-success" onclick="addNoteOrder({{ $order->ID }});"> <i class="fa fa-plus"></i> Cập nhật trạng thái</a>
									</div>
								</div>
								<!--/span-->
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
		$('#pro_list').select2({
			placeholder: "Nhập tên sản phẩm",
			minimumInputLength: 2,
			ajax: {
				url: '/dt-admin/product/profind',
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
				cache: false
			}
		});
		function addOrderPro(ID){
			var idpro = $('#pro_list').val();
			var quantity = $('#pro_list_quantity').val();
			if(idpro){
				if(quantity == ''){
					alert('Bạn chưa điền số lượng sản phẩm');
				}else{
					$.ajax({
						url: "{{ route('admin.order.addpro') }}",
						type: "post",
						data: {
							idorder : ID,
							idpro : idpro,
							quantity : quantity,
							_token: "{{ csrf_token() }}"
						},
						dataType: 'json',
						success: function (result) {
							if(result.err == 0){
								location.reload();
							}
						}
					});
				}
			}else{
				alert('Bạn chưa chọn sản phẩm');
			}
		}
		function delGetPro(ID) {
			var result = confirm("Bạn muốn xóa sản phẩm này?");
			if (result==true) {
				$.ajax({
					url: "{{ route('admin.order.delpro') }}",
					type: "post",
					data: {
						idorder : ID,
						_token: "{{ csrf_token() }}"
					},
					dataType: 'json',
					success: function (result) {
						if(result.err == 0){
							location.reload();
						}
					}
				});
			} else {
				return false;
			}
		}
		function addNoteOrder(ID){
			var idpro = $('#order_note_s').val();
			var note = $('#order_note_ss').val();
			if(idpro){
				$.ajax({
					url: "{{ route('admin.order.addnote') }}",
					type: "post",
					data: {
						idorder : ID,
						idtinhtrang : idpro,
						note : note,
						_token: "{{ csrf_token() }}"
					},
					dataType: 'json',
					success: function (result) {
						if(result.err == 0){
							location.reload();
						}
					}
				});
			}else{
				alert('Bạn chưa chọn tình trạng đơn hàng');
			}
		}
		$("#province_id").change(function() {
			var tinh_id = $(this).val();
			if(tinh_id != 0){
				url = "{{ route('cart.district') }}?action=laythanhpho&id="+tinh_id;
				$.ajax({
					type: "GET",
					url: url,
					success: function(data){
						if(data != 'error'){
							$('#district_id').html(data);
							$('#district_id').append("<option value='0'>Chọn quận huyện</option>");
							$('#district_id').val(0);                                        
						}
					}
				});
			} else {
				$('#district_id').html("<option value='0'>Chọn quận huyện</option>");
			}
		});
	</script>
@endsection
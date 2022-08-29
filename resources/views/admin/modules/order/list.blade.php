@extends('admin.main')
@section('title-admin','Quản lý đơn hàng')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Đơn hàng</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Trang chủ</a></li>
                       <li class="breadcrumb-item active">Đơn hàng</li>
                   </ol>
				   <a href="{{ url('/dt-admin/order/them') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Thêm đơn hàng</a>
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
                              <h5 class="card-title">Đơn hàng ({{ $total }})</h5>
                         </div>
                    </div>
					<div class="form-inline form-search">
						<form action="{{ route('admin.order.list') }}" method="GET" id="orderlist">
							<div class="form-group">
								<label for="">Tên sản phẩm </label>
								<input type="text" name="keysearchpro" value="{{ $keysearchpro }}" class="form-control" placeholder="Nhập tên sản phẩm">
							</div>
							<div class="form-group">
								<label for="">Từ khóa </label>
								<input type="text" name="keysearch" value="{{ $keysearch }}" class="form-control" placeholder="Nhập tên , sđt, email khách hàng">
							</div>
							<div class="form-group">
								<select name="trangthai" id="trangthai" class="form-control">
									<option value="0">Chọn....</option>  
									<option value="1" @if($trangthai == 1) selected @endif>Đơn hàng mới</option>  
									<option value="2" @if($trangthai == 2) selected @endif>Đã thanh toán</option>
									<option value="3" @if($trangthai == 3) selected @endif>Đã vận chuyển</option>
									<option value="4" @if($trangthai == 4) selected @endif>Đã hoàn tất</option>
									<option value="5" @if($trangthai == 5) selected @endif>Đã hủy bỏ</option>
									<option value="6" @if($trangthai == 6) selected @endif>Đã nhập dữ liệu</option>
									<option value="7" @if($trangthai == 7) selected @endif>Đã gọi xác nhận</option>
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
							@include('admin.blocks.sucsses')
							@include('admin.blocks.warning')
							<div id="thongbao-m"><div id="thongbao"></div></div>
						</div>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th><input type="checkbox" id="checkedAll"></th>
									<th class="text-center">Mã đơn hàng</th>
									<th>Tên</th>
									<th>Số điện thoại</th>
									<th>Tổng giá trị</th>
									<th>Tình trạng</th>
									<th>Ngày/tháng</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if($order != NULL){ ?>
									<?php $stt = 0; foreach($order as $items){ $stt++; ?>
										<tr>
											<td><input type="checkbox" class="checkSingle" data-id="{{ $items->ID }}"/></td>
											<td class="text-center">{{ $items->ID }}</td>
											<td>{{ $items->BUYER }}</td>
											<td><span class="badge badge-success badge-pill"><?=$items->PHONE?></span> </td>
											<td>{{ number_format($items->cart_total).'đ' }}</td>
											<td>
												@php
													$order_status = DB::table('order_status')->where('order_status_id', $items->order_status_id)->first();
												@endphp
												@if($order_status)
													<span style="color: {{ '#'.$order_status->color }};">{{ $order_status->name }}</span>
												@endif
											</td>
											<td>{{ $items->DATECREATE }}</td>
											<td class="text-nowrap check-home">
												<a href="/dt-admin/order/sua/<?=$items->ID?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
												<a href="/dt-admin/order/xoa/<?=$items->ID?>" onclick="return confirm('Bạn có muốn xóa nội dung này không ?');" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
											</td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						 </table>
						 {{ $order->appends(Request::except('page'))->links() }}
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
                alert("Bạn chưa chọn đơn hàng nào.");
            } else {
                var join_selected_values = allVals.join(",");
                url ="{{ route('delete.order.all') }}";
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
@extends('admin.main')
@section('title-admin','Thêm đơn hàng')
@section('content-admin')
	<div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h4 class="text-themecolor">Thêm đơn hàng</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                   <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                       <li class="breadcrumb-item active">Thêm đơn hàng</li>
                   </ol>
              </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Thêm đơn hàng</h4>
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
				<form method="post" enctype="multipart/form-data" action="{{ url('/dt-admin/order/them') }}" id="upload">
					{{ csrf_field() }}
					<div class="form-body">
						<div class="card-body">
							<div class="row pt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Tên người đặt hàng</label>
										<input name="order_buyer" type="text" id="event_name" class="form-control" size="35" />
									</div>
									<div class="form-group">
										<label class="control-label">Email</label>
										<input name="order_email" type="text" class="form-control" size="35" />
									</div>
									<div class="form-group">
										<label class="control-label">Địa chỉ</label>
										<input name="order_address" type="text" class="form-control" size="35" />
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
													<option value="{{ $tinh->provinceid }}">{{ $tinh->type.' '.$tinh->name }}</option>
												@endforeach
											@endif
										</select>
									</div>
									<div class="form-group">
										<label class="control-label">Quận/ Huyện</label>
										<select name="district_id" class="form-control" id="district_id">
											<option value="0">Chọn quận huyện</option>
										</select>
									</div>
									<div class="form-group">
										<label class="control-label">Điện thoại</label>
										<input name="order_phone" type="text" class="form-control" size="35" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Hình thức thanh toán</label>
										<select name="order_pay" class="form-control">
											<option value="0">Chọn hình thức thanh toán</option>
											<option value="1">Thanh toán khi nhận hàng</option>
											<option value="2">Thanh toán thẻ ATM nội địa</option>
											<option value="3">Thanh toán qua ngân hàng</option>
											<option value="4">Chuyển khoản qua ngân hàng</option>
										</select>
									</div>
									<div class="form-group">
										<label class="control-label">Phương thức vận chuyển</label>
										<select name="order_method" class="form-control">
											<option value="0">Chọn phương thức vận chuyển</option>
											<option value="1">Tiêu chuẩn</option>
											<option value="2">Nhanh</option>
										</select>
									</div>
									<div class="form-group">
										<label class="control-label">Ghi Chú</label>
										<textarea name="order_note" class="form-control form-control-danger" cols="30" rows="4" placeholder="Content"></textarea>
									</div>
									<div class="form-group">
										<label class="control-label">Chọn sản phẩm</label>
										<select id="pro_list" name="pro_list[]" class="form-control" multiple></select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-actions">
										<button type="submit" class="btn btn-success" name="ok"> <i class="fa fa-check"></i> Thêm mới</button>
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
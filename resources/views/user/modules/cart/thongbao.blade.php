@extends('user.layout.master')
@section('content')
	 <div class="main mb-3">
	  <div class="container">
       <div class="row">
          <div class="dat-hang-thanh-cong">
              <div class="icon"><img src="{{ asset('frontend/2020/img/dathang.svg') }}" alt="" /></div>
              <h2>Đặt Hàng Thành Công</h2>
			  @php
				$checksid = request()->get('sid');
			  @endphp
			  @if($checksid)
				  @php
					$checkout = DB::table('order')->where('session_id',$checksid)->first();
				  @endphp
				  @if($checkout)
					  <table width="100%">
						<tr>
						  <td><h3>Thông tin đơn hàng</h3></td>
						  <td class="text-right"> <p>Phí giao hàng, miễn phí</p></td>
						</tr>
						<tr>
						  <td>Mã đơn hàng</td>
						  <td>{{ $checkout->session_id }}</td>
						</tr>
						<tr>
						  <td>Người nhận</td>
						  <td>{{ $checkout->BUYER }}</td>
						</tr>
						<tr>
						  <td>Điện thoại</td>
						  <td>{{ $checkout->PHONE }}</td>
						</tr>
						<tr>
						  <td>Địa chỉ</td>
						  <td>{{ $checkout->ADDRESS }}</td>
						</tr>
						<tr>
						  <td>Tổng tiền</td>
						  <td>{{ number_format($checkout->cart_total) }}đ</td>
						</tr>
						<tr>
						  <td>Thanh toán</td>
						  <td>Tiền mặt</td>
						</tr>
						<tr>
						  <td>Trạng thái</td>
						  <td class="wait">Đang chờ xác nhận</td>
						</tr>
					  </table>
					  <a href="javascript:;" class="button">xem đơn hàng</a>
				 @endif
			  @endif
          </div>
        </div>
      </div>
    </div>
@endsection
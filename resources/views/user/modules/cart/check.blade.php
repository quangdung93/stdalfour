@extends('user.layout.master')
@section('content')
	<header class="pt-3 pb-3" id="header2">
    <div class="container">
      <div class="row align-items-center justify-content-between bgmain pt-3 pb-3 pe-3 ps-3 m-0">
        <h2 class="m-0 col-lg-4">Thanh Toán</h2>
        <div class="_right col-lg-8">
          <ul class="d-flex align-items-center m-0 p-0 justify-content-end">
            <li class="active d-flex align-items-center">
              <div class="img d-flex align-items-center justify-content-center"><img src="/img/thanhtoanchuadangnhap/thanhtoan1.svg"></div><span>1. giỏ hàng</span>
            </li>
            <li class="active d-flex align-items-center">
              <div class="img d-flex align-items-center justify-content-center"><img src="/img/thanhtoanchuadangnhap/thanhtoan2.svg"></div><span>2. thanh toán</span>
            </li>
            <li class="d-flex align-items-center">
              <div class="img d-flex align-items-center justify-content-center"><img src="/img/thanhtoanchuadangnhap/thanhtoan3.svg"></div><span>3. hoàn tất</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <div class="main mb-3">
    <div class="container">
      <div class="row" id="checkout">
		@if($getcart->count() > 0)
		@php
			$total = 0;
		 @endphp
        <div class="main_left col-lg-8">
          <div class="diachinhanhang bgmain stylett pt-3 pb-3 pe-3 ps-3 mb-3">
            <div class="content2">
              <div class="head">
                <h2>Thông tin giao hàng</h2>
              </div>
            </div>
            <div class="d-flex mt-3">
              <div class="input-column1">
                <label>Họ và tên</label>
                <input class="input" type="text" name="full_name" placeholder="Họ và tên">
              </div>
            </div>
            <div class="d-flex mt-3">
              <div class="input-column1">
                <label>Số điện thoại</label>
                <input class="input" type="text" name="phone" placeholder="Nhập điện thoại">
              </div>
            </div>
            <div class="style1">
              <div class="box2 d-flex align-items-center justify-content-between mt-3">
                <div class="input-column1">
                  <label>Địa chỉ</label>
                  <div class="diachi-popup">
                    <input class="input" type="text" name="address" placeholder="Nhập địa chỉ">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="ghichudonhang bgmain stylett style2 pt-3 pb-3 pe-3 ps-3 mb-3">
            <div class="box style2 d-flex align-items-center active">
              <div class="checkbox"></div>
              <p>ghi chú đơn hàng</p>
            </div>
            <div class="box2">
              <textarea class="textarea" name="note" cols="30" rows="10" placeholder="Lời nhắn viết lên thiệp, tối đa 75 từ..."></textarea>
            </div>
          </div>
        </div>
        <div class="sidebar_right col-lg-4">
          <div class="thongtindonhang bgmain mb-3">
            <div class="content">
			
			@foreach($getcart as $cart)
			  @php
				$product = DB::table('product')->join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')->where('product.STATUS',1)->where('product.ID',$cart->pro_id)->first();
			  @endphp
			  @if($product)
				  <div class="item d-flex justify-content-between pt-3 pb-3 pe-3 ps-3">
					<div class="left"><img class="img-fluid" src="{{ $product->IMAGE }}" alt=""></div>
					<div class="center">
					  <p class="title mb-2">{{ $product->NAME }}</p><a class="delete"><img src="/img/thanhtoanchuadangnhap/del.svg"></a>
					</div>
					<div class="right"><span class="price mb-2 d-block">{{ Custom::product_price($product->PRICE)}}đ</span>
					  <div class="number"><span class="minius">-</span>
						<input type="text" value="1"><span class="plus">+</span>
					  </div>
					</div>
				  </div>
				  @php
					$total += $cart->num_of * $product->PRICE;
				  @endphp
				@endif
              @endforeach

            </div>
          </div>
          <div class="tongcong bgmain pt-3 pb-3 pe-3 ps-3 mb-3">
			<input type="hidden" id="tongtientinh" value="{{ $total }}"/>
            <div class="item d-flex align-items-center justify-content-between"><span>Tiền hàng:</span><span>{{ Custom::product_price($total) }}đ</span></div>
            <div class="item d-flex align-items-center justify-content-between"><span>Phí giao hàng:</span><span>Miễn phí</span></div>
          </div>
          <div class="button order__btn">
            <button class="d-flex align-items-center justify-content-center btn-cod" id="cash" type="button">Thanh toán</button>
          </div>
        </div>
		@else
			<p><b>Bạn không có sản phẩm nào trong giỏ hàng của bạn.</b></p>
		@endif
      </div>
    </div>
  </div>
@endsection

@section('js')
	<script>
		jQuery.fn.extend({
			live: function (event, callback) {
				if (this.selector) {
					jQuery(document).on(event, this.selector, callback);
				}
				return this;
			}
		});
		$(document).ready(function () {
			$('#checkout').delegate('.order__btn > .btn-cod', 'click', function() {
				var fname   = $('input[name="full_name"]').val(),
					phone   = $('input[name="phone"]').val(),
					address = $('input[name="address"]').val(),
					note = $('input[name="note"]').val(),
					total = $('#tongtientinh').val(),
					error   = false;
					phone = phone.replace(/[^A-Z0-9]/gi,'');
				var substr = phone.substring(0, 2);
				if( !phone.length ) {
					error = true;
				} else if( !validatePhone(phone) ) {
					error = true;
				} else if( substr == '09' || substr == '08' ) {
					if( phone.length != 10 )
						error = true;
				} else if( substr == '01' ) {
					if( phone.length != 11 )
						error = true;
				} else if( phone.length < 10 || phone.length > 11 ) {
					error = true;
				}
				if( error ) {
					$('input[name="phone"]').css("border-color", "red").val('').attr("placeholder", "Số điện thoại không hợp lệ!");
					return;
				}
				$.ajax({
					url: "{{ route('frontend.cart.checkout') }}",
                    type: "post",
                    data: {
                        fname   : fname,
						phone   : phone,
						address : address,
						giamgia : 0,
						note : note,
						total : total,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',
					success: function (result) {
						if(result.code == '00'){
							window.location.href = result.data;
						}else{
							if(result.sid){
								window.location.href = "{{ route('cart-return').'?sid=' }}" + result.sid;
							}else{
								if(result.err == 0){
									alert('Bạn đã mua hàng thành công. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.');
									setTimeout(function () {
										window.location.href = "{{ route('frontend.home') }}"
									}, 2000);
								}
							}
						}
					}
				}); 
			});
			function validatePhone(txtPhone) {
				var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
				if (filter.test(txtPhone)) {
					return true;
				} else {
					return false;
				}
			}
		});
	</script>
@endsection
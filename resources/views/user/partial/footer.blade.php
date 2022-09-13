@if($isNonGoogle)
<div class="section-map pt-5 pb-5">
    <div class="container">
      <div class="d-flex content">
        <div class="info py-4 px-4">
          <div class="inn">
            <div class="d-flex align-items-center mb-3">
              <div class="icon"><img class="lazy" data-src="{{ asset('img/home/icon-3.svg') }}" alt=""></div>
              <div class="title"><a href="tel:0909991612">0909991612 (Mr.Bách)</a></div>
            </div>
            <div class="d-flex align-items-center mb-3">
              <div class="icon"><img class="lazy" data-src="{{ asset('img/home/icon-4.svg') }}" alt=""></div>
              <div class="title"><span>contact-us</span></div>
            </div>
            <div class="d-flex align-items-center mb-3">
              <div class="icon"><img class="lazy" data-src="{{ asset('img/home/icon-5.svg') }}" alt=""></div>
              <div class="title"><span>24953 Paseo De Valencia, #6c, Laguna Hills, Ca 92653</span></div>
            </div>
          </div>
        </div>
        <div class="map">
          {{-- <img class="img-fluid lazy" data-src="{{ asset('img/home/map-1.png') }}" alt="map"> --}}
            <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1496.5880489355543!2d106.6797709038836!3d10.794572647144804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528d4404e3a19%3A0x25f861ded2cfc242!2zNzIvMSBIdeG7s25oIFbEg24gQsOhbmgsIFBoxrDhu51uZyAxNSwgUGjDuiBOaHXhuq1uLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmg!5e0!3m2!1svi!2s!4v1662693252205!5m2!1svi!2s" 
            width="100%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>
</div>
@endif

  <footer id="footer">
    <div class="container">
      <div class="row pt-5 pb-5">
        <div class="col-lg-2 text-center">
          <div class="logo mb-3"><a href="#"><img class="lazy" width="100" data-src="{{ asset('img/home/logo.png') }}" alt=""></a></div>
          {{-- <form class="form" action="#">
            <div class="input">
              <input type="email" requied placeholder="Email">
              <button type="submit"><img class="lazy" data-src="{{ asset('img/home/icon-8.svg') }}" alt=""></button>
            </div>
          </form> --}}
          <div class="social mt-4">
            <div class="d-flex align-items-center justify-content-between m-0 p-0">
              <div class="item"><a href="#"><img class="lazy" data-src="{{ asset('img/home/icon-9.svg') }}" alt=""></a></div>
              <div class="item"><a href="#"><img class="lazy" data-src="{{ asset('img/home/icon-6.svg') }}" alt=""></a></div>
              <div class="item"><a href="#"><img class="lazy" data-src="{{ asset('img/home/icon-7.svg') }}" alt=""></a></div>
            </div>
          </div>
        </div>
        <div class="col-lg-10">
          <div class="row">
            <div class="col-lg-5 item">
              <ul>
                <li><a href="#" class="font-bold">CÔNG TY CỔ PHẦN VINAAURA [ĐỘC QUYỀN PH N PHỐI TẠI VIỆT NAM]</a></li>
                <li><a href="#">HỒ CHÍ MINH: 72/1b Huỳnh Văn Bánh, Phường 15, Q.Phú Nhuận</a></li>
                <li><a href="#">HÀ NỘI: 319 Trần Cung, Từ Liêm</a></li>
                <li><a href="#">ĐIỆN THOẠI:  0909991612 (Mr.Bách)</a></li>
                <li><a href="#">EMAIL: dangcapphaidep@gmail.com</a></li>
              </ul>
            </div>
            <div class="col-lg-3 item">
              <ul>
                <li><a href="#" class="font-bold">GIỜ LÀM VIỆC</a></li>
                <li><a href="#">+ 8:15 - 17:15 (Thứ 2 - Thứ 6)</a></li>
                <li><a href="#">+ 8:15 - 11h45 (Thứ 7)</a></li>
              </ul>
              <h4></h4>
              <ul>
                <li><a href="#" class="font-bold">MÃ SỐ THUẾ</a></li>
                <li><a href="#">0315089805</a></li>
              </ul>
            </div>
            <div class="col-lg-4 item">
              <ul>
                <li><a href="#" class="font-bold">HỖ TRỢ KHÁCH HÀNG</a></li>
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="#">Hình thức giao hàng</a></li>
                <li><a href="#">Hình thức thanh toán</a></li>
                <li><a href="#">Chính sách đổi trả</a></li>
                <li><a href="#">Chính sách bảo mật</a></li>
                <li><a href="#">Chính sách biên tập</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center copy-right pt-3 pb-3">
      <p class="m-0 p-0">© 2022 All rights reserved</p>
    </div>
  </footer>
  <a id="top" href="#top"><img class="lazy" data-src="{{ asset('img/home/top.png') }}" alt=""></a>
  <div class="section-search">
    <div class="text-center pt-3 pb-3 img"><img class="lazy" data-src="{{ asset('img/home/logo-s.png') }}" alt=""></div><span class="close"><img class="lazy" data-src="{{ asset('img/home/icon-15.svg') }}" alt=""><span>Close</span></span>
    <form class="form" action="#">
      <div class="input">
        <input type="text" placeholder="Tìm kiếm sản phẩm">
        <button type="submit"><img class="lazy" data-src="{{ asset('img/home/icon-16.svg') }}" alt=""></button>
      </div>
    </form>
  </div>
  @php
	$session_id = Session::get('session_id');
	$getCart = DB::table('order_term')->where('tinhtrang',0)->where('session_id',$session_id)->get();
	$countCart = $getCart->count();
  @endphp
  <div class="section-cart">
    <div class="head d-flex align-items-center justify-content-between">
      <h3 class="m-0 p-0">Giỏ hàng của bạn</h3><span class="close"><img class="lazy" data-src="{{ asset('img/home/icon-15.svg') }}" alt></span>
    </div>
	<div class="check-cart-list">
	@if($countCart > 0)
    <div class="content">
	  @php
				$tongtien = 0;
			@endphp
			@foreach($getCart as $cart)
				@php
					$product = DB::table('product')->join('product_detail', 'product.ID', '=', 'product_detail.PRODUCTID')->where('product.STATUS',1)->where('product.ID',$cart->pro_id)->first();
				@endphp
				@if($product)
      <div class="card">
        <div class="card-body">
          <div class="d-flex">
            <div class="img"><img class="lazy" data-src="{{ '/timthumb.php?src='.$product->IMAGE.'&w=80&h=80&q=72&zc=2' }}" alt=""></div>
            <div class="text"><span class="title">{{ $product->NAME }}</span>
              <div class="d-flex mb-3 align-items-center">
				@if($product->DISCOUNT)
							@php
								$tongtien = $tongtien + ($cart->num_of*$product->DISCOUNT);
							@endphp
							<span class="price-new">{{ number_format($product->DISCOUNT) }}</span>
							<span class="price-old">{{ number_format($product->PRICE) }}đ</span>
						@else
							@php
								$tongtien = $tongtien + ($cart->num_of*$product->PRICE);
							@endphp
							<span class="price-new">{{ number_format($product->PRICE) }}đ</span>
						@endif
			  </div>
              <input type="number" value="{{ $cart->num_of }}">
            </div>
          </div>
          <div class="line-bottom pt-3"></div>
        </div>
      </div>
	  @endif
	  @endforeach
      
    </div>
    <div class="bottom">
      <div class="total"><span>Tổng tiền : </span><span>{{ number_format($tongtien) }} đ</span></div><a class="button mt-3 text-uppercase" href="{{ route('frontend.giohang') }}">Thanh toán</a>
    </div>
	@else
		<div class="card">
        <div class="card-body">
			<div class="item row align-items-start">
				<p>Bạn chưa mua sản phẩm nào.</p>
			</div>
		</div>
		</div>
	@endif
	</div>
  </div>
@if($isNonGoogle)
<div class="section-map pt-5 pb-5">
    <div class="container">
      <div class="d-flex content">
        <div class="info py-4 px-4">
          <div class="inn">
            <div class="d-flex align-items-center mb-3">
              <div class="icon"><img class="lazy" data-src="{{ asset('img/home/icon-3.svg') }}" alt=""></div>
              <div class="title"><a href="tel:0906947824">0906947824</a></div>
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
        <div class="map"><img class="img-fluid lazy" data-src="{{ asset('img/home/map-1.png') }}" alt="map"></div>
      </div>
    </div>
</div>
@endif

  <footer id="footer">
    <div class="container">
      <div class="row pt-5 pb-5">
        <div class="col-lg-4">
          <div class="logo mb-3"><a href="#"><img class="lazy" data-src="{{ asset('img/home/logo.svg') }}" alt=""></a></div>
          <form class="form" action="#">
            <p>Love beauty innovation?</p>
            <div class="input">
              <input type="email" requied placeholder="Email">
              <button type="submit"><img class="lazy" data-src="{{ asset('img/home/icon-8.svg') }}" alt=""></button>
            </div>
          </form>
          <div class="social mt-4">
            <div class="d-flex align-items-center justify-content-between m-0 p-0">
              <div class="item"><a href="#"><img class="lazy" data-src="{{ asset('img/home/icon-9.svg') }}" alt=""></a></div>
              <div class="item"><a href="#"><img class="lazy" data-src="{{ asset('img/home/icon-6.svg') }}" alt=""></a></div>
              <div class="item"><a href="#"><img class="lazy" data-src="{{ asset('img/home/icon-7.svg') }}" alt=""></a></div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="row">
            <div class="col-lg-4 item">
              <h4>ABOUT</h4>
              <ul>
                <li><a href="#">Collections</a></li>
                <li><a href="#">Skincare</a></li>
                <li><a href="#">Makeup</a></li>
                <li><a href="#">The House</a></li>
              </ul>
            </div>
            <div class="col-lg-4 item">
              <h4>LA PRAIRIE</h4>
              <ul>
                <li><a href="#">Collections</a></li>
                <li><a href="#">Skincare</a></li>
                <li><a href="#">Makeup</a></li>
                <li><a href="#">The House</a></li>
              </ul>
            </div>
            <div class="col-lg-4 item">
              <h4>Legal</h4>
              <ul>
                <li>     <a href="#">Privacy policy</a></li>
                <li><a href="#">Cookie policy</a></li>
                <li><a href="#">Terms and conditions</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Press</a></li>
                <li><a href="#">Imprint</a></li>
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
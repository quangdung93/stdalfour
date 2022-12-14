@extends('user.layout.master')
@section('schema')
<script type="application/ld+json">
  {
    "@context": "https://schema.org/",
    "@type": "Product",
    "name": "{{ $product->NAME }}",
    "image": "{{ asset($product->IMAGE) }}",
    "url": "{{ url($product->URL) }}",
    "description": "{{ $product->SUMMARY }}",
    "category": "{{ $product->CATEGORYID }}",
    "sku": "$sku$",
    "mpn": "$sku$",
    "brand": {
    "@type": "Brand",
    "name": "ST Dalfour",
    "description": "Stdalfour.com.vn: chuyên phân phối mỹ phẩm nhập khẩu giá tốt, mỹ phẩm làm đẹp chất lượng cao từ các thương hiệu nổi tiếng trên thế giới.",
    "alternateName": "{{ $product->NAME }} ST Dalfour",
    "url": "https://stdalfour.com.vn",
    "logo": "https://stdalfour.com.vn/img/home/logo.png",
    "sameAs": [
   "https://www.dnb.com/business-directory/company-profiles.swissline_immobilien_gmbh.3ea7ed6db7782333d6881cbacc2bbeed.html",
      "https://www.swissline-cosmetics.com/"
    ]},
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "4",
      "bestRating": "5",
      "worstRating": "1",
      "ratingCount": "200"
    },
    "offers": {
      "@type": "Offer",
      "url": "{{ url($product->URL) }}",
      "priceCurrency": "VND",
      "price": "{{ $product->PRICE }}",
      "priceValidUntil": "{{ \Carbon\Carbon::now()->addDays(90)->format('Y-m-d') }}",
      "itemCondition": "https://schema.org/NewCondition",
      "availability": "https://schema.org/InStock",
      "seller": {
        "@type": "Organization",
        "name": "stdalfour.com.vn"
      }
    }
  }</script>
  <script type="application/ld+json">
      {
        "@context": "https://schema.org/", 
        "@type": "BreadcrumbList", 
        "itemListElement": [{
          "@type": "ListItem", 
          "position": 1, 
          "name": "Trang chủ",
          "item": "{{ url('/') }}"  
        },{
          "@type": "ListItem", 
          "position": 2, 
          "name": "Sản phẩm",
          "item": "{{ url('/san-pham') }}"  
        }]
      }
  </script>    
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <ul class="breadcrumbs">
          <li><a href="/">Trang chủ</a></li>
          <li>/ <a href="/san-pham">Sản phẩm</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="section-15 pt-5 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 pe-5">
          <div class="d-flex">
			@php
				$slidesProduct = DB::table('product_image')->where('PRODUCTID',$product->ID)->get();
			@endphp
			@if($slidesProduct)
            <div class="thumb pe-5">
              <ul class="m-0 p-0">
				@foreach($slidesProduct as $item)
					<li class="m-3"><a class="d-block" data-src="{{ $item->BASE_URL }}"><img class="img-fluid lazy" data-src="{{ $item->BASE_URL }}" alt=""></a></li>
                @endforeach
              </ul>
            </div>
			@endif
            <div class="big"><img class="img-fluid lazy" data-src="{{ $product->IMAGE }}" alt=""></div>
          </div>
        </div>
        <div class="col-lg-5">
          <h1 class="mb-3">{{ $product->NAME }}</h1>
          <div class="review mb-3 d-flex align-items-center">
            <div class="star">
              <img class="lazy" data-src="/img/detail/icon1.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon1.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
            </div><span>4.9 (123) Write a review</span>
          </div>
          <div class="description mb-3">
			  <span class="mb-2 d-block">Discover complexion perfection</span>
            <p>{{ $product->SUMMARY }}</p>
          </div>
          <div class="pt-3 pb-3">
            <div class="line-bottom"></div>
          </div>
          <div class="color"><span class="d-block mb-3">Choose color: Mint</span>
            <ul class="m-0 p-0 d-flex">
              <li class="active"><a class="green d-block"></a></li>
              <li><a class="pink d-block"></a></li>
              <li><a class="red d-block"></a></li>
            </ul>
          </div>
          <div class="pt-3 pb-3">
            <div class="line-bottom"></div>
          </div>
          <div class="shipdate">Expected delivery date for Vietnam: <span>10 Jun 2022</span></div>
          <div class="pt-3 pb-3">
            <div class="line-bottom"></div>
          </div>
          <div class="price d-flex align-items-center justify-content-between"><span>{{ number_format($product->PRICE).'đ' }}</span>
            <button type="button" class="add_buy_product_right">Add to cart</button>
          </div>
          <div class="pt-3 pb-3">
            <div class="line-bottom"></div>
          </div>
          <div class="warranty d-flex align-items-start"><img class="lazy" data-src="/img/detail/icon12.svg" alt=""><span>WARRANTY<br>2 years</span></div>
        </div>
      </div>
    </div>
  </div>
  @if($product->ORIGIN)
	{!! $product->ORIGIN !!}
  @endif

  @if($relatedProduct)
  <div class="section-16 pb-5">
    <div class="container">
        <div class="row">
            @foreach($relatedProduct as $key => $item)
              @php
                $urlProduct = route('frontend.category.detail', ['urlpost' => Custom::get_url_alias('product_id='.$item->PRODUCTID)]);
              @endphp
              <div class="col-lg-6">
                  <div class="item d-flex align-items-center">
                      <img class="lazy img-w-150" data-src="{{ asset($item->IMAGE) }}" alt="">
                      <div class="card-body">
                        <h4 class="card-title">{{ $item->NAME }}</h4>
                        <p>{{ \Str::limit($item->SUMMARY, 70) }}</p>
                        <span class="price-old d-block">4.567.000 vnd</span>
                        <span class="price-new d-block">{{ $item->PRICE }} đ</span>
                        <a class="buy mt-3" href="{{ $urlProduct }}">Mua ngay</a>
                      </div>
                  </div>
              </div>
            @endforeach
        </div>
    </div>
  </div>
  @endif
  <div class="section-review pb-5">
    <div class="container">
      <div class="text-center">
        <h2 class="mb-5">We got glowing reviews</h2>
      </div>
      <div class="d-flex content">
        <div class="block-1 pe-5">
          <div class="d-flex mb-5"><span class="number">4.8</span>
            <div class="d-block">
              <div class="star mb-2">
                <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
                <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
                <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
                <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
                <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
              </div><span>499 nhận xét</span>
            </div>
          </div>
          <button class="text-uppercase">Gửi đánh giá và bình luận</button>
        </div>
        <div class="block-2 mt-2"> 
          <div class="d-flex align-items-center mb-2">
            <div class="star">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
            </div>
            <div class="bg-line">
              <div class="bg-1"></div>
              <div class="bg-2" style="width: 100%"></div>
            </div><span class="color1">10 đánh giá</span>
          </div>
          <div class="d-flex align-items-center mb-2">
            <div class="star">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
            </div>
            <div class="bg-line">
              <div class="bg-1"></div>
              <div class="bg-2" style="width: 80%"></div>
            </div><span class="color1">5 đánh giá</span>
          </div>
          <div class="d-flex align-items-center mb-2">
            <div class="star">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
            </div>
            <div class="bg-line">
              <div class="bg-1"></div>
              <div class="bg-2" style="width: 20%"></div>
            </div><span class="color1">3 đánh giá</span>
          </div>
          <div class="d-flex align-items-center mb-2">
            <div class="star">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt=""></div>
            <div class="bg-line">
              <div class="bg-1"></div>
              <div class="bg-2"></div>
            </div><span class="color2">0 đánh giá</span>
          </div>
          <div class="d-flex align-items-center mb-2">
            <div class="star">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt=""></div>
            <div class="bg-line">
              <div class="bg-1"></div>
              <div class="bg-2"></div>
            </div><span class="color2">0 đánh giá</span>
          </div>
        </div>
      </div>
      <div class="block-3 pt-5">
        <div class="mb-2"><span>Bạn  thấy sản phẩm như thế nào ?<br>(Chọn sao nhé)</span>
          <div class="star"><span></span><span></span><span></span><span></span><span></span></div>
        </div>
        <form class="form" action="#">
          <div class="inner mb-3">
            <textarea rows="4" cols="50" placeholder="Đánh giá chi tiết"></textarea>
            <input type="file" id="myfile" name="myfile"><img class="lazy" data-src="/img/detail/icon4.svg" alt="">
          </div>
          <div class="d-flex justify-content-between">
            <div class="d-flex">
              <input class="input" type="text" placeholder="Họ Tên" required>
              <input class="input" type="text" placeholder="Email" required>
            </div>
            <button type="submit">Gửi</button>
          </div>
        </form>
      </div>
      <div class="block-4 pt-5">
        <h3 class="mb-3">Hình ảnh từ các bài đánh giá</h3>
        <div class="owl-carousel owl-theme">
          <div class="item"><img class="w-100 lazy" data-src="/img/detail/img27.png" alt="image"></div>
          <div class="item"><img class="w-100 lazy" data-src="/img/detail/img28.png" alt="image"></div>
          <div class="item"><img class="w-100 lazy" data-src="/img/detail/img29.png" alt="image"></div>
          <div class="item"><img class="w-100 lazy" data-src="/img/detail/img30.png" alt="image"></div>
          <div class="item"><img class="w-100 lazy" data-src="/img/detail/img31.png" alt="image"></div>
          <div class="item"><img class="w-100 lazy" data-src="/img/detail/img27.png" alt="image"></div>
          <div class="item"><img class="w-100 lazy" data-src="/img/detail/img28.png" alt="image"></div>
          <div class="item"><img class="w-100 lazy" data-src="/img/detail/img29.png" alt="image"></div>
          <div class="item"><img class="w-100 lazy" data-src="/img/detail/img30.png" alt="image"></div>
          <div class="item"><img class="w-100 lazy" data-src="/img/detail/img31.png" alt="image"></div>
        </div>
      </div>
      <div class="block-5 pt-5">
        <h3 class="mb-3">Danh sách bài đánh giá</h3>
        <div class="row danhgia pt-3 pb-3">
          <div class="col-lg-3">
            <div class="star mb-2">
              <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
              <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
            </div><span class="time">Cách 12 giờ</span>
          </div>
          <div class="col-lg-6 pe-5 d-center">
            <h5 class="mb-2">Uy tín lắm nha</h5>
            <p>Đầu tiên là hàng đc bọc khá ổn ko gọi là kĩ nhưng cũng khá chắc chắn chất của em này là gel đặc rất thơm luôn shipper thì rất vui tính và thân thiện tuy muộn mất mấy ngày vì mình ko cầm</p>
            <div class="img mb-3"><img class="lazy" data-src="/img/detail/img25.png" alt=""><img class="lazy" data-src="/img/detail/img26.png" alt=""></div>
            <div class="review">
              <div class="d-flex align-items-center">
                <div class="like"><img class="lazy" data-src="/img/detail/icon9.svg" alt=""><span>Hữu ích (1)</span></div>
                <div class="answer">Gửi trả lời</div>
              </div>
              <form class="form mt-4" action="#">
                <div class="d-flex"><img class="img" src="/img/detail/avatar1.png" alt="">
                  <div class="input">
                    <input type="text" placeholder="Viết câu trả lời">
                    <button type="button"> <img class="lazy" data-src="/img/detail/icon13.png" alt=""></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-3 ps-5">
            <div class="d-flex">
              <div class="avatar"><img class="lazy" data-src="/img/detail/avatar2.png" alt=""></div>
              <div class="title"><span class="d-block">Nguyễn Ngọc An </span><span class="date d-block">Đã tham gia 4 năm   </span></div>
            </div>
          </div>
        </div>
        <div class="row danhgia pt-3 pb-3">
          <div class="col-lg-3">
            <div class="star mb-2"><img class="lazy" data-src="/img/detail/icon2.svg" alt=""><img class="lazy" data-src="/img/detail/icon3.svg" alt=""><img class="lazy" data-src="/img/detail/icon3.svg" alt=""><img class="lazy" data-src="/img/detail/icon3.svg" alt=""><img class="lazy" data-src="/img/detail/icon3.svg" alt=""></div><span class="time">Cách 12 giờ</span>
          </div>
          <div class="col-lg-6 pe-5 d-center">
            <h5 class="mb-2">Uy tín lắm nha</h5>
            <p>Đầu tiên là hàng đc bọc khá ổn ko gọi là kĩ nhưng cũng khá chắc chắn chất của em này là gel đặc rất thơm luôn shipper thì rất vui tính và thân thiện tuy muộn mất mấy ngày vì mình ko cầm</p>
            <div class="img mb-3"><img class="lazy" data-src="/img/detail/img25.png" alt=""><img class="lazy" data-src="/img/detail/img26.png" alt=""></div>
            <div class="review">
              <div class="d-flex align-items-center">
                <div class="like"><img class="lazy" data-src="/img/detail/icon9.svg" alt=""><span>Hữu ích (1)</span></div>
                <div class="answer">Gửi trả lời</div>
              </div>
              <form class="form mt-4" action="#">
                <div class="d-flex"><img class="img lazy" data-src="/img/detail/avatar1.png" alt="">
                  <div class="input">
                    <input type="text" placeholder="Viết câu trả lời">
                    <button type="button"> <img class="lazy" data-src="/img/detail/icon13.png" alt=""></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-3 ps-5">
            <div class="d-flex">
              <div class="avatar">
                <div class="bg"><img class="lazy" data-src="/img/detail/icon14.png" alt=""></div>
              </div>
              <div class="title"><span class="d-block">Nguyễn Ngọc An </span><span class="date d-block">Đã tham gia 4 năm    </span></div>
            </div>
          </div>
        </div>
        <div class="paging pt-5 pb-5">
          <ul class="m-0 p-0 d-flex align-items-center justify-content-center">
            <li><a class="prev" href="#"><img class="lazy" data-src="/img/detail/icon14.svg" alt=""></a></li>
            <li><a class="page active" href="#">1</a></li>
            <li><a class="page" href="#">2</a></li>
            <li><a class="page" href="#">3</a></li>
            <li><a class="page" href="#">4</a></li>
            <li><a class="next" href="#"><img class="lazy" data-src="/img/detail/icon15.svg" alt=""></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
	<script type="text/javascript">
		jQuery.fn.extend({
			live: function (event, callback) {
				if (this.selector) {
					jQuery(document).on(event, this.selector, callback);
				}
				return this;
			}
		});
		$(document).ready(function(){
			$(".add_buy_product_right").click(function () {
				$('#modal-1').modal('show');
				$('#checkout').html('<div id="loadercart"><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>');
				$.ajax({
					url: "{{ route('frontend.cart.add') }}",
					type: "post",
					data: {
						product_id: "{{ $product->ID }}",
                        product_price: "{{ $product->PRICE }}",
                        product_quantity: 1,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',
					success: function (result) {
						if(result.err == 1){
                            $('#error-message').find('.modal-body h1').html(result.msg);
							$('#error-message-btn').trigger('click');
                        }else{
							document.location = "{{ route('frontend.giohang') }}";
						}
					}
				});
			});
		});
	</script>
@endsection
@extends('user.layout.master')
@section('schema')
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "HealthAndBeautyBusiness",
        "name": "Stdalfour.com.vn: Sứ Mệnh Làm Đẹp Cho Phụ Nữ Việt",
        "description": "Stdalfour.com.vn: chuyên phân phối mỹ phẩm nhập khẩu giá tốt, mỹ phẩm làm đẹp chất lượng cao từ các thương hiệu nổi tiếng trên thế giới.",
        "image": "https://stdalfour.com.vn/img/home/logo.png",
        "@id": "",
        "url": "{{ url('/') }}",
        "telephone": "+84 888845999",
        "priceRange": "200000VND-5000000VND",
        "email": "info@dangcapphaidep.vn",
        "faxNumber": "0315089805",
        "hasMap": "https://www.google.com/maps/place/%C4%90%E1%BA%B3ng+C%E1%BA%A5p+Ph%C3%A1i+%C4%90%E1%BA%B9p+-+Dangcapphaidep.vn/@10.7942599,106.6784174,17z/data=!3m1!4b1!4m8!1m2!2m1!1zxJHhurNuZyBj4bqlcCBwaMOhaSDEkeG6uXA!3m4!1s0x317528cef8c16579:0x494fce39a29c815d!8m2!3d10.7942599!4d106.6806061",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "72/1B Huỳnh Văn Bánh, Phường 15, Quận Phú Nhuận",
          "addressLocality": "Hồ Chí Minh",
          "postalCode": "700000",
          "addressCountry": "VN"
        },
        "geo": {
          "@type": "GeoCoordinates",
          "latitude": 10.7942599,
          "longitude": 106.6806061
        },
        "openingHoursSpecification": [{
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday"
          ],
          "opens": "08:00",
          "closes": "18:00"
        },{
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": "Saturday",
          "opens": "08:00",
          "closes": "13:00"
        }] 
      }
    </script>
@endsection

@section('content')
	@if($producthot)
	<div class="section-1 pt-5 pb-5">
    <div class="container">
      <div class="heading pb-5">
        <h2>my skincare rountine </h2>
      </div>
      <div class="row">
		@foreach($producthot as $km)
        <div class="col-lg-4">
          <div class="card p-5"><img class="img-fluid lazy" data-src="{{ $km->IMAGE }}" alt="img">
            <div class="card-body">
              <h4 class="card-title">{{ $km->NAME }}</h4><a class="find mb-3" href="{{ route('frontend.category.detail', ['urlpost' => Custom::get_url_alias('product_id='.$km->PRODUCTID)]) }}">Find a Store near you</a><span class="size">@if($km->PRICE == 0) Liên hệ @else {{ Custom::product_price($km->PRICE) }}đ @endif</span>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif
  @if($setting)
	  @php
			$pic_thumb_array = explode('|', $setting->about_gallery_list);
	  @endphp
	@if(count($pic_thumb_array) > 0)
	  <div class="section-2 pt-5 pb-5">
		<div class="container">
		  <div class="heading pb-5">
			<h2>THIS MONTH’S CURATION</h2>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>
		  </div>
		  <div class="slides-custom owl-carousel owl-theme style1_dots">
          @foreach ($pic_thumb_array as $pic_thumb_array_val)
          <div class="item">
            <a class="card d-block" href="javascript:;"><img class="w-100 lazy" data-src="{{ '/images/services/'.$pic_thumb_array_val }}" alt="image">
              <div class="card-body"><img class="lazy" data-src="/img/home/icon-11.svg" alt="image"></div></a>
          </div>
          @endforeach
		  </div>
		</div>
	  </div>
	 @endif
  @endif
  
  @if($tiktok && $isNonGoogle)
  <div class="section-3 pt-5 pb-5">
    <div class="container">
      <div class="heading pb-4">
        <h2>FROM THE HOUSE</h2>
      </div>
      <ul class="nav" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab" aria-controls="products" aria-selected="true">Products</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="store-tab" data-bs-toggle="tab" data-bs-target="#store" type="button" role="tab" aria-controls="store" aria-selected="true">Store</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="experience-tab" data-bs-toggle="tab" data-bs-target="#experience" type="button" role="tab" aria-controls="experience" aria-selected="true">Experience</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="science-tab" data-bs-toggle="tab" data-bs-target="#science" type="button" role="tab" aria-controls="science" aria-selected="true">Science</button>
        </li>
      </ul>
      <div class="tab-content mt-5">
        <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab" tabindex="0">
          <div class="row align-items-center">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">What is Lorem Ipsum?</h3>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p><a href="#">Xem thêm</a>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="owl-carousel owl-theme">
			        @foreach($tiktok as $tik)
                <div class="item"><a class="card d-block" href="/tin-tuc/{{ Custom::get_url_alias('news_id='.$tik->NEWSID) }}"><img class="w-100 lazy" data-src="{{ $tik->IMAGE }}" alt="image">
                    <div class="card-body"><img class="lazy" data-src="/img/home/icon-12.svg" alt="image"></div></a></div>
              @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="store" role="tabpanel" aria-labelledby="store-tab" tabindex="0">
          <div class="row align-items-center">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">What is Lorem Ipsum?</h3>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p><a href="#">Xem thêm</a>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="owl-carousel owl-theme">
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img8.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img9.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img8.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img9.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img8.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab" tabindex="0">
          <div class="row align-items-center">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">What is Lorem Ipsum?</h3>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p><a href="#">Xem thêm</a>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="owl-carousel owl-theme">
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img8.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img9.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img8.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img9.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img8.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="science" role="tabpanel" aria-labelledby="science-tab" tabindex="0">
          <div class="row align-items-center">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">What is Lorem Ipsum?</h3>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p><a href="#">Xem thêm</a>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="owl-carousel owl-theme">
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img8.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img9.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img8.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img9.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
                <div class="item"><a class="card d-block" href="#"><img class="w-100 lazy" data-src="img/home/img8.png" alt="image">
                    <div class="card-body"><img class="lazy" data-src="img/home/icon-12.svg" alt="image"></div></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

  @if($news && $isNonGoogle)
  <div class="section-4 pt-5 pb-5">
    <div class="container">
      <div class="heading pb-4">
        <h2>Blog</h2>
      </div>
      <div class="slides-custom owl-carousel owl-theme style1_dots">
		@foreach($news as $tin)
        <div class="item">
          <div class="card">
            <a href="/tin-tuc/{{ Custom::get_url_alias('news_id='.$tin->NEWSID) }}">
            <img class="w-100 mb-4 lazy" data-src="{{ $tin->IMAGE }}" alt="image">
            </a>
            <div class="card-body">
              <a class="text-link" href="/tin-tuc/{{ Custom::get_url_alias('news_id='.$tin->NEWSID) }}"><h4 class="card-title mb-4">{{ $tin->NAME }}</h4></a>
              <a class="btn-link" href="/tin-tuc/{{ Custom::get_url_alias('news_id='.$tin->NEWSID) }}">read more</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif
@endsection
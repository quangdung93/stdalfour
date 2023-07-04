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
          <li>/ <a href="/san-pham">{{ $product->NAME }}</a></li>
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
            <p>{{ $product->SUMMARY }}</p>
          </div>
          <div class="price d-flex align-items-center justify-content-between"><span>{{ number_format($product->PRICE).'đ' }}</span>
            <button type="button" class="add_buy_product_right">Add to cart</button>
          </div>
          <div class="pt-3 pb-3">
            <div class="line-bottom"></div>
          </div>
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
        <h3 class="mb-5">Đánh giá và Bình luận</h3>
      </div>
      <div class="d-flex content">
        <div class="block-1 pe-5">
          <div class="d-flex mb-5"><span class="number">{{ round($avgVote, 1) }}</span>
            @php
              $avgVoteNumber = round($avgVote);
            @endphp
            <div class="d-block">
              <div class="star mb-2">
                @for($i = 0; $i < 5; $i++)
                  @if($i < $avgVoteNumber)
                  <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
                  @else
                  <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
                  @endif
                @endfor
              </div><span>{{ $ratings->count() }} nhận xét</span>
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
          <div class="star rating-star">
            <span data-vote="5"></span>
            <span data-vote="4"></span>
            <span data-vote="3"></span>
            <span data-vote="2"></span>
            <span data-vote="1"></span>
          </div>
        </div>

        <form id="frm-rating" class="form" data-action="{{ route('frontend.rating.add') }}">
          <div class="inner mb-3">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="product_id" value="{{ $product->ID }}">
            <input type="hidden" id="input-vote" name="vote" value="">
            <textarea rows="4" cols="50" id="comment" name="comment" placeholder="Đánh giá chi tiết"></textarea>
            <input type="file" class="upload-image" id="myfile" name="myfile"><img class="lazy" data-src="/img/detail/icon4.svg" alt="">
          </div>
          <div class="d-flex justify-content-between">
            <div class="d-flex">
              <input class="input" id="input-name" type="text" name="name" placeholder="Họ Tên" required>
              <input class="input" id="input-phone" type="text" name="phone" placeholder="Điện thoại">
            </div>
            <button type="submit">Gửi</button>
          </div>
        </form>
      </div>
      <ul class="list-image-comment"></ul>
      <div class="block-4 pt-5">
        <h3 class="mb-3">Hình ảnh từ các bài đánh giá</h3>
        @php
          $imgRating = [];
          if($ratings){
            $imagesArr = $ratings->pluck('images')->toArray();
            $imagesArr = array_filter($imagesArr);

            if($imagesArr){
              foreach ($imagesArr as $img) {
                if($img){
                  $temp = explode(',', $img);
                  $imgRating += $temp;
                }
              }
            }
          }
        @endphp

        @if($ratings && $imgRating)
        <div class="owl-carousel owl-theme">
          @foreach($imgRating as $value)
          <div class="item"><img class="w-100 lazy" data-src="{{ asset('/storage/storage/rating/'. $value) }}" alt="image"></div>
          @endforeach
        </div>
        @endif
      </div>
      @if($ratings)
      <div class="block-5 pt-5">
        <h3 class="mb-3">Danh sách bài đánh giá</h3>
        @foreach($ratings as $rating)
        <div class="row danhgia pt-3 pb-3">
          <div class="col-lg-3">
            <div class="star mb-2">
              @for($i = 0; $i < 5; $i++)
                @if($i < $rating->vote)
                <img class="lazy" data-src="/img/detail/icon2.svg" alt="">
                @else
                <img class="lazy" data-src="/img/detail/icon3.svg" alt="">
                @endif
              @endfor
            </div>
            <span class="time">{{ App\Helpers\Custom::getAgoTime($rating->created_at) }}</span>
          </div>
          <div class="col-lg-6 pe-5 d-center">
            <p>{{ $rating->comment }}</p>
            @php
              $imagesList = explode(',', $rating->images);
            @endphp
            @if($imagesList)
            <div class="img mb-3">
              @foreach($imagesList as $key => $image)
                <img width="150" src="{{ asset('storage/storage/rating/' .$image) }}" alt="">
              @endforeach
            </div>
            @endif
            <div class="review">
              {{-- <div class="d-flex align-items-center">
                <div class="like"><img class="lazy" data-src="/img/detail/icon9.svg" alt=""><span>Hữu ích (1)</span></div>
                <div class="answer">Gửi trả lời</div>
              </div> --}}
              @php
                $userId = Cookie::get('userAdId');
              @endphp

              @if($userId)
              <form class="form mt-4" action="#">
                <div class="d-flex"><img class="img lazy" data-src="/img/detail/avatar1.png" alt="">
                  <div class="input">
                    <input type="text" placeholder="Viết câu trả lời">
                    <button type="button"> <img class="lazy" data-src="/img/detail/icon13.png" alt=""></button>
                  </div>
                </div>
              </form>
              @endif
            </div>
          </div>
          <div class="col-lg-3 ps-5">
            <div class="d-flex">
              <div class="avatar">
                <div class="bg"><img class="lazy" data-src="/img/detail/icon14.png" alt=""></div>
              </div>
              <div class="title"><span class="d-block">{{ $rating->name_user }} </span></div>
            </div>
          </div>
        </div>
        @endforeach
        {{-- <div class="paging pt-5 pb-5">
          <ul class="m-0 p-0 d-flex align-items-center justify-content-center">
            <li><a class="prev" href="#"><img class="lazy" data-src="/img/detail/icon14.svg" alt=""></a></li>
            <li><a class="page active" href="#">1</a></li>
            <li><a class="page" href="#">2</a></li>
            <li><a class="page" href="#">3</a></li>
            <li><a class="page" href="#">4</a></li>
            <li><a class="next" href="#"><img class="lazy" data-src="/img/detail/icon15.svg" alt=""></a></li>
          </ul>
        </div> --}}
      </div>
      @endif
    </div>
  </div>
@endsection

@section('js')
	<script type="text/javascript">
    const URL_MAIN = '{{ url("/") }}';
		jQuery.fn.extend({
			live: function (event, callback) {
				if (this.selector) {
					jQuery(document).on(event, this.selector, callback);
				}
				return this;
			}
		});
		$(document).ready(function(){

      $(document).on('click', '.rating-star span', function(e){
        e.preventDefault();
        $('.rating-star span').removeClass('rating-active');
        let vote = $(this).data('vote');
        $('#input-vote').val(vote);
        $('.rating-star span').each(function(){
          if(vote >= $(this).data('vote')){
            $(this).addClass('rating-active');
          }
        });

        $(this).addClass('rating-active');
      });

      $(document).on('submit', '#frm-rating', function(e){
        e.preventDefault();

        let images = [];
        $('.list-image-comment li').each(function(){
          let item = $(this).data('img');

          if(item){
            images.push(item);
          }
        })

        if($('#input-vote').val() == ""){
          alert('Bạn chưa chọn sao đánh giá')
        }
        else if($('#comment').val() == ""){
          alert('Bạn chưa nhập nội dung đánh giá')
        }
        else if($('#input-name').val() == ""){
          alert('Bạn chưa nhập họ tên')
        }
        else{
          $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              method: 'POST',
              url: $(this).data('action'),
              data: `${$(this).serialize()}&images=${images}`,
              success: function (response) {
                  if (response.error) {
                    alert(response.message)
                  }
                  else{
                    alert(response.message);
                    window.location.reload();
                  }
              }
          });
        }

      });

      $(document).on('change', '.upload-image', function(e){
            // var data_index = $(this).data("index");
            var files = $(this)[0].files,
                listFiles = [];
            if(files.length > 4){
                alert('Chỉ được upload tối đa 4 ảnh');
                return false;
            }
            
            for(let i = 0; i < files.length; i++){
                if(files[i].size > 5242880){ 
                    alert('Dung lượng ảnh [' + files[i].name + '] không được vượt quá 5Mb');
                }else{
                    listFiles.push(files[i]);
                }
            }
            if(listFiles.length > 0) handleImageUpload(listFiles);
        });

      function handleImageUpload(files){

            var frmData = new FormData();

            for(let i = 0; i < files.length; i++){
                frmData.append('files[]', files[i]);
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{ route("upload.image") }}',
                data: frmData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data.error){
                      alert(data.message);
                    }
                    else{
                        let html = '';
                        if(data.data.length > 0){
                            $.each(data.data, function(index, item) {
                                html += `<li data-img="${item.split('/').pop()}"><img width="150" src="${URL_MAIN}/storage/${item}" alt=""><span class="remove-img-cmt"><i class="iconhita-close"></i></span></li>`;
                            });
                        }
                        $('.list-image-comment').prepend(html);
                    }
                },
                error: function (n) {

                }
            });
        }

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
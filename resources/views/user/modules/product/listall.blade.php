@extends('user.layout.master')
@section('schema')
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
<script type="application/ld+json">
  {
    "@context":"https://schema.org",
    "@type":"ItemList",
    "name": "Sản phẩm",
    "alternateName": "",
    "image": "https://stdalfour.com.vn/img/home/logo.png",
    "url": "{{ url('/san-pham') }}",
    "description": "",
    "sameAs": [
      "http://swisslinevietnam.com",
      "https://www.swissline-cosmetics.com"
    ],
    "numberOfItems": "{{ $productcat->count() }}",
    "additionalType":[
      "http://www.productontology.org/id/Skin_care",
      "http://www.productontology.org/id/Beauty"
    ],
    "itemListElement":[
      @foreach($productcat as $km)
      {"@type":"ListItem","position": {{ $loop->iteration }},"url":"{{ route('frontend.category.detail', ['urlpost' => Custom::get_url_alias('product_id='.$km->PRODUCTID)]) }}"}@if(!$loop->last),@endif
      @endforeach
    ]
  }
</script>
@endsection
{{-- @dd($productcat) --}}
@section('content')
	<div class="seciton-product">
    <div class="container">
      <div class="d-flex section-filter pt-4 pb-4 justify-content-end">
        <div class="icon1 d-flex align-items-center icon"><span>Filter</span><img class="img-fluid" src="img/product/icon2.svg" alt=""></div>
        <div class="icon2 d-flex align-items-center icon"><span>Sort By</span><img class="img-fluid" src="img/product/icon1.svg" alt=""></div>
      </div>
      <div class="row style1_product pt-3">
	  @foreach($productcat as $km)
        <div class="col-lg-4">
          <a class="item mb-4 text-center d-block" href="{{ route('frontend.category.detail', ['urlpost' => Custom::get_url_alias('product_id='.$km->PRODUCTID)]) }}">
            <img class="img-fluid lazy" data-src="{{ $km->IMAGE }}" alt="">
            <div class="body">
              <h4 class="product-title">{{ $km->NAME }}</h4>
            </div></a></div>
      @endforeach
      </div>
    </div>
  </div>
@endsection
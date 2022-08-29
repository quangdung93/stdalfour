@extends('user.layout.master')
@section('content')
	<div class="seciton-product">
    <div class="container">
      <div class="d-flex section-filter pt-4 pb-4 justify-content-end">
        <div class="icon1 d-flex align-items-center icon"><span>Filter</span><img class="img-fluid" src="img/product/icon2.svg" alt=""></div>
        <div class="icon2 d-flex align-items-center icon"><span>Sort By</span><img class="img-fluid" src="img/product/icon1.svg" alt=""></div>
      </div>
      <div class="row style1_product pt-3">
	  @foreach($productcat as $km)
        <div class="col-lg-4"><a class="item mb-4 text-center d-block" href="{{ route('frontend.category.detail', ['urlpost' => Custom::get_url_alias('product_id='.$km->PRODUCTID)]) }}"><img class="img-fluid" src="{{ $km->IMAGE }}" alt="">
            <div class="body">
              <h4 class="product-title">{{ $km->NAME }}</h4>
            </div></a></div>
      @endforeach
      </div>
    </div>
  </div>
  <div class="section-map pt-5 pb-5">
    <div class="container">
      <div class="d-flex content">
        <div class="info py-4 px-4">
          <div class="inn">
            <div class="d-flex align-items-center mb-3">
              <div class="icon"><img src="img/home/icon-3.svg" alt=""></div>
              <div class="title"><a href="tel:0906947824">0906947824</a></div>
            </div>
            <div class="d-flex align-items-center mb-3">
              <div class="icon"><img src="img/home/icon-4.svg" alt=""></div>
              <div class="title"><span>contact-us</span></div>
            </div>
            <div class="d-flex align-items-center mb-3">
              <div class="icon"><img src="img/home/icon-5.svg" alt=""></div>
              <div class="title"><span>24953 Paseo De Valencia, #6c, Laguna Hills, Ca 92653</span></div>
            </div>
          </div>
        </div>
        <div class="map"><img class="img-fluid" src="img/home/map-1.png" alt="map"></div>
      </div>
    </div>
  </div>
@endsection
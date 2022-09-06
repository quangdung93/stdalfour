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
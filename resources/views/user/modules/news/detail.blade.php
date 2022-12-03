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
			"name": "Tin tức",
			"item": "{{ url('/tin-tuc') }}"  
			}]
		}
	</script>    
	<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "BlogPosting",
			"headline": "{{ $news->NAME }}",
			"description": "{{ $news->SUMMARY }}",
			"image": "{{ asset($news->IMAGE) }}",  
			"author": {
			"@type": "Person",
				"name": "ST Dalfour",
				"url": "https://stdalfour.com.vn"
			},  
			"publisher": {
				"@type": "Organization",
				"name": "Stdalfour.com.vn",
				"logo": {
					"@type": "ImageObject",
					"url": "https://stdalfour.com.vn/img/home/logo.png"
				}
			},
			"datePublished": "{{ \Carbon\Carbon::parse($news->DATECREATE)->format('Y-m-d') }}",
			"dateModified": "{{ \Carbon\Carbon::parse($news->DATECREATE)->format('Y-m-d') }}"
		}
	</script>
@endsection
@section('content')
	<div class="container mt-2">
		<div class="row">
			<div class="col-sm-12">
			<ul class="breadcrumbs">
				<li><a href="/">Trang chủ</a></li>
				<li>/ <a href="/tin-tuc">Tin tức</a></li>
				@if($category)
					<li>/ <a href="#">{{ $category->NAME }}</a></li>
				@endif
			</ul>
			</div>
		</div>
	</div>
	<div class="seciton-introduce news-content pt-3 pb-5">
		<div class="container">
			<div class="news-wrap">
				<div class="row">
					<div class="col-sm-9">
						<h1>{{ $news->NAME }}</h1>
						@if($news->hoten)
							<p class="d-flex justify-content-between">
								<span>Tác giả: {{ $news->hoten }}</span>
								<span>Ngày đăng: {{ \Carbon\Carbon::parse($news->DATECREATE)->format('d/m/Y') }}</span>
							</p>
						@endif
						<div class="des">
							{{ $news->SUMMARY }}
						</div>
						<div class="content">
							{!! $news->CONTENT !!}
						</div>
					</div>
					
					<div class="col-sm-3">
						<div class="mb-3">
							<h3 class="mb-3">Bài viết liên quan</h3>
							<div class="news-related">
								@foreach($relatedNews as $key => $value)
								<div class="item mb-2">
									<div class="img">
										<a href="{{ url('tin-tuc/'.$value->URL) }}">
											<img class="img-fluid" src="{{ asset($value->IMAGE) }}" alt="{{ $value->NAME }}">
										</a>
									</div>
									<div class="title mt-3">
										<a class="text-decoration-none" href="{{ url('tin-tuc/'.$value->URL) }}">
											{{ $value->NAME }}
										</a>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<div class="mb-3">
							<h3 class="mb-3">Sản phẩm liên quan</h3>
							<div class="news-related">
								@foreach($products as $key => $product)
								@php
									$urlProduct = route('frontend.category.detail', ['urlpost' => Custom::get_url_alias('product_id='.$product->PRODUCTID)]);
								@endphp
								<div class="item mb-2">
									<div class="img">
										<a href="{{ $urlProduct }}">
											<img class="img-fluid" src="{{ asset($product->IMAGE) }}" alt="{{ $product->NAME }}">
										</a>
									</div>
									<div class="title mt-3">
										<a class="text-decoration-none" href="{{ $urlProduct }}">
											{{ $product->NAME }}
										</a>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
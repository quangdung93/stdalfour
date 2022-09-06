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
	<div class="seciton-introduce pt-5 pb-5">
		<div class="container">
			<h1>{{ $news->NAME }}</h1>
			<div class="des">
				{{ $news->SUMMARY }}
			</div>
			<div class="content">
				{!! $news->CONTENT !!}
			</div>
		</div>
	</div>
@endsection
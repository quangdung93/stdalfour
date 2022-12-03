@extends('user.layout.master')
@section('schema')
<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "Article",
		"@id": "{{ url('thong-tin/'.$newspage->URL) }}"
		"keywords": "{{ $newspage->SEO_KEYWORDS }}"
		"articleSection": "$Tên danh mục$"
		"inLanguage":"vi"
		"headline": "{{ $newspage->NAME }}",
		"description": "{{ $newspage->SUMMARY }}",
		"image": "{{ asset($newspage->IMAGE) }}",  
		"author": {
			"@type": "Organization",
			"name": "Stdalfour.com.vn",
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
		"datePublished": "{{ $newspage->DATETIME }}",
		"dateModified": "{{ $newspage->DATETIME }}"
	}
	</script>
	
@endsection
@section('content')
	@if($newspage->ID == 1)
		<div class="section-daily pt-5 pb-5"> 
			<div class="container">
				<div class="row">
					{!! $newspage->CONTENT !!}
				</div>
			</div>
		</div>
	@else
		<div class="seciton-introduce pt-5 pb-5">
			<div class="container">
				{!! $newspage->CONTENT !!}
			</div>
		</div>
	@endif
@endsection
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="robots" content="noindex, nofollow">
	<meta name="googlebot" content="noindex,nofollow">
	@if($isNonGoogle)
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NQCJ3TD');</script>
	<!-- End Google Tag Manager -->
	@endif
	{!! SEOMeta::generate() !!}
	 <!-- Load css styles-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css').'?v=2' }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl-carousel2/owl.carousel.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/reponsive.css').'?v=2' }}">
    <!-- Load fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Krub:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&amp;family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
	@yield('css')
	<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "WebSite",
			"url": "{{ url('/') }}",
			"potentialAction": {
			"@type": "SearchAction",
			"target": "{{ url('/') }}/tim-kiem?s={search_term_string}",
			"query-input": "required name=search_term_string"
			}
		}
	</script>
	@yield('schema')
</head>
@section('body')
<body>
	@if($isNonGoogle)
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NQCJ3TD"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	@endif
	@show
	@include('user.partial.header')
	@yield('content')
	@include('user.partial.footer')
	@include('user.partial.js')
	@yield('js')
</body>
</html>
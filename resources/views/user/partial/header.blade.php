@php
	$getRoute = Route::currentRouteName();
	$timenow = time();
	$session_id = Session::get('session_id');
	$cookie_id = Cookie::get("cookie_id");
	$getCart = DB::table('order_term')->where('tinhtrang',0)->where('session_id',$session_id)->get();
	$countCart = $getCart->count();
	if( !$session_id || $session_id < ($timenow - 86400) ){
		Session::put('session_id', $timenow);
	}
	$category = DB::table('category')->join('category_detail', 'category.ID', '=', 'category_detail.CATEGORYID')->where('category.PARENTID', 0)->where('category.STATUS',1)->orderBy('category.SORT','ASC')->get();
	if(!$cookie_id){
		Cookie::queue("cookie_id", $timenow, time() + 12 * 30 * 24 * 3600);
	}
@endphp
@if($getRoute == 'frontend.giohang')
<header class="header2" id="header">
    <nav class="navbar navbar-expand-lg p-0 pt-3 pb-3">
      <div class="container">
        <div class="navbar-toggler"><span class="openmenu">Menu</span></div>
        <div class="collapse navbar-collapse align-items-center justify-content-between"><a class="navbar-brand" href="/"><img src="/img/home/logo.png" alt="logo"></a>
          <div class="float-right d-flex align-items-center">
            <ul class="navbar-nav">
              <li class="nav-item"><a class="nav-link active text-uppercase" href="{{ route('frontend.sanpham.list') }}">Sản phẩm</a></li>
              <li class="nav-item"><a class="nav-link text-uppercase" href="/thong-tin/dai-ly">đại lý</a></li>
              <li class="nav-item"><a class="nav-link text-uppercase" href="{{ route('frontend.news') }}">blog làm đp</a></li>
              <li class="nav-item"><a class="nav-link text-uppercase" href="/thong-tin/gioi-thieu">giới thiệu</a></li>
            </ul>
            <div class="list-icon">
              <div class="icon1 icon"><img src="/img/home/icon-1.svg" alt=""></div>
              <div class="icon2 icon"><img src="/img/home/icon-2.svg" alt=""></div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
@else
<header id="header">

	<nav class="navbar navbar-expand-lg pt-lg-3 pb-lg-3">
      <div class="container container-lg">
        <div class="navbar-toggler justify-content-between align-items-center w-100"><span class="openmenu">
            <svg width="24" height="17" viewBox="0 0 24 17" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M23 8.33398H5.88892" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M23 1H1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M23 15.666H1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg></span><a class="navbar-brand" href="/"><img src="/img/home/logo.png" alt="logo" width="50"></a>
          <div class="list-icon">
            <div class="icon1 icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.7778 20.5556C16.1779 20.5556 20.5556 16.1779 20.5556 10.7778C20.5556 5.37766 16.1779 1 10.7778 1C5.37766 1 1 5.37766 1 10.7778C1 16.1779 5.37766 20.5556 10.7778 20.5556Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M23 22.9998L17.6834 17.6831" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
            <div class="icon2 icon"><span>0</span>
              <svg width="24" height="27" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.66667 1L1 5.88889V23C1 23.6483 1.25754 24.2701 1.71596 24.7285C2.17438 25.1869 2.79614 25.4444 3.44444 25.4444H20.5556C21.2039 25.4444 21.8256 25.1869 22.284 24.7285C22.7425 24.2701 23 23.6483 23 23V5.88889L19.3333 1H4.66667Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M1 5.88916H23" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M16.8889 10.7778C16.8889 12.0744 16.3738 13.318 15.457 14.2348C14.5401 15.1516 13.2966 15.6667 12 15.6667C10.7034 15.6667 9.45989 15.1516 8.54304 14.2348C7.6262 13.318 7.11112 12.0744 7.11112 10.7778" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
          </div>
        </div>
        <div class="collapse navbar-collapse align-items-center justify-content-between"><a class="navbar-brand" href="/"><img width="100" src="/img/home/logo.png" alt="logo"></a>
          <div class="float-right d-flex align-items-center">
            <ul class="navbar-nav">
              <li class="nav-item"><a class="nav-link active text-uppercase" href="{{ route('frontend.sanpham.list') }}">Sản phẩm</a></li>
              <li class="nav-item"><a class="nav-link text-uppercase" href="/thong-tin/dai-ly">Đại lý</a></li>
              <li class="nav-item"><a class="nav-link text-uppercase" href="{{ route('frontend.news') }}">Blog Làm Đẹp</a></li>
              <li class="nav-item"><a class="nav-link text-uppercase" href="/thong-tin/gioi-thieu">Giới Thiệu</a></li>
            </ul>
            <div class="list-icon">
              <div class="icon1 icon"><img src="{{ asset('/img/home/icon-1.svg') }}" alt=""></div>
              <div class="icon2 icon"><img src="{{ asset('/img/home/icon-2.svg') }}" alt=""></div>
            </div>
          </div><span class="close">
            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.8889 1H4.11111C2.39289 1 1 2.39289 1 4.11111V25.8889C1 27.6071 2.39289 29 4.11111 29H25.8889C27.6071 29 29 27.6071 29 25.8889V4.11111C29 2.39289 27.6071 1 25.8889 1Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M10.3333 10.3335L19.6666 19.6668" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M19.6666 10.3335L10.3333 19.6668" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg></span>
        </div>
      </div>
    </nav>
	@php
		$getSilde = DB::table('slider')->where('status',1)->get();
	@endphp
	@if($getSilde)
    <div class="owl-carousel owl-theme slider">
	  @foreach($getSilde as $slide)
      @if($loop->iteration > 1 && !$isNonGoogle)
        @break
      @endif
		  <div class="item"><img class="w-100" src="{{ '/images/slider/'.$slide->image }}" alt="image"></div>
	  @endforeach
    </div>
	@endif
</header>
@endif

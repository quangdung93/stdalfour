$(document).ready(function () {
	var slider = $('.slider');
	slider.owlCarousel({
		items: 1,
		nav: false,
		autoplay: true
	});
    var block2 = $('.section-2 .owl-carousel');
	block2.owlCarousel({
		items: 4,
		nav: false,
        dots: true,
		autoplay: true,
        margin:24,
        responsive:{
            0:{
                dots: false,
                items:1.5
            },
            768:{
                items:3
            },
            1200:{
                items:4
            }
        }
	});
    var block3 = $('.section-3 .owl-carousel');
	block3.owlCarousel({
        margin: 24,
        nav: true,
        navText:["<div class='nav-btn prev-slide'><img src='img/home/icon-14.svg' alt='img' /></div>","<div class='nav-btn next-slide'><img src='img/home/icon-13.svg' alt='img' /></div>"],
        dots: false,       
        responsive: {
            0:{
                items:1
            },
            768:{
                items:1.5
            },
            1000: {
                items:2.5
            }
        }
	});
    var block4 = $('.section-4 .owl-carousel');
	block4.owlCarousel({
		items: 3,
		nav: false,
        dots: true,
		autoplay: true,
        margin:24,
        responsive:{
            0:{
                dots: false,
                items:1.5
            },
            600:{
                items:3
            },
            1000:{
                items:3
            }
        }
	});
    var block5 = $('.section-review .owl-carousel');
	block5.owlCarousel({
        margin: 24,
        nav: true,
        navText:["<div class='nav-btn prev-slide'><img src='img/detail/icon6.svg' alt='img' /></div>","<div class='nav-btn next-slide'><img src='img/detail/icon7.svg' alt='img' /></div>"],
        dots: false,       
        responsive: {
            1000: {
                items:4.5
            }
        }
	});
    var block6 = $('.section-15 .owl-carousel');
	block6.owlCarousel({
        margin: 24,
        nav: true,
        navText:["<div class='nav-btn prev-slide'><svg width='15' height='49' viewBox='0 0 15 49' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M14 1L1 25L14 48' stroke='#858585'/></svg></div>","<div class='nav-btn next-slide'><svg width='15' height='49' viewBox='0 0 15 49' fill='none' xmlns='http://www.w3.org/2000/svg'> <path d='M1 1L14 25L1 48'stroke='#858585'/> </svg></div>"],
        dots: false,   
        items:1   
	});
    $(window).on('scroll', function () {
        var wtop = $(window).scrollTop();
        if (wtop > 100) {
            $("#top").addClass('active');
            $(".section-14 .buy").addClass('active');
        } else {
            $("#top").removeClass('active');
            $(".section-14 .buy").removeClass('active');
        }
    });
    $("#top").click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
        return false;
    });
    $(".question-item p").click(function(e){
        $(".question-item").removeClass('active')
        $(this).parent().addClass('active')
    })
    $(".list-icon .icon1").click(function(e){
        $(".section-search").addClass('active')
    })
    $(".section-search .close").click(function(e){
        $(".section-search").removeClass('active')
    })
    $(".list-icon .icon2").click(function(e){
        $(".section-cart").addClass('active')
    })
    $(".section-cart .close").click(function(e){
        $(".section-cart").removeClass('active')
    })
    $(".section-14 .buy").click(function(e){
        $('html, body').animate({
            scrollTop: $(".section-15").offset().top
        },  "slow");
    })
    // Thanh toán chưa đăng nhập
    $(".quan-popup .input").click(function(e) {
        $(this).toggleClass("active");
    })
    $(".quan-popup .content2 .item p").click(function(e) {
        var text = $(this).text();
        $(".quan-popup .input").val(text);
        $(".quan-popup .input").removeClass("active");
    })
    $(".phuong-popup .input").click(function(e) {
        $(this).toggleClass("active");
    })
    $(".phuong-popup .content2 .item p").click(function(e) {
        var text = $(this).text();
        $(".phuong-popup .input").val(text);
        $(".phuong-popup .input").removeClass("active");
    })
    $(".tp-popup .input").click(function(e) {
        $(this).toggleClass("active");
    })
    $(".tp-popup .content2 .item p").click(function(e) {
        var text = $(this).text();
        $(".tp-popup .input").val(text);
        $(".tp-popup .input").removeClass("active");
    })
    $(".thongtinxuathoadon .box").click(function(e) {
        $(this).toggleClass("active");
    })
    $(".ghichudonhang .box").click(function(e) {
        $(this).toggleClass("active");
    })
    $(".minius").click(function(e){
        var number = parseInt($(this).parent().find("input").val());
        if(number > 1){
            number  = number - 1;
        }
        $(this).parent().find("input").val(number);
    })
    $(".plus").click(function(e){
        var number = parseInt($(this).parent().find("input").val()) ;
        number  = number + 1;
        $(this).parent().find("input").val(number);
    })
    $(".choose").click(function(e) {
        $(this).parent().toggleClass("active");
    })
    $(".diachinhanhang .boxship2 .style a").click(function(e) {
        $(".bgpopup").show();
        $(".addaddress").show();
    })
    $(".addaddress .close_popup").click(function(e) {
        $(".bgpopup").hide();
        $(".addaddress").hide();
    })
    $(".bgpopup").click(function(e) {
        $(".bgpopup").hide();
        $(".addaddress").hide();
    })
    $(".openmenu").click(function(e){
        $("#header").addClass("active");
        $(".navbar-collapse").addClass("show");
    })
    $(".navbar-collapse .close").click(function(e){
        $("#header").removeClass("active");
        $(".navbar-collapse").removeClass("show");
    })
    $(".thumb li").click(function(e){
        var _data = $(this).find("a").attr("data-src");
        $(".big img").attr("src",_data);
    })
})
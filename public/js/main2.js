$(document).ready(function () {
    $(window).on('scroll', function () {
        var wtop = $(window).scrollTop();
        var x = $(".section-13").position().top;
        if(wtop > x)
        {
            $(".section-14 .buy").removeClass('active');
        }
    });
})
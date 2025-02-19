$(".our-btn").click(function () {
    $(".our-btn").toggleClass("close");
    $(".overlaymnu .our-btn").fadeIn();
    $("body").addClass("overflow-hidden");
    $(".navbar-collapse").css("right", "0");
});
$(".overlaymnu .our-btn").click(function () {
    $("body").removeClass("overflow-hidden");
    $(".navbar-collapse").css("right", "-100%");
    $(".overlaymnu .our-btn").toggle();
});

$(document).ready(function () {
    $("#loader-wrapper").fadeOut(2000);
});
$(function () {
    'use strict';
    $(window).scroll(function () {
        var nav = $('header')
        var nav2 = $('header')
        if ($(window).scrollTop() >= (nav.height() + nav2.height()) + 10) {
            nav.addClass('header-top')
        } else {
            nav.removeClass('header-top')
        }
        if (document.getElementById('wpadminbar')) {
            $(".fixed-top").css({"top": "10px "});
        }
    })
});

$('#slider').owlCarousel({
    loop: false,
    rtl: true,
    margin: 0,
    autoHeight: true,
    nav: true,
    navText: ['<i class="fas fa-arrow-right fa-2x bg-white rounded p-2"></i>', '<i class="fas fa-arrow-left fa-2x bg-white rounded p-2"></i>'],
    dots: false,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    items: 1,
});
$('.archive').owlCarousel({
    loop: false,
    rtl: true,
    margin: 0,
    autoHeight: true,
    nav: true,
    navText: ['<i class="fas fa-arrow-left fa-2x bg-white rounded p-2"></i>', '<i class="fas fa-arrow-right fa-2x bg-white rounded p-2"></i>'],
    dots: false,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    items: 1,
});
$('#events').owlCarousel({
    loop: true,
    ltr: true,
    margin: 30,
    padding:20,
    autoHeight: true,
    nav: false,
    // navText:['<i class="fas fa-angle-left fa-2x text-secondary px-2"></i>','<i class="fas fa-angle-right fa-2x text-secondary px-2"></i>'],
    dots: false,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        380: {
            items: 2
        },
        768: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
});
$('#wanted').owlCarousel({
    loop: true,
    // rtl:true,
    margin: 20,
    autoHeight: true,
    nav: false,
    // navText:['<i class="fas fa-angle-left fa-2x text-secondary px-2"></i>','<i class="fas fa-angle-right fa-2x text-secondary px-2"></i>'],
    dots: false,
    autoplay: true,
    autoplayTimeout: 9000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        360: {
            items: 2
        },
        768: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
});
$('#wanted-2').owlCarousel({
    loop: true,
    // rtl:true,
    margin: 20,
    autoHeight: true,
    nav: false,
    // navText:['<i class="fas fa-angle-left fa-2x text-secondary px-2"></i>','<i class="fas fa-angle-right fa-2x text-secondary px-2"></i>'],
    dots: false,
    autoplay: true,
    autoplayTimeout: 9000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        360: {
            items: 1
        },
        768: {
            items: 2
        },
        1000: {
            items: 2
        }
    }
});

$('#our-partners').owlCarousel({
    loop: false,
    rtl: true,
    smartSpeed: 1000,
    margin: 15,
    nav: false,
    // navText:['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
    dots: true,
    responsive: {
        0: {
            items: 1,
        },
        380: {
            items: 1
        },
        768: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
});
// $(".hover-drop").hover(
//   function () {
//     $(".hover-drop").addClass("show");
//   },
//   function () {
//     $(".hover-drop").removeClass("show");
//   }
// );


AOS.init({disable: 'mobile'});


$("body").on('click', '.image-click', function () {
    $('.larg-image').attr('src', $(this).attr('src'));
    $(function () {
        $(".image-click").click(function () {
            $(".image-click").removeClass("active");
            $(this).addClass("active");
        });
    });
    return false;
})


$(document).ready(function () {
    $('.plus').click(function () {
        $(this).parent().find('.count').val((parseInt($(this).parent().find('.count').val()) + 1))
    });
});

$(document).ready(function () {
    $('.minus').click(function () {
        if (parseInt($(this).parent().find('.count').val()) > 0) {
            $(this).parent().find('.count').val((parseInt($(this).parent().find('.count').val()) - 1))
        }
    });
});

$(".favorite").click(
    function () {
        $(this).addClass("fas");
    });

$('.input-o').click(function () {
    $('.input-o').removeClass('input-hover');
    $(this).addClass('input-hover');
});

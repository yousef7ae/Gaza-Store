    $(document).ready(function(){
        $("#loader").fadeOut(1000);
    });

        $(".our-btn").click(function(){
		$(".our-btn").toggleClass("close");
		    $(".overlaymnu .our-btn").fadeIn();
            $("body").addClass("overflow-hidden");
            $(".navbar-collapse").css("right", "0");
	});
    $(".overlaymnu .our-btn").click(function(){
            $("body").removeClass("overflow-hidden");
            $(".navbar-collapse").css("right", "-100%");
            $(".overlaymnu .our-btn").toggle();
        });

    function aos_init() {
    AOS.init({
      duration: 1000,
      easing: "ease-in-out",
      once: true,
      mirror: false,
      disable: 'mobile'
    });
  }
  window.addEventListener('load', () => {
    aos_init();
  });

    $(function () {
        'use strict';
        $(window).scroll(function () {
            var nav = $('header')
            var nav2 = $('header')
            if ($(window).scrollTop() >= (nav.height() + nav2.height()) - 300) {
                nav.addClass('header-top')
            } else {
                nav.removeClass('header-top')
            }
        })
    })

    $('.single-item').slick({
        dots: true,
        rtl: true,
        infinite: true,
        //autoplay: true,
        //autoplaySpeed: 9000,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    $('.product').slick({
        nextArrow: '<span class="slick-o slick-next-o"><i class="fa-solid fa-chevron-right"></i></span>',
        prevArrow: '<span class="slick-o slick-prev-o"><i class="fa-solid fa-chevron-left"></i></span>',
        dots: false,
        rtl: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    // infinite: true,
                    // dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }
        ]
    });

    $('.clients').slick({
        nextArrow: '<span class="slick-next"><i class="fa-solid fa-chevron-right text-dark"></i></span>',
        prevArrow: '<span class="slick-prev"><i class="fa-solid fa-chevron-left text-dark"></i></span>',
        dots: false,
        rtl: true,
        infinite: false,
        speed: 300,
        slidesToShow: 7,
        slidesToScroll: 7,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    // infinite: true,
                    // dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    dots: true,
                    nextArrow: '<span class="slick-next d-none"></span>',
                    prevArrow: '<span class="slick-prev d-none"></span>',
                }

            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            }
        ]
    });


    $('.slider-for').slick({
        nextArrow: '<span class="slider-next"><i class="fa-solid fa-chevron-left"></i></span>',
        prevArrow: '<span class="slider-prev"><i class="fa-solid fa-chevron-right"></i></span>',
        dots: false,
        rtl: true,
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 3,
    });
        $("body").on('click','.image-click',function(){
            $('.larg-image').attr('src', $(this).attr('src') );
            $(function() {
              $(".image-click").click(function() {
                $(".image-click").removeClass("active");
                $(this).addClass("active");
              });
            });
            return false;
        })


            $(document).ready(function () {
          $('.plus').click(function () {
            $(this).parent().find('.count').val(( parseInt( $(this).parent().find('.count').val() )+1))
          });
        });

         $(document).ready(function () {
          $('.minus').click(function () {
              if(parseInt( $(this).parent().find('.count').val()) > 0) {
                  $(this).parent().find('.count').val((parseInt($(this).parent().find('.count').val()) - 1))
              }
          });
        });

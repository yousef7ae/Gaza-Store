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

$(document).ready(function(){
    $("#loader-wrapper").fadeOut(2000);
});
    $(function () {
      'use strict';
      $(window).scroll(function () {
          var nav = $('header')
          var nav2 = $('header')
          if ($(window).scrollTop() >= ( nav.height() + nav2.height() )+10 ) {
              nav.addClass('header-top')
          }else{
              nav.removeClass('header-top')
          }
          if (document.getElementById('wpadminbar')) {
            $(".fixed-top").css({"top": "10px "});
          }
      })
  });


  /**
   * Easy on scroll event listener
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  $(".loade").fadeOut("slow");

    $('#slider').owlCarousel({
        loop: false,
        rtl:true,
        animateOut: 'fadeOut',
        margin: 0,
        autoHeight:true,
        nav: true,
        navText:['<i class="fas fa-arrow-left fa-2x text-white shadow rounded-0 p-2"></i>','<i class="fas fa-arrow-right fa-2x text-white shadow rounded-0 p-2"></i>'],
        dots: true,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        items: 1,
    });

$('.product').owlCarousel({
    loop: true,
    rtl:true,
    margin: 15,
    autoHeight:true,
    nav: true,
    navText:['<i class="fas fa-arrow-left fs-20p text-white rounded p-2"></i>','<i class="fas fa-arrow-right fs-20p text-white rounded p-2"></i>'],
    dots: false,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    responsive:{
                0:{
                    items:2
                },
                380:{
                    items:2
                },
                768:{
                    items:3
                },
                1000:{
                    items:3
                },
                1016:{
                    items:3
                },
                1272:{
                    items:4
                },
                1500:{
                    items:5
                }
            }
    });

    $('.modal-product').owlCarousel({
        loop: true,
        rtl:true,
        margin: 15,
        autoHeight:true,
        nav: false,
        // navText:['<i class="fas fa-angle-left fa-2x text-secondary px-2"></i>','<i class="fas fa-angle-right fa-2x text-secondary px-2"></i>'],
        dots: true,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        items: 1,
     });


$('#partners').owlCarousel({
    loop: true,
    rtl:true,
    margin: 15,
    autoHeight:true,
    nav: true,
    navText:['<i class="fas fa-arrow-left fs-20p text-white rounded p-2"></i>','<i class="fas fa-arrow-right fs-20p text-white rounded p-2"></i>'],
    dots: false,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    responsive:{
                0:{
                    items:2
                },
                380:{
                    items:2
                },
                768:{
                    items:3
                },
                1000:{
                    items:4
                },
                1016:{
                    items:4
                },
                1272:{
                    items:5
                },
                1500:{
                    items:6
                }
            }
    });

$('#site-ratings').owlCarousel({
    loop: true,
    rtl:true,
    margin: 15,
    autoHeight:true,
    nav: true,
    navText:['<i class="fas fa-arrow-left fs-20p text-white rounded p-2"></i>','<i class="fas fa-arrow-right fs-20p text-white rounded p-2"></i>'],
    dots: false,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    responsive:{
                0:{
                    items:1
                },
                380:{
                    items:1
                },
                768:{
                    items:2
                },
                1000:{
                    items:2
                },
                1016:{
                    items:3
                },
                1272:{
                    items:3
                },
                1500:{
                    items:4
                }
            }
    });

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

         $('.input-o').click(function () {
            $(this).parent().parent().find('.input-o').removeClass('input-hover');
            $(this).addClass('input-hover');
          });
  // end osama


(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }


  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Header fixed top on scroll
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    let headerOffset = selectHeader.offsetTop
    let nextElement = selectHeader.nextElementSibling
    const headerFixed = () => {
      if ((headerOffset - window.scrollY) <= 0) {
        selectHeader.classList.add('fixed-top')
        nextElement.classList.add('scrolled-offset')
      } else {
        selectHeader.classList.remove('fixed-top')
        nextElement.classList.remove('scrolled-offset')
      }
    }
    window.addEventListener('load', headerFixed)
    onscroll(document, headerFixed)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }


  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)

  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });

  /**
  //  * Initiate glightbox
  //  */
  // const glightbox = GLightbox({
  //   selector: '.glightbox'
  // });

  /**
   * Clients Slider
   */
  // new Swiper('.slider', {
  //   speed: 400,
  //   loop: true,
  //   autoplay: {
  //     delay: 5000,
  //     disableOnInteraction: false
  //   },
  //   slidesPerView: 'auto',
  //   pagination: {
  //     el: '.swiper-pagination',
  //     type: 'bullets',
  //     clickable: true
  //   },
  //   breakpoints: {
  //     320: {
  //       slidesPerView: 1,
  //       spaceBetween: 40
  //     },
  //     480: {
  //       slidesPerView: 1,
  //       spaceBetween: 60
  //     },
  //     640: {
  //       slidesPerView: 1,
  //       spaceBetween: 80
  //     },
  //     992: {
  //       slidesPerView: 1,
  //       spaceBetween: 120
  //     }
  //   }
  // });


  /**
   * Initiate portfolio lightbox
   */
  // const portfolioLightbox = GLightbox({
  //   selector: '.portfolio-lightbox'
  // });


  /**
   * Animation on scroll
   */
  window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false,
      disable: 'mobile',
    })
  });

})()

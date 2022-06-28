(function ($) {
    "use strict";

    //* Navbar Fixed
    var nav_offset_top = $('header').height() + 50;
    /*-------------------------------------------------------------------------------
      Navbar 
    -------------------------------------------------------------------------------*/
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll < 400) {
            $("#sticky-header").removeClass("navbar_fixed");
            $('#back-top').fadeOut(500);
        } else {
            $("#sticky-header").addClass("navbar_fixed");
            $('#back-top').fadeIn(500);
        }
    });



    // MENU ACTIVE 
    jQuery(function ($) {
        var path = window.location.href;
        $('.main_menu a').each(function () {
            if (this.href === path) {
                $(this).parents(".submenu").closest('li').addClass('submenu_active');
                $(this).addClass('active');
            }
        });
    });




    // back to top 
    $('#back-top a').on("click", function () {
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
        return false;
    });

    // wow js
    // new WOW().init();


    // nice select 
    /* 
    var select = $('.primary_select');

    if ('select.length') {
        select.niceSelect();
    }
    */

    // BARFILLER 
    $(document).ready(function () {
        var proBar = $('#bar1');
        if (proBar.length) {
            proBar.barfiller({ barColor: '#ffd500', duration: 2000 });
        }
        var proBar = $('#bar2');
        if (proBar.length) {
            proBar.barfiller({ barColor: '#ffd500', duration: 2100 });
        }
        var proBar = $('#bar3');
        if (proBar.length) {
            proBar.barfiller({ barColor: '#ffd500', duration: 2200 });
        }

    });


    // #######################
    //  service_slide
    // #######################
    // $('.banner_carousel').owlCarousel({
    //     loop: true,
    //     margin: 0,
    //     items: 1,
    //     autoplay: true,
    //     navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    //     nav: true,
    //     dots: true,
    //     autoplayHoverPause: true,
    //     autoplaySpeed: 1000,
    //     responsive: {
    //         0: {
    //             items: 1
    //         },
    //         767: {
    //             items: 1
    //         },
    //         992: {
    //             items: 1
    //         },
    //         1200: {
    //             items: 1
    //         }
    //     }
    // });
    $('.movie_lists_carousel').owlCarousel({
        loop: false,
        margin: 20,
        items: 1,
        autoWidth:true,
        autoplay: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        nav: true,
        dots: false,
        autoplayHoverPause: true,
        autoplaySpeed: 900,
        responsive: {
            0: {
                items: 1
            },
            767: {
                items: 5
            },
            992: {
                items: 5
            },

            1200: {
                items: 6
            }
        }
    });
    $('.profile_carousel').owlCarousel({
        loop: false,
        margin: 20,
        height: 320,
        items: 1,
        // autoplay: true,
        autoWidth:true,
    });
    $('.videos_carousel').owlCarousel({
        loop: false,
        margin: 0,
        items: 1,
        autoplay: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        nav: true,
        dots: false,
        autoplayHoverPause: true,
        autoplaySpeed: 900,
        responsive: {
            0: {
                items: 1
            },
            767: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 5
            }
        }
    });

    /*
    // magnificPopup img view
    $('.popup-image').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    // magnificPopup video view
    $('.popup-video').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
    */


    // $('.slider-for').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     arrows: false,
    //     fade: true,
    //     asNavFor: '.slider-nav'
    // });
    // $('.slider-nav').slick({
    //     slidesToShow: 6,
    //     slidesToScroll: 1,
    //     asNavFor: '.slider-for',
    //     dots: false,
    //     centerMode: false,
    //     focusOnSelect: true,

    //     nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
    //     prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
    //     centerPadding: '0px',
    //     focusOnSelect: true
    // });


    // for filter
    /*
    // init Isotope
    var $grid = $('.grid').isotope({
        itemSelector: '.grid-item',
        percentPosition: true,
        masonry: {
            // use outer width of grid-sizer for columnWidth
            columnWidth: 1
        }
    });

    // filter items on button click
    $('.portfolio-menu').on('click', 'button', function () {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
    });
    */

    //for menu active class
    $('.portfolio-menu button').on('click', function (event) {
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();
    });


    /*=============================================== 
          Parallax business_image
    ================================================*/
    if ($('.man_img').length > 0) {
        $('.man_img').parallax({
            scalarX: 7.0,
            scalarY: 7.0,
        });
    }

    if ($('#mc_embed_signup').length > 0) {
        $('#mc_embed_signup').find('form').ajaxChimp();
    }

})
    (jQuery);
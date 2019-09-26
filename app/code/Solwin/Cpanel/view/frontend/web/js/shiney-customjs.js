require(['jquery', 'cpowlcarousel'], function ($) {
    $(document).ready(function () {
        $(".blog-home-slider").owlCarousel({
            items: 3,
            itemsDesktop: [1080, 3],
            itemsDesktopSmall: [860, 2],
            itemsTablet: [768, 2],
            itemsTabletSmall: [639, 1],
            itemsMobile: [360, 1],
            pagination: false,
            navigationText: ["<div class='lft-btn'><i class='fa fa-angle-left'></i></div>", "<div class='rgt-btn'><i class='fa fa-angle-right'></div>"],
            navigation: true,
        });

        $(".brh-inner-main").owlCarousel({
            items: 5,
            itemsDesktop: [1080, 4],
            itemsDesktopSmall: [860, 3],
            itemsTablet: [768, 3],
            itemsTabletSmall: [639, 3],
            itemsMobile: [360, 2],
            pagination: false,
            navigationText: ['<div class="lft-btn"><i class="fa fa-angle-left"></i></div>', '<div class="rgt-btn"><i class="fa fa-angle-right"></div>'],
            navigation: false,
            autoPlay: true,
        });

        $(".bg-side-inner-main").owlCarousel({
            items: 1,
            itemsDesktop: [1080, 1],
            itemsDesktopSmall: [860, 1],
            itemsTablet: [768, 1],
            itemsTabletSmall: [639, 1],
            itemsMobile: [360, 1],
            pagination: false,
            navigationText: ["<div class='lft-btn'><i class='fa fa-angle-left'></i></div>", "<div class='rgt-btn'><i class='fa fa-angle-right'></div>"],
            navigation: true,
        });

        $(".br-side-inner-main").owlCarousel({
            items: 1,
            itemsDesktop: [1199, 1],
            itemsDesktopSmall: [979, 1],
            itemsTablet: [767, 2],
            itemsTabletSmall: [640, 2],
            itemsMobile: [500, 1],
            pagination: false,
            navigationText: ['<div class="lft-btn"><i class="fa fa-angle-left"></i></div>', '<div class="rgt-btn"><i class="fa fa-angle-right"></div>'],
            navigation: true,
        });
    });
});

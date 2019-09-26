define(['jquery'], function () {
    (function ($) {
        var SolMegaMenu = function (target, settings) {
            var MENU = $(target);
            $(".navigation.sol-megamenu li.classic .submenu, .navigation.sol-megamenu li.staticwidth .submenu, .navigation.sol-megamenu li.classic .subchildmenu .subchildmenu").each(function () {
                $(this).css("left", "-9999px");
                $(this).css("right", "auto");
            });
            MENU.find("li.classic .subchildmenu > li.parent").mouseover(function () {
                var PARENT = $(this);
                var popup = PARENT.children("ul.subchildmenu");
                var w_width = $(window).innerWidth();

                if (popup) {
                    var pos = PARENT.offset();
                    var c_width = $(popup).outerWidth();
                    if (w_width <= pos.left + PARENT.outerWidth() + c_width) {
                        $(popup).css("left", "auto");
                        $(popup).css("right", "100%");
                    } else {
                        $(popup).css("left", "100%");
                        $(popup).css("right", "auto");
                    }
                }
            });
            MENU.find("li.staticwidth.parent,li.classic.parent").mouseover(function () {
                var PARENT = $(this);
                var popup = PARENT.children(".submenu");
                var w_width = $(window).innerWidth();

                if (popup) {
                    var pos = PARENT.offset();
                    var c_width = $(popup).outerWidth();
                    if (w_width <= pos.left + PARENT.outerWidth() + c_width) {
                        $(popup).css("left", "auto");
                        $(popup).css("right", "0");
                    } else {
                        $(popup).css("left", "0");
                        $(popup).css("right", "auto");
                    }
                }
            });
            $(window).resize(function () {
                $(".navigation.sol-megamenu li.classic .submenu, .navigation.sol-megamenu li.staticwidth .submenu, .navigation.sol-megamenu li.classic .subchildmenu .subchildmenu").each(function () {
                    $(this).css("left", "-9999px");
                    $(this).css("right", "auto");
                });
            });
            $(".nav-toggle").click(function (e) {
                if (!$("html").hasClass("nav-open")) {
                    $("html").addClass("nav-before-open");
                    setTimeout(function () {
                        $("html").addClass("nav-open");
                    }, 300);
                }
                else {
                    $("html").removeClass("nav-open");
                    setTimeout(function () {
                        $("html").removeClass("nav-before-open");
                    }, 300);
                }
            });
            $("li.ui-menu-item > .open-children-toggle").click(function () {
                if (!$(this).parent().children(".submenu").hasClass("opened")) {
                    $(this).parent().children(".submenu").addClass("opened");
                    $(this).parent().children("a").addClass("ui-state-active");
                }
                else {
                    $(this).parent().children(".submenu").removeClass("opened");
                    $(this).parent().children("a").removeClass("ui-state-active");
                }
            });
            
            
            $("li.ui-menu-item > a").hover(function () {
                $(this).addClass('ui-state-focus');
            }, function () {
                $(this).removeClass('ui-state-focus');
            });
            
            $(".submenu").hover(function () {
                $(this).parent().children('a').addClass('ui-state-active');
            }, function () {
                $(this).parent().children('a').removeClass('ui-state-active');
            });
            
            $(".subchildmenu").hover(function () {
                $(this).parent().children('a').addClass('ui-state-active');
            }, function () {
                $(this).parent().children('a').removeClass('ui-state-active');
            });
        };


        $.fn.solMegamenu = function (options) {
            var settings = $.extend({
                sticky: true,
            }, options);

            return this.each(function () {
                new SolMegaMenu(this, settings);
            });
        };
    })(jQuery);
});
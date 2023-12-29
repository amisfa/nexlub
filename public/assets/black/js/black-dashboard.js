var transparent = true;
var sidebar_mini_active = false;
var $html = $('html');
var $body = $('body');
var $navbar = $('.navbar');
var $datepicker = $('.datepicker');

/*!

 =========================================================
 * Black Dashboard - v1.0.0
 =========================================================

 * Product Page: https://www.creative-tim.com/product/black-dashboard
 * Copyright 2018 Creative Tim (http://www.creative-tim.com) & UPDIVISION (https://updivision.com)

 * Coded by www.creative-tim.com

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 */

$(document).ready(function () {
    if ($('.full-screen-map').length == 0 && $('.bd-docs').length == 0) {
        // On click navbar-collapse the menu will be white not transparent
        $('.collapse').on('show.bs.collapse', function () {
            $(this).closest('.navbar').removeClass('navbar-transparent').addClass('bg-white');
        }).on('hide.bs.collapse', function () {
            $(this).closest('.navbar').addClass('navbar-transparent').removeClass('bg-white');
        });
    }
    blackDashboard.initMinimizeSidebar();
    $('.form-control').on("focus", function () {
        $(this).parent('.input-group').addClass("input-group-focus");
    }).on("blur", function () {
        $(this).parent(".input-group").removeClass("input-group-focus");
    });
});

$(document).on('click', '.navbar-toggle', function () {
    var $toggle = $(this);
    if (blackDashboard.misc.navbar_menu_visible == 1) {
        $html.removeClass('nav-open');
        blackDashboard.misc.navbar_menu_visible = 0;
        setTimeout(function () {
            $toggle.removeClass('toggled');
            $('.bodyClick').remove();
        }, 550);
    } else {
        setTimeout(function () {
            $toggle.addClass('toggled');
        }, 580);
        var div = '<div class="bodyClick"></div>';
        $(div).appendTo('body').click(function () {
            $html.removeClass('nav-open');
            blackDashboard.misc.navbar_menu_visible = 0;
            setTimeout(function () {
                $toggle.removeClass('toggled');
                $('.bodyClick').remove();
            }, 550);
        });
        $html.addClass('nav-open');
        blackDashboard.misc.navbar_menu_visible = 1;
    }
});


blackDashboard = {
    misc: {
        navbar_menu_visible: 0
    },
    initMinimizeSidebar: function () {
        if ($('.sidebar-mini').length != 0) {
            sidebar_mini_active = true;
        }
        $('#minimizeSidebar').click(function () {
            var $btn = $(this);

            if (sidebar_mini_active == true) {
                $('body').removeClass('sidebar-mini');
                sidebar_mini_active = false;
                blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
            } else {
                $('body').addClass('sidebar-mini');
                sidebar_mini_active = true;
                blackDashboard.showSidebarMessage('Sidebar mini activated...');
            }

            // we simulate the window Resize so the charts will get updated in realtime.
            var simulateWindowResize = setInterval(function () {
                window.dispatchEvent(new Event('resize'));
            }, 180);

            // we stop the simulation of Window Resize after the animations are completed
            setTimeout(function () {
                clearInterval(simulateWindowResize);
            }, 1000);
        });
    },
    showSidebarMessage: function (message) {
        try {
            $.notify({
                icon: "tim-icons ui-1_bell-53",
                message: message
            }, {
                type: 'info',
                timer: 4000,
                placement: {
                    from: 'top',
                    align: 'right'
                }
            });
        } catch (e) {
            console.log('Notify library is missing, please make sure you have the notifications library added.');
        }
    }
};

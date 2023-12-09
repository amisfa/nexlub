<!DOCTYPE html>
<html lang="en">
<head>

    <!--begin::Base Path (base relative path for assets of this page) -->

    <!--end::Base Path -->
    <meta charset="utf-8"/>
    <title>Metronic | Dashboard</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Asap+Condensed:500"]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Fonts -->

    <!--end::Page Vendors Styles -->

    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <link href="{{ asset('/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
          type="text/css"/>

    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('/dashboard/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>

</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-page--fluid kt-page-content-white kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="demo11/index.html">
            <img alt="Logo" src="./assets/media/logos/logo-11-sm.png"/>
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left"
                id="kt_aside_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                class="flaticon-more-1"></i></button>
    </div>
</div>

<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <!-- begin:: Header -->
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on">
                <div class="kt-container">

                    <!-- begin:: Brand -->
                    <div class="kt-header__brand " id="kt_header_brand">
                        <div class="kt-header__brand-logo">
                            <a href="demo11/index.html">
                                <img alt="Logo" src="./assets/media/logos/logo-11.png"/>
                            </a>
                        </div>
                    </div>

                    <!-- end:: Brand -->

                    <!-- begin:: Header Topbar -->
                    <div class="kt-header__topbar">
                        <!--begin: Notifications -->
                        <div class="kt-header__topbar-item dropdown">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                <span class="kt-header__topbar-icon"><i class="flaticon2-bell-alarm-symbol"></i></span>
                                <span class="kt-hidden kt-badge kt-badge--danger"></span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                <form>

                                    <!--begin: Head -->
                                    <div class="kt-head kt-head--skin-light kt-head--fit-x kt-head--fit-b">
                                        <h3 class="kt-head__title">
                                            User Notifications
                                            &nbsp;
                                            <span class="btn btn-label-primary btn-sm btn-bold btn-font-md">23 new</span>
                                        </h3>
                                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x"
                                            role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active show" data-toggle="tab"
                                                   href="#topbar_notifications_notifications" role="tab"
                                                   aria-selected="true">Alerts</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab"
                                                   href="#topbar_notifications_events" role="tab" aria-selected="false">Events</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs"
                                                   role="tab" aria-selected="false">Logs</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!--end: Head -->
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="topbar_notifications_notifications"
                                             role="tabpanel">
                                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll"
                                                 data-scroll="true" data-height="300" data-mobile-height="200">
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-line-chart kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New order has been received
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            2 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-box-1 kt-font-brand"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New customer is registered
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            3 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-chart2 kt-font-danger"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            Application has been approved
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            3 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-image-file kt-font-warning"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New file has been uploaded
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            5 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-bar-chart kt-font-info"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New user feedback received
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            8 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-pie-chart-2 kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            System reboot has been successfully completed
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            12 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-favourite kt-font-danger"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New order has been placed
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            15 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item kt-notification__item--read">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-safe kt-font-primary"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            Company meeting canceled
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            19 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-psd kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New report has been received
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            23 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon-download-1 kt-font-danger"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            Finance report has been generated
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            25 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon-security kt-font-warning"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New customer comment recieved
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            2 days ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-pie-chart kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New customer is registered
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            3 days ago
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
                                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll"
                                                 data-scroll="true" data-height="300" data-mobile-height="200">
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-psd kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New report has been received
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            23 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon-download-1 kt-font-danger"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            Finance report has been generated
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            25 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-line-chart kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New order has been received
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            2 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-box-1 kt-font-brand"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New customer is registered
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            3 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-chart2 kt-font-danger"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            Application has been approved
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            3 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-image-file kt-font-warning"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New file has been uploaded
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            5 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-bar-chart kt-font-info"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New user feedback received
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            8 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-pie-chart-2 kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            System reboot has been successfully completed
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            12 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-favourite kt-font-brand"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New order has been placed
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            15 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item kt-notification__item--read">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-safe kt-font-primary"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            Company meeting canceled
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            19 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-psd kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New report has been received
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            23 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon-download-1 kt-font-danger"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            Finance report has been generated
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            25 hrs ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon-security kt-font-warning"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New customer comment recieved
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            2 days ago
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-pie-chart kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title">
                                                            New customer is registered
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            3 days ago
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                                            <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                                                <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                                    <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                                        All caught up!
                                                        <br>No new notifications.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!--end: Notifications -->

                        <!--begin: User bar -->
                        <div class="kt-header__topbar-item kt-header__topbar-item--user">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                <span class="kt-header__topbar-welcome kt-visible-desktop">Hi,</span>
                                <span class="kt-header__topbar-username kt-visible-desktop">Nick</span>
                                <img alt="Pic" src="./assets/media/users/300_21.jpg"/>
                                <span class="kt-header__topbar-icon kt-bg-brand kt-hidden"><b>S</b></span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                <!--begin: Head -->
                                <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                                    <div class="kt-user-card__avatar">
                                        <img class="kt-hidden-" alt="Pic" src="./assets/media/users/300_25.jpg"/>

                                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                        <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
                                    </div>
                                    <div class="kt-user-card__name">
                                        Sean Stone
                                    </div>
                                    <div class="kt-user-card__badge">
                                        <span class="btn btn-label-primary btn-sm btn-bold btn-font-md">23 messages</span>
                                    </div>
                                </div>

                                <!--end: Head -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end:: Header -->
            <div class="kt-container kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch"
                 id="kt_body">

                <!-- begin:: Aside -->
                <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
                <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop"
                     id="kt_aside">

                    <!-- begin:: Aside Menu -->
                    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
                            <ul class="kt-menu__nav ">
                                <li class="kt-menu__section kt-menu__section--first">
                                    <h4 class="kt-menu__section-text">Departments</h4>
                                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                                </li>
                                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                                          class="kt-menu__link kt-menu__toggle"><i
                                            class="kt-menu__link-icon flaticon-layers"></i><span class="kt-menu__link-text">Games</span><i
                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                    class="kt-menu__link"><span
                                                        class="kt-menu__link-text">Resources</span></span></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="#"
                                                                                               class="kt-menu__link "><i
                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">Poker</span></a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- end:: Aside Menu -->
                </div>

                <!-- end:: Aside -->
                <div class="kt-holder kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

                    <!-- begin:: Subheader -->
                    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                        <div class="kt-subheader__main">
                            <h3 class="kt-subheader__title">
                                Dashboard </h3>
                            <span class="kt-subheader__separator kt-hidden"></span>
                            <div class="kt-subheader__breadcrumbs">
                                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                                <span class="kt-subheader__breadcrumbs-separator"></span>
                                <a href="" class="kt-subheader__breadcrumbs-link">
                                    Application </a>
                            </div>
                        </div>
                    </div>

                    <!-- begin::Global Config(global config for global JS sciprts) -->
                    <script>
                        var KTAppOptions = {
                            "colors": {
                                "state": {
                                    "brand": "#5d78ff",
                                    "light": "#ffffff",
                                    "dark": "#282a3c",
                                    "primary": "#5867dd",
                                    "success": "#34bfa3",
                                    "info": "#36a3f7",
                                    "warning": "#ffb822",
                                    "danger": "#fd3995"
                                },
                                "base": {
                                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                                }
                            }
                        };
                    </script>
                    <script src="{{ asset('/jquery/dist/jquery.js') }}" type="text/javascript"></script>
                    <script src="{{ asset('/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>
                    <script src="{{ asset('/bootstrap/dist/js/bootstrap.min.js') }}"
                            type="text/javascript"></script>
                    <script src="{{ asset('/dashboard/js/scripts.bundle.js') }}" type="text/javascript"></script>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<div>
    <div class="modern-menu-wrapper">
        <div class="modern-menu-icon-wrapper">
            <div class="toggle">
                <span class="line-toggle"></span>
                <span class="line-toggle"></span>
                <span class="line-toggle"></span>
            </div>
        </div>
        <ul class="modern-menu">
            <li @if ($pageSlug == 'dashboard') class="active"@endif>
                <a href="{{route('dashboard')}}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li @if ($pageSlug == 'invoices' || $pageSlug == 'payments') class="active" @endif>
                <a>
                    <i class="fab fa-css3-alt"></i> Deposit
                    <span class='cavet'><i class="fas fa-caret-right"></i></span>
                </a>
                <ul>
                    <li @if ($pageSlug == 'invoices') class="active " @endif><a href="{{route('invoices')}}"><i
                                class="fas fa-mobile"></i> Create Invoice</a></li>
                    <li @if ($pageSlug == 'payments') class="active " @endif><a href="{{route('payments')}}"><i
                                class="fas fa-glasses"></i> Payments</a></li>
                </ul>
            </li>
            <li @if ($pageSlug == 'subset') class="active"@endif>
                <a href="{{route('subset')}}">
                    <i class="fas fa-tachometer-alt"></i> Subset
                </a>
            </li>
        </ul>
    </div>
</div>
@push('js')
    <script>
        $(".modern-menu li").unbind("click").click(function (event) {
            event.stopPropagation(); //stop trigger parent
            var el = $(this).parents("li").siblings();
            el = el.length == 0 ? $(this).siblings() : el;
            el.find(".active").addBack().removeClass("active");

            if ($(this).hasClass("active")) {
                $(this).find(".active").addBack().removeClass("active");
            } else {
                $(this).addClass("active");
            }
        });
        var responsive = function () {
            var s = 500;
            $(window).resize(function () {
                windowSize(s);
            });
            windowSize(s);
        }
        var windowSize = function (s) {
            var w = $(window).width();
            if (w <= s) {
                $(".toggle").removeClass("active");
                $(".modern-menu-wrapper").addClass("hide").removeClass("show");
            } else {
                $(".toggle").addClass("active");
                $(".modern-menu-wrapper").addClass("show").removeClass("hide");
            }
        }
        responsive();
        $(".modern-menu-icon-wrapper").unbind("click").click(function (e) {
            e.preventDefault();
            $('.toggle').toggleClass("active");
            if ($(".toggle").hasClass("active")) {
                $(".modern-menu-wrapper").addClass("show").removeClass("hide");
            } else {
                $(".modern-menu-wrapper").addClass("hide").removeClass("show");
            }
        });
    </script>
@endpush


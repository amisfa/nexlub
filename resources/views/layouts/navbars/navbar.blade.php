@auth()
    @include('layouts.navbars.navs.auth')
@endauth

@guest()
{{--    @include('layouts.navbars.navs.guest')--}}
@include('layouts.navbars.navs.auth')
@endguest

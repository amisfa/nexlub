<!DOCTYPE html>
<html lang="en">
{{--@include('../partials/head')--}}
@yield('head', view('../partials.head'))
<body>
<section><span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span>
    <div class="signin">
        <div class="content">
            <h2>Register</h2>
            <form class="form" action="{{ route('register-form') }}" method="post"
                  onsubmit="return registerValidation();">
                @csrf
                <div class="inputBox">
                    <input type="text" name="email" value="{{old('email')}}" required> <i>Email</i>
                </div>
                <div class="inputBox">
                    <input type="text" name="username" value="{{old('username')}}" required> <i>Username</i>
                </div>
                <div class="inputBox">
                    <input id="password" type="password" name="password" required> <i>Password</i>
                </div>
                <div class="inputBox">
                    <input id="password_confirmation" type="password" name="password_confirmation" required> <i>Confirm
                        Password</i>
                </div>
                <div class="inputBox">
                    <input type="text" name="wallet_no" value="{{old('wallet_no')}}" required> <i>Wallet No.</i>
                </div>
                <div class="links"><a href="{{route('forgot-pass')}}">Forgot Password</a> <a href="{{route('login')}}">Sign
                        in</a>
                </div>
                @if(config('services.recaptcha.key'))
                    <div class="captcha-container">
                        <div class="g-recaptcha" data-theme="dark"
                             data-sitekey="{{config('services.recaptcha.key')}}">
                        </div>
                    </div>
                @endif
                <div class="inputBox">
                    <input type="submit" value="Create your account">
                </div>
                <br/>
                @if(count($errors->all()))
                    @foreach($errors->all() as $error)
                        <div class="notification-container">
                            <div class="notification-rectangle">
                                <div class="notification-text">
                                    <li>{{$error}}</li>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </form>
        </div>
    </div>
</section>
</body>
</div>
<script>
    function registerValidation() {
        let e = document.querySelector("#password").value, r = document.querySelector("#password_confirmation").value;
        return !(e.length < 8) && !(r.length < 8) || (alert("Your password must be at least 8 characters long"), !1)
    }
</script>
</body>
</html>

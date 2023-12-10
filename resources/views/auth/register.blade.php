<!DOCTYPE html>
<html lang="en">
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
                    <input type="text" name="wallet_no" value="{{old('wallet_no')}}" required> <i>Wallet(0xabc123...)</i>
                </div>
                <div class="links"><a href="#">Forgot Password</a> <a href="{{route('login')}}">Sign
                        in</a>
                </div>
                <div style="overflow-x: scroll;border: solid 2px;" class="beauty-scroll">
                    <div style="width:100%;display: flex;position: relative">
                        @php
                            for ($i = 0; $i < 64; $i++)
                            {
                              $a = "display: inline-block; width: " . 64 . "px; height: " . 64 . "px; background: " .
                                   "url('" . env('mavens_url') . "/Image?Name=Avatars') no-repeat -" . ($i * 64) . "px 0px;";
                              $s = "<div><input type='radio' name='avatar' value='" . ($i + 1) . "'";
                              if ($i == 0) $s .= " checked";
                              $s .= " required>";
                              $s .= "<div style=\"" . $a . "\"></div></div>";
                              echo $s;
                            }
                        @endphp
                    </div>
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
    //horizontal avatar scroll
    const element=document.querySelector(".beauty-scroll");element.addEventListener("wheel",e=>{e.preventDefault(),element.scrollBy({left:e.deltaY<0?-30:30})});
</script>
</body>
</html>

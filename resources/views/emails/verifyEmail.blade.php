@component('mail::message')
<a style="width: 100%;margin:auto;display: ruby-text;" href="{{route('home-page')}}">
<img width="100px" src="{{env('APP_URL') . asset('black').'/img/logo-circle.png'}}"/>
</a>

Dear {{ $user->username }},

Please verify your email by clicking on the button below:

@component('mail::button', ['url' => env('URL_FRONT').'auth/email-validation?user_id='.$user->id.'&token='.$token])
Verify
@endcomponent

Thanks,
{{ env('APP_NAME') }}
@endcomponent

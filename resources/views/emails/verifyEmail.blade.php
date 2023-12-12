@component('mail::message')
Dear {{ $user->username }},

Please verify your email with bellow link:

@component('mail::button', ['url' => env('URL_FRONT').'auth/email-validation?user_id='.$user->id.'&token='.$token])
Validation
@endcomponent

Thanks,
{{ env('APP_NAME') }}
@endcomponent

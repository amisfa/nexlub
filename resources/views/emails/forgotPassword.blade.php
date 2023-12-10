@component('mail::message')
    # Dear {{ $user->username }},

    Someone, hopefully you, has requested to reset the password for your account.
    If you did not perform this request, you can safely ignore this email.

    Otherwise, click the link below to complete the process.

    @component('mail::button', ['url' => env('URL_FRONT').'auth/reset-password?email='.$user->email.'&token='.$token])
        Reset Password
    @endcomponent

    Thanks,
    {{ env('APP_NAME') }}
@endcomponent

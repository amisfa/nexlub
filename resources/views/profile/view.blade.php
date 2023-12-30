@extends('layouts.app', ['page' => __('Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-8">
                    <livewire:user-profile-view :model="auth()->id()"/>
                    @if(!auth()->user()->email_verified_at)
                        <div class="card-footer" style="margin-left: auto">
                            <button class="btn btn-fill btn-success resend-email" onclick="enableButton()"
                                    disabled>{{ __('Resend Email') }}</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (!document.querySelector('.card-footer')) {
                if (localStorage.hasOwnProperty('resend-email-timer')) localStorage.removeItem('resend-email-timer');
                return
            }
            if (localStorage.hasOwnProperty('resend-email-timer')) enableButton(localStorage.getItem('resend-email-timer'))
            else document.querySelector('.resend-email').removeAttribute('disabled');
        });

        function humanDiff(t1, t2) {
            const diff = Math.max(t1, t2) - Math.min(t1, t2)
            const SEC = 1000, MIN = 60 * SEC, HRS = 60 * MIN
            const min = Math.floor((diff % HRS) / MIN).toLocaleString('en-US', {minimumIntegerDigits: 2})
            const sec = Math.floor((diff % MIN) / SEC).toLocaleString('en-US', {minimumIntegerDigits: 2})
            return `${min}:${sec}`
        }

        function enableButton(clickedTime) {
            var currentTime = new Date().getTime()
            var diffTime = clickedTime ? humanDiff(clickedTime, currentTime) : null
            let limitTime = "05:00";
            if (diffTime) {
                var diffLocalTime = new Date();
                diffLocalTime.setMinutes(diffTime.split(":")[0], diffTime.split(":")[1]);
                var defaultTime = new Date();
                defaultTime.setMinutes(limitTime.split(":")[0], limitTime.split(":")[1]);
                limitTime = diffLocalTime < defaultTime ? humanDiff(defaultTime.getTime(), diffLocalTime.getTime()) : "00:00"
            }
            var interval = setInterval(function () {
                var timer = limitTime.split(':');
                var minutes = parseInt(timer[0], 10);
                var seconds = parseInt(timer[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                if (minutes < 0) clearInterval(interval);
                seconds = (seconds < 0) ? 59 : seconds;
                limitTime = minutes + ':' + seconds;
                if (minutes === 0 && seconds === 0) {
                    clearInterval(interval);
                    document.querySelector('.resend-email').removeAttribute('disabled');
                    $('.resend-email').html('Resend Email');
                    localStorage.removeItem('resend-email-timer');
                } else {
                    document.querySelector('.resend-email').setAttribute('disabled', true);
                    $('.resend-email').html(minutes + ':' + seconds);
                    localStorage.setItem("resend-email-timer", clickedTime || currentTime);
                }
            }, 1000);
            if (!clickedTime)
                $.ajax({
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    url: "/api/v1/resend-email/" + {{ auth()->id() }},
                    type: "post",
                });
        }
    </script>
@endpush

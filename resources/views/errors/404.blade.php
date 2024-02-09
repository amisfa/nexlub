@extends('layouts.app', ['pageSlug' => '404'])
@section('content')
    <div class="w-full h-full relative">
        <div class="w-full flex flex-col md:flex-row items-center justify-center text-gray-700 m-auto"
             style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,50%);">
            <div class="w-full mx-8 text-center">
                <img width="150px" class="m-auto" src="{{asset('black').'/img/logo-circle.png'}}"/>
                <div class="text-5xl font-extrabold mb-2"> 404</div>
                <p class="text-2xl md:text-3xl font-light leading-normal mb-8">
                    Sorry we couldn't find the page you're looking for
                </p>
                <a href="{{route('home-page')}}"
                   class="px-5 inline py-3 text-sm font-medium leading-5 shadow-2xl
                    transition-all duration-400 border border-transparent rounded-lg
                     focus:outline-none ">back to homepage</a>
            </div>
        </div>
    </div>
@endsection

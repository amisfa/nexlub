@extends('layouts.app', ['pageSlug' => '404'])
@section('content')
    <div class="w-full h-full flex items-center">
        <div class="container flex flex-col md:flex-row items-center justify-between px-5 text-gray-700 m-auto">
            <div class="w-full lg:w-1/2 mx-8">
                <div class="text-5xl font-extrabold mb-8"> 404</div>
                <p class="text-2xl md:text-3xl font-light leading-normal mb-8">
                    Sorry we couldn't find the page you're looking for
                </p>
                <a href="{{route('home-page')}}"
                   class="px-5 inline py-3 text-sm font-medium leading-5 shadow-2xl
                    transition-all duration-400 border border-transparent rounded-lg
                     focus:outline-none ">back
                    to homepage</a>
            </div>
            <div class="w-full flex justify-center lg:w-1/2 mx-5 my-12">
                <img width="100px" src="{{asset('black').'/img/logo-circle.png'}}"/>
            </div>

        </div>
    </div>
@endsection

@extends('layouts.app', ['page' => __('Icons'), 'pageSlug' => 'icons'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="title">Choose Your Game</h1>
                </div>
                <div class="card-body all-icons">
                    <div class="row">
                        <div class="font-icon-list col-lg-5 col-md-3 col-sm-4 col-xs-6 col-xs-6">
{{--                            <img src="https://maxfreespins.com/wp-content/uploads/2018/02/poker-hd-wallpaper-9.jpg" alt="Poker">--}}
                            <a href=><img src="https://maxfreespins.com/wp-content/uploads/2018/02/poker-hd-wallpaper-9.jpg" alt="Poker">
                            </a>
                        </div>
                        <div class="font-icon-list col-lg-5 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                            <img src="https://www.mpl.live/blog/wp-content/uploads/2022/02/Black-Jack.png" alt="BlackJack">
                            <div class="font-icon-detail">
                                <i class="tim-icons icon-align-center"></i>
                                <p>icon-align-center</p>
                            </div>
                        </div>
                        <div class="font-icon-list col-lg-5 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                            <div class="font-icon-detail">
                                <i class="tim-icons icon-align-left-2"></i>
                                <p>icon-align-left-2</p>
                            </div>
                        </div>
                        <div class="font-icon-list col-lg-5 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                            <div class="font-icon-detail">
                                <i class="tim-icons icon-app"></i>
                                <p>icon-app</p>
                            </div>
                        </div>
{{--                        <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">--}}
{{--                            <div class="font-icon-detail">--}}
{{--                                <i class="tim-icons icon-atom"></i>--}}
{{--                                <p>icon-atom</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">--}}
{{--                            <div class="font-icon-detail">--}}
{{--                                <i class="tim-icons icon-attach-87"></i>--}}
{{--                                <p>icon-attach-87</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

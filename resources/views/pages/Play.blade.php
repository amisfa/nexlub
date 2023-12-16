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
                        <div class="font-icon-list col-lg-5 col-md-3 col-sm-4 col-xs-6 col-xs-6 ">
                            <a href=><img src="{{ asset('black') }}/img/1.jpg" alt="Poker">
                            </a>
                        </div>
                        <div class="font-icon-list col-lg-5 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                            <a href=><img src="{{ asset('black') }}/img/2.jpg" alt="Poker">
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="font-icon-list col-lg-5 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                            <a href=><img src="{{ asset('black') }}/img/3.jpg" alt="Poker">
                            </a>
                        </div>
                        <div class="font-icon-list col-lg-5 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                            <a href=><img src="{{ asset('black') }}/img/4.jpg" alt="Poker">
                            </a>
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

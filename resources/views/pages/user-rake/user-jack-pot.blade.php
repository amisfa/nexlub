@extends('layouts.app', ['page' => __('UserJackPot'), 'pageSlug' => 'user-jack-pot'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Jack Pot Rewards</div>
                    <div class="px-2">
                        <livewire:user-rake.jack-pot-reward-view/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


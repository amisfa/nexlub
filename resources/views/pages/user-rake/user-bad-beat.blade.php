@extends('layouts.app', ['page' => __('UserBadBeat'), 'pageSlug' => 'user-bad-beat'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Bad Beat Rewards</div>
                    <div class="px-2">
                        <livewire:user-rake.bad-beat-reward-view/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


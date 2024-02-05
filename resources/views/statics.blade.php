@extends('layouts.app', ['pageSlug' => 'statics'])

@section('content')
    @if(!count($gameStrategy['data']) && !count($sngStats['data']))
        <div class="text-danger text-center">You Need to Play More!</div>
    @else
        <div class="flex justify-center items-center sm:flex-row flex-col w-full flex-wrap">
            @if($cashGameWinLoseStates['data'] && count($cashGameWinLoseStates['data']))
                <div>
                    <canvas id="cashGameWinLoseStates"></canvas>
                </div>
            @endif

            @if($sngStats['data'] && count($sngStats['data']))
                <div>
                    <canvas id="sngStats"></canvas>
                </div>
            @endif
            @if($gameStrategy['data'] && count($gameStrategy['data']))
                <div>
                    <canvas id="gameStrategy"></canvas>
                </div>
            @endif
        </div>
    @endif
@endsection
@push('js')
    <script>
        var gameStrategy
        var sngStats
        var cashGameWinLoseStates
        @if($gameStrategy['data'] && count($gameStrategy['data']))
        if (gameStrategy) gameStrategy.destroy();
        var ctx = document.getElementById('gameStrategy').getContext('2d');
        gameStrategy = new Chart(ctx, {
            type: 'pie',
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                        maxWidth: '400',
                    },
                    title: {
                        display: true,
                        text: 'Played Hands stats',
                        position: 'top',
                    }
                },
            },
            data: {
                labels: @json($gameStrategy['labels']),
                datasets: [{
                    data: @json($gameStrategy['data']),
                    backgroundColor: [
                        'rgb(129, 13, 207, 0.1)',
                        'rgba(239, 43, 189, 0.1)',
                        'rgba(251, 171, 84, 0.1)',
                        'rgba(242, 216, 67, 0.1)',
                        'rgba(27, 196, 68, 0.1)',
                        'rgba(15, 150, 207, 0.1)',
                    ],
                    borderColor: [
                        'rgb(129, 13, 207)',
                        'rgba(239, 43, 189)',
                        'rgba(251, 171, 84)',
                        'rgba(242, 216, 67)',
                        'rgba(27, 196, 68)',
                        'rgba(15, 150, 207)',
                    ],
                    borderWidth: 2
                }]
            },
        });
        @endif
            @if($sngStats['data'] && count($sngStats['data']))
        if (sngStats) sngStats.destroy();
        var ctx = document.getElementById('sngStats').getContext('2d');
        sngStats = new Chart(ctx, {
            type: 'pie',
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        maxWidth: '400',
                    },
                    title: {
                        display: true,
                        text: 'Sit and Go Wins/Losses',
                        position: 'top',
                    }
                },
            },
            data: {
                labels: @json($sngStats['labels']),
                datasets: [{
                    data: @json($sngStats['data']),
                    backgroundColor: [
                        'rgb(0,255,32, 0.1)',
                        'rgb(255,0,0, 0.1)',
                    ],
                    borderColor: [
                        'rgb(0,248,255)',
                        'rgb(200,0,255)',
                    ],
                    borderWidth: 2
                }]
            },
        });
        @endif
            @if($cashGameWinLoseStates['data'] && count($cashGameWinLoseStates['data']))
        if (cashGameWinLoseStates) cashGameWinLoseStates.destroy();
        var ctx = document.getElementById('cashGameWinLoseStates').getContext('2d');
        cashGameWinLoseStates = new Chart(ctx, {
            type: 'pie',
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        maxWidth: '400',
                    },
                    title: {
                        display: true,
                        text: 'Cash Games Wins/Losses',
                        position: 'top',
                    }
                },
            },
            data: {
                labels: @json($cashGameWinLoseStates['labels']),
                datasets: [{
                    data: @json($cashGameWinLoseStates['data']),
                    backgroundColor: [
                        'rgb(0,255,32, 0.1)',
                        'rgb(255,0,0, 0.1)',
                    ],
                    borderColor: [
                        'rgb(0,248,255)',
                        'rgb(200,0,255)',
                    ],
                    borderWidth: 2
                }]
            },
        });
        @endif
    </script>
@endpush


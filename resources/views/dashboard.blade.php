@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
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
                        maxWidth: '200',
                    },
                    title: {
                        display: true,
                        text: 'Played hands stats',
                        position: 'bottom',
                    }
                },
            },
            data: {
                labels: @json($gameStrategy['labels']),
                datasets: [{
                    data: @json($gameStrategy['data']),
                    backgroundColor: [
                        'rgba(82, 215, 38, 0.7)',
                        'rgba(255, 236, 0, 0.7)',
                        'rgba(255, 115, 0, 0.7)',
                        'rgba(255, 0, 0, 0.7)',
                        'rgba(0, 126, 214, 0.7)',
                        'rgba(124, 221, 221, 0.7)',
                    ],
                    borderColor: [
                        'rgba(82, 215, 38, 1)',
                        'rgba(255, 236, 0, 1)',
                        'rgba(255, 0, 0, 1)',
                        'rgba(255, 115, 0, 1)',
                        'rgba(0, 126, 214, 1)',
                        'rgba(124, 221, 221, 1)',
                    ],
                    borderWidth: 1
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
                        position: 'bottom',
                    }
                },
            },
            data: {
                labels: @json($sngStats['labels']),
                datasets: [{
                    data: @json($sngStats['data']),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
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
                        position: 'bottom',
                    }
                },
            },
            data: {
                labels: @json($cashGameWinLoseStates['labels']),
                datasets: [{
                    data: @json($cashGameWinLoseStates['data']),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });
        @endif
    </script>
@endpush


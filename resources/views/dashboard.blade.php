@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="flex justify-center items-center sm:flex-row flex-col w-full">
        @if($gameStrategy['data'] && count($gameStrategy['data']))
            <div>
                <canvas id="gameStrategy"></canvas>
            </div>
        @endif
        @if($sngStats['data'] && count($sngStats['data']))
            <div>
                <canvas id="sngStats"></canvas>
            </div>
        @endif
        @if($cashGameWinLoseStates['data'] && count($cashGameWinLoseStates['data']))
            <div>
                <canvas id="cashGameWinLoseStates"></canvas>
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
                        position: 'right',
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
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(153, 102, 242, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 242, 1)',
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
                        position: 'right',
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
                        position: 'right',
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


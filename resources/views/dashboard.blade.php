@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="flex justify-center items-center">
        @if($gameStrategy['data'] && count($gameStrategy['data']))
            <div>
                <canvas id="gameStrategy"></canvas>
            </div>
        @endif
    </div>
@endsection
@push('js')
    <script>
        @if($gameStrategy['data'] && count($gameStrategy['data']))
        var ctx = document.getElementById('gameStrategy').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        maxWidth: '200'
                    },
                    title: {
                        display: true,
                        text: 'Played hands stats'
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
    </script>
@endpush


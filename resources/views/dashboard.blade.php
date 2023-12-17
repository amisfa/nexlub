@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <p>Hello </p>
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function () {
            demo.initDashboardPageCharts();
        });
    </script>
@endpush

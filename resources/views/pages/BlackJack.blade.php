@extends('dashboard', ['pageSlug' => 'BlackJack'])
@section('content')
<div class="BlackJack">
        <ul class="nav">
            <li @if ($pageSlug == 'BlackJck') class="active " @endif>
                <a href="#">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <h1>Blackjack</h1>
                </a>
            </li>
        </ul>
    </div>
@endsection



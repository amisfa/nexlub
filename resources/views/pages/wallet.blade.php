@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'wallet'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">koli pool tooshe$$$$</div>
                <div class="card-body">
                    <!-- Wallet details -->
{{--                    <div class="mb-3">--}}
{{--                        <h5>Current Balance: ${{ $balance }}</h5>--}}
{{--                    </div>--}}

                    <!-- Recent Transactions -->
{{--                    <div class="mb-3">--}}
{{--                        <h5>Recent Transactions</h5>--}}
{{--                        <table class="table">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>Date</th>--}}
{{--                                <th>Description</th>--}}
{{--                                <th>Amount</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($transactions as $transaction)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $transaction->date }}</td>--}}
{{--                                <td>{{ $transaction->description }}</td>--}}
{{--                                <td>{{ $transaction->amount }}</td>--}}
{{--                            </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}

                    <!-- Add funds form -->
{{--                    <div>--}}
{{--                        <h5>Add Funds</h5>--}}
{{--                        <form method="post" action="{{ route('wallet.addFunds') }}">--}}
{{--                            @csrf--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="amount">Amount</label>--}}
{{--                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter amount">--}}
{{--                            </div>--}}
{{--                            <button type="submit" class="btn btn-primary">Add Funds</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
@endsection

@extends('layouts.app', ['page' => __('Tables'), 'pageSlug' => 'withdraw'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Withdraw Funds</div>

                    <div class="card-body">
                            @csrf

                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">Amount to Withdraw</label>
                                <div class="col-md-6">
                                    <input id="amount" type="number" class="form-control" name="amount" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Withdraw
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

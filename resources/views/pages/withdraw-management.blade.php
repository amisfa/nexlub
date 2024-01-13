@extends('layouts.app', ['page' => __('Withdraw Management'), 'pageSlug' => 'withdrawManagement'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-3 overflow-auto">
                    <div class="card-header">Withdraw Management</div>
                    <table class="min-w-full">
                        <thead
                            class="border-b border-t border-gray-200 bg-gray-100 text-xs leading-4 font-semibold uppercase tracking-wider text-left">
                        <tr>
                            <th class="px-3 py-3 w-1/2">Currency</th>
                            <th class="px-3 py-3 w-1/5">Balance</th>
                            <th class="w-1/6"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($currencies as $currency)
                            <tr class="border border-gray-200 text-sm" id="{{$currency['currency']}}">
                                <td class="px-3 py-2 whitespace-no-wrap">
                                    <div class="flex justify-between">{{$currency['name']}} <img
                                            src="{{$currency['icon']}}" style="height: 45px!important;"></div>
                                </td>
                                <td class="px-3 py-2 whitespace-no-wrap balance"></td>
                                <td>
                                    <div class="p-2 cursor-pointer button"
                                         onclick="getWalletBalance('{{$currency['currency']}}')">
                                        <i class='bx cursor-pointer bx-download text-white text-2xl'></i>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br/>
                    <livewire:withdraw-management-view/>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function getWalletBalance(currencyId) {
            $('#' + currencyId + ' .button').html("<i class='bx bx-refresh text-danger text-2xl'></i>")
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                url: "/api/v1/get-wallet-balance",
                type: "get",
                dataType: "json",
                data: {currencyId},
                success: function (response) {
                    $('#' + currencyId + ' .balance').html(response.balance)
                }
            }).then(function(){
                $('#' + currencyId + ' .button').html("<i class='bx cursor-pointer bx-download text-white text-2xl'></i>")
            });
        }
    </script>
@endpush


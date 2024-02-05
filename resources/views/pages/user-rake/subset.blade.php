@extends('layouts.app', ['page' => __('Referral'), 'pageSlug' => 'referral'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-3">
                    <livewire:user-rake.affiliate-rake-view/>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function copyText(e) {
            document.getElementById("text").select();
            if (window.isSecureContext && navigator.clipboard) {
                navigator.clipboard.writeText(document.getElementById("text").value)
            } else {
                document.execCommand('copy')
            }
            e.currentTarget.setAttribute("tooltip", "Copied!");
        }

        function resetTooltip(e) {
            e.currentTarget.setAttribute("tooltip", "Copy to clipboard");
        }

        document.getElementById("copy").addEventListener("click", (e) => copyText(e));
        document.getElementById("copy").addEventListener("mouseover", (e) => resetTooltip(e));
    </script>
@endpush

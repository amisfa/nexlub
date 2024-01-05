@extends('layouts.app', ['page' => __('Subset'), 'pageSlug' => 'subset'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-3 overflow-auto">
                    <div class="card-header">
                        <div class="flex justify-between sm:flex-row flex-col">
                            <div>Subsets</div>
                            <div class="shareLink">
                                <div class="permalink">
                                    <input class="textLink" type="text" name="shortlink"
                                           value="{{auth()->user()->referral_link}}" id="text"
                                           readonly="">
                                    <span class="copyLink" id="copy" tooltip="Copy to clipboard">
                                        <i class="fa-regular fa-copy"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <livewire:user-subset-view/>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function copyText(e) {
            document.getElementById("text").select();
            document.execCommand("copy");
            e.currentTarget.setAttribute("tooltip", "Copied!");
        }

        function resetTooltip(e) {
            e.currentTarget.setAttribute("tooltip", "Copy to clipboard");
        }

        document.getElementById("copy").addEventListener("click", (e) => copyText(e));
        document.getElementById("copy").addEventListener("mouseover", (e) => resetTooltip(e));
    </script>
@endpush

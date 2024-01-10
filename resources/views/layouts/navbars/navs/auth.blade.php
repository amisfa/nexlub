<div>
    <nav class="navbar navbar-expand-lg navbar-absolute navbar-desktop">
            <livewire:header-view/>
    </nav>
</div>
@push('js')
    <script>
        $('.arrow').each(function () {
            $(this).unbind().click(function (e2) {
                let arrowParent = e2.currentTarget.parentElement.parentElement
                if (arrowParent.classList.contains("showMenu")) arrowParent.classList.remove("showMenu");
                else arrowParent.classList.add("showMenu");
            })
        })

        function clickedToggleButton() {
            var toggle = document.querySelector('.toggle input')
            var sidebar = document.querySelector('.sidebar')
            if (!toggle.checked) {
                sidebar.classList.remove("close");
            } else {
                sidebar.classList.add("close");
            }
            toggle.checked = !toggle.checked
        }
    </script>
@endpush

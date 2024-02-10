<footer style="background: #181818">
    <div class="mx-auto max-w-5xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="flex justify-center text-teal-600">
            <img src="{{asset('black').'/img/logo.png'}}"/>
        </div>
        <p class="mx-auto mt-6 max-w-md text-center leading-relaxed text-gray-500">
            ©{{now()->format('Y')}} Nexlub.com | All Rights Reserved.
        </p>
        <ul class="mt-12 flex justify-center gap-6 md:gap-8">
            <li>
                <a href="#"
                    rel="noreferrer"
                    target="_blank"
                    class="text-gray-700 transition text-xl">
                    <span class="sr-only">Twitter</span>
                    <i class='bx bxl-twitter'></i>
                </a>
            </li>
            <li>
                <a href="#"
                    rel="noreferrer"
                    target="_blank"
                    class="text-gray-700 transition text-xl">
                    <span class="sr-only">Telegram</span>
                    <i class='bx bxl-telegram'></i>
                </a>
            </li>
        </ul>
    </div>
</footer>

<footer style="background: #181818">
    <div class="mx-auto w-5/6 md:w-3/5 m-auto px-4 pt-16 sm:px-6 lg:px-8 pb-1">
        <div class="flex justify-center text-teal-600">
            <img src="{{asset('black').'/img/logo.png'}}"/>
        </div>
        <p class="mx-auto mt-6 max-w-md text-center leading-relaxed text-gray-500">
            Nexlub.com is for entertainment purposes only.
        </p>
        <p class="mx-auto max-w-md text-center leading-relaxed text-gray-500">
            Users are encouraged to gamble responsibly. We are not responsible for any losses incurred while playing.
        </p>

        <ul class="mt-12 flex justify-center gap-6 md:gap-8">
            <li>
                <a href="https://twitter.com/nexlub"
                   rel="noreferrer"
                   target="_blank"
                   class="text-gray-700 transition text-xl">
                    <span class="sr-only">Twitter</span>
                    <i class='bx bxl-twitter'></i>
                </a>
            </li>
            <li>
                <a href="https://t.me/Nexlub"
                   rel="noreferrer"
                   target="_blank"
                   class="text-gray-700 transition text-xl">
                    <span class="sr-only">Telegram</span>
                    <i class='bx bxl-telegram'></i>
                </a>
            </li>
        </ul>
        <br/>
        <p class="mx-auto mt-6 max-w-md text-center leading-relaxed text-gray-500">
            ©{{now()->format('Y')}} Nexlub.com | All Rights Reserved.
        </p>
    </div>
</footer>

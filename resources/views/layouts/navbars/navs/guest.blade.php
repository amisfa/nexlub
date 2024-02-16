<div>
    <nav class="navbar navbar-expand-lg navbar-absolute navbar-desktop w-full">
        <div class="flex justify-between w-full">
            <a class="navbar-brand" href="{{route('home-page')}}">
                <img src="{{asset('black').'/img/logo.png'}}"/>
            </a>
            <div class="flex items-center hidden sm:inline-flex">
                <a href="{{route('login')}}" class="hover:text-white px-2">Login</a>
                <a href="{{route('signup')}}" class="hover:text-white px-2">Register</a>
                <a href="https://t.me/Nexlub" rel="noreferrer" target="_blank" class="transition text-xl flex items-end px-1 hover:text-white">
                    <span class="sr-only">Telegram</span>
                    <i class="bx bxl-telegram"></i>
                </a>
                <a href="https://twitter.com/nexlub" rel="noreferrer" target="_blank" class="transition text-xl flex items-end px-1 hover:text-white">
                    <span class="sr-only">Twitter</span>
                    <i class="bx bxl-twitter"></i>
                </a>
            </div>
            <div class="sm:hidden">
                <input id="menu-toggle" type="checkbox"/>
                <label class='menu-button-container' for="menu-toggle">
                    <div class='menu-button'></div>
                </label>
                <ul class="menu">
                    <li>
                        <a href="{{route('login')}}" class="hover:text-white px-2">Login</a>
                    </li>
                    <li>
                        <a href="{{route('signup')}}" class="hover:text-white px-2">Register</a>
                    </li>
                    <li>
                        <div class="flex flex-row w-full items-center content-center justify-center">
                            <a href="https://t.me/Nexlub" rel="noreferrer" target="_blank" class="text-gray-700 transition text-xl flex items-end mx-2">
                                <span class="sr-only">Telegram</span>
                                <i class="bx bxl-telegram"></i>
                            </a>
                            <a href="https://twitter.com/nexlub" rel="noreferrer" target="_blank" class="text-gray-700 transition text-xl flex items-end mx-2">
                                <span class="sr-only">Twitter</span>
                                <i class="bx bxl-twitter"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

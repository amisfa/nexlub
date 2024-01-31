<div>
    <nav class="navbar navbar-expand-lg navbar-absolute navbar-desktop w-full">
        <div class="flex justify-between w-full">
            <a class="navbar-brand" href="{{route('home-page')}}">
                <img src="{{asset('black').'/img/logo.png'}}"/>
            </a>
            <div class="flex items-center hidden sm:inline-flex">
                <a href="{{route('login')}}" class="hover:text-white px-2">Login</a>
                <a href="{{route('signup')}}" class="hover:text-white px-2">Register</a>
                <a href="#" class="text-gray-500 hover:text-white text-sm px-2">
                    <i class='bx bxl-telegram'></i>
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
                        <div class="flex flex-col flex-wrap w-full items-center">
                            <a href="#" class="text-white-50 hover:text-white text-sm px-2">
                                <i class='bx bxl-telegram'></i>
                            </a>
                            <a href="#" class="text-white-50 hover:text-white text-sm px-2">
                                <i class='bx bxl-telegram'></i>
                            </a>
                            <a href="#" class="text-white-50 hover:text-white text-sm px-2">
                                <i class='bx bxl-telegram'></i>
                            </a>
                            <a href="#" class="text-white-50 hover:text-white text-sm px-2">
                                <i class='bx bxl-telegram'></i>
                            </a>
                            <a href="#" class="text-white-50 hover:text-white text-sm px-2">
                                <i class='bx bxl-telegram'></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>





        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="{{ asset('assets/images/user.webp') }}">
                </button>

                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>

                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="{{ route((!empty($url) ? $url : "") . '.profile') }}" class="block px-4 py-2 account-link hover:text-white">Profile</a>

                    <a class="block px-4 py-2 account-link hover:text-white" href="{{ route((!empty($url) ? $url : "") . '.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route((!empty($url) ? $url : "") . '.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="{{ route((!empty($url) ? $url : "") . '.dashboard') }}" 
                    class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
                    {{ (!empty($url) ? strFilter($url) : "") }} Panel
                </a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a  href="{{ route((!empty($url) ? $url : "") . '.dashboard') }}" 
                    class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>

                <a href="" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-tablet-alt mr-3"></i>
                    URL Shortener
                </a>

                <a href="" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-users mr-3"></i>
                    Admins
                </a>

                <a href="" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-users mr-3"></i>
                    Clients
                </a>
                
                <a href="{{ route((!empty($url) ? $url : "") . '.profile') }}" 
                    class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    Profile
                </a>

                <a  class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item" 
                    href="{{ route((!empty($url) ? $url : "") . '.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route((!empty($url) ? $url : "") . '.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </header>
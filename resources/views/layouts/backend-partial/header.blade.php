@php
    $avatar = 'assets/images/user.webp';
    if($url == 'admin') {
        $avatar = getAdminInfo()->avatar;
    } else {
        $avatar = getClientInfo()->avatar;
    }

    $userName = '';
    if($url == 'admin') {
        $userName = strFilter(getAdminInfo()->name);
    } else {
        $userName = strFilter(getClientInfo()->name);
    }
@endphp

        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="{{ asset($avatar) }}">
                </button>

                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>

                <div x-show="isOpen" class="absolute w-52 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <div class="border-b-2 border-gray-500 pb-1 mb-1">
                        <p class="px-4 py-2 account-link hover:text-white">
                            {{ $userName }}
                        </p>
                    </div>

                    <a href="{{ route((!empty($url) ? $url : '') . '.profile') }}" class="flex justify-start items-center gap-3 px-4 py-2 account-link hover:text-white">
                        <i class="fas fa-user"></i>
                        Profile
                    </a>

                    <a class="flex justify-start items-center gap-3 px-4 py-2 account-link hover:text-white" href="{{ route((!empty($url) ? $url : '') . '.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill="none" stroke-width="2" d="M13,9 L13,2 L1,2 L1,22 L13,22 L13,15 M22,12 L5,12 M17,7 L22,12 L17,17"></path></svg>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route((!empty($url) ? $url : '') . '.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="{{ route((!empty($url) ? $url : '') . '.dashboard') }}" 
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
                <a  href="{{ route((!empty($url) ? $url : '') . '.dashboard') }}" 
                    class="flex items-center {{ $activeMenu == 'dashboard' ? 'active-nav-link' : '' }} text-white py-4 pl-6 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                
                <a href="{{ route((!empty($url) ? $url : '') . '.shorteners') }}" class="flex items-center {{ $activeMenu == 'shortener' ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-tablet-alt mr-3"></i>
                    URL Shortener
                </a>
                
                @if($url=="admin")

                <a href="{{ route('admin.users') }}" class="flex items-center {{ $activeMenu == 'users' ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-users mr-3"></i>
                    Users
                </a>

                
                <a href="{{ route('admin.clients') }}" class="flex items-center {{ $activeMenu == 'clients' ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-users mr-3"></i>
                    Clients
                </a>
                
                @endif

                <a href="{{ route((!empty($url) ? $url : '') . '.profile') }}" 
                    class="flex items-center {{ $activeMenu == 'dashboard' ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    Profile
                </a>

                <a  class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item" 
                    href="{{ route((!empty($url) ? $url : '') . '.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route((!empty($url) ? $url : '') . '.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </header>
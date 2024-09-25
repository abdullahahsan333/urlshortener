


<aside class="relative bg-sidebar h-screen w-72 hidden sm:block shadow-xl">
    <div class="p-6">
        <a  href="{{ route((!empty($url) ? $url : "") . '.dashboard') }}" 
            class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
            {{ (!empty($url) ? strFilter($url) : "") }} Panel
        </a>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
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
    </nav>

</aside>
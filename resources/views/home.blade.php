
@extends('layouts.app')

@section('content')

<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('assets/images/logo.webp') }}" class="h-8" alt="Flowbite Logo">

            <span class="self-center text-2xl font-semibold whitespace-nowrap">{{ strFilter('url Shortener') }}</span>
        </a>

        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <div class="">
                <a href="{{ route('admin.login') }}" 
                    class="mr-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-3 text-center">
                    Admin Login
                </a>

                <a href="{{ route('client.login') }}" 
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 text-center">
                    Client Login
                </a>
            </div>
            
            <button data-collapse-toggle="navbar-sticky" type="button" 
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-sticky" aria-expanded="false">

                <span class="sr-only">Open main menu</span>

                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>

        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a  href="{{ route('home') }}" 
                        class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0" aria-current="page">
                        Home
                    </a>
                </li>

                <li>
                    <a  href="#" 
                        class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                        About Us
                    </a>
                </li>

                <li>
                    <a  href="#" 
                        class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                        Contact
                    </a>
                </li>
            </ul>
        </div>
    </div>
  </nav>


<div class="bg-white w-full pt-5 border-b border-gray-200">
    <div class="max-w-screen-xl mx-auto p-4">
        <div class="pt-5 text-center">
            <h3 class="text-4xl cta-btn font-bold pb-3">
                Paste the URL to be shortened
            </h3>
            <p class="text-xl w-3/4 m-auto">
                ShortURL is a free tool to shorten URLs and generate short links URL shortener allows to create a shortened link making it easy to share
            </p>
        </div>

        <div class="flex items-center justify-center mt-3">
            
            <div class="w-2/3">
                <form action="{{ url('/short/store') }}" method="POST" class="p-5 bg-white rounded">
                    @csrf
                    <div class="mt-2">
                        <textarea class="w-full px-5 py-2 text-gray-700 rounded" autocorrect="off" spellcheck="false" autocomplete="off"
                            name="main_url" rows="5" required="" placeholder="Paste the URL to be shortened" aria-label="LongUrl"></textarea>
                    </div>
    
                    <div class="mt-6">
                        <button class="px-6 py-3 text-white font-light bg-brand-btn rounded" type="submit">
                            Url Shortener
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@if(session('myUrl'))
<div class="bg-gray-200 w-full pt-5 border-b border-gray-200">
    <div class="max-w-screen-xl mx-auto p-4">

        <p class="text-xl w-2/3 m-auto">
            <span class="font-bold">Your Main URL: </span>
            <a target="_blank" href="{{ session('myUrl')->main_url }}" class="underline cta-btn font-bold cursor-pointer">
                {{ session('myUrl')->main_url }}
            </a>
        </p>
        <p class="text-xl w-2/3 m-auto mt-5">
            <span class="font-bold">Your Short URL: </span>

            <input type="hidden" value="{{ url('/short', session('myUrl')->short_url) }}" id="copyUrl">

            <span class="underline cta-btn font-bold cursor-pointer" onclick="copyText()" onmouseout="outFunc()" 
                data-tooltip-target="tooltip-copy" data-tooltip-trigger="hover" data-tooltip-placement="top">
                {{ url('/short', session('myUrl')->short_url) }}
            </span>

            <div id="tooltip-copy" role="tooltip" class="hidden tooltip">
                Copy invoice Link
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </p>

    </div>
</div>
@endif
    
<div class="bg-white w-full pt-5 border-b border-gray-200">
    <div class="max-w-screen-xl mx-auto p-4">
        <div class="pt-5 text-center">
            <h3 class="text-4xl cta-btn font-bold pb-3">
                Want More? Try Premium Features!
            </h3>
            <p class="text-xl w-3/4 m-auto">
                Custom short links, powerful dashboard, detailed analytics and support
            </p>
        </div>

        <div class="flex items-center justify-center mt-3">
            <a class="px-7 py-4 text-white font-light bg-brand-btn rounded" href="{{ route('client.register') }}">
                Create Account
            </a>
        </div>
    </div>
</div>
  
@endsection



@push('footerPartial')
    <script>
    function copyText() {
        var span = document.querySelector('span[data-tooltip-target="tooltip-copy"]');
        span.setAttribute('data-tooltip', 'Copying...');
        var copyText = document.getElementById("copyUrl").value;

        if (navigator.clipboard) {
            navigator.clipboard.writeText(copyText)
                .then(function() {
                    span.setAttribute('data-tooltip', 'Copied');
                    setTimeout(() => {
                        span.setAttribute('data-tooltip', 'Copy invoice Link');
                    }, 2000);
                }).catch(function(err) {
                    console.error('Failed to copy text: ', err);
                    span.setAttribute('data-tooltip', 'Copy failed');
                });
        } else {
            var textarea = document.createElement('textarea');
            textarea.value = copyText;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            span.setAttribute('data-tooltip', 'Copied');

            setTimeout(() => {
                span.setAttribute('data-tooltip', 'Copy invoice Link');
            }, 2000);
        }
    }

    function outFunc() {
        var span = document.querySelector('span[data-tooltip-target="tooltip-copy"]');
        span.setAttribute('data-tooltip', 'Copy invoice Link');
    }

    </script>
@endpush
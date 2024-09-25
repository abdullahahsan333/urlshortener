@extends('layouts.auth')

@section('content')

{{-- <h1 class="w-full text-3xl text-black pb-6">Forms</h1> --}}

<div class="flex justify-center">

    <div class="w-full lg:w-1/3 mt-6 pl-0 lg:pl-2">
        <p class="text-xl pb-6 flex items-center">
            <i class="fas fa-list mr-3"></i> {{ isset($url) ? ucwords($url) : ""}} {{ __('Register') }} Form
        </p>
        <div class="leading-loose">
            <form method="POST" action='{{ url("$url/register") }}' aria-label="{{ __('Register') }}" class="p-10 bg-white rounded shadow-xl">
                @csrf

                <p class="text-lg text-gray-800 font-medium pb-4">{{ isset($url) ? ucwords($url) : ""}} information</p>

                <div class="">
                    <label class="block text-sm text-gray-600" for="name">Name</label>
                    <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" id="name" name="name" type="text" required="" placeholder="Your Name" aria-label="Name">
                </div>

                <div class="mt-5">
                    <label class="block text-sm text-gray-600" for="email">Email</label>
                    <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="email" name="email" type="text" required="" placeholder="Your Email" aria-label="Email">
                </div>
                
                <div class="mt-5">
                    <label class="block text-sm text-gray-600" for="password">Password</label>
                    <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" id="password" name="password" type="text" required="" placeholder="Your Password" aria-label="Password">
                </div>

                <div class="mt-6">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Sign Up</button>
                </div>
            </form>
        </div>

        <div class="mt-6">
            <p>
                I have already account? 
                <a href="{{ route($url . '.login') }}" class="text-red-600">Login Here</a>.
            </p>
        </div>



    </div>
</div>

@endsection
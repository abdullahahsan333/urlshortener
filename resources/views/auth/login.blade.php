@extends('layouts.auth')

@section('content')


{{-- <h1 class="w-full text-3xl text-black pb-6">Forms</h1> --}}

<div class="flex justify-center">
    <div class="w-full lg:w-1/3 my-6 pr-0 lg:pr-2">
        <p class="text-xl pb-6 flex items-center">
            <i class="fas fa-list mr-3"></i> {{ isset($url) ? ucwords($url) : "" }} Login Form
        </p>
        <div class="leading-loose">
            <form method="POST" action='{{ url("$url/login") }}' class="p-10 bg-white rounded shadow-xl">
                @csrf
                
                <div class="mb-2">
                    <label class="block text-sm text-gray-600" for="email">Email</label>
                    <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="email" name="email" type="text" required="" placeholder="Your Email" aria-label="Email">
                </div>

                <div class="">
                    <label class="block text-sm text-gray-600" for="password">Password</label>
                    <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" id="password" name="password" type="password" required="" placeholder="Your Password" aria-label="Password">
                </div>

                <div class="mt-6">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                </div>
            </form>
        </div>

        <div class="mt-6">
            <p>
                I dont have account? 
                <a href="{{ route($url . '.register') }}" class="text-red-600">Sign Up Here</a>.
            </p>
        </div>
    </div>
</div>


@endsection
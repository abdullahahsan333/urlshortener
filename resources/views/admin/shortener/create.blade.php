@extends('layouts.backend')

@section('content')

<div class="w-full">
    <div class="flex items-center justify-between">
        <p class="text-xl pb-3">
            <i class="fas fa-plus mr-3"></i>
            Add Shortener
        </p>

        <a href="{{ route('admin.shorteners') }}" class="w-48 bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg hover:bg-gray-300 flex items-center gap-2 justify-center">
            <i class="fas fa-list mr-3"></i>
            All Url
        </a>
    </div>

    <div class="bg-white overflow-auto mt-3">
        <form action="{{ route('admin.shortener.store') }}" method="POST" class="p-10 bg-white rounded shadow-xl">
            @csrf

            <div class="leading-loose">
                <div class="mt-2">
                    <label class="mb-4  block text-sm text-gray-600" for="mainUrl">Your Long Url</label>
                    <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" autocorrect="off" spellcheck="false" autocomplete="off"
                        id="mainUrl" name="main_url" rows="4" required="" placeholder="Your Long Url" aria-label="LongUrl"></textarea>
                </div>

                <div class="mt-6">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Url Shortener</button>
                </div>
            </div>

        </form>
    </div>
</div>


@endsection
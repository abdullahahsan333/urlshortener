@extends('layouts.backend')

@section('content')

<div class="w-full">
    <div class="flex items-center justify-between">
        <p class="text-xl pb-3">
            URL Shorteners
        </p>
    </div>

    <div class="bg-white overflow-auto mt-3">
        
            <div class="w-2/3">
                <div class="leading-loose">
                    <form action="{{ route('client.shortener.store') }}" method="POST" class="p-5 bg-white rounded">
                        @csrf
                        <div class="mt-2">
                            <label class="mb-4  block text-sm text-gray-600" for="mainUrl">Your Long Url</label>
                            <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" autocorrect="off" spellcheck="false" autocomplete="off"
                                id="mainUrl" name="main_url" rows="5" required="" placeholder="Your Long Url" aria-label="LongUrl"></textarea>
                        </div>
        
                        <div class="mt-6">
                            <button class="px-4 py-1 text-white font-light bg-brand-btn rounded" type="submit">Url Shortener</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="w-full p-5 border-t-2 border-gray-200">
                <div class="flex items-center justify-between">
                    <p class="text-xl pb-3">
                        All Shorteners
                    </p>
                </div>

                <table class="min-w-full border border-gray-200 leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                SL
                            </th>

                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Long URL
                            </th>
        
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Short URL
                            </th>

                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Click
                            </th>
        
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
        
                    <tbody>
                        @foreach ($results as $key => $shortener)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $key + 1 }}
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $shortener->main_url }}
                                </td>
        
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <a href="{{ url('/short',$shortener->short_url) }}" target="_blank">
                                            {{ url('/short',$shortener->short_url) }}
                                        </a>
                                    </p>
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ (!empty($shortener->hit) ? $shortener->hit : 0) }}
                                </td>
        
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
        
                                    <a href="{{ route('admin.shortener.delete', $shortener->id) }}" class="flex justify-center gap-3 rounded px-2 py-2 text-white hover:text-black bg-red-500 hover:bg-red-400">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path>
                                        </svg>
                                        Delete
                                    </a>
                                        
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
        
                </table>
            </div>
    </div>
</div>


@endsection
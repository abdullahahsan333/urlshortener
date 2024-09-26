@extends('layouts.backend')

@section('content')

<div class="w-full">
    <div class="flex items-center justify-between">
        <p class="text-xl pb-3">
            All Shorteners
        </p>

        <a href="{{ route('admin.shortener.create') }}" class="w-48 bg-brand-btn text-white font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg flex items-center gap-2 justify-center">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
            </svg>
            Add New Shortener
        </a>
    </div>

    <div class="bg-white overflow-auto mt-3">
        <table class="min-w-full border border-gray-200 leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        SL
                    </th>

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        User Info
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

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($results as $key => $shortener)
                    @php
                        $status = '';
                        $textclass = '';
                        $bgClass = '';
                        if($shortener->status == 1) {
                            $textclass = "text-green-900";
                            $bgClass = "bg-green-200";
                            $status = 'Active';
                        } else {
                            $textclass = "text-red-900";
                            $bgClass = "bg-red-200";
                            $status = 'Inactive';
                        }

                        $avatar = $userName = $privilege =  null;
                        if(!empty($shortener->admin)) {
                            $avatar = asset($shortener->admin->avatar);
                            $userName = $shortener->admin->name;
                            $privilege = 'Admin';
                        } elseif (!empty($shortener->client)) {
                            $avatar = asset($shortener->client->avatar);
                            $userName = $shortener->client->name;
                            $privilege = 'Client';
                        } else {
                            $avatar = asset('assets/images/user.webp');
                            $userName = 'From Website';
                            $privilege = 'Not Register';
                        }
                    @endphp
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $key + 1 }}
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center gap-2">
                                <div class="flex-shrink-0 w-10 h-10">
                                    <img class="w-full h-full rounded-full" src="{{ $avatar }}" alt="" />
                                </div>
                                <div class="">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ strFilter($userName) }}
                                    </p>
                                    <p class="text-gray-600">
                                        <small>- {{ strFilter($privilege) }}</small>
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="">
                                {{ $shortener->main_url }}
                            </p>
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
                            <span
                                class="relative inline-block px-3 py-1 font-semibold {{ $textclass }} leading-tight">
                                <span aria-hidden class="absolute inset-0 {{ $bgClass }} opacity-50 rounded-full"></span>
                                <span class="relative">
                                    {{ $status }}
                                </span>
                            </span>
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


@endsection
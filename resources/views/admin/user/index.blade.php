@extends('layouts.backend')

@section('content')

{{-- @dd($results) --}}
<div class="w-full mt-12">
    <p class="text-xl pb-3 flex items-center">
        <i class="fas fa-list mr-3"></i> All Users
    </p>
    <div class="bg-white overflow-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        SL
                    </th>
                    
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Avatar
                    </th>

                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Name
                    </th>

                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Email
                    </th>

                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>

                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $key => $user)
                @php
                    $status = '';
                    $textclass = '';
                    $bgClass = '';
                    if($user->status == 1) {
                        $textclass = "text-green-900";
                        $bgClass = "bg-green-200";
                        $status = 'Active';
                    } else {
                        $textclass = "text-red-900";
                        $bgClass = "text-red-200";
                        $status = 'Inactive';
                    }
                @endphp

                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $key + 1 }}
                        </td>
                        
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10">
                                    <img class="w-full h-full rounded-full"
                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                        alt="" />
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ strFilter($user->name) }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $user->email }}
                            </p>
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
                            {{-- <div class="flex items-center justify-center"> --}}
                                <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" data-dropdown-placement="left"
                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none" type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                        <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                    </svg>
                                </button>
                                
                                <!-- Dropdown menu -->
                                <div id="dropdownDots" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                        <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                                        </li>
                                        <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
                                        </li>
                                        <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Earnings</a>
                                        </li>
                                    </ul>
                                    <div class="py-2">
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Separated link</a>
                                    </div>
                                </div>
                                
                            {{-- </div> --}}
                        </td>
                    </tr>
                    
                @endforeach

            </tbody>
        </table>
    </div>
</div>


@endsection
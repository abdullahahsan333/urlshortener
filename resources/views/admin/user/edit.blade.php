@extends('layouts.backend')

@section('content')

<div class="w-full">
    <div class="flex items-center justify-between">
        <p class="text-xl pb-3">
            Edit User
        </p>

        <a href="{{ route('admin.users') }}" class="w-48 text-white bg-brand-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg flex items-center gap-2 justify-center">
            <i class="fas fa-list mr-3"></i>
            All Users
        </a>
    </div>

    <div class="bg-white overflow-auto mt-3">
        <form action="{{ route('admin.user.update') }}" method="POST" enctype="multipart/form-data" class="p-10 bg-white rounded shadow-xl">
            @csrf

            <input type="hidden" hidden name="id" value="{{ $info->id }}">

            <div class="flex flex-wrap flex-row">

                <div class="w-3/4">
                    <div class="leading-loose">
                        <div class="">
                            <label class="mb-4 block text-sm text-gray-600" for="name">Name <span class="req">*</span></label>
                            <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" autocorrect="off" spellcheck="false" autocomplete="off"
                                id="name" name="name" type="text" value="{{ (!empty($info->name) ? $info->name : '') }}" required="" placeholder="Your Name" aria-label="Name">
                        </div>
        
                        <div class="mt-2">
                            <label class="mb-4 block text-sm text-gray-600" for="email">Email <span class="req">*</span></label>
                            <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" autocorrect="off" spellcheck="false" autocomplete="off"
                                id="email" name="email" type="text" value="{{ (!empty($info->email) ? $info->email : '') }}" required="" placeholder="Your Email" aria-label="Email" readonly>
                        </div>
                        
                        <div class="mt-2">
                            <label class="mb-4 block text-sm text-gray-600" for="mobile">Mobile</label>
                            <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" autocorrect="off" spellcheck="false" autocomplete="off"
                                id="mobile" name="mobile" type="text" value="{{ (!empty($info->mobile) ? $info->mobile : '') }}" placeholder="Your Mobile" aria-label="Email">
                        </div>
        
                        <div class="mt-2">
                            <label class="mb-4  block text-sm text-gray-600" for="address">Address</label>
                            <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" autocorrect="off" spellcheck="false" autocomplete="off"
                                id="address" name="address" rows="3" placeholder="Your Address" aria-label="Email">{{ (!empty($info->address) ? $info->address : '') }}</textarea>
                        </div>

                        <div class="mt-2">
                            <label class="mb-4 block text-sm text-gray-600" for="status">Status</label>
                            <select class="w-full px-5 h-16 text-gray-700 bg-gray-200 rounded" id="status" name="status">
                                <option value="1" {{ ($info->status == 1) ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ ($info->status == 0) ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
        
                        <div class="mt-6">
                            <button class="px-4 py-1 text-white font-light bg-brand-btn rounded" type="submit">Update</button>
                        </div>
                    </div>
                </div>
                
                <div class="w-1/4">
                    <!-- Thumbnail area -->
                    <div class="px-10 py-4">
                        <div id="displayImage" class="w-full rounded-10 my-4"></div>
                        
                        <input class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" 
                            id="featuredImage" name="avatar" type="file">
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>


@endsection


@push('headerPartial')
<style>
    #displayImage {
        height: 320px;
        border: 1px solid #E5E7EB;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background: #d8d8d860;
    }
    .req {
        color: red;
    }
</style>
@endpush

@push('footerPartial')
<script>
    //   Display Blog Thumbnail
    const imageUrl = "{{ (!empty($info->avatar) ? asset($info->avatar) : asset('assets/images/user.webp')) }}";
    document.getElementById('displayImage').style.backgroundImage = 'url(' + imageUrl + ')';

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('displayImage').style.backgroundImage = 'url(' + e.target.result + ')';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("featuredImage").addEventListener("change", function () {
        readURL(this);
    });
</script>
@endpush
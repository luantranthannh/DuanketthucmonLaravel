@extends('layouts.admin.admin')
@section('content')
<style>
    /* Loại bỏ các kiểu mặc định của thẻ a */
    .head-title a {
        color: inherit; /* Giữ màu chữ như mặc định */
        text-decoration: none; /* Loại bỏ gạch chân */
        padding: 0; /* Loại bỏ padding */
    }
</style>
<div class="head-title flex items-center">
    <a href="{{url('/admin/banners')}}" class="flex items-center mr-4 mb-4">
        <img width="32" height="32" class="mr-1" src="https://img.icons8.com/ios-filled/50/000000/left.png" alt="back"/>
        <h1 class="text-2xl font-bold ml-2">Update banner</h1>
    </a>
</div>

<form action="{{ url('admin/banners/banner/' . $banner->id . '/edit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="flex items-center justify-center w-full">
        <label for="banner_image" class="w-1/2 flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>
            <input type="file" id="banner_image" name="banner_image" class="hidden" onchange="handleFileUpload(event)" accept="image/svg+xml,image/png,image/jpeg,image/gif" />
        </label>
        <div id="image-preview" class="w-1/2 flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 rounded-lg">
            <img id="preview" src="{{asset('assets/admin/banners/'.$banner->image_path)}}" alt="Preview Image" class="w-full h-full object-contain" />
        </div>
    </div>
    <div class="flex justify-left mt-4">
        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Update</button>
    </div>
    
</form>

<script>
    function handleFileUpload(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            const previewImage = document.getElementById('preview');
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        }

        reader.readAsDataURL(file);
    }
</script>



@endsection
@extends('layouts.admin.admin')

@section('content')
<div class="head-title">
  <div class="left">
    <h1>Add new doctor</h1>
  </div>
  <a href="{{url('/admin/doctors')}}"><button class="btn btn-primary" data-ripple-light="true"> Back</button></a>

</div>
<div class="flex items-center justify-center p-12">
  <!-- Author: FormBold Team -->
  <!-- Learn More: https://formbold.com -->
  <div class="mx-auto w-full max-w-full">
    <form action="{{url('/admin/doctors/create') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3 sm:w-1/3">
          <div class="mb-5">
            <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
              Full name
            </label>
            <input type="text" name="name" id="name" placeholder="Name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="{{old('name')}}" />
            @error('name')
            <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
          </div>
        </div>
        <div class="w-full px-3 sm:w-1/3">
          <div class="mb-5">
            <label for="Email" class="mb-3 block text-base font-medium text-[#07074D]">
              Email
            </label>
            <input type="text" name="email" id="email" placeholder="Email" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="{{old('email')}}" />
            @error('email')
            <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
          </div>
        </div>
        <div class="w-full px-3 sm:w-1/3">
          <div class="mb-5">
            <label for="phone" class="mb-3 block text-base font-medium text-[#07074D]">
              Phone
            </label>
            <input type="text" name="phone" id="phone" placeholder="Phone" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="{{old('phone')}}" />
            @error('phone')
            <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
          </div>
        </div>

      </div>

      <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
            <label for="specialization" class="mb-3 block text-base font-medium text-[#07074D]">
              Specialization
            </label>
            <!-- <input type="text" name="specialization" id="specialization" placeholder="Specialization" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="{{old('specialization')}}" />
            @error('specialization')
            <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror -->
            <select name="specialization" id="specialization" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
              <option value="">-- Select Specialization --</option>
              <option value="Neurologist" {{ old('specialization') == 'Neurologist' ? 'selected' : '' }}>Neurologist</option>
              <option value="Psychologists" {{ old('specialization') == 'Psychologists' ? 'selected' : '' }}>Psychologists</option>
              <option value="Psycho Doctor" {{ old('specialization') == 'Psycho Doctor' ? 'selected' : '' }}>Psycho Doctor</option>
            </select>
            @error('specialization')
            <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror

          </div>
        </div>
        <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
            <label for="experience" class="mb-3 block text-base font-medium text-[#07074D]">
              Description
            </label>
            <input type="text" name="description" id="description" placeholder="description" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="{{old('description')}}" />
            @error('description')
            <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
          </div>
        </div>
        <div class=" w-full px-3 sm:w-1/2">
          <div class="mb-5">
            <label for="experience" class="mb-3 block text-base font-medium text-[#07074D]">
              Address
            </label>
            <input type="text" name="address" id="address" placeholder="address" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="{{old('address')}}" />
            @error('address')
            <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
          </div>
        </div>
        <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
            <label for="experience" class="mb-3 block text-base font-medium text-[#07074D]">
              Password
            </label>
            <input type="text" name="password" id="password" placeholder="password" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="{{old('password')}}" />
            @error('password')
            <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
          </div>
        </div>
        <div class="w-full px-3 sm:w-1/2">
          <div class="mb-5">
            <label for="Image" class="mb-3 block text-base font-medium text-[#07074D]">Image</label>
            <input type="file" name="url_image" id="url_image" placeholder="Image" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            @error('url_image')
            <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
          </div>
        </div>
      </div>
      <div>
        <button class="btn btn-primary" data-ripple-light="true" type="submit">
          Submit
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
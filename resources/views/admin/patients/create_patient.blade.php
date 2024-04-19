@extends('layouts.admin.admin')

@section('content')
<div class="head-title">
    <div class="left">
        <h1>Add new patient</h1>
    </div>
    <a href="{{url('/admin/patients')}}"><button class="middle none center mr-4 rounded-lg bg-blue-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none 
        active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        data-ripple-light="true"> Back</button></a>
    
</div>
<div class="flex items-center justify-center p-12">
    <div class="mx-auto w-full max-w-full">
      <form action="{{ route('admin.patients.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="-mx-3 flex flex-wrap">
          <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
              <label
                for="name"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Full name
              </label>
              <input
              value="{{old('name')}}"
                type="text"
                name="name"
                id="name"
                placeholder="Name"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              />
              @error('name')
              <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
          </div>
          <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
              <label
                for="email"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Email
              </label>
        
              <input
              value="{{old('email')}}"
                type="email"
                name="email"
                id="email"
                placeholder="Email"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              />
              @error('email')
              <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
          </div>

          <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
              <label
                for="password"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Password
              </label>
              <input
                value="{{old('password')}}"
                type="password"
                name="password"
                id="password"
                placeholder="Password"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              />
              @error('password')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>

          <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
              <label
                for="phone"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Phone
              </label>
              <input
              
              value="{{old('phone')}}"
                type="text"
                name="phone"
                id="phone"
                placeholder="Phone"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              />
              @error('phone')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>

          <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
              <label
                for="address"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Address
              </label>
              <input
              value="{{old('address')}}"
                type="text"
                name="address"
                id="address"
                placeholder="Address"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              />
              @error('address')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>

          <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
              <label for="url_image" class="mb-3 block text-base font-medium text-[#07074D]">
                Avatar
              </label>
              <input type="file" name="url_image" id="url_image" class="hidden" />
              <label for="url_image" class="flex items-center justify-center w-full h-12 rounded-md border border-[#e0e0e0] bg-white text-[#6B7280] cursor-pointer hover:bg-gray-100 focus:outline-none focus:border-[#6A64F1] focus:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="ml-2">Upload Avatar</span>
              </label>
              @error('url_image')
              <span class="text-danger">{{$message}}</span>
              @enderror

            </div>
          </div>

        </div>

        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2">
              <div class="mb-5">
                <label
                  for="health_condition"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  Health conditional
                </label>
                <textarea
                value="{{old('health_condition')}}"
                  type="text"
                  name="health_condition"
                  id="health_condition"
                  placeholder="Health conditional"
                  class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                ></textarea>
                @error('health_condition')
                <span class="text-danger">{{$message}}</span>
                @enderror

              </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                  <label
                    for="note"
                    class="mb-3 block text-base font-medium text-[#07074D]"
                  >
                    Note
                  </label>
                  <textarea
                  value="{{old('note')}}"
                    type="text"
                    name="note"
                    id="note"
                    placeholder="Note"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                  ></textarea>
                  @error('note')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
  
          </div>
  
        
  
        <div>
          <button type="submit"
          class="middle none center mr-4 rounded-lg bg-blue-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none 
          active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
          data-ripple-light="true" >
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>


      
@endsection
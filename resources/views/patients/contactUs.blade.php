@extends('layouts.patients.master')
@section('title', 'Mental Health Care')

@section('header')
  @parent 
@endsection

@section('content')
<section class="contact-us-section">
  <h2 class="contact-us-heading">
    <span style="color: rgba(28, 187, 208, 1)">Contact</span> Us
  </h2>
  <p class="ps-3 py-3">
    "With profound knowledge and meticulousness, doctors ensure all decisions are made accurately and carefully."
  </p>
  <div class="contact-us-content">
    <div class="contact-us-columns">
      <div class="contact-us-image-column">
        <img src="assets/patients/images/photo4.png" alt="Contact us" class="contact-us-image">
      </div>
      <div class="contact-us-form-column">
        <div class="contact-us-form-heading">
          Free <span style="color: rgba(28, 187, 208, 1)">Consultation</span>
        </div>
        {{-- Hiển ra thông báo đã gửi thành công --}}
        @if (session()->has('success'))
          <div class="relatives flex flex-col sm:flex-row sm:items-center bg-green-600 shadow rounded-md py-3 pl-6 pr-8 sm:pr-6 mb-3 mt-4">
            <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto">
                <div class="text-green-500" dark:text-gray-500="">
                    <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="text-sm text-gray font-medium ml-3">Success!.</div>
            </div>
            <div class="text-sm tracking-wide text-white sm:mt-0 sm:ml-4"> Your message has been sent successfully.</div>
            <div class="absolute sm:relative sm:top-auto sm:right-auto ml-auto left-3 top-2 text-white cursor-pointer">
              <svg class="w-4 h-4 custom-cursor-on-hover" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
          </div>
        @endif

        <form action="{{route('contact.send')}}" method="POST" style="width: 90%; padding-top: 5%">
          @csrf
          <div class="flex flex-wrap -m-2">
            <div class="p-2 w-1/2">
              <div class="relative">
                <label for="name" class="leading-7 text-sm text-black-400">Full Name</label>
                <input type="text" id="name" name="name" class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 text-base outline-none text-black-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('name') }}">
              </div>
              @error('name')
                <span class="text-red-500">{{$message}}</span>
              @enderror
            </div>
            <div class="p-2 w-1/2">
              <div class="relative">
                <label for="email" class="leading-7 text-sm text-black-400">Email</label>
                <input type="email" id="email" name="email" class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 text-base outline-none text-black-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('email') }}">
              </div>
              @error('email')
                <span class="text-red-500">{{$message}}</span>
              @enderror
            </div>
            <div class="p-2 w-full">
              <div class="relative">
                <label for="message" class="leading-7 text-sm text-black-400">Message</label>
                <textarea id="message" name="message" class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 h-32 text-base outline-none text-black-100 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out" value="{{ old('message') }}"></textarea>
              </div>
              @error('message')
                <span class="text-red-500">{{$message}}</span>
              @enderror
            </div>
            <div class="p-2 w-full pt-4">
              <button href="#" type="submit" class="flex mx-auto text-white border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg" style=" padding-top: 5%; background-color: #e61f57;">SEND A MESSAGE</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

@section('footer')
  @parent 
@endsection
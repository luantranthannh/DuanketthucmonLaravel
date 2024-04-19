@extends('layouts.patients.master')
@section('title', 'Mental Health Care')

@section('header')
@parent
@endsection

@section('content')
<style>
    #title{
        margin-left: 130px;
    }
</style>
<body class="bg-gray-100">
    <div class="container">         
    <div class="grid grid-cols-4 gap-4">
    <?php foreach ($carts as $cart) : ?>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4">
                <h2 id="title" class="text-2xl font-semibold text-gray-800">Cart</h2>
            </div>
            <form action="/patient/cart/booking" method="POST" class="p-6">
                <div class="mb-4">
                    <label for="customer_name" class="block text-gray-800 text-sm font-semibold mb-2">ID</label>
                    <input type="text" id="customer_name" class="form-input w-full" name="patientId" value="{{$cart->patient_id}}">
                </div>
                <div class="mb-4">
                    <label for="doctor_name" class="block text-gray-800 text-sm font-semibold mb-2">Doctor name:</label>
                    <input type="text" id="doctor_name" class="form-input w-full" value="{{$cart->name}}">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="start_time" class="block text-gray-800 text-sm font-semibold mb-2">Start time:</label>
                        <input type="time" id="start_time" class="form-input w-full" value="{{$cart->time_start}}">
                    </div>
                    <div class="mb-4">
                        <label for="end_time" class="block text-gray-800 text-sm font-semibold mb-2">End time:</label>
                        <input type="time" id="end_time" class="form-input w-full"  value="{{$cart->time_end}}">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-800 text-sm font-semibold mb-2">Date:</label>  
                    <input type="text" id="" class="form-input w-full" name="selectedDate" value="{{$cart->date_booking}}">
                </div>
                <input type="hidden"class="form-input w-full" name="doctorId" value="{{$cart->doctor_id}}">
                <input type="hidden"class="form-input w-full" name="id" value="{{$cart->time_id}}">
                <div class="mb-4">
                    <label for="price" class="block text-gray-800 text-sm font-semibold mb-2">Price:</label>
                    <input type="number" id="price" class="form-input w-full"  value="{{$cart->price}}">
    </div>
                <button type="summit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Confirm payment</button>
            </form>
        </div>
        <?php endforeach; ?>
        </div>
    </div>
</body>
@endsection

@section('footer')
  @parent 
@endsection

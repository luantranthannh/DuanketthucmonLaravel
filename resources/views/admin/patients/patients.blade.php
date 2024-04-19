@extends('layouts.admin.admin')

@section('content')
<div class="head-title">
    <div class="left">
        <h1>Management patient</h1>
    </div>
    <form class="form-inline" method="get" action="{{ url('admin/patients/search') }}">
        <input name='search' value="{{isset($search) ? $search : ''}}" class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
    {{-- <a href="{{url('/admin/patients/create')}}"><button class="btn btn-primary"
        data-ripple-light="true"> Add</button></a> --}}
    
</div>
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@elseif(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<table class="border-collapse w-full">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Patient name</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Email</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Phone</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Address</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Health conditional</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Note </th>
           
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            {{-- name --}}
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <div class="flex items-center">
                    <img src="{{ asset('assets/admin/images/'.$patient->url_image) }}" alt="Avatar" class="w-10 h-10 rounded-full mr-2" >
                    <span>{{$patient->name}}</span>
                </div>
            </td>
            {{-- email --}}
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                {{$patient->email}}
            </td>
            {{-- phone --}}
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                {{$patient->phone}}
            </td>
            {{-- address --}}
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                {{$patient->address}}
            </td>
            {{-- health conditional --}}
            <td style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                {{$patient->health_condition}}
            </td>
            {{-- note --}}
            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                {{$patient->note}}
            </td>
          
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <a href="{{ route('edit.patient', $patient->user_id) }}">
                    <button type="button" class="btn btn-primary">Update</button>
                </a>
                <a href="{{ route('delete_patient', $patient->user_id) }}">
                    <button type="button" class="btn btn-danger">Block</button>
                </a>

                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

      
@endsection
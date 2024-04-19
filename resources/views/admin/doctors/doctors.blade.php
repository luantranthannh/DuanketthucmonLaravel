@extends('layouts.admin.admin')

@section('content')
<div class="head-title">
    <div class="left">
        <h1>Management doctor</h1>
    </div>
    <form class="form-inline" method="get" action="{{ url('admin/doctors/search_doctor/search') }}">
        <input name='search' value="{{isset($search) ? $search : ''}}" class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
    </form>

    <a href="{{url('/admin/doctors/create')}}"><button class="btn btn-primary" data-ripple-light="true">Add new doctor</button></a>

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
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Doctor name</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Email</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Phone</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Specialization</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Description</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($doctors as $doctor)
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <div class="flex items-center">
                    <img src="{{ asset('assets/admin/images/'.$doctor->url_image) }} " alt="Avatar" class="w-10 h-10 rounded-full mr-2" >
                    <span>{{$doctor->name}}</span>
                </div>
            </td>
            <td  style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                {{$doctor->email}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                {{$doctor->phone}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                {{$doctor->specialization}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                {{$doctor->description}}
            </td>

            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <a href="{{url('/admin/doctors/'.$doctor->user_id.'/edit')}}"><button type="button" class="btn btn-primary">Update</button></a>
                <a href="{{route('deletedoctor',$doctor->user_id)}}"><button type="button" class="btn btn-danger">Block</button></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

      
@endsection
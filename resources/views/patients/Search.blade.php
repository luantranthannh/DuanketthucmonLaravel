
@extends('layouts.patients.master')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }
    .container-search {
        display: flex;
        background-color: black;
        border-radius: 10px;
        padding: 5px 0;
        margin-left: 50px;
        margin-right: 150px;
    }
    .container {
        width: 100%;
        margin: 0 auto;
        padding: 20px;

    }
    .lists_card {
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;
    }
    .lists_card>div {
        width: calc(25% - 20px);
        margin-bottom: 20px;
        cursor: pointer;
    }

    .max-w-sm {
        max-width: 100%;
        overflow: hidden;
    }

    .max-w-sm {
        margin-right: 20px;
    }
    .max-w-sm img {
        width: 100%;
        height: auto;
        border-top-left-radius: 0.375rem;
        border-top-right-radius: 0.375rem;
    }
    .p-5 {
        padding: 1.25rem;
    }
    .mb-2 {
        margin-bottom: 0.5rem;
    }
    .text-2xl {
        font-size: 1.5rem;
    }
    .font-bold {
        font-weight: 700;
    }
    .tracking-tight {
        letter-spacing: -0.0125em;
    }
    .text-gray-900 {
        color: #333;
    }
    .dark:text-white {
        color: #fff;
    }
    .bg-white {
        background-color: #fff;
    }
    .dark:bg-gray-800 {
        background-color: #2d2d2d;
    }
    .border {
        border-width: 1px;
    }
    .rounded-lg {
        border-radius: 0.375rem;
    }
    .shadow {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .dark:border-gray-700 {
        border-color: #4a5568;
    }
    .dark:hover:border-gray-500 {
        border-color: #cbd5e0;
    }
    #input {
        width: 95%;
        border-radius: 10px;
        padding: 10px;
        box-sizing: border-box;
        margin-left: 10px;
    }
    #icon-search {
        background-color: black;
        margin-left: 10px;
    }
    .content {
        margin-top: 20px;
        margin-left: 50px;
    }
    .title {
        font-size: 25px;
        font-weight: bolder;
    }
    #title{
        text-align: center;
    }

    .rounded-t-lg {
        height: 300px !important;
        object-fit: cover;
    }
    @media screen and (max-width: 600px) {
        #icon-search {
            margin-left: 10px;
        }
        .container-search {
            flex-direction: column;
            align-items: center;
        }
    }
</style>
@section('content')
<body>
    <div class="container">
        <div class="container-search ">
            <input type="text" id="input">
            <button type="button" id="icon-search" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Search</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" />
                </svg>
            </button>
        </div>
        <div class="content">
            <h1 class="title">Search results</h1>
            <div class="lists_card" id="lists_card">               

            </div>
            <h1 id="title" class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-4xl dark:text-white">Find your expert now</h1>
        </div>
    </div>
</body>
@endsection
@section('JScontent')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript">
    function redirectBooking(doctorId) {
        window.location.href = 'doctor/' + doctorId + '/booking';
    }
    var searchButton = document.getElementById("icon-search");
    var listsCard = document.querySelector(".lists_card");
    searchButton.addEventListener("click", function() {
        document.getElementById("title").style.display = "none"
        var key = document.getElementById('input').value;
        if(key == "") {
            document.getElementById("title").style.display = "block"
            document.getElementById('title').innerHTML = "Enter your name Doctor" ;
            document.getElementById('lists_card').innerHTML = " ";
            return;
        }
        axios.post('/api/patient/search', {
                key
            })
        .then(res => {
            if (res.status === 200) {
                var listDoctor = res.data.ListDoctor;
                if(listDoctor == ""){
                    document.getElementById("title").style.display = "block"
                    document.getElementById("title").innerHTML = "The expert you seek is not available"
                    document.getElementById('title1').style.display = "none" ;
                    document.getElementById('lists_card').innerHTML = " ";
                    return;
                }
                console.log(listDoctor)
                document.getElementById('lists_card').innerHTML = " ";
                listDoctor.forEach(doctor => {
                    var doctorContainer = document.createElement("div");
                    doctorContainer.className = "max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700";
                    doctorContainer.onclick = function() {
                        redirectBooking(doctor.id);
                    };

                    var img = document.createElement("img");
                    img.className = "rounded-t-lg object-cover";
                    var doctorImageUrl = "assets/admin/images/"+doctor.url_image;
                    img.src = doctorImageUrl;
                    img.alt = "";

                    var doctorInfoDiv = document.createElement("div");
                    doctorInfoDiv.className = "p-5";

                    var doctorNameH5 = document.createElement("h5");
                    doctorNameH5.className = "mb-2 text-2xl font-bold tracking-tight text-gray-900";
                    doctorNameH5.textContent = "Bs. " + doctor.name;

                    doctorInfoDiv.appendChild(doctorNameH5);
                    doctorContainer.appendChild(img);
                    doctorContainer.appendChild(doctorInfoDiv);

                    listsCard.appendChild(doctorContainer);
                });
            }
        });
    });
</script>
@endsection
@section('footer')
  @parent 
@endsection
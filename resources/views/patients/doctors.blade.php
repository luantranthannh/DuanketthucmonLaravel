@extends('layouts.patients.master')
@section('title', 'Mental Health Care')

@section('header')
@parent
@endsection
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
</style>
<script src="https://cdn.tailwindcss.com"></script>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        width: 100%;
        margin-left: 0px;
    }

    .header {
        width: 100%;
    }

    .title,
    .sub_title {
        text-align: center;
    }

    .titles {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .title {
        font-size: 50px;
        font-weight: bolder;
        font-family: Georgia, "Times New Roman", Times, serif;
        margin-top: 80px;
    }

    .sub_title {
        font-size: 22px;
        margin-top: 20px;
    }


    .imgDoctor {
        width: 100%;
    }

    .max-w-sm {
        margin: 10px;
    }

    /* Doctor list styles */
    .title_lists {
        text-align: center;
        padding: 20px 0;
    }

    .lists_card {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        padding-top: 5%;
    }

    .max-w-sm {
        width: calc(25% - 20px);
        margin-bottom: 20px;
        box-sizing: border-box;
    }

    .rounded-t-lg {
        width: 100%;
    }

    .listPage {
        padding: 10px;
        text-align: center;
        list-style: none;
    }

    .listPage li {
        background-color: #ffffffBD;
        padding: 5px 15px 5px 15px;
        display: inline-block;
        margin: 0 10px;
        cursor: pointer;
        border-radius: 5px;
    }

    .listPage .active {
        background-color: black;
        color: #fff;
    }

    .color {
        color: #1CBBD0;
    }

    @media only screen and (max-width: 768px) {
        .title {
            font-size: 30px;
        }

        .sub_title {
            font-size: 16px;
            top: 20px;
            left: 0;
            width: 100%;
        }

        .lists_doctor {
            font-size: 36px;
        }

        .max-w-sm {
            width: calc(50% - 20px);
        }
    }

    #myDiv {
        background-color: #1CBBD0;
        color: white;
        text-align: center;
        cursor: pointer;
    }

    li {
        cursor: pointer;
    }
</style>
@section('content')
<div class="container" style="margin-left: -15px;">
    <div class="header">
        <h1 class="title" style="width: 100%;"><span class="color">Team of doctors </span>of different specialties</h1>
        <p class="sub_title">
            We would like to extend our warm greetings and express our gratitude for your interest in our services. This website was created with the aim of providing you with excellent experiences and high-quality services.
        </p>
    </div>

    <ul class="nav justify-content-center tab">
        <li class="nav-item tablinks" onclick="openTab(event, 'Psycho doctor')">
            <a class="nav-link active" aria-current="page">Psycho doctors</a>
        </li>
        <li class="nav-item tablinks">
            <a class="nav-link" onclick="openTab(event, 'Pediatrician')">Pediatricians</a>
        </li>
        <li class="nav-item tablinks" onclick="openTab(event, 'Neurologist')">
            <a class="nav-link">Neurologist</a>
        </li>
    </ul>
    <div class="lists_card" id="lists_card">
        <div id="Psycho doctor" class="tabcontent container-fluid">
            <h3 id="myDiv" style="border-radius:10px;">Psycho doctors</h3>
            <ul id="doctorListPsycho doctor">
                <!-- Danh sách bác sĩ sẽ được hiển thị ở đây -->
                <?php foreach ($psychoDoctors as $doctor) : ?>
                    <li class="list-unstyled max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex-column justify-content-between d-inline-block">
                        <a href="#">
                            <img class="rounded-t-lg h-60 object-cover" src="{{asset('assets/admin/images/'.$doctor->url_image)}}" alt="" />
                        </a>
                        <div class="p-2" onclick="redirectBooking('{{$doctor->id}}')">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark">Bs. {{$doctor->name}}</h5>
                        </div>
                        <!-- Thêm biểu tượng yêu thích -->
                        <button type="button" class="btn btn-danger" data-doctor-id="{{$doctor->id}}" onclick="addToFavorites(this)" style="width: 100%;">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                            Like
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div id="Pediatrician" class="tabcontent">
        <h3 id="myDiv" style="border-radius:10px;">Pediatricians</h3>
        <ul id="doctorListPediatrician">
            <!-- Danh sách bác sĩ chuyên khoa nhi sẽ được hiển thị ở đây -->
            <?php foreach ($psychologists as $doctor) : ?>
                <li class="list-unstyled max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex-column justify-content-between d-inline-block">
                    <a href="#">
                        <img class="rounded-t-lg h-60 object-cover" src="{{asset('assets/admin/images/'.$doctor->url_image)}}" alt="" />
                    </a>
                    <div class="p-2" onclick="redirectBooking('{{$doctor->id}}')">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark">Bs. {{$doctor->name}}</h5>
                    </div>
                    <!-- Thêm biểu tượng yêu thích -->
                    <button type="button" class="btn btn-danger" data-doctor-id="{{$doctor->id}}" onclick="addToFavorites(this)" style="width: 100%;">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        Like
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div id="Neurologist" class="tabcontent">
        <h3 id="myDiv" style="border-radius:10px;">Neurologists</h3>
        <ul id="doctorListNeurologist">
            <!-- Danh sách bác sĩ chuyên da liễu sẽ được hiển thị ở đây -->
            <?php foreach ($neurologists as $doctor) : ?>
                <li class="list-unstyled max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex-column justify-content-between d-inline-block">
                    <a href="#">
                        <img class="rounded-t-lg h-60 object-cover" src="{{asset('assets/admin/images/'.$doctor->url_image)}}" alt="" />
                    </a>
                    <div class="p-2" onclick="redirectBooking('{{$doctor->id}}')">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark">Bs. {{$doctor->name}}</h5>
                    </div>
                    <!-- Thêm biểu tượng yêu thích -->
                    <button type="button" class="btn btn-danger" data-doctor-id="{{$doctor->id}}" onclick="addToFavorites(this)" style="width: 100%;">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        Like
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <ul class="listPage"></ul>
</div>
<div class="btn btn-primary" style="position: fixed; top: 90%; left: 95%; transform: translate(-50%, -50%); z-index:999;" onclick="sortList()">SORT</div>
@endsection
@section('JScontent')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function redirectBooking(doctorId) {
        window.location.href = 'doctor/' + doctorId + '/booking';
    }

    // Mở tab và hiển thị nội dung của tab được chọn
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        document.getElementById(tabName).style.display = "block";
    }

    // Mặc định hiển thị tab "Psycho doctor" khi trang được tải
    document.getElementById("defaultOpen"); 


    var isSorted = false; // Biến đánh dấu trạng thái sắp xếp

    function sortList() {
        var list, i, switching, b, shouldSwitch;
        list = document.getElementById("lists_card");
        switching = true;
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            b = list.getElementsByTagName("LI");
            // Loop through Psycho doctor list items:
            for (i = 0; i < (b.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Check if the next item should
                switch place with the current item: */
                if (!isSorted) {
                    if (b[i].innerHTML.toLowerCase() > b[i + 1].innerHTML.toLowerCase()) {
                        /* If next item is alphabeticPsycho doctory lower than current item,
                        mark as a switch and break the loop: */
                        shouldSwitch = true;
                        break;
                    }
                } else {
                    if (b[i].innerHTML.toLowerCase() < b[i + 1].innerHTML.toLowerCase()) {
                        /* If next item is alphabeticPsycho doctory lower than current item,
                        mark as a switch and break the loop: */
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark the switch as done: */
                b[i].parentNode.insertBefore(b[i + 1], b[i]);
                switching = true;
            }
        }
        isSorted = !isSorted; // Đảo ngược trạng thái sắp xếp
    }


    let thisPage = 1;
    let limit = 8;
    let list = document.querySelectorAll('.lists_card .max-w-sm');

    function loadItem() {
        let beginGet = limit * (thisPage - 1);
        let endGet = limit * thisPage - 1;
        list.forEach((item, key) => {
            if (key >= beginGet && key <= endGet) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
        listPage();
    }

    function listPage() {
        let count = Math.ceil(list.length / limit);
        let listPageContainer = document.querySelector('.listPage');
        listPageContainer.innerHTML = '';

        if (thisPage > 1) {
            let prev = document.createElement('li');
            prev.innerText = 'PREV';
            prev.setAttribute('onclick', "changePage(" + (thisPage - 1) + ")");
            listPageContainer.appendChild(prev);
        }

        for (let i = 1; i <= count; i++) {
            let newPage = document.createElement('li');
            newPage.innerText = i;
            if (i === thisPage) {
                newPage.classList.add('active');
            }
            newPage.setAttribute('onclick', "changePage(" + i + ")");
            listPageContainer.appendChild(newPage);
        }

        if (thisPage < count) {
            let next = document.createElement('li');
            next.innerText = 'NEXT';
            next.setAttribute('onclick', "changePage(" + (thisPage + 1) + ")");
            listPageContainer.appendChild(next);
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        var likedItems = JSON.parse(localStorage.getItem('likedItems')) || [];
        likedItems.forEach(function(doctorId) {
            var heartIcon = document.querySelector('button[data-doctor-id="' + doctorId + '"] i.fa-heart');
            if (heartIcon) {
                heartIcon.classList.add('liked');
                heartIcon.style.color = 'red';
            }
        });
    });

    function addToFavorites(button) {
        var doctorId = button.getAttribute('data-doctor-id');
        const userInfo = localStorage.getItem("user-info");
        var heartIcon = button.querySelector('i.fa-heart');

        if (heartIcon && doctorId) {
            var iconClassList = heartIcon.classList;
            var likedClass = 'liked';

            // Kiểm tra xem nút đã được thích hay chưa bằng cách kiểm tra class 'liked'
            if (iconClassList.contains(likedClass)) {
                iconClassList.remove(likedClass);
                heartIcon.style.color = 'white'; // Chuyển sang biểu tượng trái tim không được thích
                removeFromLikedItems(doctorId);
            } else {
                iconClassList.add(likedClass);
                heartIcon.style.color = 'red'; // Chuyển sang biểu tượng trái tim được thích
                addToLikedItems(doctorId);
            }
        }
        if (userInfo !== null) {
            const userData = JSON.parse(userInfo);
            const userId = userData.roleId;

            axios.post('/doctor/favorite', {
                    userId: userId,
                    doctorId: doctorId
                })
                .then(res => {
                    console.log(res.data)
                })
                .catch(err => {
                    console.error('Has error:', err)
                })
        }

    }

    function addToLikedItems(doctorId) {
        var likedItems = JSON.parse(localStorage.getItem('likedItems')) || [];
        if (!likedItems.includes(doctorId)) {
            likedItems.push(doctorId);
            localStorage.setItem('likedItems', JSON.stringify(likedItems));
        }
    }

    function removeFromLikedItems(doctorId) {
        var likedItems = JSON.parse(localStorage.getItem('likedItems')) || [];
        var index = likedItems.indexOf(doctorId);
        if (index !== -1) {
            likedItems.splice(index, 1);
            localStorage.setItem('likedItems', JSON.stringify(likedItems));
        }
    }

    function changePage(i) {
        thisPage = i;
        loadItem();
    }

    loadItem();

    // Chọn phần tử có lớp "nav justify-content-center tab"
    const navElement = document.querySelector('.nav.justify-content-center.tab');

    // Vị trí cuộn cụ thể bạn muốn áp dụng CSS (ví dụ: 300px)
    const scrollPosition = 1060;
    

    // Thêm sự kiện scroll cho cửa sổ
    window.addEventListener('scroll', function() {
        // Kiểm tra vị trí cuộn hiện tại
        const currentScrollY = window.pageYOffset || document.documentElement.scrollTop;
        // Kiểm tra xem vị trí cuộn có đạt đến vị trí cụ thể không
        if (currentScrollY >= scrollPosition) {
            // Áp dụng CSS cho phần tử
            navElement.style.position = 'fixed';
            navElement.style.top = '10%';
            navElement.style.left = '50%';
            navElement.style.backgroundColor = 'lightblue';
            navElement.style.transform = 'translate(-50%, -50%)';
            navElement.style.zIndex = '999';
        } else {
            // Nếu vị trí cuộn thấp hơn vị trí cụ thể, loại bỏ CSS
            navElement.style.position = '';
            navElement.style.top = '';
            navElement.style.left = '';
            navElement.style.backgroundColor = '';
            navElement.style.transform = '';
            navElement.style.zIndex = '';
        }
    });
</script>
@endsection
@section('footer')
@parent
@endsection
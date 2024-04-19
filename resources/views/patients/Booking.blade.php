
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Care</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Beau+Rivage&family=Poppins&display=swap');
    </style>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Volkhov:ital,wght@0,400;0,700;1,700&family=Yesteryear&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.3/axios.min.js" integrity="sha512-JWQFV6OCC2o2x8x46YrEeFEQtzoNV++r9im8O8stv91YwHNykzIS2TbvAlFdeH0GVlpnyd79W0ZGmffcRi++Bw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    body {
        background-color: beige;
    }

    a {
        display: block;
        width: 100%;
        height: 40px;
        line-height: 40px;
        font-size: 18px;
        font-family: sans-serif;
        text-decoration: none;
        color: #333;
        border: 1px solid #333;
        letter-spacing: 2px;
        text-align: center;
        position: relative;
        transition: all .35s;
    }

    .date {
        background: rgb(59 130 246);
    }

    .container {
        width: 100%;
    }

    #timeContainer {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        margin: 20px 0px 0px 10px;
    }

    .col-span-1 {
        width: 200px;
    }

    .checkbox-selected {
        background-color: rgb(59 130 246);
    }


    @keyframes fade-in {
        0% {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.5);
        }

        100% {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }

    .booking-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9998;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.5s ease-in-out;
    }

    .booking-overlay-visible {
        opacity: 1;
        pointer-events: auto;
    }

    .col-span-1 {
        width: calc(25% - 20px);
        margin-bottom: 20px;
        box-sizing: border-box;
    }

    .booking-success {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.5);
        opacity: 0;
        background-color: #f0f0f0;
        border: 2px solid #ccc;
        padding: 20px;
        z-index: 9999;
        animation: fade-in 0.5s ease-in-out forwards;
    }


    .booking-success-hidden {
        display: none;
    }

    .booking-success-visible {
        opacity: 1;
    }

    .booking-success-text {
        font-size: 18px;
        font-weight: bold;
    }

    #container {
        background-color: #f0f0f0;
    }

    .paragrap {
        margin-top: 20px;
    }

    .row {
        padding: 5px 0px 5px 0px;
    }

    #header {
        margin-top: 20px;
        width: 100%;
    }


    #price-booking {
        margin-top: 50px;
    }

    #prices {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 30px;
    }

    #price {
        padding: 0px 5px 0px 5px;
    }

    #name {
        margin-top: 25px;
    }

    #fullname {
        font-size: 20px;
    }

    #error {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 30px;
        font-size: 20px;
        color: red;
    }

    #notification {
        color: red;
        margin: auto;
        font-size: 30px;
        font-weight: bolder;
    }
</style>

<div id="container" class="w-full px-5 py-24 mx-auto ">
    <div class="flex flex-col lg:flex-row lg:space-x-12 h-3/4">
        <div class="w-full max-w-screen-sm m-auto mt-12 lg:w-1/4 lg:order-first">
            <div class="p-2 transition duration-500 ease-in-out transform bg-white border rounded-lg">
                <div id="image-div" class="w-full h-3/4 object-cover">
                    <img src="{{asset('assets/admin/images/'.$doctor[0]->url_image)}}" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
        <div class="w-full px-4 mt-12 prose lg:px-0 lg:w-3/4">
            <div class="mb-5 border-b border-gray-200">
                <div class="flex flex-wrap items-baseline mt-2">
                    <h1 class="css-1jxf684 text-2xl font-bold leading-[20.8px] text-primary text-blue-600">Doctor, Psychologist  {{$doctor[0]->name}}</h1>
                    <div class="paragrap">
                        <p class="row">Expert in counseling for stress reduction, psychological crisis, improving sleep quality, and deep sleep in adolescents and adults.</p>
                        <p class="row">Expert in school psychological intervention, assisting parents and teachers in managing oppositional behavior, disciplinary violations of students, or helping students build healthy friendships.</p>
                        <p class="row">Expert in counseling to overcome loss, separation, sexual abuse and harassment, domestic violence, workplace violence, accidents, disasters, or stress related to legal issues.</p>
                    </div>
                </div>
                <div id="header" class="w-full bg-blue-500 p-2 text-white text-center mt-2">
                    <h1 class="text-2xl">Doctor's Consultation Schedule</h1>
                    <input type="date" class="date" id="dateInput">
                </div>
                <div id="timeContainer">
                    <p id="notification"></p>
                </div>

                <div id="booking-overlay" class="booking-overlay booking-overlay-hidden"></div>

                <div id="booking-success" class="booking-success booking-success-hidden">
                    <span class="booking-success-text">Appointment successfully booked</span>
                </div>
                <div id="price-booking" class="flex justify-end mt-5">
                    <p id="error"></p>
                    <div id="prices" class="flex justify-center items-center mr-3"> Price:
                        <div id="price"></div>
                        VND
                    </div>
                    <button type="submit" onclick="Payment()" class="px-6 py-3 text-lg font-semibold text-white transition duration-500 ease-in-out transform bg-blue-600 border border-current rounded hover:bg-blue-700 focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2">Make an appointment</button>
                    <button type="submit" onclick="Cart()" class="px-6 py-3 text-lg font-semibold text-white transition duration-500 ease-in-out transform bg-blue-600 border border-current rounded hover:bg-blue-700 focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2">Add to cart</button>
                    <button class="px-6 py-3 text-lg font-semibold text-white transition duration-500 ease-in-out transform bg-blue-600 border border-current rounded hover:bg-blue-700 focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2"><a href="/doctors" style="border: none;">Back</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
  
        var doctorId = ""
    var patientId = ""

    var url = window.location.href; // Lấy đường dẫn URL hiện tại trên trình duyệt

    var startIndex = url.indexOf("/doctor/") + 8; // Tìm vị trí bắt đầu của số "2059" (8 là độ dài của "/doctor/")
    var endIndex = url.indexOf("/booking"); // Tìm vị trí kết thúc của số "2059"
    var idSubstring = url.substring(startIndex, endIndex); // Lấy phần chuỗi giữa vị trí bắt đầu và kết thúc
    var id = parseInt(idSubstring, 10); // Chuyển chuỗi thành số nguyên
    doctorId = id; // Gán giá trị "id" vào biến doctorId
    
    var totalPrice = document.getElementById("price").innerHTML = 0
    var Time =""
    var currentDate = new Date().toISOString().split('T')[0];
    document.getElementById('dateInput').value = currentDate;
    document.getElementById('dateInput').setAttribute('min', currentDate);
    var selectedDate = currentDate
    axios.post('/patient/list-doctor/booking/time', {
            doctorId,
            selectedDate
        })
        .then(res => {
            const listTimes = res.data.listTime
            if (res.status === 201) {
                console.log("Selected Date: " + selectedDate);
                if (listTimes != 0) {
                    console.log(listTimes)
                    resultTime(listTimes)
                } else {
                    document.getElementById("notification").innerHTML = "This day's schedule is fully booked"
                }
            }
        })

    dateInput.addEventListener('change', function() {
        document.getElementById("error").innerHTML = ""
        time = ""
        var selectedDate = dateInput.value;
        var totalPrice = document.getElementById("price").innerHTML = 0
        console.log("Selected Date: " + selectedDate);
        axios.post('/patient/list-doctor/booking/time', {
                doctorId,
                selectedDate
            })
            .then(res => {
                const listTimes = res.data.listTime
                if (res.status === 201) {
                    console.log("Select: " + selectedDate);
                    if (listTimes != 0) {
                        console.log(listTimes);
                        resultTime(listTimes)
                    } else {
                        document.getElementById("notification").innerHTML = "This day's schedule is fully booked"
                    }

                }
            })
    });
    var selectedTimeId = ""

    function resultTime(listTime) {
        var timeContainer = document.getElementById("timeContainer");
        timeContainer.innerHTML = "";


        for (var i = 0; i < listTime.length; i++) {
            (function(index) {
                var label = document.createElement("label");
                label.className =
                    "col-span-1 flex items-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded m-2";
                var totalPrice = 0;
                var radio = document.createElement("input");
                radio.type = "radio";
                radio.name = "selectedTime";
                radio.className = "hidden";
                radio.setAttribute("id", "hidden");
                radio.value = index; // Lấy giá trị giờ từ listTime
                var timeText = document.createElement("span");
                var timeTextId = "timeText" + index;
                timeText.setAttribute("id", timeTextId);
                timeText.textContent = listTime[index].time_start+" - "+listTime[index].time_end;
                label.appendChild(radio);
                label.appendChild(timeText);
                label.addEventListener("click", function() {
                    var checkedRadio = document.querySelector('input[name="selectedTime"]:checked');
                    if (checkedRadio) {
                        checkedRadio.parentNode.classList.remove("checkbox-selected");
                        var checkedTimeTextId = "timeText" + checkedRadio.value;
                        var checkedTimeTextElement = document.getElementById(checkedTimeTextId);
                        if (checkedTimeTextElement) {
                            checkedTimeTextElement.style.color = "";
                        }
                    }
                    radio.checked = true;
                    this.classList.add("checkbox-selected");
                    timeText.style.color = "#fff";
                    selectedTimeId = listTime[index].id;
                    Time = listTime[index].time_start+" - "+listTime[index].time_end;
                    price = listTime[index].price;
                    document.getElementById("price").innerHTML = price

                });
                timeContainer.appendChild(label);
            })(i);
        }
    }


    var data = localStorage.getItem("user-info");
    if (data) {
        var jsonData = JSON.parse(data);
        var id = jsonData.roleId;
        var name = jsonData.fullName;
        patientId = id
        console.log(patientId)
    }

    function Cart() {
        {
            var selectedDate = dateInput.value;
            console.log(patientId);
            console.log(doctorId);
            console.log(selectedTimeId);
            console.log(selectedDate);
            axios.post('/add-to-cart', {
                    patientId: patientId,
                    doctorId: doctorId,
                    id: selectedTimeId,
                    selectedDate: selectedDate
                })
                .then(res => {
                    if (res.status === 200) {
                        window.location.href = "/add-to-cart/"+patientId
                    }

                }).catch(error => {
                    if (error.response.status === 404) {
                        document.getElementById("error").innerHTML = "Please select a time before making an appointment"
                    }
                })
        }
    }


    function Payment() {
        {
            var selectedDate = dateInput.value;
            window.location.href = "/payment/"+patientId+"/"+doctorId+"/"+selectedDate+"/"+selectedTimeId
        }
    }
    
</script>
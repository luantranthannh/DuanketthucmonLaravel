<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<style>
    #title{
        margin-left: 160px;
    }
</style>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4">
                <h2 id="title" class="text-2xl font-semibold text-gray-800">Payment</h2>
            </div>
            <form class="p-6">
                <div class="mb-4">
                    <label for="customer_name" class="block text-gray-800 text-sm font-semibold mb-2">Patient name:</label>
                    <input type="text" id="customer_name" class="form-input w-full" value="{{$patient[0]->name}}">
                </div>
                <div class="mb-4">
                    <label for="doctor_name" class="block text-gray-800 text-sm font-semibold mb-2">Doctor name:</label>
                    <input type="text" id="doctor_name" class="form-input w-full" value="{{$doctor[0]->name}}">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="start_time" class="block text-gray-800 text-sm font-semibold mb-2">Start time:</label>
                        <input type="time" id="start_time" class="form-input w-full" value="{{$time[0]->time_start}}">
                    </div>
                    <div class="mb-4">
                        <label for="end_time" class="block text-gray-800 text-sm font-semibold mb-2">End time:</label>
                        <input type="time" id="end_time" class="form-input w-full"  value="{{$time[0]->time_end}}">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-800 text-sm font-semibold mb-2">Date:</label>  
                    <input type="text" id="" class="form-input w-full" value="{{$date}}">
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-800 text-sm font-semibold mb-2">Price:</label>
                    <input type="number" id="price" class="form-input w-full"  value="{{$time[0]->price}}">
                </div>
                <div class="mb-4">
                    <label for="payment_method" class="block text-gray-800 text-sm font-semibold mb-2">Payment method:</label>
                    <select id="payment_method" class="form-select w-full"> 
                        <option value="credit_card">Cast</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Banking</option>
                    </select>
                </div>
                <button type="button" onclick="book()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Confirm payment</button>
            </form>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.3/axios.min.js" integrity="sha512-JWQFV6OCC2o2x8x46YrEeFEQtzoNV++r9im8O8stv91YwHNykzIS2TbvAlFdeH0GVlpnyd79W0ZGmffcRi++Bw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function book(){
    var urlString = window.location.href;
    var url = new URL(urlString);
    var pathParts = url.pathname.split("/");
    var patientId = pathParts[2]; 
    var doctorId = pathParts[3]; // 29102
    var selectedDate = pathParts[4]; // 2024-04-05
    var id = pathParts[5]; // 8
    axios.post('/patient/list-doctor/booking', {
                        patientId: patientId,
                        doctorId: doctorId,
                        id: id,
                        selectedDate: selectedDate
                    })
                    .then(res => {
                        console.log(res.status);
                        if (res.status == 200) {
                            window.location.href = "/patient/history-booking"
                        }

                    }).catch(error => {
                        if (error.response && error.response.status === 404) {
                            document.getElementById("error").innerHTML = "Please select a time before making an appointment"
                        }
                    })

    }
</script>
</body>
</html>

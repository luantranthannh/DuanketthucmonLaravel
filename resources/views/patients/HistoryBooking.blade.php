
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
  .table-auto{
    width: 1450px;
  }
  #container{
    width: 1900px;
    padding: 0px;
  }
</style>
<div id="container" class="border-b-2 block md:flex" style="height: 100vh;">
  <div id="profileInfo" class="w-full md:w-4/5 p-8 bg-white lg:ml-4 shadow-md">
    <div class="container mx-auto p-4 rounded-lg shadow-md bg-white">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl text-center font-bold text-gray-700 shadow text-shadow-sm bg-gray-200 py-2 px-4 rounded-md">All booking</h2>
        <a href="{{url('/home')}}"><button id="back" class="middle none center mr-4 rounded-lg bg-blue-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none 
        active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        data-ripple-light="true"> Back</button></a>
      </div>
      <table class="table-auto">
        <thead>
          <tr>
            <th class="border-b-2 border-gray-300 px-4 py-2" id="username">Doctor's name</th>
            <th class="border-b-2 border-gray-300 px-4 py-2" id="email">Doctor's email</th>
            <th class="border-b-2 border-gray-300 px-4 py-2" id="phoneNumber">Doctor's phone number</th>
            <th class="border-b-2 border-gray-300 px-4 py-2" id="address">Time Booking</th>
            <th class="border-b-2 border-gray-300 px-4 py-2" id="password">Date Booking</th>
            <th class="border-b-2 border-gray-300 px-4 py-2">Total Price</th>
          </tr>
        </thead>
        <tbody id="history-booking">
        </tbody>
      </table>
    </div>
  </div>
  <script>
    var email_by_localstore = JSON.parse(localStorage.getItem('user-info'));
    var email = email_by_localstore.email;
    var formData = new FormData();
    formData.append('email', email);
    axios.post('/api/patient/processHistoryBooking', formData)
      .then(function(response) {
        const bookings = response.data
        const tableBody = document.getElementById("history-booking");
        bookings.forEach((booking) => {
          const row = tableBody.insertRow();
          row.innerHTML = `
  <td class="px-4 py-2">${booking.name}</td>
  <td class="px-4 py-2">${booking.email}</td>
  <td class="px-4 py-2">${booking.phone}</td>
  <td class="px-4 py-2">${booking.time_start}</td>
  <td class="px-4 py-2">${booking.date_booking}</td>
  <td class="px-4 py-2">${booking.price}</td>
`;
          row.addEventListener("mouseover", function() {
            row.style.boxShadow = "0 2px 4px 0 rgba(0, 0, 0, 0.1)";
            row.style.backgroundColor = "#BFCFE7";
            row.style.color = "white";
            row.style.borderRadius = "10px";
          });
          row.addEventListener("mouseout", function() {
            row.style.boxShadow = "none";
            row.style.backgroundColor = "transparent";
            row.style.color = "black"
          });
        });
      })
      .catch(function(error) {
        if (error.response) {
          console.error('Error :', error.response.status);
          console.error('Message:', error.response.data);
        } else if (error.request) {
          console.error('No response received:', error.request);
        } else {
          console.error('Error:', error.message);
        }
      })
    showInfo()
    document.addEventListener('error', function(e) {
      if (e.target.tagName.toLowerCase() === 'img') {
        var originalSrc = e.target.getAttribute('src');
        var modifiedSrc = originalSrc.replace('http://localhost:8000/upload/user/', '');
        e.target.setAttribute('src', modifiedSrc);
      }
    }, true);
  </script>
  </body>

  </html>
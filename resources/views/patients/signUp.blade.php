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
<style>
       .form {
        width: 500px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 80px;
        border-radius: 10px;
        padding: 20px;
    }

    .form:hover {
        border-color: #000;
    }
    body{
        background-image: url("https://nld.mediacdn.vn/2020/3/23/9039620610212637445889418153362171059765248o-158496854249670836900.jpg");
        background-size: cover;
        background-position: center;
    }
    .form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color:white;
    }
    .centered-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

}

</style>
</head>

<body>
        <form class='form'>
            <div class="bg-white rounded-lg shadow-md p-4 " style="background-color: rgb(20, 20, 107);">
                <div class="form-container">
                    <h1 class="text-2xl font-semibold mb-6">Sign Up</h1>
                </div>
            <div class="mb-4" >
                <label for="full-name" class="block font-semibold text-gray-700 mb-1 text-white text-white">Full Name</label>
                <input id="name" name="name" type="text" required placeholder="Your Full Name" class="border-gray-300 border rounded-md px-4 py-2 w-full">
                <p id="full-name-error" class="text-red-600 text-[13px]"></p>
            </div>
            <div class="mb-4">
                <label for="phoneNumber" class="block font-semibold text-gray-700 mb-1 text-white text-white">Phone Number</label>
                <input id="phone" name="phone" type="text" required placeholder="Your Phone Number" class="border-gray-300 border rounded-md px-4 py-2 w-full">
                <p id="phoneNumber-error" class="text-red-600 text-[13px]"></p>
            </div>
            <div class="mb-4">
                <label for="email" class="block font-semibold text-gray-700 mb-1 text-white">Email Address</label>
                <input id="email" name="email" type="email" required placeholder="Your Email Address" class="border-gray-300 border rounded-md px-4 py-2 w-full">
                <p id="email-error" class="text-red-600 text-[13px]"></p>
            </div>
            <div class="mb-4">
                <label for="password" class="block font-semibold text-gray-700 mb-1 text-white">Password</label>
                <input id="password" name="password" type="password" required placeholder="Your Password" class="border-gray-300 border rounded-md px-4 py-2 w-full">
                <p id="password-error" class="text-red-600 text-[13px]"></p>
            </div>
            <div class="mb-6">
                <label for="address" class="block font-semibold text-gray-700 mb-1 text-white">Address</label>
                <input id="address" name="address" type="address" required placeholder="Your Address" class="border-gray-300 border rounded-md px-4 py-2 w-full">
                <p id="address-error" class="text-red-600 text-[13px]"></p>
            </div>
            <div class="centered-container">
                <div>
                    <button onclick="handleSubmitSignUp()" type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">Sign Up</button>
                </div>
                <div>
                    <p style="color:white">Already have an account? <a href="/sign-in" class="text-blue-600 hover:underline">Sign In</a></p>
                </div>
            </div>
        </div>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function handleSubmitSignUp() {
        var fullName = document.getElementById("name").value;
        var phone = document.getElementById("phone").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var address = document.getElementById("address").value;

        console.log(fullName);
        console.log(phone);
        console.log(password);
        console.log(email);
        console.log(address);
        axios.post('/api/patient/sign-up', {
                email,
                password,
                address,
                phone,
                fullName
            })
            .then(res => {
                const payload = res.data.payload;
                if (res.status === 200) {
                    window.location.href = "/sign-in";
                }
            })
            .catch(error => {
                if (error.response.status === 400) {
                    const errors = error.response.data;
                    if (errors.error.email) {
                        document.getElementById("email-error").textContent = "Wrong email format, ex:loan@gmail.com";
                    } else {
                        document.getElementById("email-error").textContent = "";
                    }
                    if (errors.error.password) {
                        document.getElementById("password-error").textContent = "Password must be at least 6 digits containing upper and lower case letters, numbers and special characters";
                    } else {
                        document.getElementById("password-error").textContent = "";
                    }
                    if (errors.error.fullName) {
                        document.getElementById("full-name-error").textContent = "Name at least 2 characters";
                    } else {
                        document.getElementById("full-name-error").textContent = "";
                    }
                    if (errors.error.phone) {
                        document.getElementById("phoneNumber-error").textContent = "Phone must have 10 numbers and start with 0";
                    } else {
                        document.getElementById("phoneNumber-error").textContent = "";
                    }
                    if (errors.error.address) {
                        document.getElementById("address-error").textContent = "Address must have 5 characters or more";
                    } else {
                        document.getElementById("address-error").textContent = "";
                    }
                }
                if (error.response.status === 422) {
                    const errors = error.response.data;
                    if (errors.error.email == "") {
                        document.getElementById("email-error").textContent = "Please fill in your email";
                    } else {
                        document.getElementById("email-error").textContent = "";
                    }
                    if (errors.error.password == "") {
                        document.getElementById("password-error").textContent = "Please fill in your password";
                    } else {
                        document.getElementById("password-error").textContent = "";
                    }
                    if (errors.error.fullName == "") {
                        document.getElementById("full-name-error").textContent = "Please fill in your name";
                    } else {
                        document.getElementById("full-name-error").textContent = "";
                    }
                    if (errors.error.phone == "") {
                        document.getElementById("phoneNumber-error").textContent = "Please fill in your phone";
                    } else {
                        document.getElementById("phoneNumber-error").textContent = "";
                    }
                    if (errors.error.address == "") {
                        document.getElementById("address-error").textContent = "Please fill in your address";
                    } else {
                        document.getElementById("address-error").textContent = "";
                    }
                }
                if (error.response.status === 401) {
                    const errors = error.response.data;
                    if (errors.error == "email is error") {
                        document.getElementById("email-error").textContent = "email already exists";
                        document.getElementById("full-name-error").textContent = "";
                        document.getElementById("password-error").textContent = "";
                    } else {
                        document.getElementById("email-error").textContent = "";
                    }
                }

            });
    }

    function handleOnClickSignIn() {
        window.location.href = "/sign-in"
    }
</script>

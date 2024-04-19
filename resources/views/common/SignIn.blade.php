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
                     <h1 class="text-2xl font-semibold mb-6">Sign In</h1>
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
             <div class="centered-container">
                 <div>
                     <button onclick="handleSubmitSignIn()" type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">Sign In</button>
             <!-- <button onclick="SignInGoogle()" type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">Sign In</button> -->
                 </div>
                 <div>
                     <p style="color:white">Don’t have an account?<a href="/sign-up" class="text-blue-600 hover:underline">Sign Up</a></p>
                 </div>
             </div>
            
             
         </div>
     </form>
 </body>
 <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
 <script>
    function SignInGoogle(){
        window.location.href ="/auth/google"
    }
    function handleSubmitSignIn() {
        const email = document.getElementById("email").value
        const password = document.getElementById("password").value

        axios.post('/api/sign-in', {
                email,
                password
            })
            .then(res => {
                const payload = res.data.payload;
                if (res.status === 200) {
                    localStorage.setItem("user-info", JSON.stringify(payload))
                    if (payload.role === "Admin") {
                        window.location.href = "/admin/doctors"
                    } else if (payload.role === "Doctor") {
                        window.location.href = "/admin/doctors"
                    } else if (payload.role === "Patient") {
                        window.location.href = "/home"
                    }
                }
            })
            .catch(error => {
                if (error.response.status === 401) {
                    document.getElementById("email-error").textContent = "email or password is invalid"
                    document.getElementById("password-error").textContent = "email or password is invalid"
                } else {
                    console.log("Error: ", error)
                }
                if (error.response.status === 422) {
                    const errors = error.response.data;
                    if (errors.error.email == "") {
                        document.getElementById("email-error").textContent = "Please enter email"
                    } else {
                        document.getElementById("email-error").textContent = ""

                    }
                    if (errors.error.password == "") {
                        document.getElementById("password-error").textContent = "Please enter password"
                    } else {
                        document.getElementById("password-error").textContent = ""
                    }
                } else {
                    console.log("Error: ", error)
                }
            });
    }

    function handleOnClickCreateNewAccount() {
        window.location.href = "sign-up"
    }
</script>

</html>

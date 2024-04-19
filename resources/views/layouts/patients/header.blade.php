<div id="header">
    <div id="header-content">
        <img loading="lazy" src="{{asset('assets/patients/images/logo.png')}}" id="logo" />
        <div id="header-title">Mental Health Care</div>
    </div>
    <div id="header-actions">
        <img loading="lazy" src="{{asset('assets/patients/images/location.png')}}" id="location-icon" />
        <div id="header-location">Son Tra, Da Nang Viet Nam</div>

        <img loading="lazy" src="{{asset('assets/patients/images/email.png')}}" id="location-icon" />
        <div id="header-location">Hospital@hello.com</div>
        <a href="{{ url('/doctors') }}" id="book-now"><b>BOOK NOW</b></a>
    </div>
</div>

<div class="menu">
    <div class="menu-1">
        <a href="{{ url('/home') }}" class="name1 {{ Request::is('home') ? 'active' : '' }}">Home</a>
        <a href="{{ url('/about-us') }}" class="name2 {{ Request::is('about-us') ? 'active' : '' }}">About Us</a>
        <a href="#" class="name3 {{ Request::is('department') ? 'active' : '' }}">Department</a>
        <a href="{{ url('/doctors') }}" class="name4 {{ Request::is('doctors') ? 'active' : '' }}">Doctors</a>
        <a href="{{ url('/services') }}" class="name5 {{ Request::is('services') ? 'active' : '' }}">Services</a>
        <a href="{{ url('/contact-us') }}" class="name6 {{ Request::is('contact-us') ? 'active' : '' }}">Contact Us</a>
        <a href="{{ url('/add-to-cart/') }}" class="name7 {{ Request::is('cart') ? 'active' : '' }}">Cart</a>
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>

        <div claa="ml-8" style="margin-left: 15rem;">
            <div id="user-info">
                <img id="profile-image" src="https://static.thenounproject.com/png/4314581-200.png" alt="Profile Image" style="width: 40px; border-radius:50%; height: 40px; object-fit: cover;">
                <div id="profile-links" style="display: none; width: 20%">
                    <a id="profile">Profile</a>
                    <a href="/favorite-doctors">Favorite Doctors</a>
                    <a href="/patient/history-booking">Appointment History</a>
                    <a href="#" onclick="logout()">Logout</a>
                </div>
            </div>

            <div id="sign-in-up" class="btn-group" role="group" aria-label="Sign In and Sign Up">
                <a href="/sign-in" id="sign-in-link" class="btn text-decoration-none">Sign In</a>
                <a href="/sign-up" id="sign-up-link" class="btn text-decoration-none">Sign Up</a>
            </div>
        </div>
    </div>
</div>
<script>
    var user = localStorage.getItem('user-info');
    if (user) {
        user = JSON.parse(user);
        document.getElementById('user-info').style.display = "block";
        if (user.image !== '') {
            document.getElementById('profile-image').src = "{{ asset('assets/admin/images/') }}" + "/" + user.image;
        }

        document.getElementById('sign-in-up').style.display = "none";
    } else {
        document.getElementById('user-info').style.display = "none";
        document.getElementById('sign-in-up').style.display = "block";
    }

    const button = document.getElementById('button-addon2');

    function handleButtonClick() {
        window.location.href = '/search';
    }

    button.addEventListener('click', handleButtonClick);

    document.getElementById("profile").addEventListener("click", function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>

        // Lấy id từ local storage
        var user = localStorage.getItem("user-info");
        user = JSON.parse(user);

        // Kiểm tra xem id có tồn tại không
        if (user.id) {
            // Chuyển hướng người dùng đến đường dẫn /Profile/{id}
            window.location.href = "/Profile/" + user.roleId;
        } else {
            // Xử lý trường hợp id không tồn tại trong local storage
            console.log("ID không tồn tại trong local storage");
        }
    });

    function logout() {
        localStorage.clear();
        window.location.href = "/sign-in";
    }

    var url = '/add-to-cart/' + user.roleId;
    var link = document.querySelector('.name7');
    link.href = url;
</script>

<div class="container-section">

    <div class="container-section2 w3-content w3-section">

        @foreach($banners as $banner)
        <img loading="lazy" src="{{asset('assets/admin/banners/'.$banner->image_path)}}" class="mySlides" />
        @endforeach
        <div class="container-section3">
            <div class="container-section4">
                <img loading="lazy" src="assets/patients/images/heart.png" class="img-2" />
                <div class="container-section5" style="color: #767676;">LIVE YOUR LIKE</div>
            </div>
            <div class="container-section6">
                We Care About
                <span style="color: rgba(28, 187, 208, 1)">Your Health</span>
            </div>
            <div class="container-section7" style="color: #767676;">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                accusantium doloremque laudantium
            </div>
            <a href="contact-us" class="submit"><b>CONTACT US</b></a>
        </div>
    </div>
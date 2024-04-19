<section id="sidebar" class="flex flex-col h-screen bg-gray-200">
    <a href="#" class="brand flex items-center p-4">
        <img src="/assets/admin/images/logo.png" class="w-10" alt="Logo" />
        <span class="text-lg font-semibold ml-2">Mental Health Care</span>
    </a>
    <ul class="side-menu top flex flex-col mt-8">
        <li>
            <a href="/admin/patients" class="flex items-center px-4 py-2">
                <i class='bx bxs-shopping-bag-alt text-xl'></i>
                <span class="text-lg ml-2">Patients</span>
            </a>
        </li>
        <li>
            <a href="/admin/doctors" class="flex items-center px-4 py-2">
                <i class='bx bxs-dashboard text-xl'></i>
                <span class="text-lg ml-2">Doctors</span>
            </a>
        </li>
        <li>
            <a href="/admin/appointment" class="flex items-center px-4 py-2">
                <i class='bx bxs-message-dots text-xl'></i>
                <span class="text-lg ml-2">Appointments</span>
            </a>
        </li>
        <li>
            <a href="/admin/banners" class="flex items-center px-4 py-2">
                <i class='bx bxs-message-dots text-xl'></i>
                <span class="text-lg ml-2">Banners</span>
            </a>
        </li>
        <li>
            <a href="/admin/contact" class="flex items-center px-4 py-2">
                <i class='bx bxs-message-dots text-xl'></i>
                <span class="text-lg ml-2">Contact</span>
            </a>
        </li>
        <li>
            <a href="/admin/dashboard" class="flex items-center px-4 py-2">
                <i class='bx bxs-dashboard text-xl'></i>
                <span class="text-lg ml-2">Dashboard</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu mt-auto">
        <li>
            <a href="{{url('/sign-in')}}" class="logout flex items-center px-4 py-2">
                <i class='bx bxs-log-out-circle text-xl'></i>
                <span class="text-lg ml-2">Logout</span>
            </a>
        </li>
    </ul>
</section>
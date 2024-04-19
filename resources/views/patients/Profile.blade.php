<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Boicons -->
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- My CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/admin/css/style.css">
</head>
<style>
  #back {
      margin-left: 50px;
    }
  .head-title {
      margin-top: 50px;
    }
</style>

<div class="head-title">
  <a href="{{url('/home')}}"><button id="back" class="middle none center mr-4 rounded-lg bg-blue-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true"> 
    Back</button>
  </a>
</div>
<div class="flex items-center justify-center p-12">
  <div class="mx-auto w-full max-w-full">
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    <form action="{{ url('/Profile/'.$patient[0]->user_id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3 sm:w-1/3">
          <div class="mb-5">
            <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">Full name</label>
            <input value="{{$patient[0]->name}}" type="text" name="name" id="name" placeholder="Name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            @error('name')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <div class="w-full px-3 sm:w-1/3">
          <div class="mb-5">
            <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">Email</label>
            <input value="{{$patient[0]->email}}" readonly type="text" name="email" id="email" placeholder="Email" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            @error('email')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="password" class="mb-3 block text-base font-medium text-[#07074D]">
                    Old Password
                </label>
                <div class="relative">
                    <input value="{{$patient[0]->password}}" type="password" name="password" id="password"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="h-5 w-5 text-gray-400 cursor-pointer toggle-password">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" fill-rule="evenodd" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 4C4.486 4 0 8.486 0 13s4.486 9 10 9 10-4.486 10-9-4.486-9-10-9zm0 16a6 6 0 100-12 6 6 0 000 12zM10 2a8 8 0 100 16 8 8 0 000-16z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="new_password" class="mb-3 block text-base font-medium text-[#07074D]">
                    New password
                </label>
                <div class="relative">
                    <input value="" type="password" name="new_password" id="new_password"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="h-5 w-5 text-gray-400 cursor-pointer toggle-password">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" fill-rule="evenodd" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 4C4.486 4 0 8.486 0 13s4.486 9 10 9 10-4.486 10-9-4.486-9-10-9zm0 16a6 6 0 100-12 6 6 0 000 12zM10 2a8 8 0 100 16 8 8 0 000-16z" />
                        </svg>
                    </div>
                </div>
                @error('new_password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="phone" class="mb-3 block text-base font-medium text-[#07074D]">
                    Phone
                </label>
                <input value="{{$patient[0]->phone}}" type="text" name="phone" id="phone" placeholder="Phone"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="address" class="mb-3 block text-base font-medium text-[#07074D]">
                    Address
                </label>
                <input value="{{$patient[0]->address}}" type="text" name="address" id="address"
                    placeholder="Address"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                @error('address')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
      </div>

      <div class="-mx-3 flex flex-wrap">
          <div class="w-full px-3 sm:w-1/2">
              <div class="mb-5">
                  <label for="health_condition" class="mb-3 block text-base font-medium text-[#07074D]">
                      Health conditional
                  </label>
                  <textarea type="text" name="health_condition" id="health_condition"
                      placeholder="Health conditional"
                      class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">{{$patient[0]->health_condition}}</textarea>
                  @error('health_condition')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
              </div>
          </div>
          <div class="w-full px-3 sm:w-1/2">
              <div class="mb-5">
                  <label for="note" class="mb-3 block text-base font-medium text-[#07074D]">
                      Note
                  </label>
                  <textarea type="text" name="note" id="note" placeholder="Note"
                      class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">{{$patient[0]->note}}</textarea>
                  @error('note')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
              </div>
          </div>

      </div>

      <div>
        <button type="submit" class="middle none center mr-4 rounded-lg bg-blue-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true">
            Update
        </button>
      </div>
    </form>
  </div>
</div>


<script>
  const togglePasswordElements = document.querySelectorAll('.toggle-password');
  togglePasswordElements.forEach(function (element) {
    element.addEventListener('click', function () {
      const passwordField = this.parentNode.previousElementSibling;
      const fieldType = passwordField.getAttribute('type');

      if (fieldType === 'password') {
        passwordField.setAttribute('type', 'text');
        this.classList.remove('text-gray-400');
        this.classList.add('text-gray-600');
      } else {
        passwordField.setAttribute('type', 'password');
        this.classList.remove('text-gray-600');
        this.classList.add('text-gray-400');
      }
    });
  });
</script>
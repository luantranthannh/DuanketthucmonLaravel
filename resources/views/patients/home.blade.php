{{-- Xây dựng layout bằng tính kế thừa --}}
@extends('layouts.patients.master')

@section('title', 'Mental Health Care')

@section('header')
  @parent 
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
              <div class="contact-us-form-heading text-center">
                Top 4 <span style="color: rgba(28, 187, 208, 1)">Doctors</span>
              </div>
            </div>
          </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6 h-full" style="margin-top: 20px;">
            <?php foreach($topDoctors as $doctor): ?>
                <div class="flex justify-center items-center">
                    <div class="max-w-xs w-full bg-white shadow-lg rounded-lg overflow-hidden">
                        <img style="width: 100%;height: 300px;" class="w-full" src="{{asset('assets/admin/images/'.$doctor->url_image)}}">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{$doctor->name}}</div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="grid-container" style="margin-top: 100px;">
        <div class="columns">
            <div class="content">
                <span class="number">+ 5120</span>
                <br /><br /><br />
                <span class="description">Happy Patients</span>
            </div>
        </div>
        <div class="columns">
            <div class="content">
                <span class="number">+ 26</span>
                <br /><br /><br />
                <span class="description">Total Branches</span>
            </div>
        </div>
        <div class="columns">
            <div class="content">
                <span class="number">+ 50</span>
                <br /><br /><br />
                <span class="description">Senior Doctors</span>
            </div>
        </div>
        <div class="columns">
            <div class="content">
                <span class="number">+ 20</span>
                <br /><br /><br />
                <span class="description">Years Experience</span>
            </div>
        </div>
    </div>

  <div class="custom-container">
    <div class="custom-container-2">
        <div class="custom-container-3">Our Best Services For Your Solution</div>
        <div class="custom-container-4">
            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium
        </div>
    </div>
    <div class="custom-container-5">
        <div class="custom-container-6">
            <div class="columns">
                <div class="custom-container-7">
                    <img loading="lazy" srcset="assets/patients/images/home.png" class="img" />
                    <div class="custom-container-8">General Practitioners</div>
                </div>
            </div>
            <div class="columns">
                <div class="custom-container-7">
                    <img loading="lazy" srcset="assets/patients/images/person.png" class="img" />
                    <div class="custom-container-8">Pregnancy Support</div>
                </div>
            </div>
            <div class="columns">
                <div class="custom-container-7">
                    <img loading="lazy" srcset="assets/patients/images/infusion_pumps.png" class="img" />
                    <div class="custom-container-8">Nutritional Support</div>
                </div>
            </div>
            <div class="columns">
                <div class="custom-container-7">
                    <img loading="lazy" srcset="assets/patients/images/doctor_bag.png" class="img" />
                    <div class="custom-container-8">Pharmaceutical care</div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="body">
    <div class="left">
        <div class="left-2">
            <img loading="lazy" srcset="assets/patients/images/image.png" class="image mx-auto d-block" />
            <div class="left-3">
                Say Goodbye
                <span style="color: rgba(28, 187, 208, 1)">to <br> detached doctors</span>
            </div>
            <div class="left-4">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium
            </div>
            <a href="" class="left-5">BOOK AN APPOINTMENT</a>
        </div>
    </div>

    <div class="right">
        <div class="right-1">
            <div class="right-2">
                <img loading="lazy" srcset="assets/patients/images/lightning.png" class="image1" />
                <div class="right-3">Fast Reply</div>
            </div>
            <div class="right-4">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.
            </div>


        </div>
        <div class="right-1">
            <div class="right-2">
                <img loading="lazy" srcset="assets/patients/images/tick.png" class="image1" />
                <div class="right-3">Verified Diagnosis</div>
            </div>
            <div class="right-4">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.
            </div>
        </div>
        <div class="right-1">
            <div class="right-2">
                <img loading="lazy" srcset="assets/patients/images/development_skill.png" class="image1" />
                <div class="right-3">Follow Up Accountability</div>
            </div>
            <div class="right-4">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.
            </div>
        </div>
    </div>
  </div>
<!-- Truy cập các thuộc tính trong $payload -->
  <div class="team">
      <div class="h1">Our Team</div>
      <div class="h2">
          <div class="h3">
              <div class="images1">
                  <img loading="lazy" srcset="assets/patients/images/doctor1.png" class="doctor" />
              </div>
              <div class="title">
                  <div class="titles">
                      <span style="font-weight: 700; color: rgba(0, 0, 0, 1)">Dr. Leslie Taylor</span>
                      <span style="font-weight: 700; font-size: 24px; color: rgba(28, 187, 208, 1);">PEDIATRICIAN</span>
                      <br/>
                      <span style=" font-weight: 400; font-size: 24px; color: rgba(118, 118, 118, 1);">Eos nam veniam unde quia nihil asperiores officiis volupt</span>
                  </div>
              </div>
          </div>
          <div class="h3">
              <div class="images1">
                  <img loading="lazy" srcset="assets/patients/images/doctor2.png" class="doctor" />
              </div>
              <div class="title">
                  <div class="titles">
                      <span style="font-weight: 700; color: rgba(0, 0, 0, 1)">Dr. Leslie Taylor</span>
                      <span style="font-weight: 700; font-size: 24px; color: rgba(28, 187, 208, 1);">PEDIATRICIAN</span>
                      <br>
                      <span style=" font-weight: 400; font-size: 24px; color: rgba(118, 118, 118, 1);">Eos nam veniam unde quia nihil asperiores officiis volupt</span>
                  </div>
              </div>
          </div>
      </div>
      <img loading="lazy"
          src="https://cdn.builder.io/api/v1/image/assets/TEMP/120195dba242992d6c6329dd07669a632a8d377117487a8350b74d4d253f47ac?apiKey=cceb8282e0e64aaeb0533b2dfea39e76&"
          class="button" />
  </div>

  <!-- <script> 
  var payload = <?php echo json_encode(session()->get('payload')); ?>;
    localStorage.setItem('user-info', JSON.stringify(payload));
  </script> -->
@endsection

@section('footer')
  @parent 
@endsection
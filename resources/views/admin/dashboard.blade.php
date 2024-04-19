@extends('layouts.admin.admin')

@section('content')
<div class="head-title">
    <div class="left">
        <h1>Dashboard</h1>
    </div>
    {{-- <a href="{{url('/admin/patients')}}"><button class="middle none center mr-4 rounded-lg bg-blue-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none 
        active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        data-ripple-light="true"> Back</button></a> --}}
    
</div>
<div class="antialiased sans-serif bg-gray-200 w-lg min-h-screen ">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
      body {
        font-family: 'IBM Plex Mono', sans-serif;
      }
      [x-cloak] {
        display: none;
      }
  
      .line {
        background: repeating-linear-gradient(
          to bottom,
          #eee,
          #eee 1px,
          #fff 1px,
          #fff 8%
        );
      }
      .tick {
        background: repeating-linear-gradient(
          to right,
          #eee,
          #eee 1px,
          #fff 1px,
          #fff 5%
        );
      }
    </style>
  
  
  
  <div x-data="app()" x-cloak class="px-4">
    <div class="max-w-lg mx-auto py-10">
        <div class="shadow p-6 rounded-lg bg-white">
            <div class="md:flex md:justify-between md:items-center">
                <div>
                   
                </div>

                <!-- Legends -->
                <div class="mb-4">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-600 mr-2 rounded-full"></div>
                        <div class="text-sm text-gray-700">Appointments</div>
                    </div>
                </div>
            </div>


            <div class="line my-8 relative">
                <!-- Tooltip -->
                <template x-if="tooltipOpen == true">
                    <div x-ref="tooltipContainer" class="p-0 m-0 z-10 shadow-lg rounded-lg absolute h-auto block"
                         :style="`bottom: ${tooltipY}px; left: ${tooltipX}px`"
                    >
                        <div class="shadow-xs rounded-lg bg-white p-2">
                            <div class="flex items-center justify-between text-sm">
                                <div>Appointments</div>
                                <div class="font-bold ml-2">
                                    <span x-html="tooltipContent"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Bar Chart -->
                <div class="flex -mx-2 items-end mb-2">
                    <template x-for="(data, index) in chartData">
                        <div class="px-2 w-1/6">
                            <div :style="`height: ${data}px`"
                                 class="transition ease-in duration-200 bg-blue-600 hover:bg-blue-400 relative"
                                 @mouseenter="showTooltip($event); tooltipOpen = true"
                                 @mouseleave="hideTooltip($event)"
                            >
                                <div x-text="data" class="text-center absolute top-0 left-0 right-0 -mt-6 text-gray-800 text-sm"></div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Labels -->
                <div class="border-t border-gray-400 mx-auto" :style="`height: 1px; width: ${ 100 - 1/chartData.length*100 + 3}%`"></div>
                <div class="flex -mx-2 items-end">
                    <template x-for="(label, index) in labels">
                        <div class="px-2 w-1/6">
                            <div class="bg-red-600 relative">
                                <div class="text-center absolute top-0 left-0 right-0 h-2 -mt-px bg-gray-400 mx-auto" style="width: 1px"></div>
                                <div x-text="label" class="text-center absolute top-0 left-0 right-0 mt-3 text-gray-700 text-sm"></div>
                            </div>
                        </div>
                    </template>	
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function app() {
        return {
            chartData: @json($chartData), // Thay đổi dữ liệu từ biến PHP
            labels: @json($labels), // Thay đổi nhãn từ biến PHP

            tooltipContent: '',
            tooltipOpen: false,
            tooltipX: 0,
            tooltipY: 0,
            showTooltip(e) {
                console.log(e);
                this.tooltipContent = e.target.textContent
                this.tooltipX = e.target.offsetLeft - e.target.clientWidth;
                this.tooltipY = e.target.clientHeight + e.target.clientWidth;
            },
            hideTooltip(e) {
                this.tooltipContent = '';
                this.tooltipOpen = false;
                this.tooltipX = 0;
                this.tooltipY = 0;
            }
        }
    }
</script>

  </div>
@endsection
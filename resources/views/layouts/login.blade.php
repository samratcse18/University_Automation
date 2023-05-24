<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/5507de1efb.js" crossorigin="anonymous"></script>
    <title>@yield('page_title')</title>
</head>

<body>
    <div class="relative h-[100vh] overflow-hidden bg-repeat"
        style="background-image: url('{{ asset('images/feather.png') }}')">
        <div class="nav flex flex-row justify-between">
            @section('bsmrstu_logo')

            @show
            <i class="fa-solid fa-bars absolute right-1 top-3 z-30 text-3xl lg:invisible" id="icon" onclick="nav()"
                aria-hidden="true"></i>
            <div id="nav_menu"
                class="nav_menu font-['Segoe UI'] z-20 -mt-[500px] w-full bg-[#006666] py-10 text-center text-3xl font-bold text-white lg:relative lg:top-0 lg:mt-[45.4px] lg:mr-[70.9px] lg:w-[652.14px] lg:bg-transparent lg:py-0 lg:text-right lg:text-[25px] lg:text-[#3E3E3E]">
                <ul class="space-y-8 lg:inline-flex lg:space-y-0 lg:space-x-[25.9px] 2xl:space-x-[55px]">
                    <a href="/" class="cursor-pointer hover:bg-[#1ee6e6] lg:hover:bg-[#006666] rounded-md px-[8px] lg:hover:text-white">
                        Home
                    </a>
                    {{-- <li class="cursor-pointer hover:bg-[#1ee6e6] lg:hover:bg-[#006666]  rounded-md px-[8px] lg:hover:text-white">
                        Blog
                    </li>
                    <li class="cursor-pointer hover:bg-[#1ee6e6] lg:hover:bg-[#006666]  rounded-md px-[8px] lg:hover:text-white">
                        About
                    </li>
                    <li class="cursor-pointer hover:bg-[#1ee6e6] lg:hover:bg-[#006666]  rounded-md px-[8px] lg:hover:text-white">
                        Archive
                    </li> --}}
                    <div></div>
                    <a href="{{ route('user.login') }}" class="cursor-pointer mehedi">
                        <i class="fa-solid fa-arrow-right-to-bracket mr-3 cursor-pointer"></i>
                        <span class="cursor-pointer hover:bg-[#1ee6e6] lg:hover:bg-[#006666]  rounded-md px-[8px] lg:hover:text-white">
                            Log In</span>
                    </a>
                </ul>
            </div>
        </div>
        @section('content')
        @show
        <div class="ml-[1500px] lg:ml-0">
            <img src="{{ asset('images/Path 1.png') }}"
                class="absolute lg:-bottom-2 lg:-left-3 lg:h-[429.87px] lg:w-[570.75px] 2xl:w-[600px]" alt="" />
            <img src="{{ asset('images/Ellipse 1.png') }}"
                class="absolute lg:left-[112.2px] lg:bottom-[82.5px] lg:h-[153.46px] lg:w-[153.24px] 2xl:left-[120px] 2xl:w-[130px]"
                alt="" />
            <img src="{{ asset('images/Ellipse 4.png') }}"
                class="absolute lg:left-[284.38px] lg:bottom-[52.5px] 2xl:left-[280px] 2xl:bottom-[121px]"
                alt="" />
            <img src="{{ asset('images/Ellipse 5.png') }}"
                class="absolute lg:bottom-[263px] lg:left-[97.2px] 2xl:bottom-[300px] 2xl:left-[100px]"
                alt="" />
            <img src="{{ asset('images/Ellipse 3.png') }}"
                class="absolute lg:-right-[399.5px] lg:-bottom-[408px] lg:h-[655px] lg:w-[666px] 2xl:-right-[327px] 2xl:-bottom-[447px] 2xl:w-[700px]"
                alt="" />
            <img src="{{ asset('images/Ellipse 7.png') }}"
                class="absolute lg:right-[292px] lg:bottom-[20.8px] 2xl:right-[387px] 2xl:bottom-[50px]"
                alt="" />
            <img src="{{ asset('images/Ellipse 2.png') }}"
                class="absolute lg:right-[180px] lg:bottom-[144px] 2xl:right-[247px] 2xl:bottom-[170px]"
                alt="" />
            <img src="{{ asset('images/Ellipse 6.png') }}"
                class="absolute lg:right-[30.7px] lg:bottom-[262px] 2xl:right-[82px] 2xl:bottom-[288px]"
                alt="" />
        </div>
    </div>
    {{-- @section('modal')
    @show --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"
        integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function nav() {
            let icon = document.getElementById("icon").classList.contains("fa-bars");
            document.getElementById("nav_menu").classList.add("duration-[1000ms]");
            if (icon) {
                document.getElementById("icon").classList.replace("fa-bars", "fa-times");
                document.getElementById("nav_menu").classList.remove("-mt-[500px]");
            } else {
                document.getElementById("nav_menu").classList.add("-mt-[500px]");
                document.getElementById("icon").classList.replace("fa-times", "fa-bars");
            }
        }

        // function show() {
        //     document.getElementById("signUp").classList.replace("invisible", "visible");
        //     document.getElementById("signUp").classList.add("duration-[1000ms]");
        //     document.getElementById("item").classList.replace("h-[0%]", "h-[50%]");
        //     document.getElementById("item").classList.replace("w-[0%]", "w-[50%]");
        //     document.getElementById("item").classList.remove("invisible");
        //     document.getElementById("item").classList.add("duration-[1000ms]");
        //     document.getElementById("text").classList.replace("scale-0", "scale-100");
        //     document.getElementById("text").classList.add("duration-[1000ms]");
        // }

        // function ss() {
        //     document.getElementById("signUp").classList.replace("visible", "invisible");
        //     document.getElementById("signUp").classList.remove("duration-[1000ms]");
        //     document.getElementById("item").classList.replace("h-[50%]", "h-[0%]");
        //     document.getElementById("item").classList.replace("w-[50%]", "w-[0%]");
        //     document.getElementById("item").classList.remove("visible");
        //     document.getElementById("item").classList.remove("duration-[1000ms]");
        //     document.getElementById("text").classList.replace("scale-100", "scale-0");
        //     document.getElementById("text").classList.remove("duration-[1000ms]");
        // }
    </script>
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "3000",
                "hideDuration": "1000",
                "timeOut": "10000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
            
        });
    </script>
</body>

</html>

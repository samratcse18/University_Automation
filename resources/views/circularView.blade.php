<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>meeting</title>

    <style>
        body {
            margin: 0px;
            padding: 29px;
        }

        .header-section {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left-section {
            text-align: left;
            flex: 2;
        }

        .mid-section {
            flex: 0.5;
            text-align: center;
        }

        .right-section {
            text-align: right;
            flex: 2;
        }

        .mid-section img {
            height: 50px;
            width: 50px;
        }

        .left-section h4,
        p,
        .right-section h4,
        p {
            margin: 0px;
        }

        .hr-line {
            /* transform: translateY(15px); */
            margin-top: 15px;
            color: gray;
        }

        .bottom-header {
            display: flex;
            justify-content: space-between;
        }

        small {
            font-size: 10px;
        }

        .body-section h2 {
            text-align: center;
            font-size: 16px;
            font-weight: 800;
            margin-top: 20px;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .dean-signature {
            margin-top: 30px;
            height: 50px;
            width: 60px;
        }

        .footer-hr-line {
            border-bottom: 2px solid forestgreen;
            transform: translateY(95px);
        }

        .footer-section {
            transform: translateY(290px)
                /* margin-top: 18%;
            /* height: 40px; */
                display: flex;
            justify-content: space-around;
            */
        }

        a {
            text-decoration: none;
            cursor: pointer;
            color: forestgreen;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div id="btn" class="absolute top-4 right-4 w-[100px] cursor-pointer bg-[#006666] text-center text-white"
        onclick="mehedi()">Print Now</div>
    <div class="header-section" id="container">
        <div class="left-section">
            <h4>{{ $role_bangla }} ,{{ $dept->department_bn }}</h4>
            <p>
                বঙ্গবন্ধু শেখ মুজিবুর রহমান বিজ্ঞান ও প্রযুক্তি বিশ্ববিদ্যালয়,
                গোপালগঞ্জ ৮১০০
            </p>
        </div>
        <div class="mid-section">
            <img src="https://i.ibb.co/g3b60qg/logo.jpg" alt="university-logo" />
        </div>
        <div class="right-section">
            <h4>{{ $role_eng }}, {{ $dept->department_full }}</h4>
            <p>
                Bangabandhu Sheikh Mujibur Rahman Science and Technology University
                Gopalganj 8100, Bangladesh
            </p>
        </div>
    </div>
    <div class="" style="display: flex; justify-content: space-between;">
        <small>fbs.bsmrstu@gmail.com</></small>
        <small>www.bsmrstu.edu.bd</small>
    </div>
    <hr class="hr-line" />
    <div class="bottom-header">
        <p>
            <small>Ref: {{$circular->prefix}}/{{$circular->suffix}}/</small>
        </p>
        <p><small>Date: {{ date('l, jS F Y') }}</small></p>
    </div>
    <div class="body-section">
        <br>
        <br>
        {!! $circular->circular !!}
    </div>
    <div class="footer-section" style="display: flex;">
        {{-- <hr class="footer-hr-line" /> --}}
       
    </div>
    <script>
        const btn = document.getElementById('btn');

        function mehedi() {
            btn.hidden = true;
            window.print();
            setTimeout(() => {
                btn.hidden = false;
            }, 1000);
        }
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>paySlip</title>

    <style>
        * {
            margin: 2px;
            padding: 0;

            @font-face {
                font-family: "CORBEL";
                src: url(fonts/corbel/CORBEL.TTF);
            }

            /* font-family: "Courier New", Courier, monospace; */
        }

        .container {
            /* display:; */
            /* float: ;
            justify-content: space-between; */
            /* height: 975px; */
        }

        .left_section {
            width: 45%;
            float: left;
        }

        .right_section {
            width: 45%;
            float: right;
        }

        #serial-no {
            margin-top: 6px;
            font-size: 12px;
            font-weight: 800;
            text-align: center;
        }

        .part {
            background: white;
            font-weight: 500;
            color: black;
            font-size: 11px;
            margin-top: 0;
            padding-bottom: 5px;
            text-align: center;
        }


        .header-section h2 {
            font-size: 12px;
            text-align: center;
        }

        .name_logo {
            /* display: flex;
            flex-wrap: nowrap;
            justify-content: space-between; */
            padding-left: 5px;
            padding-right: 5px;
        }

        .name_logo img {
            height: 50px;
            width: 50px;
            margin-top: 5px;
        }

        .receipt {
            text-align: center;
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .barcode {
            width: 100px;
            height: 40px;
            margin: 0 auto;
        }

        .student_info {
            height: 10%;
            /* margin-top: -1%; */
            padding: 5px 0px;
        }

        ul>li {
            list-style-type: none;
        }

        .wrapper {
            padding: 0;
            border-radius: 3px;
        }

        .row {
            display: flex;
            justify-content: flex-end;
            padding: 0px 1px;
        }

        .row>label {
            flex: 1;
        }

        .row>input {
            flex: 3;
        }

        li>label {
            font-size: 11px;
        }

        input {
            outline: none;
            border: none;
            border-bottom: 0.5px dotted black;
            height: 10px;
            padding: 1px;
            font-size: 11px;
        }

        #accountNo {
            border: 1px solid black;
            border-radius: 25px;
            text-align: center;
        }

        .table {
            margin-top: 60px;
        }

        table,
        td,
        th {
            border: 1px solid black;
            font-size: 11px;
            padding: 0px;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0px;
            width: 100%;
            margin: 0px, 0px, 20px, 20px;
        }

        th:nth-child(1) {
            width: 30%;
        }

        th:nth-child(2) {
            width: 50%;
        }
        td:nth-child(2) {
            text-align: left;
        }

        th:nth-child(3) {
            width: 30%;
        }

        td{
            text-align: center;
            padding: 0 4px
        }

        td,
        th {
            height: 2px;
        }

        .footer_section {
            margin-top: 30px;
            height: 8.5%;
        }

        .bank_signature {
            margin-top: 30px;
            justify-content: space-between;
            align-items: center;
        }

        .signature {
            margin-top: 15%;
        }

        .cashier {
            float: left;
        }

        .officer {
            float: right;
        }

        .cashier p,
        .officer p {
            margin: 0px;
            font-size: 11px;
        }

        .name {
            width: 200px;
            text-align: center;
            margin: 0 auto;
            font-size: 10px;
        }

        .versity_logo {
            float: left;
        }

        .student_img {
            float: right;
        }
    </style>
</head>

<body>
    @php
        $user = Auth::guard('student')->user();
    @endphp
    <div class="container">
        <div class="left_section">
            <h2 id="serial-no">Serial NO: {{time()}}</h2>
            <p class="part"><small>First Part(Students Copy)</small></p>
            <div class="header-section">
                <div class="name">
                    Bangabandhu Sheikh Mujibur Rahman Science & Technology university
                    Gopalganj 8100,Bangladesh
                </div>
                {{-- <div class="name_logo">
                    @php
                        $img = Auth::guard('student')->user();
                    @endphp
                    <div class="varsity_logo">
                        <img src="https://i.ibb.co/g3b60qg/logo.jpg" alt="university logo" class="versity_logo" />
                    </div>
                    <div class="student_logo">
                        <img src="{{ public_path('/images/' . $img->img) }}" alt="student image" class="student_img" />
                    </div>
                </div> --}}
                <div class="receipt">
                    <p style="font-size: 11px">
                        <small>Student's Money Receipt</small>
                    </p>
                    <div class="barcode">
                        {!! DNS1D::getBarcodeHTML($data->token, 'C128', 1, 18) !!}
                    </div>
                    <p><small>{{ $data->token }}</small></p>
                </div>
            </div>

            <div class="student_info">
                <ul class="wrapper">
                    <li class="row">
                        <label for="name">Name:</label>
                        <input type="text" id="name" value="{{ $user->ApplicantName }}" />
                    </li>
                    {{-- <li class="row">
                        <label for="class">Class:</label>
                        <input type="text" style="width: 200px" id="class" value="{{ $admission->Class }}, {{$admission->program}}" />
                    </li> --}}
                    {{-- <li class="row">
                        <label for="semester">Semester:</label>
                        <input type="text" id="semester" value="{{ $admission->Semester }}" />
                    </li> --}}
                    <li class="row">
                        <label for="deptName">Department:</label>
                        <input type="text" id="deptName" value="{{ $user->dept }}" />
                    </li>
                    <li class="row">
                        <label for="roll">Roll:</label>
                        <input type="text" id="roll" value="{{ $user->student_id }}" />
                    </li>
                    <li class="row">
                        <label for="session">Session:</label>
                        <input type="text" id="session" value="{{ $user->session }}" />
                    </li>
                </ul>
            </div>
            <div class="table">
                <table>
                    <tr>
                        <th>Account</th>
                        <th>Details</th>
                        <th>Taka</th>
                    </tr>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($fee as $item)
                        @php
                            $total = $total + ($item->amount * $month);
                        @endphp
                        <tr>
                            <td>{{ $item->account_number }}</td>
                            <td>{{ $item->fee_title }} <span class="hifen"> - </span></td>
                            <td>{{ $item->amount * $month }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td><span class="hifen">Total-</span></td>
                        <td>{{ $total }}</td>
                    </tr>
                </table>
            </div>
            <div style="margin-top: 20px" class="footer_section">
                <ul>
                    <li class="row">
                        <label for="words">In Words:</label>
                        <input type="text" name="words" id="words" />
                    </li>
                    <li class="row">
                        <label for="date">Date:</label>
                        <input type="text" name="date" id="date" />
                    </li>
                    <li class="row">
                        <label for="mobile">Mobile:</label>
                        <input type="text" name="mobile" id="mobile" />
                    </li>
                </ul>

                <div class="bank_signature">
                    <div class="cashier">
                        <p style="text-align: center"><small>Cashier</small></p>
                        <p><small>Agrani Bank Limited</small></p>
                    </div>
                    <div class="officer">
                        <p style="text-align: center"><small>Officer</small></p>
                        <p style="text-align: center">
                            <small>Agrani Bank Limited <br />BSMRSTU Branch</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="vr_line"></div> -->
        <div class="right_section">
            <h2 id="serial-no">Serial NO: {{time()}}</h2>
            <p class="part"><small>Second Part(Banks Copy)</small></p>
            <div class="header-section">
                <div class="name">
                    Bangabandhu Sheikh Mujibur Rahman Science & Technology university
                    Gopalganj 8100,Bangladesh
                </div>
                {{-- <div class="name_logo">
                    @php
                        $img = Auth::guard('student')->user();
                    @endphp
                    <div class="varsity_logo">
                        <img src="https://i.ibb.co/g3b60qg/logo.jpg" alt="university logo" class="versity_logo" />
                    </div>
                    <div class="student_logo">
                        <img src="{{ public_path('/images/' . $img->img) }}" alt="student image"
                            class="student_img" />
                    </div>
                </div> --}}
                <div class="receipt">
                    <p style="font-size: 11px">
                        <small>Student's Money Receipt</small>
                    </p>
                    <div class="barcode">
                        {!! DNS1D::getBarcodeHTML($data->token, 'C128', 1, 18) !!}
                    </div>
                    <p><small>{{ $data->token }}</small></p>
                </div>
            </div>

            <div class="student_info">
                <ul class="wrapper">
                    <li class="row">
                        <label for="name">Name:</label>
                        <input type="text" id="name" value="{{ $user->ApplicantName }}" />
                    </li>
                    {{-- <li class="row">
                        <label for="class">Class:</label>
                        <input type="text" style="width: 200px" id="class" value="{{ $admission->Class }}, {{$admission->program}}" />
                    </li> --}}
                    {{-- <li class="row">
                        <label for="semester">Semester:</label>
                        <input type="text" id="semester" value="{{ $admission->Semester }}" />
                    </li> --}}
                    <li class="row">
                        <label for="deptName">Department:</label>
                        <input type="text" id="deptName" value="{{ $user->dept }}" />
                    </li>
                    <li class="row">
                        <label for="roll">Roll:</label>
                        <input type="text" id="roll" value="{{ $user->student_id }}" />
                    </li>
                    <li class="row">
                        <label for="session">Session:</label>
                        <input type="text" id="session" value="{{ $user->session }}" />
                    </li>
                </ul>
            </div>
            <div class="table">
                <table>
                    <tr>
                        <th>Account</th>
                        <th>Details</th>
                        <th>Taka</th>
                    </tr>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($fee as $item)
                        @php
                            $total = $total + ($item->amount * $month);
                        @endphp
                        <tr>
                            <td>{{ $item->account_number }}</td>
                            <td>{{ $item->fee_title }} <span class="hifen"> - </span></td>
                            <td>{{ $item->amount * $month }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td><span class="hifen">Total-</span></td>
                        <td>{{ $total }}</td>
                    </tr>
                </table>
            </div>
            <div style="margin-top: 20px" class="footer_section">
                <ul>
                    <li class="row">
                        <label for="words">In Words:</label>
                        <input type="text" name="words" id="words" />
                    </li>
                    <li class="row">
                        <label for="date">Date:</label>
                        <input type="text" name="date" id="date" />
                    </li>
                    <li class="row">
                        <label for="mobile">Mobile:</label>
                        <input type="text" name="mobile" id="mobile" />
                    </li>
                </ul>

                <div class="bank_signature">
                    <div class="cashier">
                        <p style="text-align: center"><small>Cashier</small></p>
                        <p><small>Agrani Bank Limited</small></p>
                    </div>
                    <div class="officer">
                        <p style="text-align: center"><small>Officer</small></p>
                        <p style="text-align: center">
                            <small>Agrani Bank Limited <br />BSMRSTU Branch</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

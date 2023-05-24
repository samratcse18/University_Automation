<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Reference letter</title>



    <style>

        body {

            margin: 0px;

            padding: 0px;

            font-family: 'corbel', serif;

            font-style:regular;

        }

        .header-section {

            display: flex;

            align-items: center;

            justify-content: center;

            padding-bottom: 5px;

        }

        .left-section {

        text-align: left;

        flex: 2;

        font-family: 'Nikosh', serif;

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

            margin-bottom:0px;

        }



        .bottom-header {

            display: flex;

            justify-content: space-between;

            margin-top: -10px;

        }

        small {

            font-size: 10px;

        }

        .title-text {

            font-size: 29px;

            font-weight: 800;

            text-align: left;

            color: rgb(24, 24, 96);

            margin-bottom: 0px;

            margin-top: 10px;

        }

        .letter-title {

            display: flex;

        }

        .c-green {

            border: 4px solid green;

            background:green;

        }

        .c-navy {

            border: 4px solid navy;

            background:navy;

        }

        .middle-section {

            display: flex;

            justify-content: space-between;

        }



        .left-mid {

            /* border: 2px solid red; */

            height: auto;

            width: 23%;

            text-align: left;

        }

        .left-mid p,

        b {

            font-size: 11px;

        }

        .left-mid p,

        b {

            color: rgb(27, 27, 179);

        }

        .right-mid p {

            font-size: 12px;

            padding-left: 4px;

        }

        .left-mid b,

        .right-mid b {

            font-size: 14px;

        }

        .right-mid {

        /* border: 2px solid green; */

            height: auto;

            width: 78%;

            text-align: justify;

            margin-left: 10px;

        }

        .dean-signature {

            margin-top: 30px;

            height: 50px;

            width: 60px;

        }

        .footer-hr-line {

            border-bottom: 2px solid forestgreen;

            transform: translateY(87px);

            margin:0px;

        }

        .footer-section {

            margin-top: 12%;

            height: 70px;

            display: flex;

            justify-content: space-around;

        }

        a {

            text-decoration: none;

            cursor: pointer;

            color: forestgreen;

            font-weight: 700;

        }

        .barcode{

            position:absolute;

            top:17%;

            right:3rem;

            width:200px;

            overflow:hidden;

        }

        @page {

        size: auto;

        odd-footer-name: html_myFooter1;



        }

    </style>

  </head>

  <body>

    <table style=" width:100%">

        <tbody>

            <tr>

                <td style="width:43%" class="left-section">

                    <div class="left-section">

                    <h4 style="font-size:1.1rem;font-weight: bold">চেয়ারম্যান, {{$dept->department_bn}}</h4>

                    <p style="font-size:1rem;font-weight: 800">

                        <p>বঙ্গবন্ধু শেখ মুজিবুর রহমান বিজ্ঞান ও প্রযুক্তি বিশ্ববিদ্যালয়,</p>

                        গোপালগঞ্জ ৮১০০,বাংলাদেশ।

                    </p>

                    </div>

                </td>

                <td style="width:10%" class="mid-section">

                    

                    <img src="{{public_path('images/logo.jpg')}}" style="width:50px;height:50px" alt="university-logo" />

                    

                </td>

                <td style="width:47%;" class="right-section">

                    <div class="right-section">

                    <h4 style="text-align:right;font-size:1rem;font-weight: bold;white-space: nowrap;">Chairman, Dept. of {{$dept->department_full}}</h4>

                    <p style="font-size:0.85rem">

                        <p>Bangabandhu Sheikh Mujibur Rahman Science </p> 

                        <p>and Technology University</p>

                        Gopalganj 8100, Bangladesh

                    </p>

                    </div>

                </td>

            </tr>

        </tbody>

    </table>

    <hr class="hr-line" />

    <table class="" style="width:100%">

        <tbody>

            <tr style="width:100%">

                <td style="width:50%;text-align:left">

                    <p style="text-transform:uppercase">Ref: BSMRSTU/{{strtolower($reference_letter->dept_name)}}/PP/{{$reference_letter->std_id}}/(3)

                    </p>

                </td >

                <td style="width:49%;text-align:right"><p>Date: {{date('d-M-Y',strtotime($reference_letter->updated_at))}}</p></td>

            </tr>

        </tbody>

    </table>

    <h1 style="margin:0px;font-size:2.9rem">Letter of Reference</h1>



    <table style="width:64%">

        <thead >

            <tr>

                <th class="c-green" style="width:30%">

                    

                </th>

                <th style="width:14%"></th>

                <th class="c-navy" style="width:56%">

                    

                </th>

            </tr>

        </thead>

    </table>

    <table style="width:100%">

        <tr>

            <td style="width:20%">

               <table style="width:100%; ">

                        <tr >

                            <td style="height:5rem"></td>

                        </tr>

                        <tr>

                            <td >

                                <b style="font-size:1rem;letter-spacing:0.3rem">Subject</b>

                                <p>Recommendation for {{$reference_letter->letter_opportunity}} opportunity.</p>

                                <br />

                                    <b style="font-size:1rem;">To</b>

                                <p>

                                    {{$reference_letter->receiver_title}} <br/> {{$reference_letter->organization_name}}

                                <br />

                                    {{$reference_letter->organization_address}}

                                </p>

                                <br />

                                    <b style="font-size:1rem;letter-spacing:0.1rem">Subject’s Information</b>

                                <p>

                                    {{$reference_letter->full_name}} <br />

                                    {{$reference_letter->std_id}} <br />

                                    {{$student->email}}

                                </p>

                                <br />

                                    <b style="font-size:1rem;letter-spacing:0.3rem">Address</b>

                                <p>

                                    Vill/Area: {{$reference_letter->vill_area}} <br />

                                    P.O.: {{$reference_letter->post_office}} <br />

                                    P.S.: {{$reference_letter->thana}} <br />

                                    District: {{$reference_letter->district}} <br />

                                    Country: {{$reference_letter->country}} <br />

                                </p>

                            </td>



                        </tr>

                        <tr>

                            <td style="height:19rem"></td>    

                        </tr>



                </table> 

            </td>

            <td style="width:80%">

                <table style="width:100%;">

                        <tr>

                            <td style="text-align: justify;">

                                <p>Dear {{$reference_letter->receiver_title}},</p>

                        <p style="text-align: justify;">

                            Please take my greetings! It's a pleasure to write for {{$reference_letter->full_name}}

                            @if($reference_letter->gender == "Male")son @elseif($reference_letter->gender == "Female")daughter @else Here @endif

                            of {{$reference_letter->father_name}} and {{$reference_letter->mother_name}} of

                            {{$reference_letter->vill_area}}, Post: {{$reference_letter->post_office}}, P.S.: {{$reference_letter->thana}},

                            District: {{$reference_letter->district}} of {{$reference_letter->country}}. 

                            @if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif has

                            been known to me since {{date('d-M-Y',strtotime($student->created_at))}} as my student in

                            this institution. I had sufficient opportunities during the period

                            with @if($reference_letter->gender == "Male")him @elseif($reference_letter->gender == "Female")her @else Here @endif has

                            to assess as my student and as an

                            individual.

                        </p>

                        <br />

                        <p style="text-align: justify;">

                        I found {{$student->fname}} intelligent, time-bound, team-oriented, and

                        achievement-oriented. 

                        @if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif

                        seems to be quite good in

                        analytical and technical skills, and sincere in access to

                        state-of-the-art information about the latest issues. 

                        @if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif

                        also has a keen interest in research and development. {{$student->fname}} has also a good academic score in secondary (SSC) and higher

                        secondary (HSC) level of education (SSC: {{$reference_letter->ssc_gpa}}, and HSC: {{$reference_letter->hsc_gpa}}). 

                        @if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif

                        has also proven to have excellent academic

                        performance and research skills in the current program ({{$reference_letter->fprogram}}) of study of this university. The

                        medium of instruction of this program is in English.

                        </p>

                        <br />

                        <p style="text-align: justify;">

                        @if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif is passionate about such the {{$reference_letter->letter_opportunity}} opportunity in an organization like yours, and I believe

                        {{$student->fname}} will be able to abide by all the regulations. I

                        strongly recommend <span>@if($reference_letter->gender == "Male")him @elseif($reference_letter->gender == "Female")her @else Here @endif</span> for this {Intention of this

                        Letter} position at your esteemed organization with all available support. Please feel free to contact me for any queries, if

                        needed.

                        </p>

                        <div class="signature-box">

                        <img

                            class="dean-signature"

                            src="{{public_path('/images/'.$dept_chairman->signature) }}"

                            alt="dean-signature"

                        />

                        <span style="font-size:0.6rem;font-style:italic;font-family: 'HelloKetta-d99oX', serif;">{{date('d-m-Y', strtotime($reference_letter->updated_at))}}</span>

                        </div>

                        <p> {{$dept_chairman->name_english}}</p>

                        <p>

                            Chairman <br/>Department of {{$dept->dept_eng}}

                        </p>

                        <p style="margin-top: 10px">

                        Bangabandhu Sheikh Mujibur Rahman Science and Technology University

                        <br />

                        Gopalganj 8100, Bangladesh

                        </p>

                            </td>

                        </tr>



                </table>

            </td>

        </tr>

    </table>

    <div class="barcode">

            <barcode style="width:100%" code="{{$student->student_id}}-{{$reference_letter->id}}" type="C39+" size="1.0" height="0.7"/>

       </div>

    

    <htmlpagefooter name="myFooter1" style="display:none">

        <p style="font-size:0.7rem;color:black">This document is electronically generated, requires no manual signature and seal.</p>

        <hr class="footer-hr-line" />

        

        <table style="width:100%;">

            

            <tbody>

                

                <tr >

                    <td style="width:33%;text-align:start">

                    <small><a href="fbs.bsmrstu@gmail.com">fbs.bsmrstu@gmail.com</a></small>

                    </td>

                    <td style="width:33%;text-align:center">

                    <small><a style="width:34%" href="www.bsmrstu.edu.bd">www.bsmrstu.edu.bd</a></small>

                    </td>

                    <td style="width:33%;text-align:right">

                    <small style="color: forestgreen">+88 026682257 ext. 1411</small>

                    </td>

                </tr>

                <tr>

                    <td></td>

                    <td  align="center" style="font-size:0.5rem">{PAGENO}/{nbpg}</td>

                    <td></td>

                </tr>

            </tbody>

        </table>

    </htmlpagefooter>

  </body>

</html>


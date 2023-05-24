@extends('layouts.Dashboard')
@section('styleDevDept')
<style>
    body {
        margin: 0px;
        padding: 0px;
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
        width: 13%;
    }
    .c-navy {
        border: 4px solid navy;
        width: 20%;
        margin-left: 10.3%;
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
    }
    .footer-section {
        margin-top: 12%;

    }
    a {
        text-decoration: none;
        cursor: pointer;
        color: forestgreen;
        font-weight: 700;
    }
</style>
@endsection
@section('content')
<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div class="border-b-2 py-2" style="display: flex;justify-content: end;">
            <a href="{{route('office.referenceLetterList')}}" class="bg-blue-500 text-center hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-1/5">Back</a>
        </div>
        <div class="p-1 border-x-2">
            <div class="header-section">
                <div class="left-section">
                    <h4 class="text-[0.8rem] font-semibold 2xl:text-[1rem]" style="white-space: nowrap;">চেয়ারম্যান, {{$dept->department_bn}}</h4>
                    <p class="text-[0.9rem] 2xl:text-[1.2rem]">
                    বঙ্গবন্ধু শেখ মুজিবুর রহমান বিজ্ঞান ও প্রযুক্তি বিশ্ববিদ্যালয়,
                    গোপালগঞ্জ ৮১০০
                    </p>
                </div>
                <div class="mid-section flex justify-center" >
                    <img src="{{asset('/images/logo.jpg')}}" alt="university-logo" />
                </div>
                <div class="right-section">
                    <h4 class="text-[0.8rem] font-semibold 2xl:text-[1rem]" style="white-space: nowrap;">Chairman, {{$dept->department_full}}</h4>
                    <p class="text-[0.9rem] 2xl:text-[1.2rem]" style="white-space: nowrap;">
                    Bangabandhu Sheikh Mujibur Rahman Science </br>and Technology University </br>
                    Gopalganj 8100, Bangladesh
                    </p>
                </div>
            </div>
            <hr class="hr-line" />
            <div class="bottom-header">
            <p>
                <small>
                Ref: BSMRSTU/{{$reference_letter->dept_name}}/RL/{{$student->student_id}} (3)
                </small>
            </p>
            <p><small>Date: {{date('d-M-Y',strtotime($reference_letter->created_at))}}</small></p>
            </div>
            <h1 class="title-text">Letter of Reference</h1>
            <div class="letter-title">
                <div class="c-green"></div>
                <div class="c-navy"></div>
            </div>
            <div class="middle-section">
                <div class="left-mid">
                    <b>Subject</b>
                    <p>Recommendation for {{$reference_letter->letter_opportunity}} opportunity.</p>
                    <br />
                    <b>To</b>
                    <p>
                    {{$reference_letter->receiver_title}} <br> {{$reference_letter->organization_name}}
                    <br />
                    {{$reference_letter->organization_address}}
                    </p>
                    <br />
                    <b>Subject’s Information</b>
                    <p>
                    {{$reference_letter->full_name}} <br />
                    {{$reference_letter->std_id}} <br />
                    {{$student->email}}
                    </p>
                    <br />
                    <b>Address</b>
                    <p>
                    Vill/Area: {{$reference_letter->vill_area}} <br />
                    P.O.: {{$reference_letter->post_office}} <br />
                    P.S.: {{$reference_letter->thana}} <br />
                    District: {{$reference_letter->district}} <br />
                    Country: {{$student->Nationality}} <br />
                    </p>
                </div>
                <div class="right-mid">
                    <p>Dear {{$reference_letter->receiver_title}},</p>
                    <p>
                        Please take my greetings! It's a pleasure to write for {{$reference_letter->full_name}}
                        @if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif
                        of {{$reference_letter->father_name}} and {{$reference_letter->mother_name}} of
                        {{$reference_letter->vill_area}}, Post: {{$reference_letter->post_office}}, P.S.: {{$reference_letter->thana}},
                        District: {{$reference_letter->district}} of {{$student->Nationality}} . 
                        @if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif has
                        been known to me since {{date('d-M-Y',strtotime($student->created_at))}} as my {You are a}} in
                        this institution. I had sufficient opportunities during the period
                        with @if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif has
                         to assess as my @if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif has and as an
                        individual.
                    </p>
                    <br />
                    <p>
                    I found {{$student->fname}} intelligent, time-bound, team-oriented, and
                    achievement-oriented. 
                    @if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif
                    seems to be quite good in
                    analytical and technical skills, and sincere in access to
                    state-of-the-art information about the latest issues. 
                    @if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif
                    also has a keen interest in research and development. {{$student->fname}} has a good academic score in secondary (SSC) and higher
                    secondary (HSC) level of education (SSC: {{$reference_letter->ssc_gpa}}, and HSC: {{$reference_letter->hsc_gpa}}). 
                    @if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif
                     has also proven to have excellent academic
                    performance and research skills in the current program ({Last Study
                    Program}) of study as resulted in the academic records. In the
                    {Program} ({Last Study Program}) program of this university, the
                    medium of instruction is in English.
                    </p>
                    <br />
                    <p>
                    @if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif is passionate about such the {Intention of this
                    Letter} opportunity in an organization like yours, and I believe
                    {{$student->fname}} will be able to abide by all the regulations. I
                    strongly recommend <span>@if($reference_letter->gender == "Male")He @elseif($reference_letter->gender == "Female")She @else Here @endif</span> for this {Intention of this
                    Letter} position at your esteemed organization with all available and
                    continuous support. Please feel free to contact me for any queries, if
                    needed.
                    </p>
                    <div class="signature-box">
                    <img
                        class="dean-signature"
                        src="/images/{{$dept_chairman->signature}}"
                        alt="dean-signature"
                    />
                    </div>
                    <p>{{$dept_chairman->name_english}}</p>
                    <p>
                    Chairman<br />
                    Department of {{$dept->department_full}}
                    </p>
                    <p style="margin-top: 10px">
                    Bangabandhu Sheikh Mujibur Rahman Science and Technology University
                    <br />
                    Gopalganj 8100, Bangladesh
                    </p>
                    <div class="position-absolute bottom-[24%] right-[5%]">
                        {!! DNS1D::getBarcodeHTML($reference_letter->std_id, 'C39+',1,33) !!}
                    </div>
                </div>
            </div>

            <div class="footer-section">
                <p class="border-b-2 pb-1" style="font-size:0.7rem;color:black">This document is electronically generated, requires no manual signature and seal.</p>
                <div class="flex justify-between">
                    <small><a href="fbs.bsmrstu@gmail.com">fbs.bsmrstu@gmail.com</a></small
                    ><small><a href="www.bsmrstu.edu.bd">www.bsmrstu.edu.bd</a></small
                    ><small style="color: forestgreen">+88 026682257 ext. 1411</small>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
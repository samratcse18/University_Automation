@extends('layouts.Dashboard')
@section('styleDevDept')
<style>
      
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
        margin-top: 13%;

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
            <a href="{{route('office.testimonialList')}}" class="bg-blue-500 text-center hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-1/5">Back</a>
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
                    <small>Ref: BSMRSTU/{{strtolower($testimonial->dept_name)}}/PP/{{$testimonial->std_id}}/(3)
                    </small>
                </p>
                <p><small>Date:{{date('d-M-Y',strtotime($testimonial->updated_at))}}</small></p>
            </div>
            <div class="body-section">
                <h2 class="mb-4">To Whom It May Concern</h2>
                <p class="text-justify">
                    It's a pleasure to write for {{$testimonial->full_name}} 
                    @if($testimonial->gender == "Male")Son @elseif($testimonial->gender == "Female")Daughter @else Here @endif of {{$testimonial->mother_name}} and {{$testimonial->father_name}} 
                    of Vill/Area :{{$testimonial->vill_area}}, Post: {{$testimonial->post_office}}, 
                    P.S.: {{$testimonial->thana}}, District: {{$testimonial->district}} of Bangladesh. 
                    @if($testimonial->gender == "Male")He @elseif($testimonial->gender == "Female")She @else Here @endif has been known to me since 
                    {{date('d-M-Y',strtotime($student->created_at)) }} 
                    as my student in this institution. 
                    I had sufficient opportunities during the period 
                    with {pPronoun} to assess as my student and as an individual.
                </p>
            
                <p class="pt-2 text-justify">
                    I found {{$student->fname}} intelligent, time-bound, team-oriented, 
                    and achievement-oriented. @if($testimonial->gender == "Male")He @elseif($testimonial->gender == "Female")She @else Here @endif seems to be quite good 
                    in analytical and technical skills, and sincere in access to state-of-the-art 
                    information about the latest issues. {{$student->fname}} has a good academic score in 
                    secondary (SSC) and higher secondary (HSC) level of education (SSC: {{$testimonial->ssc_gpa}} GPA, 
                    and HSC: {{$testimonial->hsc_gpa}} GPA).
                </p>
                <p style="padding: 20px 0px" class="text-justify">
                @if($testimonial->gender == "Male")He @elseif($testimonial->gender == "Female")She @else Here @endif has also proven to have excellent academic 
                    performance and research skills in the concerned {{$testimonial->fProgram}} 
                    ({{$testimonial->cprogram}}) program as resulted in the academic records. 
                    {{$student->fname}} has obtained CGPA {CGPA in concerned program} out of 4.00 in the 
                    {{$testimonial->cprogram}} program of the Bangabandhu Sheikh Mujibur Rahman Science and Technology University of this University. 
                    @if($testimonial->gender == "Male")his @elseif($testimonial->gender == "Female")hers @else theris @endif student number is {{$testimonial->std_id}}. 
                </p>
                <p>
                    In the {{$testimonial->fprogram}} ({{$testimonial->cprogram}}) program, the medium of instruction is in English.
                </p>
                <p style="padding: 20px 0px" class="text-justify">
                    To the best of my knowledge {{$student->fname}} did not take part in any activity subversive to state or of discipline.
                    I wish @if($testimonial->gender == "Male")his @elseif($testimonial->gender == "Female")hers @else theris @endif every success in life. 
                </p>
                <p>
                    Sincerely,
                </p>
                <div class="signature-box">
                    <img
                    class="dean-signature"
                    src="/images/{{$dept_chairman->signature}}"
                    alt="dean-signature"
                    />
                </div>
                <p class="pt-2">
                    {{$dept_chairman->name_english}}<br />
                    Chairman <br/> {{$dept->dept_eng}}
                </p>
                <p>
                  Bangabandhu Sheikh Mujibur Rahman Science and Technology University <br />
                  Gopalganj 8100, Bangladesh.
                </p>
                <div class="position-absolute bottom-[24%] right-[5%]">
                    {!! DNS1D::getBarcodeHTML($testimonial->std_id, 'C39+',1,33) !!}
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
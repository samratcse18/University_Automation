

<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Medium of Instruction Certificate</title>

    <style>

      body {

        /* margin: 0px;

        padding: 0px; */

        font-family: 'corbel', serif;

        font-style:regular;

        

        

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

        /*font-family: 'Nikosh', serif;*/

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

        margin-top: 10px;

        color: gray;

        margin-bottom:0px;

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

        /*transform: translateY(95px);*/

        margin:0px;

      }

      /*.footer-section {*/

      /*  margin-top: 13%;*/

      /*  height: 70px;*/

      /*  display: flex;*/

      /*  justify-content: space-around;*/

      /*}*/

      a {

        text-decoration: none;

        cursor: pointer;

        color: forestgreen;

        font-weight: 700;

      }

      .create_date{

          font-family:"HelloKetta-d99oX" serif;

          

      }

      .barcode{
        position:absolute;
        top:11.5%;
        left:42%;
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

    <table style="width:100%">

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

                    <p style="font-size:0.85rem;font-weight: 800;">

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

            <td style="width:50%;text-align:left ">

                <p style="text-transform:uppercase">Ref: BSMRSTU/{{strtolower($certificate->dept_name)}}/PP/{{$certificate->std_id}}/(3)

                </p>

            </td >

                <td style="width:49%;text-align:right"><p>Date: {{date('d-M-Y',strtotime($certificate->updated_at))}}</p></td>

            </tr>

        </tbody>

    </table>

        <div class="body-section">

            <h2 style="font-weight: bold;font-size:1.5rem">Medium of Instruction Certificate</h2>

            <p style="text-align: justify;">

                This is to certify that, {{$certificate->full_name}} @if($certificate->gender == "Male")Son @elseif($certificate->gender == "Female")Daughter @else Here @endif of 

                {{$certificate->mother_name}} and {{$certificate->father_name}} of Vill/Area 

                {{$certificate->vill_area}}, Post: {{$certificate->post_office}}, Police Station/Thana: {{$certificate->thana}}, 

                District: {{$certificate->district}} of Bangladesh is a student of 

                the {{$certificate->fProgram}} {{$certificate->cprogram}} program of 

                the Bangabandhu Sheikh Mujibur Rahman Science and Technology University.

                @if($certificate->gender == "Male")He @elseif($certificate->gender == "Female")She @else Here @endif 

                has been known to me since {{date('d-M-Y',strtotime($student->created_at)) }} 

                as my student in this institution. I had sufficient opportunities during 

                the period with  @if($certificate->gender == "Male")his @elseif($certificate->gender == "Female")hers @else theirs @endif to assess as my student and as an individual.

            </p>



            <p style="padding-top:1rem;text-align: justify;">

                {{$student->fname}}’s student number is {{$certificate->std_id}} in the academic session 

                {{$certificate->academic_session}}. For the {{$certificate->fProgram}}  {{$certificate->cprogram}}  program of 

                this University, the medium of instruction is in English.

            </p>



            <p style="padding: 20px 0px;text-align: justify;">

                To the best of my knowledge {{$student->fname}} did not take part in any activity subversive to state or of discipline.

                I wish @if($certificate->gender == "Male")his @elseif($certificate->gender == "Female")hers @else theirs @endif every success in life. 

            </p>

            <p style="text-align: justify;margin-top:1rem">

                Sincerely,

            </p>

            <div class="signature-box">

                <img

                class="dean-signature"

                src="{{public_path('/images/'.$dept_chairman->signature) }}"

                alt="dean-signature"

                />

                <span style="font-size:0.6rem;font-style:italic;font-family: 'HelloKetta-d99oX', serif;">{{date('d/m/Y', strtotime($certificate->updated_at))}}</span>

            </div>

            <p class="pt-2">

                {{$dept_chairman->name_english}}<br />

                Chairman <br/>Department of  {{$dept->dept_eng}}

            </p>

            <p>

                Bangabandhu Sheikh Mujibur Rahman Science and Technology University <br />

                Gopalganj 8100, Bangladesh.

            </p>

            

        </div>

       <div class="barcode" >
            <barcode style="width:100%" code="{{$student->student_id}}-{{$certificate->id}}" type="C39+" size="1.0" height="0.7"/>
       </div>
      

        <htmlpagefooter name="myFooter1" style="display:none;margin:0">
            <p style="font-size:0.7rem;color:black">This document is electronically generated, requires no manual signature and seal.</p>

            <hr class="footer-hr-line" />

          <table style="width:100%;margin:0">

              

              <tfoot>

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

              </tfoot>

          </table>

        </htmlpagefooter>

  </body>

  

</html>


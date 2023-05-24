
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>meeting</title>
    <style>
      body {
        /* margin: 0px;
        padding: 0px; */
        font-family: 'Nikosh', serif;
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
        font-family: 'corbel', serif;
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
        margin:0px;
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
        margin:0px;
      }
      .footer-section {
        margin-top: 13%;
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
      @page {
        size: auto;
        odd-footer-name: html_myFooter1;

        }
    </style>
  </head>
  <body style="margin:0.5rem 2rem">
    <table style="width:100%">
      <tbody>
        <tr>
          <td style="width:43%" class="left-section">
            <div class="left-section">
              <h4 style="font-size:1.1rem;font-weight: bold">চেয়ারম্যান, {{$dept->department_bn}}</h4>
              <p style="font-size:1rem;font-weight: 800">
                <p>বঙ্গবন্ধু শেখ মুজিবুর রহমান বিজ্ঞান ও প্রযুক্তি বিশ্ববিদ্যালয়</p>
                গোপালগঞ্জ ৮১০০,বাংলাদেশ।
              </p>
            </div>
          </td>
          <td style="width:10%" class="mid-section">
            
            <img src="{{$message->embed(public_path().'/images/logo.jpg')}}" style="width:50px;height:50px" alt="university-logo" />
            
          </td>
          <td style="width:47%;" class="right-section">
            <div class="right-section">
              <h4 style="text-align:right;font-size:1rem;font-weight: bold;white-space: nowrap;">Chairman, {{$dept->department_full}}</h4>
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
            <p style="text-transform:uppercase;font-size:0.6rem"
              >Ref: bsmrstu/{{$letter->dept_name}}/{{$letter->m_name}}/{{$letter_number}}
            </p>
          </td >
            <td style="width:49%;text-align:right"><p style="font-size:0.6rem">তারিখঃ {{date('d-M-Y',strtotime($letter->create_at))}}</p></td>
        </tr>
      </tbody>
    </table>

    <div class="body-section">
      <h2 style="font-size:2.5rem;font-weight:bold;letter-spacing:2px">বিজ্ঞপ্তি</h2>
      <p>
        প্রিয় মহোদয়,<br/>
        আপনাকে আন্তরিক শুভেচ্ছা। আপনার সদয় অবগতির জন্য জানাচ্ছি যে, 
        আগামী   <span id="meeting_time">{{$letter->m_date}}</span> ইং তারিখ {{$letter->m_time}} 
        ঘটিকায় বঙ্গবন্ধু শেখ মুজিবুর রহমান বিজ্ঞান ও প্রযুক্তি বিশ্ববিদ্যালয়ের {{$letter->m_building_name}} 
        এর {{$letter->m_room_number}} নম্বর কক্ষে {{$letter->dept_nameB}} -এর {{$letter->m_name}} র 
        {{$letter_number}} তম সভা অনুষ্ঠিত হবে। 
        </br>
      </p>
      <p style="padding: 8px 0px">
        উক্ত সভায় আপনি একজন সন্মানিত সদস্য। অতএব, যথাসময়ে উপস্থিত থাকার জন্য 
        আপনাকে আন্তরিক অনুরোধ জানাচ্ছি। 
        উল্লেখ্য, সভার আলোচ্যসূচি এতদসঙ্গে উল্লিখিত সংযুক্তি অংশে সন্নিবেশিত হলো। 
      </p>
      <p>বিনীত </p>
      <p>স্বা/-</p>
      <p>{{$dept_chairman->name_bangla}}</p>
      <p>চেয়ারম্যান, {{$dept->department_bn}}</p>
      <p style="padding-top: 8px; padding-bottom: 15px">
        বঙ্গবন্ধু শেখ মুজিবুর রহমান বিজ্ঞান ও প্রযুক্তি বিশ্ববিদ্যালয়, গোপালগঞ্জ
        ৮১০০, বাংলাদেশ
      </p>
      <p>
        অনুলিপি সদয় অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য- <br />
      </p>
      <div>
        <ol>
          @foreach($meetingMember as $member)
            <li style="text-align:justify">{{$member->email}}</li>
          @endforeach 
      </ol>
      </div>
      <div class="signature-box">
        <img
          class="dean-signature"
          src="{{$message->embed(public_path().'/images/dept/signature/'.$dept_chairman->signature)}}"
          alt="dean-signature"
        />
        <span style="font-size:0.6rem;font-style:italic;font-family: 'HelloKetta-d99oX', serif;">{{date('d-m-Y',strtotime($letter->create_at))}}</span>
      </div>
      <p>
        {{$dept_chairman->name_bangla}}<br />
        চেয়ারম্যান, {{$dept->department_bn}}
      </p>
      <p>
        বঙ্গবন্ধু শেখ মুজিবুর রহমান বিজ্ঞান ও প্রযুক্তি বিশ্ববিদ্যালয়, <br />
        গোপালগঞ্জ ৮১০০, বাংলাদেশ
      </p>
      <p style="margin-top: 15px">
        সংযুক্তিঃ আলোচ্যসূচি <br />
      </p>
      <ol>
          @if(count($agendas) > 0)
              @foreach($agendas as $agenda)
                <li style="text-align:justify">{{$agenda['agenda_text']}}</li>
              @endforeach 
          @endif
      </ol>
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
                
            </tbody>
        </table>
    </htmlpagefooter>  
  </body>

</html>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>recess</title>
    <style>
        body{
            font-family: 'Nikosh', serif;
        }
      /* .header {
        display: flex;
      } */
      .university-logo {
        width: 80px;
        height: 80px;
      }
      .university-name {
        font-size: 2rem;
      }
      .matter {
        margin: 20px 0px;
      }
      p {
        font-size: 10px;
        font-weight: 400;
      }
      .label {
        display: inline-block;
        width: 360px;
        font-size: 10px;
        font-weight: 500;
      }

      .input {
        width: 300px;
        font-size: 10px;
      }
      .num-five {
        font-size: 10px;
        display: inline-block;
      }
      .input,
      .extra-input {
        outline: none;
        border: none;
        border-bottom: dotted;
        font-size: 10px;
      }

      .signature {
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
      }
      .hr-line {
        width: 100%;
        border-bottom: 1px solid black;
        text-align: center;
        font-size: 10px;
      }
      .vacation-count {
        position:absolute;
        top:60%;
        left:5%;
        width:45%
      }
      .hr-line1 {
        border-bottom: 1px solid;
        width: 235px;
        margin-top: 2px;
      }
      .footer {
        position:absolute;
        bottom:5%;
        margin-top: 10px;
        width:100%
      }
    </style>
  </head>
  <body>
    <table>
        <tbody>
            <tr>
                <td>
                    <img
                    class="university-logo"
                    src="https://i.ibb.co/g3b60qg/logo.jpg"
                    alt="university_logo"
                    />
                </td>
                <td style="text-align: center;">
                    <h1 class="university-name">
                        বঙ্গবন্ধু শেখ মুজিবুর রহমান বিজ্ঞান ও প্রযুক্তি বিশ্ববিদ্যালয়
                        গোপালগঞ্জ - ৮১০০
                    </h1>
                </td>
            </tr>
        </tbody>
    </table>
    
      <br />
      <p style="font-size:1.2rem">ডীন/রেজিস্ট্রার/বিভাগীয় চেয়ারম্যান/দপ্তর প্রধান</p>
      <p class="matter" style="font-size:1.2rem">
        বিষয়ঃ নৈমিত্তিক/অর্জিত/কর্তব্য ছুটি ও কর্মস্থল ত্যাগের আবেদন ।
      </p>
       <table style="width:100%">
            <tbody>
                <tr>
                    <td style="width:40%;font-size:1.4rem">১। আবেদনকারীর নাম</td>
                    <td style="width:60%;font-size:1.2rem">{{$application->first_name}} {{$application->last_name}}</td>
                </tr>
                <tr>
                    <td style="width:20%;font-size:1.4rem">২। পদবী</td>
                    <td style="width:80%;font-size:1.2rem">Teacher</td>
                </tr>
                <tr>
                    <td style="width:20%;font-size:1.4rem">৩। বিভাগ/দপ্তর</td>
                    <td style="width:80%;font-size:1.2rem">{{$application->dept_name}}</td>
                </tr>
                <tr>
                    <td style="width:20%;font-size:1.4rem">৪। ছুটির কারন</td>
                    <td style="width:80%;font-size:1.2rem">{{$application->reason}}</td>
                </tr>
                <tr>
                    <td style="width:20%;font-size:1.4rem">৫। ছুটির সময়</td>
                    <td style="width:80%;font-size:1.2rem">{{$application->vacation_start}} 
                        তারিখ থেকে {{$application->vacation_end}} পর্যন্ত {{$application->vacation_days}}
                        দিন
                    </td>
                </tr>
                <tr>
                    <td style="width:20%;font-size:1.4rem;">৬। আবেদন কারীর ক্লাসের দায়িত্বে থাকবেন</td>
                    <td style="width:80%;font-size:1.2rem">{{$application->helper_first_name}} {{$application->helper_last_name}}</td>
                </tr>
                <tr>
                    <td style="width:20%;font-size:1.4rem;text-align:center">৭। ছুটিকালীন সময়ে যোগাযোগের ঠিকানা / মোবাইল নম্বর</td>
                    <td style="width:80%;font-size:1.2rem">{{$application->phone}}</td>
                </tr>
                
            </tbody>
       </table> 
       <div style="position:absolute;top:52%;left:5%;right:5%">
        <table style="width:100%;">
            <tbody>
                <tr>
                    <td style="width:33%;">
                        <p style="margin-left:20%">limon</p>
                        <p style="text-align: center; margin-top: 1px;font-size:1.2rem">
                            ক্লাসের দায়িত্ব পালনকারীর স্বাক্ষর
                        </p>
                    </td>
                    <td style="width:34%">
                        <div class="hr-line">{}</div>
                        <p style="text-align: center; margin-top: 1px;font-size:1.2rem">
                            অন্যান্য দায়িত্ব পালনকারীর স্বাক্ষর
                        </p>
                    </td>
                    <td style="text-align:right;width:33%">
                        <div class="hr-line">{}</div>
                        <p style="text-align: center; margin-top: 1px;font-size:1.2rem">আবেদনকারীর স্বাক্ষর</p>
                    </td>
                </tr>
            </tbody>
        </table>
       </div>


    <div class="vacation-count">
        <table style="width:100%">
            <tbody>
                <tr>
                    <td style="width:45%">2023 সালে পাওনা ছুটি </td>
                    <td style="width:40%;text-align:center">30</td>
                    <td style="width:15%">দিন</td>
                </tr>
                <tr style="margin:0">
                    <td style="border-bottom:1px solid">প্রস্তাবিত / ভোগকৃত ছুটি </td>
                    <td style="text-align:center;border-bottom:1px solid;padding:0">10</td>
                    <td style="border-bottom:1px solid;padding:0">দিন</td>
                </tr>
                <tr>
                    <td>বাকি ছুটি</td>
                    <td style="text-align:center">10</td>
                    <td>দিন</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div
          style="
            position:absolute;
            right:5%;
            bottom:20%;
            width:20%;
            text-align:right;
          "
        >
          <div
            style="
              border-bottom: 1px solid black;
              width: 100%;
              font-size: 10px;
              text-align: right;
              align-item:right;
            "
          >
            {}
          </div>
          <p style="text-align: center;font-size:1.2rem;margin:0px;padding:0px">বিভাগ / দপ্তর প্রধান</p>
        </div>
    <div style="position:absolute;left:5%;bottom:15%">
          <p style="font-size:1.2rem"> <span style="word-spacing: 30px;" >প্রস্তাবিত 5 দিনের</span> ছুটি মঞ্জুর করা হলো ।</p>
    </div>
    <div style="position:absolute;
        bottom:10%;
        width:33%;
        right:5%;">
            <div
            style="
              border-bottom: 1px solid black;
              width: 100%;
              font-size: 10px;
              text-align: center;
            "
          >fgh</div>
            <p style="text-align: center;font-size:1.2rem;margin:0px;padding:0px">ডীন/রেজিস্ট্রার/বিভাগীয় চেয়ারম্যান/দপ্তর প্রধান</p>
    </div>
    <div class="footer">
        <div style="width: 100%; border-bottom: 1px solid black"></div>
        <p style="text-align: center; width: 90%">
          এবং কর্মকর্তা ও কর্মচারীদের ছুটির দরখাস্ত একই ভাবে রেজিস্ট্রার দপ্তরে
          পৌঁছাতে হবে । তবে ছুটির হিসাব সংশ্লিষ্ট বিভাগ/দপ্তর/হলসমূহের
          (রেজিস্ট্রারকে লিপিবদ্ধ করতে হবে ।)
        </p>
      </div>
  </body>
</html>
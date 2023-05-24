@extends('layouts.Dashboard')
@section('divHeadTitle')
<h1>Student Attendance</h1>
@endsection
@section('content')
<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div>
            <div id="attendanceInfo" dept_name="{{$dept_name}}" course_code="{{$course_id}}">
                <div id="attendanceActive">
                    <div class="text-center h-[30vh] flex justify-center items-center bg-[#d5d5d5]">
                        <h1 class="text-[1rem] text-[3rem] md:py-5" id="studentId"></h1>
                    </div>
                    <div class='flex'>
                        <div class="col-6"><button type="button" id="nobutton" class="w-full h-[30vh] md:py-4 text-[3rem] md:text-[3rem] bg-[#e50c0c] text-[#ffffff]">Absent</button></div>
                        <div class="col-6"><button type="button" id="yesbutton" class="w-full h-[30vh] md:py-4 text-[3rem] md:text-[3rem] bg-[#019301] text-[#ffffff]">Present</button></div>
                    </div>
                </div>
                <div id="attendanceEnd"  class='flex justify-center hidden'>
                    <div>
                        @if($today_attendance >0 )
                        <div>
                            <h1 class="text-center text-[2.4rem] pt-2">Today Attendance Already Create</h1>
                            
                        </div>
                        <div class="text-center mt-4 overflow-hidden ">
                            <a href="/home" class="overflow-hidden bg-[#207420] text-[1.4rem] py-3 px-5 text-[#ffffff]" >Back home</a>
                        </div>
                        @else
                        <div>
                            <h1 class="text-center text-[2.4rem] pt-2">Attendance finish</h1>
                            <img src="{{asset('images/success.gif')}}" class="h-[40vh] md:h-[30vh]" alt="Attendance finish">
                        </div>
                        <div class="text-center">
                            <button type="button" id="showattandence" class="w-full bg-[#1AA2A2] hover:bg-[#006666] text-[1.4rem] py-3 text-[#ffffff]" >Save Attendance</button>
                        </div>
                        @endif
                        
                        
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('scriptDevDept')
<script>
    var attendance_list = new Array();
    var dept_name = $('#attendanceInfo').attr('dept_name');
    var course_code = $('#attendanceInfo').attr('course_code');
    $.ajax({
        method:'GET',
        url:"{{route('deptstudentGet',['dept_name'=>$dept_name,'course'=>$course_id])}}",
        success:(response)=>{
            var i =0
            $("#studentId").text(response[i]['student_id'])
            $('#nobutton').on('click',()=>{
                var nodict = {
                    std_id :response[i]['student_id'],
                    attendance:0
                }
                attendance_list.push(nodict)
                if(i < response.length-1){

                    i++;
                    $("#studentId").text(response[i]['student_id'])
                }else{
                    $('#attendanceActive').addClass('hidden');
                    $('#attendanceEnd').removeClass('hidden');
                }
                

            })
            $('#yesbutton').on('click',()=>{
                var yesdict = {
                    std_id :response[i]['student_id'],
                    attendance:1
                }
                attendance_list.push(yesdict)
                if(i < response.length-1){
                    i++;
                    $("#studentId").text(response[i]['student_id']);
                }else{
                    $('#attendanceActive').addClass('hidden');
                    $('#attendanceEnd').removeClass('hidden');
                }
                
            })
                
        }
        
        
    });
    $('#showattandence').on('click',()=>{
        $.ajax({
            method:"POST",
            url:'/teacher/attendance-posts',
            data:{
                "attendances":attendance_list,
                "dept_name":dept_name,
                'course_code':course_code,
                "_token": "{{ csrf_token() }}",
            },
            success:(response)=>{
                if(response == 'success'){
                    window.location.href ='/teacher/class-attendance';
                }
            }
        })
            // console.log(attendance_list);
        })

</script>
    
@endsection
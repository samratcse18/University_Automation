@extends('layouts.Dashboard')
@section('content')
<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-1 ">
    <div class="pt-4 pl-4 flex justify-start" >
        <a href="{{route('office.letters')}}" class="w-32 text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">back</a>
    </div>
    <div class="mt-5 md:col-span-2 md:mt-0">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <form action="{{route('office.routineCreateSave')}}" method="POST">
      @csrf
      <div class=" shadow sm:rounded-md">
            <div class="bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1">
                    <div id="myRoutine">
                        <div class="col-span-2 sm:col-span-3">
                            <label for="student_type" class="block text-sm font-medium text-gray-700">Student Type</label>
                            <select  name="student_type" id="student_type" value="{{ old('student_type') }}" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                <option value='' selected>select program</option>
                                <option value="1" @if($course_info->student_type == 1){{'selected'}}@endif>Regular</option>
                                <option value="2" @if($course_info->student_type == 2){{'selected'}}@endif>Professional</option>
                            </select>   
                        </div>
                        <div class="col-span-2 sm:col-span-3">
                            <label for="batch_session" class="block text-sm font-medium text-gray-700">Session</label>
                            <select  name="batch_session" id="batch_session" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                <option value="" selected>select session</option>
                                @if($course_info)
                                    <option value="{{$course_info->session_year}}" selected>{{$course_info->session_year}}</option>
                                @endif
                                
                            </select>   
                        </div>
                        <div class="col-span-2 sm:col-span-3">
                            <label for="class_name" class="block text-sm font-medium text-gray-700">Class Name</label>
                            <select  name="class_name" id="class_name" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                <option value=''selected >select class</option>
                                <option value="Under Graduation" @if($course_info->class_name == 'Under Graduation'){{'selected'}}@endif>Under Graduation</option>
                                <option value="Post Graduation" @if($course_info->class_name == 'Post Graduation'){{'selected'}}@endif>Post Graduation</option>
                            </select>   
                        </div>
                        <div class="col-span-2 sm:col-span-3 ">
                            <label for="program_name" class="block text-sm font-medium text-gray-700">Program Name</label>
                            <select  name="program_name" id="program_name" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                <option  >select program</option>
                                @if($course_info)
                                    @if($course_info->degree_name)
                                        <option value="{{$course_info->degree_id}}" selected>{{$course_info->degree_name}}</option>
                                    @else
                                        <option value="{{$course_info->degree_id}}" selected>{{$course_info->special_degree}}</option>
                                    @endif
                                @endif
                            </select>
                        
                        </div>
                        <div class="col-span-2 sm:col-span-3 "
                            <label for="semester" class="block text-sm font-medium text-gray-700">Year/Semester</label>
                            <select  name="semester" id="semester" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                <option value="" selected >Select semester</option>
                                @if($course_info)
                                    <option value="{{$course_info->semester}}" selected>{{$course_info->semester}}</option>
                                @endif
                            </select>
                        
                        </div>
                        
                        <div class="col-span-2 sm:col-span-3">
                          <label for="semester_duration" class="block text-sm font-medium text-gray-700">Semester Duration</label>
                          <select  name="semester_duration" id="semester_duration" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                              <option value="" selected>select time</option>
                              @if(count($semester_times) > 0)
                                @foreach($semester_times as $time)
                                  <option value="{{$time->id}}" @if($course_info->semester_duration_id == $time->id){{'selected'}}@endif>{{date('d-M',strtotime($time->semester_start_date))}} to {{date('d-M',strtotime($time->semester_end_date))}} {{$time->semester_year}}year </option>
                                @endforeach
                              
                              @endif
                          </select>   
                        </div>
                          
                        <div class="col-span-2 sm:col-span-3 pt-2">
                          <label for="teacher_type" class="block text-sm font-medium text-gray-700">Select teacher_type</label>
                          <select  name="teacher_type" id="teacher_type" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            <option value="" selected>select teacher type</option>
                            <option value="1">Our Department</option>
                            <option value="2">Other Department</option>
                          </select>
                      
                      </div>
                        <div class="col-span-2 sm:col-span-3 pt-2" id="internal_div" style="display:none">
                              <label for="teacher_internal" class="block text-sm font-medium text-gray-700">Select teacher_internal</label>
                              <select  name="teacher_internal" id="teacher_internal" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                              </select>
                        </div>
                        <div id="external" style="display:none">
                            <div class="col-span-2 sm:col-span-3 pt-2">
                                <label for="teacher_external_dept" class="block text-sm font-medium text-gray-700">Select teacher_external_dept</label>
                                <select  name="teacher_external_dept" id="teacher_external_dept" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                  <option value="" selected>select Dept name</option>
                                  @foreach($depts as $dept)
                                    <option value="{{$dept->dept}}">{{$dept->dept}}</option>
                                  @endforeach                            
                                </select>
                            </div>
                            <div class="col-span-2 sm:col-span-3 pt-2">
                                <label for="teacher_external_teacher" class="block text-sm font-medium text-gray-700">Select teacher_external_teacher</label>
                                <select  name="teacher_external_teacher" id="teacher_external_teacher" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                  
                                </select>
                            </div>
                        </div>
                        
                  </div>
                  <div class=" py-4 flex col-span-2 sm:col-span-3" style="display:flex">
                        <div class="col-span-2 sm:col-span-3 w-1/2">
                            <label for="course_code" class="block text-sm font-medium text-gray-700">Course Number</label>
                            <select  name="course_code" id="course_code" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                              <option value='' selected>select course number</option>
                               
                            </select>
                        
                        </div>
                        <div class="col-span-2 sm:col-span-3 w-1/2 pl-2">
                            <label for="course_credit" class="block text-sm font-medium text-gray-700">Number of class per week</label>
                            <select  name="course_credit" id="course_credit" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                              <option  value=''>select course credit</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                            </select>
                        </div>
                  </div>
                  <div id="class_day_time">
                  </div>
                </div>
                
            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                <button type="submit" class="w-3/6 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('scriptDevDept')
<script>
    let data={};
    $('#myRoutine').on('change',(event)=>{
        
        data={...data,[event.target.name]:event.target.value};

        if(data && data.student_type && data.batch_session && data.class_name && data.semester){
          $.ajax({
              type:'GET',
              url:'/'+data.student_type+'/'+data.batch_session+'/'+data.class_name+'/'+data.semester,
              success:(response)=>{
                  $('#course_code').html(response);
                //   console.log(response)
              }
          }); 
        }
    });


$('#teacher_type').on('change',()=>{
  var change_value = $('#teacher_type').val();
  if(change_value =='1'){
    $('#internal_div').css('display','block');
    $('#external').css('display','none');
    $('#teacher_external_dept').val('')
    $('#teacher_external_teacher').val('');
    $.ajax({
      type:'GET',
      url:'/select-dept-teacher',
      success:function(response){
        $('#teacher_internal').html(response);
      }
    });
  }else if(change_value =='2'){
    $('#external').css('display','block');
    $('#internal_div').css('display','none');
  }
});

$('#course_credit').on('change',()=>{
  let creditSession = sessionStorage.getItem('credit');
  
  var j;
  for(j=0;j<creditSession;j++){
    
    $('#class_day_time #dt_div').remove();
    // console.log(j);
    
  } 
  var credit = $('#course_credit').val();
  let i;
  for(i=0;i<credit;i++){
    var day_time =  '<div id="dt_div" class=" py-4 flex col-span-2 sm:col-span-3" style="display:flex">'+
                        '<div class="col-span-2 sm:col-span-3 w-1/3">'+
                            '<label for="room_number" class="block text-sm font-medium text-gray-700">Class room</label>'+
                            '<select  name="room_number[]" id="room_number'+i+'" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">'+
                            '</select>'+                       
                        '</div>'+
                        '<div class="col-span-2 sm:col-span-3 w-1/3 pl-2">'+
                            '<label for="class_day" class="block text-sm font-medium text-gray-700">Class Day</label>'+
                            '<select  name="class_day[]" id="class_day" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">'+
                              '<option value="#" selected>select day</option>'+
                              '<option value="Sun">Sunday</option>'+
                              '<option value="Mon">Monday</option>'+
                              '<option value="Tue">Tuesday</option>'+
                              '<option value="Wed">Wednestday</option>'+
                              '<option value="Thu">Thursday</option>'+
                              '<option value="Fri">Friday</option>'+
                              '<option value="Sat">Saturday</option>'+
                            '</select>'+                       
                        '</div>'+
                        '<div class="col-span-2 sm:col-span-3 w-1/3 pl-2">'+
                            '<label for="class_time" class="block text-sm font-medium text-gray-700">class start time</label>'+
                            '<input type="time" id="class_time" name="class_time[]"  class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">'+
                        '</div>'+
                        '<div class="col-span-2 sm:col-span-3 w-1/3 pl-2">'+
                            '<label for="end_time" class="block text-sm font-medium text-gray-700">class end time</label>'+
                            '<input type="time" id="end_time" name="end_time[]"  class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">'+
                        '</div>'+
                      '</div>';
       
      $('#class_day_time').append(day_time);
  }
  
    $.ajax({
        type:'GET',
        url:'/room-list',
        success:function(response){
          if(response){
            for(let rm=0;rm<credit;rm++){
              var room_id = '#room_number'+rm;
              $(room_id).html(response);
            }
          }
        }
      });
  sessionStorage.setItem('credit',credit);

});

$('#teacher_external_dept').on('change',()=>{
  var dept_name = $('#teacher_external_dept').val();
  $.ajax({
    
    type:'GET',
    url:"/select-teacher-"+dept_name,
    success:function(response){
      $('#teacher_external_teacher').html(response);
    },
    error:function(){
    }
  });
});


$('#student_type').on('change',()=>{
        var program = $('#student_type').val();
        $.ajax({
            method:"GET",
            url:'/program-type-session-'+program,
            success:(response)=>{
                $('#batch_session').html(response);
            }
        })
    });
    $("#class_name").on('change',()=>{
        var class_name = $('#class_name').val();
        $.ajax({
            method:"GET",
            url:'/class-name-to-program-'+class_name,
            success:(response)=>{
                $('#program_name').html(response);
            }
        })
        
    })

$('#class_name').on('change',()=>{
    var click_value = $('#class_name').val();
    if(click_value =='Under Graduation' ){
        $('#semester').empty();
        var under_g = '<option value="1st Year-1st Semester">1st Year-1st Semester</option>'+
                        '<option value="1st Year-2nd Semester">1st Year-2nd Semester</option>'+
                        '<option value="2nd Year-1st Semester">2nd Year-1st Semester</option>'+
                        '<option value="2nd Year-2nd Semester">2nd Year-2nd Semester</option>'+
                        '<option value="3rd Year-1st Semester">3rd Year-1st Semester</option>'+
                        '<option value="3rd Year-2nd Semester">3rd Year-2nd Semester</option>'+
                        '<option value="4th Year-1st Semester">4th Year-1st Semester</option>'+
                        '<option value="4th Year-2nd Semester">4th Year-2nd Semester</option>'+
                        '<option value="5th Year-1st Semester">5th Year-1st Semester</option>'+
                        '<option value="5th Year-2nd Semester">5th Year-2nd Semester</option>';
        $('#semester').append(under_g);
    }
    
    if(click_value =='Post Graduation'){
        $('#semester').empty();
        var post_g = '<option value="1st Semester">1st Semester</option>'+
                    '<option value="2nd Semester">2nd Semester</option>'+
                    '<option value="3rd Semester">3rd Semester</option>'+
                    '<option value="4th Semester">4th Semester</option>'+
                    '<option value="5th Semester">5th Semester</option>'+
                    '<option value="6th Semester">6th Semester</option>'+
                    '<option value="7th Semester">7th Semester</option>'+
                    '<option value="8th Semester">8th Semester</option>'+
                    '<option value="9th Semester">9th Semester</option>'+
                    '<option value="10th Semester">10th Semester</option>';
        $('#semester').append(post_g);
    }
})



window.onunload=function(){
  sessionStorage.removeItem('credit');
}
</script>

@endsection
@extends('layouts.Dashboard')
@section('content')
<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div style="display: flex;justify-content: end;">
            <a href="{{route('office.routineCreateView')}}" class="bg-[#1AA2A2] hover:bg-[#006666] text-white font-bold py-2 px-4 my-2 ">Create New Routine</a>
        </div>
        <div>
            <div class='border p-3'>
                <div class="md:flex md:gap-2">
                    <div class="col-span-2 sm:col-span-3 md:w-1/2">
                        <label for="student_type" class="block text-sm font-medium text-gray-700">Student Type</label>
                        <select  name="student_type" id="student_type" value="{{ old('student_type') }}" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            <option value='' selected>select program</option>
                            @if($present)
                                <option value="1" @if($present->student_type == 1){{'selected'}}@endif >Regular</option>
                                <option value="2" @if($present->student_type == 2){{'selected'}}@endif >Professional</option>
                            @else
                                <option value="1" >Regular</option>
                                <option value="2" >Professional</option>
                            @endif
                        </select>   
                    </div>
                    <div class="col-span-2 sm:col-span-3 md:w-1/2">
                        <label for="batch_session" class="block text-sm font-medium text-gray-700">Session</label>
                        <select  name="batch_session" id="batch_session" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            <option value="" selected>select session</option>
                            @if($present)
                            <option value="{{$present->session_year}}" selected>{{$present->session_year}}</option>
                            @endif
                        </select>   
                    </div>
                    <div class="col-span-2 sm:col-span-3 md:w-1/2">
                        <label for="class_name" class="block text-sm font-medium text-gray-700">Class Name</label>
                        <select  name="class_name" id="class_name" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            <option value="" selected>select class name</option>
                            @if($present)
                            <option value="Under Graduation" @if($present->class_name == 'Under Graduation'){{'selected'}}@endif>Under Graduation</option>
                            <option value="Post Graduation" @if($present->class_name == 'Post Graduation'){{'selected'}}@endif>Post Graduation</option>
                            @else
                                <option value="Under Graduation" >Under Graduation</option>
                                <option value="Post Graduation">Post Graduation</option>
                            @endif
                        </select>
                    
                    </div>
                </div>
                    
                <div class="md:flex md:gap-2 pt-2">

                    <div class="col-span-2 sm:col-span-3 md:w-1/2">
                        <label for="program_name" class="block text-sm font-medium text-gray-700">Program Name</label>
                        <select  name="program_name" id="program_name" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            <option value='' >select program</option>
                            @if($present)
                                @if($program->degree_name)
                                    <option value='{{$program->id}}' selected>{{$program->degree_name}}</option>
                                @else
                                    <option value='{{$program->id}}' selected>{{$program->special_degree}}</option>
                                @endif
                            @endif
                            
                        </select>
                    </div>
                
                    <div class="col-span-2 sm:col-span-3 md:w-1/2">
                        <label for="semester" class="block text-sm font-medium text-gray-700">Year/Semester</label>
                        <select  name="semester" id="semester" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            <option  value='' >Select semester</option>
                            @if($present)
                                <option  value='{{$present->semester}}' selected >{{$present->semester}}</option>
                            @endif
                        </select>
                    
                    </div>
                    
                    <div class="col-span-2 sm:col-span-3 md:w-1/2 pl-2 ">
                        <button type="submit" id="submit_" class="w-full text-center text-white mt-[1rem] md:mt-[23px] bg-[#1AA2A2] hover:bg-[#006666]" style="padding: 0.5rem 1rem;">view</button>
                    </div>
                </div>
            </div>
            <div class="mt-4 pb-2 bg-[#b1b1b1]">
                <div class="py-3 border-b">
                    <h2 class="text-center text-[2rem]">Class Routine</h2>
                </div>
                @if($present)
                <div id="oneday" class="flex py-1 text-center bg-[#b1b1b1] border-b gap-x-3">
                    <div class="capitalize self-center py-2 px-1 w-[100px]" style=" @if(date('D') == 'Sun') background-color:green @endif">sunday</div>
                    
                    @foreach($sunday as $mon)
                        <div id="divth{{$loop->index}}" class="routineBtn p-2 bg-[#505250] rounded-md text-white cursor-pointer" data-target='#model-{{$mon->class_routine_id}}' clsDay="{{$mon->routine_day}}" startdate="{{$mon->class_time}}" enddata = "{{$mon->class_end_time}}">
                            <p id="start" style="font-size:0.7rem" class="routine" >{{date('h:m a',strtotime($mon->class_time ))}}-{{date('h:m a',strtotime($mon->class_end_time ))}}</p>
                            <p style="font-size:0.7rem">{{$mon->course_code}}</p>
                        </div>
                        <div id="model-{{$mon->class_routine_id}}" class="model fixed inset-0 overflow-auto hidden bg-black bg-opacity-50 z-50">
                            <div style="top:45%" class="model-content relative m-auto max-w-md p-4 bg-white rounded-md shadow-lg">
                                <div class="flex justify-end">
                                    <button class="btn-red-500 close-model-btn" aria-label="Close model-{{$mon->class_routine_id}}" title="Closes the current model" >Close</button>
                                </div>
                                <div>
                                    <p>{{$mon->course_code}} : {{$mon->course_name}}</p>
                                    <p>Room Number : {{$mon->dept_room_number}}</p>
                                    <p>{{$mon->teacher_fname}} {{$mon->teacher_lname}}</p>
                                    <p>Dept : {{$mon->teacher_dept}}</p>
                                    <a href="{{route('office.routineClassUpdateView',['class_routine_id'=>$mon->class_routine_id])}}">Update</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
                <div id="twoday" class="flex py-1 text-center bg-[#b1b1b1] border-b gap-x-3">
                    <div class="capitalize self-center py-2 px-1 w-[100px]" style=" @if(date('D') == 'Mon') background-color:green @endif">monday</div>
                    @foreach($monday as $mon)
                        <div id="divth{{$loop->index}}" class="routineBtn p-2 bg-[#505250] rounded-md text-white cursor-pointer" data-target='#model-{{$mon->class_routine_id}}' clsDay="{{$mon->routine_day}}" startdate="{{$mon->class_time}}" enddata = "{{$mon->class_end_time}}">
                            <p id="start" style="font-size:0.7rem" class="routine" >{{date('h:m a',strtotime($mon->class_time ))}}-{{date('h:m a',strtotime($mon->class_end_time ))}}</p>
                            <p style="font-size:0.7rem">{{$mon->course_code}}</p>
                        </div>
                        <div id="model-{{$mon->class_routine_id}}" class="model fixed inset-0 overflow-auto hidden bg-black bg-opacity-50 z-50">
                            <div style="top:45%" class="model-content relative m-auto max-w-md p-4 bg-white rounded-md shadow-lg">
                                <div class="flex justify-end">
                                    <button class="btn-red-500 close-model-btn" aria-label="Close model-{{$mon->class_routine_id}}" title="Closes the current model" >Close</button>
                                </div>
                                <div>
                                    <p>{{$mon->course_code}} : {{$mon->course_name}}</p>
                                    <p>Room Number : {{$mon->dept_room_number}}</p>
                                    <p>{{$mon->teacher_fname}} {{$mon->teacher_lname}}</p>
                                    <p>Dept : {{$mon->teacher_dept}}</p>
                                    <a href="{{route('office.routineClassUpdateView',['class_routine_id'=>$mon->class_routine_id])}}">Update</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div id="threeday" class="flex py-1 text-center bg-[#b1b1b1] border-b gap-x-3">
                    <div class="capitalize self-center py-2 px-1 w-[100px]" style=" @if(date('D') == 'Tue') background-color:green @endif">tuesday</div>
                    @foreach($tuesday as  $mon)
                        <div id="divth{{$loop->index}}" class="routineBtn p-2 bg-[#505250] rounded-md text-white cursor-pointer" data-target='#model-{{$mon->class_routine_id}}' clsDay="{{$mon->routine_day}}" startdate="{{$mon->class_time}}" enddata = "{{$mon->class_end_time}}">
                            <p id="start" style="font-size:0.7rem" class="routine" >{{date('h:m a',strtotime($mon->class_time ))}}-{{date('h:m a',strtotime($mon->class_end_time ))}}</p>
                            <p style="font-size:0.7rem">{{$mon->course_code}}</p>
                        </div>
                        <div id="model-{{$mon->class_routine_id}}" class="model fixed inset-0 overflow-auto hidden bg-black bg-opacity-50 z-50">
                            <div style="top:45%" class="model-content relative m-auto max-w-md p-4 bg-white rounded-md shadow-lg">
                                <div class="flex justify-end">
                                    <button class="btn-red-500 close-model-btn" aria-label="Close model-{{$mon->class_routine_id}}" title="Closes the current model" >Close</button>
                                </div>
                                <div>
                                    <p>{{$mon->course_code}} : {{$mon->course_name}}</p>
                                    <p>Room Number : {{$mon->dept_room_number}}</p>
                                    <p>{{$mon->teacher_fname}} {{$mon->teacher_lname}}</p>
                                    <p>Dept : {{$mon->teacher_dept}}</p>
                                    <a href="{{route('office.routineClassUpdateView',['class_routine_id'=>$mon->class_routine_id])}}">Update</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    
                </div>
                <div id="fourday" class="flex py-1 text-center bg-[#b1b1b1] border-b gap-x-3">
                    <div class="capitalize self-center py-2 px-1 w-[100px]" style=" @if(date('D') == 'Wed') background-color:green @endif">wednesday</div>

                    @foreach($wednesday as $mon)
                        <div id="divth{{$loop->index}}" class="routineBtn p-2 bg-[#505250] rounded-md text-white cursor-pointer" data-target='#model-{{$mon->class_routine_id}}' clsDay="{{$mon->routine_day}}" startdate="{{$mon->class_time}}" enddata = "{{$mon->class_end_time}}">
                            <p id="start" style="font-size:0.7rem" class="routine" >{{date('h:m a',strtotime($mon->class_time ))}}-{{date('h:m a',strtotime($mon->class_end_time ))}}</p>
                            <p style="font-size:0.7rem">{{$mon->course_code}}</p>
                        </div>
                        <div id="model-{{$mon->class_routine_id}}" class="model fixed inset-0 overflow-auto hidden bg-black bg-opacity-50 z-50">
                            <div style="top:45%" class="model-content relative m-auto max-w-md p-4 bg-white rounded-md shadow-lg">
                                <div class="flex justify-end">
                                    <button class="btn-red-500 close-model-btn" aria-label="Close model-{{$mon->class_routine_id}}" title="Closes the current model" >Close</button>
                                </div>
                                <div>
                                    <p>{{$mon->course_code}} : {{$mon->course_name}}</p>
                                    <p>Room Number : {{$mon->dept_room_number}}</p>
                                    <p>{{$mon->teacher_fname}} {{$mon->teacher_lname}}</p>
                                    <p>Dept : {{$mon->teacher_dept}}</p>
                                    <a href="{{route('office.routineClassUpdateView',['class_routine_id'=>$mon->class_routine_id])}}">Update</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div id="fiveday" class="flex py-1 text-center bg-[#b1b1b1] border-b gap-x-3">
                    <div class="capitalize self-center py-2 px-1 w-[100px]" style=" @if(date('D') == 'Thu') background-color:green @endif">thursday</div>
                    @foreach($thursday as $mon)
                        <div id="divth{{$loop->index}}" class="routineBtn p-2 bg-[#505250] rounded-md text-white cursor-pointer" data-target='#model-{{$mon->class_routine_id}}' clsDay="{{$mon->routine_day}}" startdate="{{$mon->class_time}}" enddata = "{{$mon->class_end_time}}">
                            <p id="start" style="font-size:0.7rem" class="routine" >{{date('h:m a',strtotime($mon->class_time ))}}-{{date('h:m a',strtotime($mon->class_end_time ))}}</p>
                            <p style="font-size:0.7rem">{{$mon->course_code}}</p>
                        </div>
                        <div id="model-{{$mon->class_routine_id}}" class="model fixed inset-0 overflow-auto hidden bg-black bg-opacity-50 z-50">
                            <div style="top:45%" class="model-content relative m-auto max-w-md p-4 bg-white rounded-md shadow-lg">
                                <div class="flex justify-end">
                                    <button class="btn-red-500 close-model-btn" aria-label="Close model-{{$mon->class_routine_id}}" title="Closes the current model" >Close</button>
                                </div>
                                <div>
                                    <p>{{$mon->course_code}} : {{$mon->course_name}}</p>
                                    <p>Room Number : {{$mon->dept_room_number}}</p>
                                    <p>{{$mon->teacher_fname}} {{$mon->teacher_lname}}</p>
                                    <p>Dept : {{$mon->teacher_dept}}</p>
                                    <a href="{{route('office.routineClassUpdateView',['class_routine_id'=>$mon->class_routine_id])}}">Update</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    
                </div>
                @endif
            </div>
        </div>    
    </div>
</div>
@endsection
@section('scriptDevDept')
    <script>
        const button = document.querySelectorAll('.routineBtn');
        button.forEach((b)=>{
            b.addEventListener('click',()=>{
                var targert  = b.getAttribute('data-target');
                var modelid = targert.substring(1);
                var clickmodel = document.getElementById(modelid);
                clickmodel.classList.remove('hidden');
            })
        })
        const closebutton = document.querySelectorAll('.close-model-btn');
        closebutton.forEach((c)=>{
            c.addEventListener('click',()=>{
                var m= c.getAttribute('aria-label');
                console.log(m.substring(6))
                var l = document.getElementById(m.substring(6));
                l.classList.add('hidden')
                // console.log(l.classList.add('hidden'))
            })
        });
        var date_ = new Date();
        const days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
        var day = days[date_.getDay()];
        var timeSection = document.querySelectorAll('.routineBtn');
        var tims = new Date();
        var today = tims.toJSON().slice(0, 10)
        for(var l of timeSection){
            var routine_day = l.getAttribute('clsDay');
            var endString =today+' '+l.getAttribute('enddata');
            var startString = today+' '+l.getAttribute('startdate');
            var startTime = new Date(startString);
            var endTime = new Date(endString);
            if((tims.getTime() >= startTime.getTime() && tims.getTime() <= endTime.getTime()) && day == routine_day){
                l.classList.add('bg-[#2912a7]')
            }
            
        }
        if(day == "Sun"){
            $('#oneday').addClass('bg-[#ffcb6b]')
        }
        if(day == "Mon"){
            $('#twoday').addClass('bg-[#ffcb6b]')
        }
        if(day == "Tue"){
            $('#threeday').addClass('bg-[#ffcb6b]')
        }
        if(day == "Wed"){
            $('#fourday').addClass('bg-[#ffcb6b]')
        }
        if(day == "Thu"){
            $('#fiveday').addClass('bg-[#ffcb6b]')
        }
        
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
            });
            
            
            
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
            
        });
        
        $('#submit_').on('click',()=>{
            var student_type= $('#student_type').val();
            var session_ =$('#batch_session').val();
            var class_name = $('#class_name').val();
            var program_name = $('#program_name').val();
            var semester_ = $('#semester').val();
            if(student_type && session_ && class_name && program_name && semester_){
                $.ajax({
                    method:'POST',
                    url:'/present-year-semester',
                    data:{
                        student_type:student_type,
                        session:session_,
                        class_name:class_name,
                        program_name:program_name,
                        semester:semester_,
                        _token: "{{ csrf_token() }}"
                    },
                    success:function(response){
                        // console.log('success')
                        window.location.reload();
                    }
                });
            }else{
                alert('Please fill-up all field');
            }
            
        })
    </script>
    
@endsection
@extends('layouts.Dashboard')
@section('content')
<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <!--<div style="display: flex;justify-content: end;padding: 1rem 0rem;background-color: ghostwhite;">-->
            
        <!--    <a href="#" style="padding: 4px 1rem;background: #006666;color: white;font-weight: 700;font-size: 1.1rem;">Back</a>-->
            
        <!--</div>-->
        <div>
            
            <div class="pb-2 bg-[#b1b1b1]">

                    <div id="oneday" class="flex py-1 text-center bg-[#b1b1b1] border-b gap-x-3">
                        <div class="capitalize self-center py-2 px-1 w-[100px]" style=" @if(date('D') == 'Sun') background-color:green @endif">sunday</div>
                        @foreach($sunday as $mon)
                            <div id="divth{{$loop->index}}" class="routineBtn p-2 bg-[#505250] rounded-md text-white cursor-pointer" data-target='#model-{{$mon->id}}' clsDay="{{$mon->routine_day}}" startdate="{{$mon->class_time}}" enddata = "{{$mon->class_end_time}}">
                                <p id="start" style="font-size:0.7rem" class="routine" >{{date('h:m a',strtotime($mon->class_time ))}}-{{date('h:m a',strtotime($mon->class_end_time ))}}</p>
                                <p style="font-size:0.7rem">{{$mon->course_code}}</p>
                            </div>
                            <div id="model-{{$mon->id}}" class="model fixed inset-0 overflow-auto hidden bg-black bg-opacity-50 z-50">
                                <div style="top:45%" class="model-content relative m-auto max-w-md p-4 bg-white rounded-md shadow-lg">
                                    <div class="flex justify-end">
                                        <button class="btn-red-500 close-model-btn text-[#006666]" aria-label="Close model-{{$mon->id}}" title="Closes the current model" >Close</button>
                                    </div>
                                    <div>
                                        <p>{{$mon->course_code}} : {{$mon->course_name}}</p>
                                        <p>Room Number : {{$mon->dept_room_number}}</p>
                                        <p>Dept : {{$mon->dept_name}}</p>
                                        <p>Semester : {{$mon->semester_number}}</p>
                                        <a href="{{route('teacher.courseAssignmentCreateView',['course_id'=>$mon->course_id])}}" class="hover:underline underline-offset-8 hover:bg-[red] hover:py-[4px];">Add Assignment</a>
                                        
                                        <a href="{{route('studentClassAttendanceView',['dept_name'=>$mon->dept_name,'course_id'=>$mon->course_code])}}" class="px-4 text-[#114611] hover:text-[#114611] hover:underline hover:bg-[#006666] underline-offset-8">Attendance</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                    <div id="twoday" class="flex py-1 text-center bg-[#b1b1b1] border-b gap-x-3">
                        <div class="capitalize self-center py-2 px-1 w-[100px]" style=" @if(date('D') == 'Mon') background-color:green @endif">monday</div>
                        @foreach($monday as $mon)
                            <div id="divth{{$loop->index}}" class="routineBtn p-2 bg-[#505250] rounded-md text-white cursor-pointer" data-target='#model-{{$mon->id}}' clsDay="{{$mon->routine_day}}" startdate="{{$mon->class_time}}" enddata = "{{$mon->class_end_time}}">
                                <p id="start" style="font-size:0.7rem" class="routine" >{{date('h:m a',strtotime($mon->class_time ))}}-{{date('h:m a',strtotime($mon->class_end_time ))}}</p>
                                <p style="font-size:0.7rem">{{$mon->course_code}}</p>
                            </div>
                            <div id="model-{{$mon->id}}" class="model fixed inset-0 overflow-auto hidden bg-black bg-opacity-50 z-50">
                                <div style="top:45%" class="model-content relative m-auto max-w-md p-4 bg-white rounded-md shadow-lg">
                                    <div class="flex justify-end">
                                        <button class="btn-red-500 close-model-btn text-[#006666]" aria-label="Close model-{{$mon->id}}" title="Closes the current model"  >Close</button>
                                    </div>
                                    <div>
                                        <p>{{$mon->course_code}} : {{$mon->course_name}}</p>
                                        <p>Room Number : {{$mon->dept_room_number}}</p>
                                        <p>Dept : {{$mon->dept_name}}</p>
                                        <p>Semester : {{$mon->semester_number}}</p>
                                        <a href="{{route('teacher.courseAssignmentCreateView',['course_id'=>$mon->course_id])}}" class="underline underline-offset-8 hover:bg-[#006666] hover:text-[white] hover:py-[4px] hover:px-[3px]">Add Assignment</a>
                                        <a href="{{route('studentClassAttendanceView',['dept_name'=>$mon->dept_name,'course_id'=>$mon->course_code])}}" class="px-4 text-[#1AA2A2] hover:text-[#006666] hover:underline underline-offset-8">Attendance</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                    <div id="threeday" class="flex py-1 text-center bg-[#b1b1b1] border-b gap-x-3">
                        <div class="capitalize self-center py-2 px-1 w-[100px]" style=" @if(date('D') == 'Tue') background-color:green @endif">tuesday</div>
                        @foreach($tuesday as  $mon)
                            <div id="divth{{$loop->index}}" class="routineBtn p-2 bg-[#505250] rounded-md text-white cursor-pointer" data-target='#model-{{$mon->id}}' clsDay="{{$mon->routine_day}}" startdate="{{$mon->class_time}}" enddata = "{{$mon->class_end_time}}">
                                <p id="start" style="font-size:0.7rem" class="routine" >{{date('h:m a',strtotime($mon->class_time ))}}-{{date('h:m a',strtotime($mon->class_end_time ))}}</p>
                                <p style="font-size:0.7rem">{{$mon->course_code}}</p>
                            </div>
                            <div id="model-{{$mon->id}}" class="model fixed inset-0 overflow-auto hidden bg-black bg-opacity-50 z-50">
                                <div style="top:45%" class="model-content relative m-auto max-w-md p-4 bg-white rounded-md shadow-lg">
                                    <div class="flex justify-end">
                                        <button class="btn-red-500 close-model-btn text-[#006666]" aria-label="Close model-{{$mon->id}}" title="Closes the current model" >Close</button>
                                    </div>
                                    <div>
                                        <p>{{$mon->course_code}} : {{$mon->course_name}}</p>
                                        <p>Room Number : {{$mon->dept_room_number}}</p>
                                        <p>Dept : {{$mon->dept_name}}</p>
                                        <p>Semester : {{$mon->semester_number}}</p>
                                        <a href="{{route('teacher.courseAssignmentCreateView',['course_id'=>$mon->course_id])}}" class="underline underline-offset-8 hover:bg-[#006666] hover:text-[white] hover:py-[4px] hover:px-[3px]">Add Assignment</a>
                                        <a href="{{route('studentClassAttendanceView',['dept_name'=>$mon->dept_name,'course_id'=>$mon->course_code])}}" class="px-4 text-[#1AA2A2] hover:text-[#006666] hover:underline underline-offset-8">Attendance</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                    <div id="fourday" class="flex py-1 text-center bg-[#b1b1b1] border-b gap-x-3">
                        <div class="capitalize self-center py-2 px-1 w-[100px]" style=" @if(date('D') == 'Wed') background-color:green @endif">wednesday</div>
                        @foreach($wednesday as $mon)
                            <div id="divth{{$loop->index}}" class="routineBtn p-2 bg-[#505250] rounded-md text-white cursor-pointer" data-target='#model-{{$mon->id}}' clsDay="{{$mon->routine_day}}" startdate="{{$mon->class_time}}" enddata = "{{$mon->class_end_time}}">
                                <p id="start" style="font-size:0.7rem" class="routine" >{{date('h:m a',strtotime($mon->class_time ))}}-{{date('h:m a',strtotime($mon->class_end_time ))}}</p>
                                <p style="font-size:0.7rem">{{$mon->course_code}}</p>
                            </div>
                            <div id="model-{{$mon->id}}" class="model fixed inset-0 overflow-auto hidden bg-black bg-opacity-50 z-50">
                                <div style="top:45%" class="model-content relative m-auto max-w-md p-4 bg-white rounded-md shadow-lg">
                                    <div class="flex justify-end">
                                        <button class="btn-red-500 close-model-btn text-[#006666]" aria-label="Close model-{{$mon->id}}" title="Closes the current model" >Close</button>
                                    </div>
                                    <div>
                                        <p>{{$mon->course_code}} : {{$mon->course_name}}</p>
                                        <p>Room Number : {{$mon->dept_room_number}}</p>
                                        <p>Dept : {{$mon->dept_name}}</p>
                                        <p>Semester : {{$mon->semester_number}}</p>
                                        <a href="{{route('teacher.courseAssignmentCreateView',['course_id'=>$mon->course_id])}}" class="underline underline-offset-8 hover:bg-[#006666] hover:text-[white] hover:py-[4px] hover:px-[3px]">Add Assignment</a>
                                        <a href="{{route('studentClassAttendanceView',['dept_name'=>$mon->dept_name,'course_id'=>$mon->course_code])}}" class="px-4 text-[#1AA2A2] hover:text-[#006666] hover:underline underline-offset-8">Attendance</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                    <div id="fiveday" class="flex py-1 text-center bg-[#b1b1b1] border-b gap-x-3">
                        <div class="capitalize self-center py-2 px-1 w-[100px]" style=" @if(date('D') == 'Thu') background-color:green @endif">thursday</div>
                        @foreach($thursday as $mon)
                            <div id="divth{{$loop->index}}" class="routineBtn p-2 bg-[#505250] rounded-md text-white cursor-pointer" data-target='#model-{{$mon->id}}' clsDay="{{$mon->routine_day}}" startdate="{{$mon->class_time}}" enddata = "{{$mon->class_end_time}}">
                                <p id="start" style="font-size:0.7rem" class="routine" >{{date('h:m a',strtotime($mon->class_time ))}}-{{date('h:m a',strtotime($mon->class_end_time ))}}</p>
                                <p style="font-size:0.7rem">{{$mon->course_code}}</p>
                            </div>
                            <div id="model-{{$mon->id}}" class="model fixed inset-0 overflow-auto hidden bg-black bg-opacity-50 z-50">
                                <div style="top:45%" class="model-content relative m-auto max-w-md p-4 bg-white rounded-md shadow-lg">
                                    <div class="flex justify-end">
                                        <button class="btn-red-500 close-model-btn text-[#006666]" aria-label="Close model-{{$mon->id}}" title="Closes the current model" >Close</button>
                                    </div>
                                    <div>
                                        <p>{{$mon->course_code}} : {{$mon->course_name}}</p>
                                        <p>Room Number : {{$mon->dept_room_number}}</p>
                                        <p>Dept : {{$mon->dept_name}}</p>
                                        <p>Semester : {{$mon->semester_number}}</p>
                                        <a href="{{route('teacher.courseAssignmentCreateView',['course_id'=>$mon->course_id])}}" class="underline underline-offset-8 hover:bg-[#006666] hover:text-[white] hover:py-[4px] hover:px-[3px]">Add Assignment</a>
                                        <a href="{{route('studentClassAttendanceView',['dept_name'=>$mon->dept_name,'course_id'=>$mon->course_code])}}" class="px-4 text-[#1AA2A2] hover:text-[#006666] hover:underline underline-offset-8">Attendance</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                
                
                
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
        // var day = 'Sun';
        var timeSection = document.querySelectorAll('.routineBtn');
        var tims = new Date();
        var today = tims.toJSON().slice(0, 10)
        for(var l of timeSection){
            var routine_day = l.getAttribute('clsDay');
            // console.log('routine_day');
            // console.log(routine_day);
            var endString =today+' '+l.getAttribute('enddata');
            var startString = today+' '+l.getAttribute('startdate');
            var startTime = new Date(startString);
            var endTime = new Date(endString);
            if((tims.getTime() >= startTime.getTime() && tims.getTime() <= endTime.getTime() ) && day == routine_day){
                l.classList.add('bg-[#2912a7]')
                console.log(startTime);
            }
        }
        console.log()
        console.log(tims.getTime())
        
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
        
    </script>
    
@endsection
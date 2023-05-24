@extends('layouts.Dashboard')
@section('content')

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div style="display: flex;justify-content: end;">
            <a href="{{route('courseCreateView')}}" class="bg-[#1AA2A2] hover:bg-[#006666] text-white font-bold py-2 px-4 my-2">Add Course</a>
        </div>
        <div class="accordion px-[5px] lg:px-[0px]">
            @foreach($session_year_semester as $sys)
                <div class="accordion-item">
                    <div class="accordion-header text-left  cursor-pointer md:flex md:py-4 md:text-lg  md:justify-left  hover:bg-[#006666] hover:text-white" id="accordion-button-{{ $loop->index }}" onclick="toggleAccordion(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="md:w-4 md:h-[32px] w-4 h-[16px] translate-y-[28px] md:translate-y-0">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
</svg>

                        <p class="pl-[25px] md:pr-3 md:pl-[3px] text-[12px]">Session : {{$sys->session_year}}</p>
                        <p class="text-[12px] pl-[25px] md:pl-[0px]">Year/Semester:  {{$sys->semester}} </p>
                    </div>
                    <div class="accordion-content hidden">
                        <table class="border-collapse border border-slate-400  w-full ">
                            <thead>
                                <tr class="text-center text-[12px]">
                                    <th class="border border-slate-300 pt-3 pb-3 ">Course Code</th>
                                    <th class="border border-slate-300 ">Course Name</th>
                                    <th class="border border-slate-300 ">Course Credit</th>
                                    <th class="border border-slate-300 ">Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dept_course as $course)
                                    @if($course->session_year == $sys->session_year &&
                                        $course->semester == $sys->semester
                                    )
                                    <tr class="text-[12px]">
                                        <td class="border border-slate-300 text-center">{{$course->course_code}}</td>
                                        <td class="border border-slate-300 text-left">{{$course->course_name}}</td>
                                        <td class="border border-slate-300 text-left">{{$course->course_credit}}</td>
                                        <td class="border border-slate-300 text-center">
                                            <button type="button" data-target="#course-{{$course->id}}" class="course_update bg-[#1AA2A2] hover:bg-[#006666] text-white font-bold py-1 px-4">Update</button>
                                        </td>
                                    </tr>
                                    <div id="course-{{$course->id}}" class="model fixed inset-0 overflow-auto hidden bg-black bg-opacity-50 z-50">
                                        <div style="top:40%" class="model-content relative m-auto max-w-md p-4 bg-white rounded-md shadow-lg">
                                            <div class="flex justify-end">
                                                <button class="btn-red-500 close-model-btn" aria-label="Close course-{{$course->id}}" title="Closes the current model" >Close</button>
                                            </div>
                                            <div>
                                                <div>
                                                    <h3 class="text-center text-[12px]">Update Course</h3>
                                                </div>
                                                <form action="{{route('dept.courseUpdate',['course_id'=>$course->id])}}" method="POST">
                                                    @csrf
                                                    <div class="col-span-2 sm:col-span-3 ">
                                                        <label for="course_code" class="block text-sm font-medium text-gray-700">Course Code</label>
                                                        <input type="text" name="course_code" id="course_code" value="{{$course->course_code}}" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-3 ">
                                                        <label for="course_name" class="block text-sm font-medium text-gray-700">Course Name</label>
                                                        <input type="text" name="course_name" id="course_name" value="{{$course->course_name}}" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-3 ">
                                                        <label for="course_credit" class="block text-sm font-medium text-gray-700">Course Credit</label>
                                                        <input type="text" name="course_credit" id="course_credit" value="{{$course->course_credit}}" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-3 my-2">
                                                        <button type="submit" id="updatecoursee" class="bg-[#1AA2A2] hover:bg-[#006666] text-[#ffffff] w-full py-2 text-[12px]">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('scriptDevDept')
<script>
  function toggleAccordion(button) {
    var content = button.nextElementSibling;
    content.classList.toggle("hidden");
    var allContent = document.getElementsByClassName("accordion-content");
    for (var i = 0; i < allContent.length; i++) {
      if (allContent[i] !== content) {
        allContent[i].classList.add("hidden");
      }
    }
  }
   const closebutton = document.querySelectorAll('.close-model-btn');
        closebutton.forEach((c)=>{
            c.addEventListener('click',()=>{
                var m= c.getAttribute('aria-label');
                console.log(m.substring(6))
                var l = document.getElementById(m.substring(6));
                l.classList.add('hidden')
            })
        });
  document.querySelectorAll("[id^='accordion-button-']").forEach(function(button) {
  button.addEventListener("click", function() {
    // remove active class from all buttons
    document.querySelectorAll("[id^='accordion-button-']").forEach(function(b) {
      b.classList.remove("bg-[#cfcfcf]");
    });
    // add active class to the clicked button
    button.classList.add("bg-[#cfcfcf]");
  });
});

const courseUpdate = document.querySelectorAll('.course_update');
courseUpdate.forEach((c)=>{
            c.addEventListener('click',()=>{
                var targert  = c.getAttribute('data-target');
                var modelid = targert.substring(1);
                var clickmodel = document.getElementById(modelid);
                clickmodel.classList.remove('hidden');
            })
        });
$('#updatecoursee').on('click',()=>{
    var course_code = $('#course_name').val();
    console.log('course_code')
});
        
</script>
@endsection
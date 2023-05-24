@extends('layouts.Dashboard')
@section('content')

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div style="display: flex;justify-content: end;">
            <a href="{{route('office.semesterDurationCreateView')}}" class="bg-[#1AA2A2] hover:bg-[#006666] text-white font-bold py-2 px-4 my-2">Create Semester Duration</a>
        </div>
        <div>
            <table class="border-collapse border border-slate-400 w-full">
                <thead>
                    <tr class="text-center text-[12px]">
                        <th class="border border-slate-300 py-2 ">Year</th>
                        <th class="border border-slate-300 ">Semester Start Day</th>
                        <th class="border border-slate-300 ">Semester End Day </th>
                        <th class="border border-slate-300 ">Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @if(count($semesterDuration)>0)
                        @foreach($semesterDuration as $duration)
                            <tr class="text-[12px]">
                                <td class="border border-slate-300 text-center">{{$duration->semester_year}}</td>
                                <td class="border border-slate-300 text-center">{{date('d-M-Y',strtotime($duration->semester_start_date))}}</td>
                                <td class="border border-slate-300 text-center">{{date('d-M-Y',strtotime($duration->semester_end_date))}}</td>
                                <td class="">
                                    <button type="button"  data-target="#duration-{{$duration->id}}" class="durationUpdate w-full text-white bg-[#1AA2A2] hover:bg-[#006666] py-2">Update</button>
                                </td>
                            </tr>
                            <div id="duration-{{$duration->id}}" class="model fixed inset-0 overflow-auto hidden bg-black bg-opacity-50 z-50">
                                <div style="top:40%" class="model-content relative m-auto max-w-md p-4 bg-white rounded-md shadow-lg">
                                    <div class="flex justify-end">
                                        <button class="btn-red-500 close-model-btn hover:text-[#006666]" aria-label="Close duration-{{$duration->id}}" title="Closes the current model" >Close</button>
                                    </div>
                                    <div>
                                        <div>
                                            <h3 class="text-center text-[22px]">Update Semester Duration</h3>
                                        </div>
                                        <form action="{{route('office.semesterDurationUpdate',['duration_id'=>$duration->id])}}" method="POST">
                                            @csrf
                                            <div class="col-span-2 sm:col-span-3 ">
                                                <label for="semester_year" class="block text-sm font-medium text-gray-700">Semester Year</label>
                                                <input type="text" name="semester_year" id="semester_year" value="{{$duration->semester_year}}" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                            </div>
                                            <div class="col-span-2 sm:col-span-3 ">
                                                <label for="semester_start_date" class="block text-sm font-medium text-gray-700">Semester Start Date</label>
                                                <input type="date" name="semester_start_date" id="semester_start_date" value="{{$duration->semester_start_date}}" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                            </div>
                                            <div class="col-span-2 sm:col-span-3 ">
                                                <label for="semester_end_date" class="block text-sm font-medium text-gray-700">Semester End Date</label>
                                                <input type="date" name="semester_end_date" id="semester_end_date" value="{{$duration->semester_end_date}}" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                            </div>
                                            <div class="col-span-2 sm:col-span-3 my-2">
                                                <button type="submit" id="updatecoursee" class="bg-[#1AA2A2] hover:bg-[#006666] text-[#ffffff] w-full py-2 text-[12px]">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@section('scriptDevDept')
    <script>
        const courseUpdate = document.querySelectorAll('.durationUpdate');
            courseUpdate.forEach((c)=>{
                        c.addEventListener('click',()=>{
                            var targert  = c.getAttribute('data-target');
                            var modelid = targert.substring(1);
                            var clickmodel = document.getElementById(modelid);
                            clickmodel.classList.remove('hidden');
                        })
                    });
       const closebutton = document.querySelectorAll('.close-model-btn');
            closebutton.forEach((c)=>{
                c.addEventListener('click',()=>{
                    var m= c.getAttribute('aria-label');
                    console.log(m.substring(6))
                    var l = document.getElementById(m.substring(6));
                    l.classList.add('hidden')
                })
            });
       
            
    </script>
@endsection
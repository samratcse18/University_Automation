@extends('layouts.Dashboard')
@section('content')

<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-1 ">
    <div class="pt-4 pl-4 flex justify-start" >
        <a href="{{route('office.letters')}}" class="w-32 text-center bg-[#1AA2A2] hover:bg-[#006666] text-white font-bold py-2 px-4 ">Back</a>
    </div>
    <div class="mt-5 md:col-span-2 md:mt-0">
      <form action="{{ route('office.createLetter')}}" method="POST">
      @csrf
      <div class=" shadow sm:rounded-md">
            <div class="bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1">
                    <div class="col-span-2 sm:col-span-3">
                        <label for="meeting_name" class="block text-sm font-medium text-gray-700">Name of meeting</label>
                        <!-- <input type="text" name="meeting_name" id="meeting_name" placeholder="Enter name of meeting" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base"> -->
                        <select  name="meeting_name" id="meeting_name" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                          <option value="#" selected>select metting name</option>
                          <option value="volvo">Volvo</option>
                          <option value="saab">Saab</option>
                          <option value="mercedes">Mercedes</option>
                          <option value="audi">Audi</option>
                        </select>
                    
                    </div>
                    
                    <div class=" py-4 flex col-span-2 sm:col-span-3" style="display:flex">
                      <div class="col-span-2 sm:col-span-3 w-1/2">
                          <label for="meeting_date" class="block text-sm font-medium text-gray-700">Meeting Date</label>
                          <input type="text" id="meeting_ban_date" name="meeting_date" hidden>
                          <input type="date"  id="meeting_date"  class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                      
                      </div>
                      <div class="col-span-2 sm:col-span-3 w-1/2 pl-2">
                          <label for="meeting_time" class="block text-sm font-medium text-gray-700">Meeting Time</label>
                          <input type="text" name="meeting_time" id="meeting_time" hidden>
                          <input type="time" id="meeting_time_change"  class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                      </div>
                    </div>
                    <div class="flex col-span-2 sm:col-span-3">
                      <div class="col-span-2 sm:col-span-3 w-1/2">
                          <label for="builing_name" class="block text-sm font-medium text-gray-700">Name of Building</label>
                          
                          <select  name="builing_name" id="builing_name" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            <option value="#" selected>select building</option>
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                          </select>
                      
                      </div>
                      <div class="col-span-2 sm:col-span-3 w-1/2 pl-2">
                          <label for="meeting_room_number" class="block text-sm font-medium text-gray-700">Venue Of Meeting</label>
                          <input type="text" name="meeting_room_number" id="meeting_room_number" placeholder="Enter meeting venue" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                      </div>
                    </div>
                    
                    <div>
                      <div class='flex justify-between py-4 border-b'>
                        <h5 class="flex items-center text-lg font-semibold">Meeting Agenda</h5>
                        <div class="flex flex-col">
                          <div class="flex justify-center">
                            <a herf="#" id="addAgendaField" class="border w-1/2 py-1.5 rounded cursor-pointer  text-center bg-emerald-800 text-white"><i class="fa-solid fa-plus" style="font-size:18px"></i></a>
                          </div>
                          
                          <p class="text-cyan-700">if you add agenda</p>
                        </div>
                      </div>
                      <div id="agendas">
                      </div>
                      
                    </div>
                    <div class=" col-span-2 sm:col-span-3 w-full">
                      <h4 class="text-center py-3">Letter Send By</h4>
                      <textarea  id='teacher_id' name="selectTeacher" hidden></textarea>
                    </div>
                    <div  class="flex col-span-2 sm:col-span-3">
                        <div class="col-span-2 sm:col-span-3 w-1/2">
                          <h4>Self Department</h4>
                          @if(count($dept_teacher) > 0)
                                @foreach($dept_teacher as $member)
                                    <div class="flex items-center py-3 px-5 hover:bg-gray-200 rounded bg-white">
                                        <input id="filter-mobile-color-{{$member->id}}"  name="member[]" value="{{$member->id}}" type="checkbox" class="checkTeacher h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-mobile-color-{{$member->id}}" class="ml-3 min-w-0 flex-1 text-gray-500">{{$member->email}}</label>
                                    </div>
                              @endforeach
                          @else
                              <div class="flex items-center py-3 px-5 hover:bg-gray-200 rounded bg-white">
                                  <label for="filter-mobile-color" class="ml-3 min-w-0 flex-1 text-gray-500">All-ready Selected </label>
                              </div>
                          @endif
                        </div>
                        <div class="col-span-2 sm:col-span-3 w-1/2 pl-2">
                          
                          <label for="dept" class="block text-sm font-medium text-gray-700">Other Department</label>
                            <select  name="dept" id="dept" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                              <option value="#" selected>select Dept name</option>
                              @foreach($depts as $dept)
                                <option value="{{$dept->dept}}">{{$dept->dept}}</option>
                              @endforeach                            
                            </select>
                          <div id="teachers">

                          </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                <button type="submit" id="add_teacher" class="w-3/6 inline-flex justify-center  border-transparent bg-[#1AA2A2] py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-[#006666] focus:outline-none focus:ring-2 focus:ring-[#006666]-500 focus:ring-offset-2">Save</button>
            </div>
        </div>
      </form>
    
    </div>
  </div>
</div>
@endsection
@section('scriptDevDept')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js" integrity="sha512-42PE0rd+wZ2hNXftlM78BSehIGzezNeQuzihiBCvUEB3CVxHvsShF86wBWwQORNxNINlBPuq7rG4WWhNiTVHFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $('#addAgendaField').on('click',function(){
    addField();
    
  });
  var agenda_count =0
  function addField(){
    agenda_count +=1;
    var input_field ='<div class="flex py-2">'+
                      '<span class="pr-2" style="font-size:1.3rem">'+agenda_count+'</span>'+
                      '<input type="text" name="meeting_agendas[]" id="meeting_agenda" placeholder="Enter meeting agenda"  class="border-2 pl-3 h-10  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">'+
                      '<a href="#" id="remove_agenda" class="border py-1.5 rounded  text-center bg-red-700 text-white" style="width:4rem"><i class="fa-solid fa-minus" style="font-size:18px"></i></a>'+
                      '</div>';
    $('#agendas').append(input_field);
  }

  $('#agendas').on('click','#remove_agenda',function(){
    $(this).parent().remove();
    agenda_count -=1;
  })
  $('#meeting_date').on('change',function(){
    var dat =  $('#meeting_date').val();
    let bn = moment(dat).locale('bn')
    let bn_date = bn.format('LL');
    $('#meeting_ban_date').val(bn_date);
  });
  $('#meeting_time_change').on('change',function(){
    var dat =  $('#meeting_time_change').val();
    var date = new Date();
    var month = date.getMonth()+1;
    var today = date.getFullYear()+'-'+month+'-'+date.getDate()+' '+dat;
    
    let time = moment(today).locale('bn')
    let bn_time = time.format('LT');
    $('#meeting_time').val(bn_time);
    console.log(bn_time);
  });
  
  var id_array=[];
  $('#dept').on('change',()=>{
    var dept_name = $('#dept').val();
    $.ajax({
      method:'GET',
      url:"/select-"+dept_name+"-teacher",
      success:(response)=>{
        $("#teachers").html(response);
        var check = document.querySelectorAll('.checkTeacher');
        for(var ck of check){
          ck.addEventListener('click',function(){
            if(this.checked == true){
              id_array.push(this.value);
              // console.log(this.value);
            }else{
              var id_index = id_array.indexOf(this.value);
              id_array.splice(id_index,1);
            }
          })
        }
      }
    });
  })
  var check = document.querySelectorAll('.checkTeacher');
        for(var ck of check){
          ck.addEventListener('click',function(){
            if(this.checked == true){
              id_array.push(this.value);
              // console.log(this.value);
            }else{
              var id_index = id_array.indexOf(this.value);
              id_array.splice(id_index,1);
            }
          })
        }
    $('#add_teacher').on('click',()=>{
      $("#teacher_id").val(id_array);
    });
</script>
@endsection
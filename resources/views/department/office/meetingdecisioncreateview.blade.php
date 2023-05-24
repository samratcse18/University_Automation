@extends('layouts.Dashboard')
@section('content')
<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-1 ">
    <div class="pt-4 pl-4 flex justify-start" >
        <a href="{{route('office.letters')}}" class="w-32 text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">back</a>
    </div>
    <div class="mt-5 md:col-span-2 md:mt-0">
      <form action="{{route('office.meetingdecisionAdd',['letter_id'=>encrypt($letter_id)])}}" method="POST">
      @csrf
        <div class=" shadow sm:rounded-md">
            <div class="bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1">
                <div class="pt-6" id="filter-section-mobile-0">
                        <div class="space-y-2 ">
                            @if($letter_sends)
                                @foreach($letter_sends as $member)
                                    <div class="flex items-center py-3 px-5 hover:bg-gray-200 rounded bg-white">
                                        <input id="filter-mobile-color-{{$member->id}}" name="member[]" value="{{ $member->admin_id}}" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-mobile-color-{{$member->id}}" class="ml-3 min-w-0 flex-1 text-gray-500">{{$member->email}}</label>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center py-3 px-5 hover:bg-gray-200 rounded bg-white">
                                    <label for="filter-mobile-color" class="ml-3 min-w-0 flex-1 text-gray-500">All-ready Selected </label>
                                </div>
                            @endif    
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

</script>
@endsection
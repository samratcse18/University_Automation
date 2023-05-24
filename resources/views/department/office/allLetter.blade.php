@extends('layouts.Dashboard')
@section('content')

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div style="display: flex;justify-content: end;">
            <a href="{{route('office.letterWriting')}}" class="bg-[#1AA2A2] hover:bg-[#006666] text-white font-bold py-2 px-4 my-2">Create New Letter</a>
        </div>
        <div>
            <table class="border-collapse border border-slate-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-slate-300 ">Name of Meeting</th>
                        <th class="border border-slate-300 ">Meeting Date & Time </th>
                        <th class="border border-slate-300 ">Meeting Venu </th>
                        <th class="border border-slate-300 ">Actions </th>
                        
                        <th class="border border-slate-300 ">Create Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_letters as $letter )
                    <tr>
                        <td class="border border-slate-300 text-center">{{$letter->m_name}}</td>
                        <td class="border border-slate-300 text-center"><span>{{$letter->m_date}}</span>,<br/> {{$letter->m_time}}</td>
                        <td class="border border-slate-300 text-center">{{$letter->m_building_name}},<br>Room - {{$letter->m_room_number}}</td>
                        <td class="border border-slate-300 text-center">
                            <!--<a href="{{route('office.letterSendByMembers',['id' => $letter->id])}}"  > Members</a>-->
                            <a class="py-2 px-2 w-1/2 hover:bg-green-700 hover:text-white" href="{{route('office.singleLetterView',['id' => $letter->id])}}"  target="_blank"> View</a>
                            <!--<a class="py-2 px-2 w-1/2 hover:bg-yellow-500 hover:text-white"  href="{{route('office.meetingdecisionCreateView',['id'=>encrypt($letter->id)])}}">Decision</a>-->

                        </td>
                        
                        <td class="border border-slate-300 text-center">{{date('d-M-Y', strtotime($letter->created_at))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

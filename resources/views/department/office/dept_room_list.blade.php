@extends('layouts.Dashboard')
@section('content')

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div style="display: flex;justify-content: end;">
            <a href="{{route('roomCreateView')}}" class="bg-[#1AA2A2] hover:bg-[#006666] text-white font-bold py-2 px-4 my-2">Create New Room</a>
        </div>
        <div>
            <table class="border-collapse border border-slate-400 w-full">
                <thead>
                    <tr class="text-center text-[12px]">
                        <th class="border border-slate-300 pt-2 pb-2 ">Room Number</th>
                        <th class="border border-slate-300">Building Name</th>
                        <th class="border border-slate-300 ">Actions </th>
                        <!-- <th class="border border-slate-300 ">Create Date</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($dept_rooms as $room)
                        <tr class="text-[12px] ">
                            <td class="border border-slate-300">{{$room->dept_room_number}}</td>
                            <td class="border border-slate-300">{{$room->building_name}}</td>
                            <td class="border border-slate-300 text-center pt-2 pb-2">
                                <a href="#" class="bg-[#1AA2A2] hover:bg-[#006666] text-white font-bold py-2 px-4 ">Update</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
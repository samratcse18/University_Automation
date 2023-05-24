@extends('layouts.Dashboard')
@section('content')
    <form action="{{ route('admin.studentAddToHall', ['id' => $data->id]) }}" class="mt-4 space-y-3" method="POST">
        @csrf
        <div class="flex w-[300px] flex-row justify-around lg:w-full px-[8px] lg:px-0">
            <li class="flex w-[245px] justify-between"><span>Add Room</span><span>:</span></li>
            <select name="Room" id=""
                class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
                <option value="" disabled selected>Room</option>
                @foreach ($room as $item)
                    <option value="{{ $item->room }}">{{ $item->room }}</option>
                @endforeach
            </select>
        </div>
        {{-- <div class="flex w-[500px] flex-row justify-around lg:w-full">
            <li class="flex w-[245px] justify-between"><span>Student Last Name</span><span>:</span></li>
            <input type="text" name="Last_Name"
                value="{{$data->lname}}"
                class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none" readonly>
        </div>
        <div class="flex w-[500px] flex-row justify-around lg:w-full">
            <li class="flex w-[245px] justify-between"><span>Email</span><span>:</span></li>
            <input type="text" name="Email"
                value="{{$data->email}}"
                class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none" readonly>
        </div>
        <div class="flex w-[500px] flex-row justify-around lg:w-full">
            <li class="flex w-[245px] justify-between"><span>Student Roll</span><span>:</span></li>
            <input type="text" name="Roll"
                value="{{$data->student_id}}"
                class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none" readonly>
        </div>
        <div class="flex w-[500px] flex-row justify-around lg:w-full">
            <li class="flex w-[245px] justify-between"><span>Student Phone</span><span>:</span></li>
            <input type="text" name="Phone"
                value="{{$data->phone}}"
                class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none" readonly>
        </div> --}}
        <div class="mt-5 text-center">
            <input type="submit" value="Add Hall"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]" readonly>
        </div>
    </form>
@endsection

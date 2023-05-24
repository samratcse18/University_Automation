@extends('layouts.Dashboard')
@section('content')
    <div class="mt-4 flex w-[300px] flex-row justify-around lg:w-full px-[8px] lg:px-0">
        <li class="flex w-[245px] justify-between"><span>Room</span><span>:</span></li>
        <select name="Department" id=""
            class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            <option value="" disabled selected>Room</option>
            @foreach ($data as $item)
                <option value="{{$item->room}}">{{$item->room}}</option>
            @endforeach
        </select>
    </div>
    <div class="my-4 border-b-2 border-[#006666] text-center text-2xl font-bold text-[#3E3E3E]">Add Room</div>
    <form action="{{ route('admin.addHallRoom') }}" method="POST">
        @csrf
        <div class="flex w-[300px] flex-row justify-center lg:w-full px-[8px] lg:px-0">
            <li class="flex w-[245px] justify-between"><span>Room</span><span>:</span></li>
            <input type="number" min="0" placeholder="ex:104" id="Class" name="Room"
                value="{{ old('Room') }}"
                class="mx-[10px] w-[200px] border-2 border-[#006666] px-[2px] focus:outline-none">
        </div>
        <div class="mt-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
@endsection

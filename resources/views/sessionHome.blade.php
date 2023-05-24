@extends('layouts.Dashboard')
@section('content')
    <div class="mt-2 space-y-2 px-[8px] lg:px-0">
        <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
        <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Session</span><span>:</span></li>
        <select name="Department" id=""
            class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            <option value="" disabled selected>Session</option>
            @foreach ($session as $item)
                <option value="{{ $item->session }}">{{ $item->session }}</option>
            @endforeach
        </select>
    </div>
    </div>
    <div class="my-4 border-b-2 border-[#006666] text-center text-2xl font-bold text-[#3E3E3E]">Add Session</div>
    <form action="{{ route('admin.addSession') }}" method="POST"
        class="mt-2 space-y-2 px-[8px] lg:px-0">
        @csrf
        <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Session</span><span>:</span></li>
            <div class="">
                <input type="number" min="0" placeholder="ex:2000" id="Class" name="year1"
                value="{{ old('year1') }}"
                class="mx-[10px] w-[150px] border-2 border-[#006666] px-[2px] focus:outline-none">
            <span>To</span>
            <input type="number" min="0" placeholder="ex:2001" id="Class" name="year2"
                value="{{ old('year2') }}"
                class="mx-[10px] w-[150px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
        </div>
        <div class="mt-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
@endsection

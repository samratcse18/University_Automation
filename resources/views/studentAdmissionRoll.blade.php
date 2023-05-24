@extends('layouts.Dashboard')
@section('content')
    <form action="{{ route('admin.addAdmissionRoll') }}" class="space-y-3 text-center mt-5 overflow-x-auto px-3 lg:overflow-x-hidden lg:px-0" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex w-[500px] flex-row justify-around lg:w-full">
            <li class="flex w-[245px] justify-between"><span>Admission Roll Excel File</span><span>:</span></li>
            <input type="file" id="Class" name="roll"
                value="{{ old('roll') }}"
                class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
        </div>
        <div class="mt-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
@endsection

@extends('layouts.Dashboard')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mt-2 space-y-2 px-[8px] lg:px-0">
        <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Session</span><span>:</span></li>
            <select name="Session" id=""
                class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                <option value="" disabled selected>Session</option>
                @foreach ($professionalSession as $item)
                    <option value="{{ $item->professional_session }}">{{ $item->professional_session }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="my-4 border-b-2 border-[#006666] text-center text-2xl font-bold text-[#3E3E3E]">Add Session</div>
    <form action="{{ route('admin.addProfessionalSession') }}" class="mt-2 space-y-2 px-[8px] lg:px-0" method="POST">
        @csrf
        <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Session</span><span>:</span></li>
            <select name="Session" id=""
                class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                <option value="" disabled selected>Session</option>
                @foreach ($session as $item)
                    <option value="{{ $item->session }}">{{ $item->session }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Term</span><span>:</span></li>
            <select name="Term" id=""
                class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                <option value="" disabled selected>Term</option>
                <option value="Jan-Jun">Jan-Jun</option>
                <option value="Jul-Dec">Jul-Dec</option>
            </select>
        </div>
        <div class="mt-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
@endsection

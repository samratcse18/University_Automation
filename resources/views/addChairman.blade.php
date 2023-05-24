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
    <form action="{{ route('admin.chairmanCreate') }}" method="POST">
        @csrf
        <div class="mt-2 space-y-2 px-[8px] lg:px-0">
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Department</span><span>:</span></li>
                <select name="Department" id=""
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                    <option disabled selected>Select Option</option>
                    @foreach ($data as $item)
                        <option value="{{ $item->department }}">{{ $item->department }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Chairman First Name</span><span>:</span></li>
                <input type="text" placeholder="Enter First Name" id="Class" name="First_Name"
                    value="{{ old('First_Name') }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Chairman Last Name</span><span>:</span></li>
                <input type="text" placeholder="Enter Last Name" id="Class" name="Last_Name"
                    value="{{ old('Last_Name') }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Department (self)</span><span>:</span></li>
                <select name="Department_self" id=""
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                    <option value="" disabled selected>Select Option</option>
                    @foreach ($data as $item)
                        <option value="{{$item->department}}" @if (old('Department') =="{{$item->department}}") {{ 'selected' }} @endif>{{$item->department}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Contact Number</span><span>:</span></li>
                <input type="text" placeholder="Enter Contact Number" id="Class" name="Number"
                    value="{{ old('Number') }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Email</span><span>:</span></li>
                <input type="email" placeholder="Enter Email" id="Class" name="Email"
                    value="{{ old('Email') }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Password</span><span>:</span></li>
                <input type="password" placeholder="Enter Password" id="Class" name="password"
                    value="{{ old('Faculty_Name') }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Confirm Password</span><span>:</span></li>
                <input type="password" placeholder="Enter Confirm Password" id="Class" name="cpassword"
                    value="{{ old('Faculty_Name') }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
        </div>
        <div class="mt-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
@endsection

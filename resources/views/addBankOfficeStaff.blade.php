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
    <form action="{{ route('bank.bankOfficeStaffCreate') }}" method="POST">
        @csrf
        <div class="mt-5 space-y-3 overflow-x-auto lg:overflow-x-hidden px-3 lg:px-0">
            <div class="flex w-[500px] flex-row justify-around lg:w-full">
                <li class="flex w-[245px] justify-between"><span>Staff First Name</span><span>:</span></li>
                <input type="text" placeholder="Enter First Name" id="Class" name="First_Name"
                    value="{{ old('First_Name') }}"
                    class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex w-[500px] flex-row justify-around lg:w-full">
                <li class="flex w-[245px] justify-between"><span>Staff Last Name</span><span>:</span></li>
                <input type="text" placeholder="Enter Last Name" id="Class" name="Last_Name"
                    value="{{ old('Last_Name') }}"
                    class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex w-[500px] flex-row justify-around lg:w-full">
                <li class="flex w-[245px] justify-between"><span>Contact Number</span><span>:</span></li>
                <input type="text" placeholder="Enter Contact Number" id="Class" name="Number"
                    value="{{ old('Number') }}"
                    class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex w-[500px] flex-row justify-around lg:w-full">
                <li class="flex w-[245px] justify-between"><span>Email</span><span>:</span></li>
                <input type="email" placeholder="Enter Email" id="Class" name="Email"
                    value="{{ old('Email') }}"
                    class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex w-[500px] flex-row justify-around lg:w-full">
                <li class="flex w-[245px] justify-between"><span>Password</span><span>:</span></li>
                <input type="password" placeholder="Enter Password" id="Class" name="password"
                    value=""
                    class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex w-[500px] flex-row justify-around lg:w-full">
                <li class="flex w-[245px] justify-between"><span>Confirm Password</span><span>:</span></li>
                <input type="password" placeholder="Enter Confirm Password" id="Class" name="cpassword"
                    value=""
                    class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
        </div>
        <div class="mt-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
@endsection

@extends('layouts.login')

@section('page_title')
    BBA FACALTY
@endsection

@section('bsmrstu_logo')
    <div
        class="logo absolute top-[100px] left-1/2 -translate-x-1/2 transform lg:relative lg:top-0 lg:left-0 lg:mt-0 lg:ml-0 lg:-translate-x-0 2xl:mt-[20px] 2xl:ml-[46px]">
        <img class="w-[220px] lg:mx-3 lg:mt-3 lg:w-[120px]" src="{{ asset('images/logo.jpg') }}" alt="" />
    </div>
@endsection

@section('content')
    <div class="space-y-[43px] 2xl:mt-[120px]">
        <div class="text font-['Segoe UI'] mt-[356px] text-center text-[25px] font-bold text-[#3E3E3E] lg:mx-auto lg:mt-0 lg:w-[670px] lg:text-[50px] 2xl:w-[750px] 2xl:text-[56px]"
            data-aos="fade-up" data-aos-duration="3000">
            One Account for Everything.
        </div>
        <div class="login-btn space-y-2 w-[160px] mx-auto">
            <a href="/login">
                <div
                    class="loginBtn font-[Segoe UI] mx-auto cursor-pointer rounded-full bg-[#006666] p-2 text-center text-[20px] font-semibold text-white hover:bg-[#1AA2A2] lg:text-[30px]">
                    Log In
                </div>
            </a>
            <div></div>
            <a href="/signUp">
                <div
                    class="loginBtn font-[Segoe UI] mx-auto cursor-pointer rounded-full bg-[#006666] p-2 text-center text-[20px] font-semibold text-white hover:bg-[#1AA2A2] lg:text-[30px]">
                    Sign Up
                </div>
            </a>
        </div>
    </div>
@endsection
{{-- @section('modal')
    <div id="signUp"
        class="invisible absolute top-0 left-0 z-40 flex h-[100vh] w-full items-center justify-center bg-black opacity-90">
        <i onclick="ss()" class="fa-solid fa-times absolute right-4 top-4 cursor-pointer text-3xl text-white"></i>
    </div>
    <div id="item"
        class="invisible absolute top-1/2 left-1/2 z-50 flex h-[0%] w-[0%] -translate-x-1/2 -translate-y-1/2 transform items-center justify-center bg-white text-black">
        <ul id="text" class="w-[50%] scale-0 bg-gray-400 text-center">
            <li class="p-2 hover:bg-[#006666]"><a href="/studentRegistration">Student</a></li>
            <li class="border-y-2 p-2 hover:bg-[#006666]"><a href="{{ route('teacher') }}">Teacher</a></li>
            <li class="p-2 hover:bg-[#006666]"><a href="">Office Staff</a></li>
        </ul>
    </div>
@endsection --}}

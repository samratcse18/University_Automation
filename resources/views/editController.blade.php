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
    <form action="{{ route('admin.editControllerData') }}" method="POST">
        @csrf
        <div class="mt-2 space-y-2 px-[8px] lg:px-0">
            <input type="text" name="id" value="{{$data->id}}" hidden>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>First Name</span><span>:</span></li>
                <input type="text" placeholder="Enter First Name" id="Class" name="First_Name"
                    value="{{ $data->fname }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Last Name</span><span>:</span></li>
                <input type="text" placeholder="Enter Last Name" id="Class" name="Last_Name"
                    value="{{ $data->lname }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Contact Number</span><span>:</span></li>
                <input type="text" placeholder="Enter Contact Number" id="Class" name="Number"
                    value="{{ $data->phone }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Email</span><span>:</span></li>
                <input type="email" placeholder="Enter Email" id="Class" name="Email"
                    value="{{ $data->email }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none" readonly>
            </div>
        </div>
        <div class="mt-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
@endsection

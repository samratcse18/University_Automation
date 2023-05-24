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
    <form action="{{ route('admin.editAccountData') }}" method="POST">
        @csrf
        <input type="text" name="id" value="{{$data->id}}" hidden>
        <div class="mt-2 space-y-2 px-[8px] lg:px-0">
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Account Name</span><span>:</span></li>
                <input type="text" placeholder="Enter Account Name" id="Class" name="Account_Name"
                    value="{{ $data->name }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Account Number</span><span>:</span></li>
                <input type="text" placeholder="Enter Account Number" id="Class" name="Account_Number"
                    value="{{ $data->account }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Account Type</span><span>:</span></li>
                <select name="Account_Type" id=""
                        class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                        <option value="" disabled selected>Select Option</option>
                        <option value="Savings" @if ($data->type=='Savings')
                            {{'selected'}}
                        @endif>Savings</option>
                        <option value="Current" @if ($data->type=='Current')
                            {{'selected'}}
                        @endif>Current</option>
                        <option value="Fixed" @if ($data->type=='Fixed')
                            {{'selected'}}
                        @endif>Fixed</option>
                    </select>
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Bank Name and Branch</span><span>:</span></li>
                <input type="text" placeholder="Enter Bank Name and Branch" id="Class" name="Branch"
                    value="{{ $data->branch }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
        </div>
        <div class="mt-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
@endsection

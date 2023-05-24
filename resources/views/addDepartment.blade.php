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
    <form action="{{ route('admin.departmentCreate') }}" method="POST">
        @csrf
        <div class="mt-2 space-y-2 px-[8px] lg:px-0">
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Department Name(Short Form)</span><span>:</span></li>
                <input type="text" placeholder="Ex: CSE" id="Class" name="Department_Name"
                    value="{{ old('Department_Name') }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Department Name(Full Form)</span><span>:</span></li>
                <input type="text" placeholder="Enter Department Full Name" name="Department_FullName"
                    value="{{ old('Department_FullName') }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Department Name(Bangla Full Form)</span><span>:</span></li>
                <input type="text" placeholder="ex:ইলেকট্রিক্যাল এবং ইলেকট্রনিক ইঞ্জিনিয়ারিং বিভাগ" name="Department_BN"
                    value="{{ old('Department_BN') }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none text-[12px]">
            </div>
            @can('superAdmin.dashboard')
                <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Faculty</span><span>:</span></li>
                    <select name="Faculty_Name" id=""
                        class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                        <option value="" disabled selected>Select Option</option>
                        @foreach ($faculty as $item)
                            <option value="{{ $item->name }}"@if (old('Faculty_Name') == '{{ $item->name }}') {{ 'selected' }} @endif>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endcan
        </div>
        <div class="mt-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
@endsection

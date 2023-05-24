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
    <form action="{{ route('admin.editDegreeData') }}" method="post">
        @csrf
        <input type="text" name="id" value="{{ $data->id }}" hidden>
        <div class="mt-2 space-y-2 px-[8px] lg:px-0">
            {{-- <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between
"><span>Department</span><span>:</span></li>
                <select name="Department" id=""
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                    <option value="" disabled selected>Select Option</option>
                    @foreach ($dept as $item)
                        <option value="{{ $item->department }}"
                            @if ($data->degree_for == $item->department) {{ 'selected' }} @endif>{{ $item->department }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Degree Name</span><span>:</span></li>
                <input type="text" placeholder="Enter Degree Name" id="Class" name="Degree_Name"
                    value="{{ $data->degree_name }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Degree Full Name</span><span>:</span></li>
                <input type="text" placeholder="Enter Degree Full Name" id="Class" name="Degree_Full_Name"
                    value="{{ $data->degree_full_name }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Degree Level</span><span>:</span></li>
                <select name="Degree_Level" id=""
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                    <option value="" disabled selected>Select Option</option>
                    <option value="Under Graduation" @if ($data->class_level == 'Under Graduation') {{ 'selected' }} @endif>Under
                        Graduation</option>
                    <option value="Post Graduation" @if ($data->class_level == 'Post Graduation') {{ 'selected' }} @endif>Post
                        Graduation</option>
                </select>
            </div>
        </div>
        <div class="mt-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
@endsection

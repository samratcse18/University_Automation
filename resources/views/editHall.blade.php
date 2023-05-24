@extends('layouts.Dashboard')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @error('Department')
                {{ $message }}
            @enderror
        </div>
    @endif
    <form action="{{ route('admin.editHallData') }}" method="post">
        @csrf
        <div class="mt-2 space-y-2 px-[8px] lg:px-0">
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Name of the Hall</span><span>:</span></li>
                <input type="text" placeholder="Enter Hall Name" id="Class" name="Hall_Name" value="{{ $Hall->name }}"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
        </div>
        <input type="number" name="id" value="{{ $Hall->id }}" hidden>
        <div class="mt-5 text-center">
            <input type="submit" value="Update Data"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
@endsection

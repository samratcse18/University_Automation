@extends('layouts.Dashboard')

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                $(document).ready(function() {
                    toastr.options = {
                        "positionClass": "toast-top-center",
                    }
                    toastr.error('{{ $error }}');
                });
            </script>
        @endforeach
    @endif
    <form action="{{ route('admin.hallCircularData') }}" class="mt-2 space-y-2 px-[8px] lg:px-0" method="POST">
        @csrf
        <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
            <li class="flex w-full lg:w-[40%] lg:justify-between">
                <span>Last Date</span><span>:</span>
            </li>
            <input type="date" placeholder="Please Enter" name="DateofBirth"
                class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]" />
        </div>
        <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
            <li class="flex w-full lg:w-[40%] lg:justify-between">
                <span>Reference Prefix</span><span>:</span>
            </li>
            <input type="text" placeholder="Ex:BSMRSTU/MGT/" name="Prefix"
                class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]" />
        </div>
        <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
            <li class="flex w-full lg:w-[40%] lg:justify-between">
                <span>Reference Suffix</span><span>:</span>
            </li>
            <input type="text" placeholder="Please Enter" name="Suffix"
                class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]" />
        </div>
        <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>For</span><span>:</span>
            </li>
            <select name="type"
                class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                <option disabled selected>Select Type</option>
                <option value="Circular">Circular</option>
                <option value="Interview">Interview</option>
                @can('office.dashboard')
                    <option value="Student">Student</option>
                @endcan
                <option value="Others">Others</option>
            </select>
        </div>
        <label for="description">description</label>
        <textarea name="description" class="ckeditor" id="description" cols="30" rows="5"></textarea>
        <div class="my-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endsection

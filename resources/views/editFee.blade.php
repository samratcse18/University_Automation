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
    <form action="{{ route('admin.editFeeData') }}" method="post">
        @csrf
        <input type="text" name="id" value="{{ $data->id }}" hidden>
        <div class="mt-2 space-y-2 px-[8px] lg:px-0">
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Fee Title</span><span>:</span></li>
                <select name="Fee_Title"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="" disabled selected>Select Option</option>
                    @can('admin.dashboard')
                        <option value="Association" @if ($data->fee_title == 'Association') {{ 'selected' }} @endif>Association
                        </option>
                        <option value="Development" @if ($data->fee_title == 'Development') {{ 'selected' }} @endif>Development
                        </option>
                        <option value="Withdrawal of Mark Sheet" @if ($data->fee_title == 'Withdrawal of Mark Sheet') {{ 'selected' }} @endif>
                            Withdrawal of Mark Sheet</option>
                        <option value="Exam Hall Fee" @if ($data->fee_title == 'Exam Hall Fee') {{ 'selected' }} @endif>Exam Hall Fee
                        </option>
                        <option value="Testimonial/Other Services" @if ($data->fee_title == 'Testimonial/Other Services') {{ 'selected' }} @endif>
                            Testimonial/Other Services</option>
                        <option value="Seminar" @if ($data->fee_title == 'Seminar') {{ 'selected' }} @endif>Seminar</option>
                        <option value="Lab" @if ($data->fee_title == 'Lab') {{ 'selected' }} @endif>Lab</option>
                        <option value="Miscellaneous" @if ($data->fee_title == 'Miscellaneous') {{ 'selected' }} @endif>
                            Miscellaneous
                        </option>
                    @endcan
                    @can('superAdmin.dashboard')
                        <option value="Admission Fee" @if ($data->fee_title == 'Admission Fee') {{ 'selected' }} @endif>Admission Fee
                        </option>
                        <option value="Readmission Fee" @if ($data->fee_title == 'Readmission Fee') {{ 'selected' }} @endif>Readmission Fee
                        </option>
                        <option value="Registrasion Fee" @if ($data->fee_title == 'Registrasion Fee') {{ 'selected' }} @endif>Registrasion Fee
                        </option>
                        <option value="Credit Fee" @if ($data->fee_title == 'Credit Fee') {{ 'selected' }} @endif>Credit Fee
                        </option>
                        <option value="Tution Fee (salary)" @if ($data->fee_title == 'Tution Fee (salary)') {{ 'selected' }} @endif>Tution Fee (salary)
                        </option>
                        <option value="Transport Fee" @if ($data->fee_title == 'Transport Fee') {{ 'selected' }} @endif>Transport Fee
                        </option>
                        <option value="Medical Fee" @if ($data->fee_title == 'Medical Fee') {{ 'selected' }} @endif>Medical Fee
                        </option>
                        <option value="Library Fee" @if ($data->fee_title == 'Library Fee') {{ 'selected' }} @endif>Library Fee
                        </option>
                        <option value="Sports and Culture" @if ($data->fee_title == 'Sports and Culture') {{ 'selected' }} @endif>Sports and Culture
                        </option>
                        <option value="BNCC" @if ($data->fee_title == 'BNCC') {{ 'selected' }} @endif>BNCC
                        </option>
                        <option value="Rover" @if ($data->fee_title == 'Rover') {{ 'selected' }} @endif>Rover
                        </option>
                        <option value="ID Card" @if ($data->fee_title == 'ID Card') {{ 'selected' }} @endif>ID Card
                        </option>
                        <option value="Yearly Calender" @if ($data->fee_title == 'Yearly Calender') {{ 'selected' }} @endif>Yearly Calender
                        </option>
                        <option value="Dairy" @if ($data->fee_title == 'Dairy') {{ 'selected' }} @endif>Dairy
                        </option>
                        <option value="Panalty" @if ($data->fee_title == 'Panalty') {{ 'selected' }} @endif>Panalty
                        </option>
                        <option value="Others 1" @if ($data->fee_title == 'Others 1') {{ 'selected' }} @endif>Others 1
                        </option>
                        <option value="Others 2" @if ($data->fee_title == 'Others 2') {{ 'selected' }} @endif>Others 2
                        </option>
                    @endcan

                </select>
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Account Number</span><span>:</span></li>
                <select name="Account_Number" id=""
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="" disabled selected>Select Option</option>
                    @foreach ($account as $item)
                        <option value="{{ $item->account }}" @if ($data->account_number == $item->account) {{ 'selected' }} @endif>
                            {{ $item->account }}</option>
                    @endforeach
                </select>
            </div>
            @can('admin.dashboard')
                <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Program</span><span>:</span></li>
                    <select name="Class" id=""
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                        <option value="" disabled selected>Select Option</option>
                        @foreach ($degree as $item)
                            <option value="{{ $item->degree_name }}"
                                @if (old('Class') == '{{ $item->degree_name }}') {{ 'selected' }} @endif>
                                {{ $item->degree_name }}</option>
                        @endforeach
                    </select>
                </div>
            @endcan
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Amount(Semi Annual)</span><span>:</span></li>
                <input type="number" placeholder="Enter Amount" name="Amount" value="{{ $data->amount }}"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            @can('admin.dashboard')
                <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>For</span><span>:</span></li>
                    <select name="Type"
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                        <option value="" disabled selected>Select Option</option>
                        <option value="Exam">Exam</option>
                        <option value="Admission">Admission</option>
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

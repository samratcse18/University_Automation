@extends('layouts.Dashboard')
@section('content')
    @php
        use App\Models\HallTotalStudent;
        use App\Models\HallCircular;
        $user = Auth::guard('student')->user();
        $hall = HallTotalStudent::where('student_id', $user->id)->first();
        $circular = HallCircular::where('hall_name', $user->Hall)->first();
        if ($hall) {
            $month = (date('Y') - date('Y', strtotime($hall->payment))) * 12 + (date('m') - date('m', strtotime($hall->payment)));
        }
        if ($circular) {
            $Last_month = (date('Y', strtotime($circular->last_date)) - date('Y')) * 12 + (date('m', strtotime($circular->last_date)) - date('m'));
            $Last_date = date('d', strtotime($circular->last_date)) - date('d');
        }
    @endphp
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($circular && !$hall)
        @if (
            $circular->type == 'Circular' &&
                (($Last_month == 0 && $Last_date >= 0) || ($Last_month > 0 && abs($Last_date) >= 0)))
            <form action="{{ route('student.sendApplyHallData') }}" method="POST">
                @csrf
                <div class="px-[8px] lg:px-0">
                    {!! $circular->circular !!}
                </div>
                <div class="mt-5 text-center">
                    <input type="submit" value="Apply Now"
                        class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
                </div>
            </form>
        @else
            <div class="text-center text-[20px] font-bold text-[#3E3E3E]">There Are No Circular From Your Hall</div>
        @endif
    @elseif ($hall && $hall->status == 'pending')
        @if (
            $circular->type == 'Interview' &&
                (($Last_month == 0 && $Last_date >= 0) || ($Last_month > 0 && abs($Last_date) >= 0)))
            {!! $circular->circular !!}
        @else
            <div class="mt-3 space-y-2">
                <div class="px-[8px] text-[13px] lg:px-0 lg:text-[100%]">
                    <table class="w-full border-2 border-[#006666]">
                        <thead>
                            <tr class="border-2 border-[#006666]">
                                <th class="text-center">Hall</th>
                                <th class="w-[30%] text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-2 border-[#006666]">
                                <td class="border-2 border-[#006666] text-center font-semibold uppercase">
                                    {{ $user->Hall }}
                                </td>
                                <td
                                    class="flex justify-around border-0 border-[#006666] bg-[#48be0c] text-center text-[20px] font-bold text-white">
                                    {{ $hall->status }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @elseif ($hall && $hall->status == 'active')
        <span class="text-xl font-semibold text-[#FF0066]">Congratulations</span>
        <span class="font-bold uppercase">{{ Auth::guard('student')->user()->fname }}
            {{ Auth::guard('student')->user()->lname }}</span> You are Selected to
        {{ Auth::guard('student')->user()->Hall }} And Your Room Number {{ $hall->room }}.
        <span><a href="{{ route('student.hallPayslip') }}"
                class="border-2 border-transparent border-b-[#f41dff77] text-xl font-semibold text-[#0095ff]"
                target="_blank">Download
                pay slips</a> to pay
            through
            bank deposit.</span>
        <br>
        <span>For final confirmation DOWNLOAD a copy for the future reference.</span>
        <br>
        <span>For any assistance, contact the office admin of the
            {{ Auth::guard('student')->user()->dept }}</span>
        {{-- <a href="{{ route('student.hallPayslip') }}">Download</a> --}}
    @elseif ($hall && $hall->status == 'residential')
        @if ($month == 0)
            <div class="w-full px-[8px] lg:px-0">
                <div class="mt-3 border-2 border-[#006666] text-center text-[20px] font-bold text-[#3E3E3E]">Your Payment is all
                clear</div>
            </div>
        @else
            <div class="px-[8px] text-[12px] lg:px-0 lg:text-[100%]">
                <table class="mt-3 w-full border-2 border-[#006666]">
                    <tr class="text-center">
                        <th>Month</th>
                        <th>Action</th>
                    </tr>
                    <tr class="border-2 border-[#006666] text-center font-bold">
                        <td class="border-2 border-[#006666]">{{ $month }} Month</td>
                        <td class="w-[30%] p-2"><a class="bg-red-600 p-2"
                                href="{{ route('student.billingSlip', ['M' => encrypt($month)]) }}">Pay Now</a></td>
                    </tr>
                </table>
            </div>
        @endif
    @else
        <div class="text-center text-[20px] font-bold text-[#3E3E3E]">There Are No Circular From Your Hall</div>
    @endif
@endsection

@extends('layouts.Dashboard')
@section('content')
    <div class="px-4">
        <span class="text-xl font-semibold text-[#FF0066]">Congratulations</span>
        <span class="font-bold uppercase">{{ Auth::guard('student')->user()->fname }}
            {{ Auth::guard('student')->user()->lname }}</span>
        <br>
        <span>Your Exam Registrtion <span class="uppercase">{{ Auth::guard('student')->user()->dept }}</span>
            {{ $data->Semester }}
            has been received successfully.</span>
        <br>
        <span><a href="{{ route('student.examPdf', ['id' => $data->id]) }}"
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
    </div>
    <div class="">
        <a href="{{ route('user.student') }}"
            class="absolute right-0 flex h-[33px] w-[164px] cursor-pointer items-center justify-center bg-[#006666] px-2 text-[16px] text-white hover:bg-[#16afaf]">Go
            To Home Page</a>
    </div>
    {{-- <script>
        function my() {
            axios.get(`{{ route('student.examPdf', ['id' => $data->id]) }}`)
                .then((res) => {
                    console.log(res.data);
                }).catch((err) => {
                    console.log(err);
                });
        }
        my();
    </script> --}}
@endsection

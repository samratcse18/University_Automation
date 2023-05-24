@extends('layouts.Dashboard')
@section('content')
    <div class="mt-4 space-y-4">
        <div class="flex flex-row space-x-2">
            <div class="flex h-[150px] w-[30%] flex-col items-center justify-center bg-[#006666] lg:w-[20%]">
                <img class="w-11 lg:w-16" src="https://img.icons8.com/color/96/null/hand-right-skin-type-2.png" />
                <h1 class="text-white">Here</h1>
            </div>
            <div class="flex h-[150px] w-[80%] flex-col bg-[#13c2c2] lg:flex-row lg:items-center">
                <div class="-mb-6 flex h-full flex-col justify-center lg:-mb-0">
                    <form action="{{ route('bank.barcode') }}" method="post">
                        @csrf
                        <input type="text"
                            class="ml-2 h-[30px] w-[200px] bg-white px-2 focus:outline-none lg:h-[40px] lg:w-[280px]"
                            name="barcode" id="">
                    </form>
                </div>
                <div class="flex flex-row justify-items-center">
                    <div class="ml-12 mb-3 font-bold text-white lg:text-[25px] lg:mb-0">Status :</div>
                    @if (Session::has('status'))
                        <div class="mb-3 ml-[10px] lg:ml-[7px] text-[17px] font-semibold text-[#f3d306] lg:mx-auto lg:mb-0 lg:text-[25px]">Accept
                        </div>
                    @elseif (Session::has('error'))
                        <div class="mb-3 ml-[10px] lg:ml-[7px] text-[17px] font-semibold text-[#c21414] lg:mx-auto lg:mb-0 lg:text-[25px]">Invalid
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex h-[150px] flex-col items-center justify-center bg-[#13c2c2]">
            <div class="text-[20px]">{{ date('l, jS F Y') }}</div>
            <div class="text-[20px]">
                {{-- <span class="font-semibold uppercase text-[#0370C0]">Count</span> --}}
                {{-- <span class="h-[50px] w-[2px] bg-black">|</span> --}}
                {{-- <span class="text-2xl font-bold text-[#6e0f3a]">200</span> --}}
            </div>
        </div>
        <div class="h-[80px] bg-[#13c2c2]"></div>
    </div>
@endsection

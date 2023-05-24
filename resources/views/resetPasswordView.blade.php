@extends('layouts.login')

@section('page_title')
    Login
@endsection

@section('bsmrstu_logo')
    <div
        class="logo absolute top-[100px] left-[100px] z-10 lg:relative lg:top-0 lg:left-0 lg:mt-0 lg:ml-0 2xl:mt-[20px] 2xl:ml-[46px]">
        <img class="w-[0px] lg:mx-3 lg:mt-3 lg:w-[120px]" src="{{ asset('images/logo.jpg') }}" alt="" />
    </div>
@endsection

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
    <form action="{{ route('resetPasswordData') }}" method="POST">
        @csrf
        <input type="text" name="id" value="{{ $data }}" hidden>
        <input type="text" name="model" value="{{ $model }}" hidden>
        <div
            class="absolute top-[100px] left-1/2 flex -translate-x-1/2 transform flex-col space-y-[15px] text-center lg:relative lg:top-0 lg:left-0 lg:mt-[12px] lg:-translate-x-0">
            <div class="text font-['Segoe UI'] btn mx-auto font-bold text-[#3E3E3E] lg:w-[330px] lg:text-[39px]">
                Password Reset
            </div>
            <div class="mx-auto w-[374px]">
                <input class="h-[35px] bg-[#3E3E3E] px-3 text-white focus:outline-none lg:h-[45px] lg:w-[374px] lg:text-lg"
                    type="text" name="email" placeholder="Email or Username" />
            </div>
            <div class="mx-auto w-[374px]">
                <input class="h-[35px] bg-[#3E3E3E] px-3 text-white focus:outline-none lg:h-[45px] lg:w-[374px] lg:text-lg"
                    type="password" name="password" placeholder="New Password" />
            </div>
            <div class="mx-auto w-[374px]">
                <input class="h-[35px] bg-[#3E3E3E] px-3 text-white focus:outline-none lg:h-[45px] lg:w-[374px] lg:text-lg"
                    type="password" name="cpassword" placeholder="Confirm Password" />
            </div>
            <div class="text-red-400">
                {{-- @error('email')
                    {{ $message }}
                @enderror
                @error('password')
                    {{ $message }}
                @enderror --}}
            </div>
            <button type="submit"
                class="loginBtn font-[Segoe UI] mx-auto w-[190px] cursor-pointer rounded-full bg-[#006666] p-2 text-center font-semibold text-white hover:bg-[#1AA2A2] lg:text-[30px]">
                Continue
                <i class="fa-solid fa-arrow-circle-right" aria-hidden="true"></i>
            </button>
        </div>
    </form>
@endsection

@extends('layouts.registration')
@section('name')
    <div class="text-center text-2xl font-bold">Student Registration</div>
@endsection
@section('content')
    @php
        use App\Models\Department;
        use App\Models\Session;
        $dept = Department::orderBy('department', 'asc')->get();
        $sess = Session::orderBy('session', 'desc')->get();
    @endphp
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
    <div class="flex items-center justify-center">
        <div class="mx-0 lg:mx-4 px-8 py-6 text-left">
            <form action="{{ route('user.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <div>
                        <label class="block">Name<label>
                                <div class="flex justify-between">
                                    <input type="text" placeholder="First Name" name="fname"
                                        class="mt-2 h-8 w-[46%] border px-4 focus:outline-none focus:ring-1 focus:ring-[#006666]" value="{{old('fname')}}">
                                    <input type="text" placeholder="Last Name" name="lname"
                                        class="mt-2 h-8 w-[46%] border px-4 focus:outline-none focus:ring-1 focus:ring-[#006666]" value="{{old('lname')}}">
                                </div>
                    </div>
                    <div>
                        <label class="block">Email<label>
                                <input type="text" value="{{old('email')}}" placeholder="Email" name="email"
                                    class="mt-2 h-8 w-full border px-4 focus:outline-none focus:ring-1 focus:ring-[#006666]">
                    </div>
                    <div>
                        <label class="block">Department<label>
                                <select name="dept" id=""
                                    class="mt-2 h-8 w-full border px-4 focus:outline-none focus:ring-1 focus:ring-[#006666]">
                                    <option value="" selected disabled>Your Department</option>
                                    @foreach ($dept as $item)
                                        <option value="{{ $item->department }}"
                                            @if ($item->department == old('dept')) {{ 'selected' }} @endif>
                                            {{ $item->department }}</option>
                                    @endforeach
                                </select>
                                {{-- <div class="text-red-400">
                                    @error('dept')
                                        {{ $message }}
                                    @enderror
                                </div> --}}
                    </div>
                    <div>
                        <label class="block">Session<label>
                                <select name="Session"
                                    class="mt-2 h-8 w-full border px-4 focus:outline-none focus:ring-1 focus:ring-[#006666]">
                                    <option value="" selected disabled>Your Session</option>
                                    @foreach ($sess as $item)
                                        <option value="{{ $item->session }}"
                                            @if ($item->session == old('Session')) {{ 'selected' }} @endif>
                                            {{ $item->session }}</option>
                                    @endforeach
                                </select>
                                {{-- <div class="text-red-400">
                                    @error('Session')
                                        {{ $message }}
                                    @enderror
                                </div> --}}
                    </div>
                    <div>
                        <label class="block">Gender<label>
                        <select name="gender" 
                            class="mt-2 h-8 w-full border px-4 focus:outline-none focus:ring-1 focus:ring-[#006666]">
                            <option value="" selected disabled>Your Gender</option>
                            <option value="Male" @if ('Male' == old('gender')) {{ 'selected' }} @endif>Male</option>
                            <option value="Female" @if ('Female' == old('gender')) {{ 'selected' }} @endif>Female</option>
                            <option value="Other" @if ('other' == old('gender')) {{ 'selected' }} @endif>Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block">Admission Roll<label>
                                <input type="text" placeholder="Admission Roll" name="admission_roll"
                                    class="mt-2 h-8 w-full border px-4 focus:outline-none focus:ring-1 focus:ring-[#006666]" value="{{old('admission_roll')}}">
                    </div>
                    <div>
                        <label class="block">Password<label>
                                <input type="password" placeholder="Password" name="password"
                                    class="mt-2 h-8 w-full border px-4 focus:outline-none focus:ring-1 focus:ring-[#006666]">
                    </div>
                    <div>
                        <label class="block">Confirm Password<label>
                                <input type="password" placeholder="Password" name="cpassword"
                                    class="mt-2 h-8 w-full border px-4 focus:outline-none focus:ring-1 focus:ring-[#006666]">
                    </div>
                    <span class="text-xs text-red-400">Password must be same!</span>
                    <div>
                        <label class="block">Image<label>
                                <input type="file" name="image"
                                    class="mt-2 h-8 w-full border px-4 focus:outline-none focus:ring-1 focus:ring-[#006666]">
                    </div>
                    <div class="flex">
                        <button type="submit"
                            class="mt-4 h-8 w-full bg-[#006666] px-6 text-white hover:bg-[#1AA2A2]">Create
                            Account</button>
                    </div>
                    <div class="text-grey-dark mt-6 text-center">
                        Already Registered?
                        <a class="text-green-900 hover:underline" href="{{ route('user.login') }}">
                            Log in
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

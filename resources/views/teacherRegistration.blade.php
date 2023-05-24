@extends('layouts.registration')
@section('name')
    <div class="text-center text-2xl font-bold">Teacher Registration</div>
@endsection
@section('content')
    <div class="space-y-5 space-x-10 text-center">
        <input type="text" id="fname"
            class="w-[20%] px-2 shadow-[10px_10px_20px_-5px] outline outline-gray-600 focus:outline-4" name="fname"
            value="{{ old('fname') }}" placeholder="First Name">
        <input type="text" id="Lname" name="lname"
            class="w-[20%] px-2 shadow-[10px_10px_20px_-5px] outline outline-gray-600 focus:outline-4"
            placeholder="Last Name" value="{{ old('lname') }}">
        <div class="text-red-400">
            @error('fname')
                {{ $message }}
            @enderror
        </div>
        <div class="text-red-400">
            @error('lname')
                {{ $message }}
            @enderror
        </div>
    </div>
    <div class="space-x-3 text-center">
        <select name="dept" id=""
            class="w-[40%] px-2 shadow-[10px_10px_20px_-5px] outline outline-gray-600 focus:outline-4">
            <option value="" selected disabled>Designation</option>
            <option value="Professor">Professor</option>
            <option value="Associate Professor">Associate Professor</option>
            <option value="Assistant Professor">Assistant Professor</option>
            <option value="Lecturare">Lecturare</option>
        </select>
        <div class="text-red-400">
            @error('dept')
                {{ $message }}
            @enderror
        </div>
    </div>
    <div class="space-x-3 text-center">
        <select name="dept" id=""
            class="w-[40%] px-2 shadow-[10px_10px_20px_-5px] outline outline-gray-600 focus:outline-4">
            <option value="" selected disabled>Department</option>
            <option value="CSE">CSE</option>
            <option value="EEE">EEE</option>
        </select>
        <div class="text-red-400">
            @error('dept')
                {{ $message }}
            @enderror
        </div>
    </div>
    <div class="space-x-3 text-center">
        <input type="email" name="email"
            class="w-[40%] px-2 shadow-[10px_10px_20px_-5px] outline outline-gray-600 focus:outline-4"
            placeholder="Email Address" value="{{ old('email') }}">
        <div class="text-red-400">
            @error('email')
                {{ $message }}
            @enderror
        </div>

    </div>
    
    <div class="space-x-3 text-center">
        <input type="tel" name="phone" id=""
            class="w-[40%] px-2 shadow-[10px_10px_20px_-5px] outline outline-gray-600 focus:outline-4"
            placeholder="Phone Number" value="{{ old('phone') }}">
        <div class="text-red-400">
            @error('phone')
                {{ $message }}
            @enderror
        </div>
    </div>
    <div class="space-x-3 text-center">
        <input type="password" name="password" id=""
            class="w-[40%] px-2 uppercase shadow-[10px_10px_20px_-5px] outline outline-gray-600 focus:outline-4"
            placeholder="Password" value="{{ old('password') }}">
        <div class="text-red-400">
            @error('password')
                {{ $message }}
            @enderror
        </div>
    </div>
    <div class="space-x-3 text-center">
        <input type="password" name="cpassword" id=""
            class="w-[40%] px-2 uppercase shadow-[10px_10px_20px_-5px] outline outline-gray-600 focus:outline-4"
            placeholder="Confirm Password" value="{{ old('cpassword') }}">
        <div class="text-red-400">
            @error('cpassword')
                {{ $message }}
            @enderror
        </div>
    </div>
    {{-- <div class="text-center space-x-3">
        <i class="fas fa-upload fa-2x"></i>
        <input type="file" name="img" id="img" hidden>
        <button onclick="df()"
            class="w-[40%] bg-white px-2 uppercase shadow-[10px_10px_20px_-5px] outline outline-gray-600">Upload
            Image</button>
            <div class="text-red-400">
            @error('img')
                {{ $message }}
            @enderror
        </div>
    </div> --}}
@endsection

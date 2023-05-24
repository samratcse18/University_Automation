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
    @php
        $user = Auth::guard('bank')->user();
    @endphp
    <form action="{{ route('bank.updateProfileData') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-2 space-y-2 overflow-x-auto px-4 lg:overflow-x-hidden">
            <div class="flex w-[490px] flex-row justify-around space-x-5 lg:mx-auto lg:w-[625px]">
                <li class="flex w-[133px] justify-between lg:-ml-2 lg:w-[99px]"><span>First Name</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{$user->fname}}" placeholder="Please Enter" name="FirstName"
                    
                    class="w-[125px] border-2 border-[#006666] px-[2px] uppercase focus:outline-none">
                <li class="flex w-[130px] justify-between lg:w-[98px]"><span>Last Name</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{$user->lname}}"  placeholder="Please Enter"
                    name="LastName" class="w-[135px] border-2 border-[#006666] px-[2px] uppercase focus:outline-none">
            </div>
            <div class="flex w-[500px] flex-row justify-around lg:w-full">
                <li class="flex w-[245px] justify-between"><span>Email</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{$user->email}}"  placeholder="Please Enter"
                    name="Email" class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex w-[500px] flex-row justify-around lg:w-full">
                <li class="flex w-[245px] justify-between"><span>Phone</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->phone }}" placeholder="Please Enter"
                    name="Phone" class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex w-[500px] flex-row justify-around lg:w-full">
                <li class="flex w-[245px] justify-between"><span>City</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->city }}" placeholder="Please Enter"
                    name="city" class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex w-[500px] flex-row justify-around lg:w-full">
                <li class="flex w-[245px] justify-between"><span>District</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->district }}" placeholder="Please Enter"
                    name="district" class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex w-[500px] flex-row justify-around lg:w-full">
                <li class="flex w-[245px] justify-between"><span>Street</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->street }}" placeholder="Please Enter"
                    name="street" class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex w-[500px] flex-row justify-around lg:w-full">
                <li class="relative flex w-[245px] justify-between">
                    <span>Password</span><span>:</span>
                </li>
                <input type="password" name="password" placeholder="Pelase Enter Your Password"
                    class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex w-[500px] flex-row justify-around lg:w-full">
                <li class="relative flex w-[245px] justify-between">
                    <span>Confirm Password</span><span>:</span>
                </li>
                <input type="password" name="cpassword" placeholder="Pelase Enter Your Password"
                    class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
        </div>
        <div class="my-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
    <script>
        function country() {
            axios.get('https://restcountries.com/v3.1/all')
                .then((res) => {
                    const select = document.getElementById("Nationality");
                    res.data.sort((a, b) => {
                        let x = a.name.common.toUpperCase(),
                            y = b.name.common.toUpperCase();
                        return x == y ? 0 : x > y ? 1 : -1;
                    }).map((item) => {
                        let option = document.createElement("option");
                        option.textContent = item.name.common;
                        option.value = item.name.common;
                        select.appendChild(option);
                    });
                    console.log(res.data);
                }).catch((err) => {
                    console.log(err);
                });
        }
    </script>
@endsection
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
        use App\Models\Chairman;
        $user = Auth::guard('admin')->user();
        $chairman = Chairman::where('email', $user->email)->first();
    @endphp
    <form action="{{ route('admin.updateProfileData') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-2 space-y-2 px-[8px] lg:px-0">
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>First Name</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" placeholder="Please Enter" name="FirstName"
                    value="{{ $user->fname }}"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Last Name</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->lname }}" placeholder="Please Enter"
                    name="LastName"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            @can('admin.dashboard')
                <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Bangla Full Name</span><span>:</span>
                    </li>
                    <input type="text" onchange="handle(name,value)" value="{{ $chairman->name_bangla }}"
                        placeholder="Please Enter" name="name_bangla"
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                </div>
            @endcan
            @can('superAdmin.dashboard')
                <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Email</span><span>:</span>
                    </li>
                    <input type="text" onchange="handle(name,value)" value="{{ $user->email }}" placeholder="Please Enter"
                        name="Email"
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                </div>
            @endcan
            @cannot('superAdmin.dashboard')
                <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Email</span><span>:</span>
                    </li>
                    <input type="text" value="{{ $user->email }}" placeholder="Please Enter" name="Email"
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]" readonly>
                </div>
            @endcannot
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Phone</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->phone }}" placeholder="Please Enter"
                    name="Phone"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            @cannot('superAdmin.dashboard')
                <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Department</span><span>:</span>
                    </li>
                    <input type="text" onchange="handle(name,value)" value="{{ $user->dept }}" placeholder="Please Enter"
                        name="Department"
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]" readonly>
                </div>
            @endcannot
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="relative flex w-full lg:w-[40%] lg:justify-between">
                    <span>Password</span><span>:</span>
                </li>
                <input type="password" name="password" placeholder="Pelase Enter Your Password"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="relative flex w-full lg:w-[40%] lg:justify-between">
                    <span>Confirm Password</span><span>:</span>
                </li>
                <input type="password" name="cpassword" placeholder="Pelase Enter Your Password"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="relative flex w-full lg:w-[40%] lg:justify-between">
                    <span>Change Profile</span><span>:</span>
                </li>
                <input name="img"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]"
                    type="file">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="relative flex w-full lg:w-[40%] lg:justify-between">
                    <span>Add Signature</span><span>:</span>
                </li>
                <input name="signature"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]"
                    type="file">
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

@extends('layouts.Dashboard')

@section('content')
    <div class="mt-3 space-y-2">
        <div class="flex justify-end">
            <a href="{{ route('student.certificateCreateView') }}"
                class="mx-[8px] bg-[#006666] px-[8px] py-[8px] text-[15px] text-white lg:mx-0 lg:text-[20px]">Apply for New MOI</a>
        </div>
        <div class="w-full px-[8px] text-[14px] lg:px-0 lg:text-[100%]">
            
            <table class="w-full mt-2 border-[1px] border-[#006666] ">
                <thead>
                    <tr class="border-[1px] border-[#006666]">
                        <th class="text-center w-1/3 border-[1px] border-[#006666]">Ref Number</th>
                        <th class="text-center w-1/3 border-[1px] border-[#006666]">Status</th>
                        <th class="text-center w-1/3 border-[1px] border-[#006666]">Actions </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($p_certificate as $certificate)
                        <tr class="border-[1px] border-[#006666]">
                            <td class="border-[1px] border-[#006666] text-center font-semibold w-1/3">{{$certificate->std_id}}-{{$certificate->id}}</td>
                            <td class="border-[1px] border-[#006666] text-center font-semibold w-1/3">
                                <span style="color:red">In Process</span>
                            </td>
                            <td class="border-0 border-[#006666] px-2 py-2 text-center lg:px-0">
                                <a href="#" class=" px-3 text-black underline underline-offset-4" > Pls Wait</a>
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($a_certificate as $certificate)
                        <tr class="border-[1px] border-[#006666]">
                            <td class="border-[1px] border-[#006666] text-center font-semibold w-1/3">{{$certificate->std_id}}-{{$certificate->id}}</td>
                            <td class="border-[1px] border-[#006666] text-center font-semibold w-1/3">
                                <span style="color:green">Completed</span>
                            </td>
                            <td class="  border-0 border-[#006666] px-2 py-2 text-center lg:px-0">
                                <a href="{{route('student.studentMediumCertificateView',['id'=>encrypt($certificate->id)])}}" class=" px-3 text-black underline underline-offset-4" >View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

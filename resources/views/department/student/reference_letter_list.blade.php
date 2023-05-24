@extends('layouts.Dashboard')

@section('content')

<div class="mt-3 space-y-2">
        <div class="flex justify-end">
            <a href="{{ route('student.studentReferenceLetterCreateView') }}"
            class="mx-[8px] bg-[#006666] px-[8px] py-[8px]  text-white lg:mx-0 text-[15px] lg:text-[20px]">New Reference Letter</a>
        </div>
        <div class="mt-2 space-y-2 px-[8px] lg:px-0">
            <table class="w-full border-[1px] border-[#006666]">
                <thead>
                    <tr class="border-[1px] border-[#006666]">
                        <th class="text-center border-[1px] border-[#006666]">Ref Number</th>
                        <th class="text-center border-[1px] border-[#006666]">Status</th>
                        <th class="text-center border-[1px] border-[#006666]">Actions </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($p_referenceLetter as $reference)
                        <tr class="border-[1px] border-[#006666]">
                            <td class="border-[1px] border-[#006666] text-center font-semibold">{{$reference->std_id}}-{{$reference->id}}</td>
                            <td class="border-[1px] border-[#006666] text-center font-semibold">
                                <span style="color:red">In Process</span>
                            </td>
                            <td class="flex justify-around border-0 border-[#006666] px-2 text-center lg:px-0">
                                <a href="#" class="underline px-3 text-black" >Pls Wait</a>
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($a_referenceLetter as $reference)
                        <tr class="border-[1px] border-[#006666]">
                            <td class="border-[1px] border-[#006666] text-center font-semibold">{{$reference->std_id}}-{{$reference->id}}</td>
                            <td class="border-[1px] border-[#006666] text-center font-semibold">
                                <span style="color:green">Completed</span>
                            </td>
                            <td class="flex justify-around border-0 border-[#006666] px-2 text-center lg:px-0">
                                <a href="{{route('student.studentReferenceLetterView',['id'=>encrypt($reference->id)])}}" class="underline px-3 text-black" >View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


{{-- <div class="mt-10 sm:mt-0">

    <div class="md:grid md:grid-cols-1 ">

        <div style="display: flex;justify-content: end;padding: 1rem 0rem;background-color: ghostwhite;">

        <a href="{{route('student.studentReferenceLetterCreateView')}}" style="padding: 1rem 1rem;background: #187c18;color: white;font-weight: 700;font-size: 1.1rem;border-radius: 0.5rem;">Create reference Letter</a>

            

        </div>

        <div>

            <table class="table-auto border-collapse border border-slate-400 w-full">

                <thead>

                    <tr>

                        <th class="border border-slate-300 py-3">Student Id</th>

                        <th class="border border-slate-300 ">Student Name</th>

                        <th class="border border-slate-300 ">Status</th>

                        <th class="border border-slate-300 ">Actions </th>  

                        <th class="border border-slate-300 ">Create Date</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($p_referenceLetter as $reference )

                        <tr>

                            <td class="border border-slate-300 text-center">{{$reference->std_id}}</td>

                            <td class="border border-slate-300 text-center">{{$reference->full_name}}</td>

                            <td class="border border-slate-300 text-center">

                                <span style="color:red">pending</span>

                            </td>

                            <td class="border border-slate-300 text-center py-3 flex justify-center">

                                <a href="#" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" > Update</a>

                            </td>

                            

                            <td class="border border-slate-300 text-center">{{date('d-M-Y', strtotime($reference->created_at))}}</td>

                        </tr>

                    @endforeach

                    @foreach($a_referenceLetter as $reference )

                        <tr>

                            <td class="border border-slate-300 text-center">{{$reference->std_id}}</td>

                            <td class="border border-slate-300 text-center">{{$reference->full_name}}</td>

                            <td class="border border-slate-300 text-center">

                                <span style="color:green">Accepted</span>

                            </td>

                            <td class="border border-slate-300 text-center py-3">

                                <a href="{{route('student.studentReferenceLetterView',['id'=>encrypt($reference->id)])}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" > View</a>



                            </td>

                            

                            <td class="border border-slate-300 text-center">{{date('d-M-Y', strtotime($reference->created_at))}}</td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>



    </div>

</div> --}}

@endsection
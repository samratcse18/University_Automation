@extends('layouts.Dashboard')
@section('content')

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div style="display: flex;justify-content: end;">
            <!-- <a href="{{route('office.letterWriting')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Letter</a> -->
        </div>
        <div>
            <table class="table-auto border-collapse border border-slate-400 w-full mt-[56px]">
                <thead>
                    <tr class=" text-center">
                        <th class="border border-slate-300 py-3">Student Id</th>
                        <th class="border border-slate-300 ">Student Name</th>
                        <th class="border border-slate-300 ">Status</th>
                        <th class="border border-slate-300 ">Actions </th>  
                        <th class="border border-slate-300 ">Application Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($p_certificate as $certificate )
                        <tr>
                            <td class="border border-slate-300 text-center">{{$certificate->std_id}}</td>
                            <td class="border border-slate-300 text-center">{{$certificate->full_name}}</td>
                            <td class="border border-slate-300 text-center">
                                <span style="color:red">pending</span>
                            </td>
                            <td class="border border-slate-300 text-center py-3 flex justify-center">
                                <form action="{{route('office.instructionCertificateAccepted',['id' => encrypt($certificate->id)])}}" method="post">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" > Accepted</button>
                                </form>
                                <a href="{{route('office.instructionCertificateDetails',['id' => encrypt($certificate->id)])}}" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" > Details</a>
                            </td>
                            
                            <td class="border border-slate-300 text-center">{{date('d-M-Y', strtotime($certificate->created_at))}}</td>
                        </tr>
                    @endforeach
                    @foreach($a_certificate as $certificate )
                    <tr>
                            <td class="border border-slate-300 text-center">{{$certificate->std_id}}</td>
                            <td class="border border-slate-300 text-center">{{$certificate->full_name}}</td>
                            <td class="border border-slate-300 text-center">
                                <span style="color:green">Accepted</span>
                            </td>
                            <td class="border border-slate-300 text-center py-3">
                                
                                <a href="{{route('office.instructionCertificateDetails',['id' =>encrypt($certificate->id)])}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" > Details</a>
                            </td>
                            
                            <td class="border border-slate-300 text-center">{{date('d-M-Y', strtotime($certificate->created_at))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
@extends('layouts.Dashboard')
@section('content')

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        
        <div>
            <table class="border-collapse border border-slate-400 w-full mt-[56px]">
                <thead>
                    <tr class="text-center text-[12px]">
                        <th class="border border-slate-300 py-3">Student Id</th>
                        <th class="border border-slate-300 ">Student Name</th>
                        <th class="border border-slate-300 ">Status</th>
                        <th class="border border-slate-300 ">Actions </th>  
                        <th class="border border-slate-300 ">Application Date</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($p_referenceLetter as $rLetter )
                        <tr class="text-[12px]">
                            <td class="border border-slate-300 text-center">{{$rLetter->std_id}}</td>
                            <td class="border border-slate-300 text-center">{{$rLetter->full_name}}</td>
                            <td class="border border-slate-300 text-center">
                                <span style="color:red">pending</span>
                            </td>
                            <td class="border border-slate-300 text-center py-3 flex justify-center">
                                <form action="{{route('office.referenceLetterAccepted',['id' => encrypt($rLetter->id)])}}" method="post">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" > Accepted</button>
                                </form>
                                <a href="{{route('office.referenceLetterDetails',['id' => encrypt($rLetter->id)])}}" class="ml-2 bg-[#1AA2A2] hover:bg-[#006666] text-white font-bold py-2 px-4" > Details</a>
                            </td>
                            
                            <td class="border border-slate-300 text-center">{{date('d-M-Y', strtotime($rLetter->created_at))}}</td>
                        </tr>
                    @endforeach
                    @foreach($a_referenceLetter as $rLetter )
                    <tr>
                            <td class="border border-slate-300 text-center">{{$rLetter->std_id}}</td>
                            <td class="border border-slate-300 text-center">{{$rLetter->full_name}}</td>
                            <td class="border border-slate-300 text-center">
                                <span style="color:green">Accepted</span>
                            </td>
                            <td class="border border-slate-300 text-center py-3">
                                
                                <a href="{{route('office.referenceLetterDetails',['id' =>encrypt($rLetter->id)])}}" class="bg-[#1AA2A2] hover:bg-[#006666] text-white font-bold py-2 px-4" > Details</a>
                            </td>
                            
                            <td class="border border-slate-300 text-center">{{date('d-M-Y', strtotime($rLetter->created_at))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

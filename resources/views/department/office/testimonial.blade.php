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
                    <tr class="text-center">
                        <th class="border border-slate-300 py-3">Student Id</th>
                        <th class="border border-slate-300 ">Student Name</th>
                        <th class="border border-slate-300 ">Status</th>
                        <th class="border border-slate-300 ">Actions </th>  
                        <th class="border border-slate-300 ">Application Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($t_pending as $testimonial )
                        <tr>
                            <td class="border border-slate-300 text-center">{{$testimonial->std_id}}</td>
                            <td class="border border-slate-300 text-center">{{$testimonial->full_name}}</td>
                            <td class="border border-slate-300 text-center">
                                <span style="color:red">pending</span>
                            </td>
                            <td class="border border-slate-300 text-center py-3 flex justify-center">
                                <form action="{{route('office.testimonialAccepted',['id' => encrypt($testimonial->id)])}}" method="post">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" > Accepted</button>
                                </form>
                                <!-- <a href="{{route('office.testimonialAccepted',['id' => $testimonial->id])}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" > Accepted</a> -->
                                <a href="{{route('office.testimonialDetails',['id' => encrypt($testimonial->id)])}}" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" > Details</a>
                            </td>
                            
                            <td class="border border-slate-300 text-center">{{date('d-M-Y', strtotime($testimonial->created_at))}}</td>
                        </tr>
                    @endforeach
                    @foreach($t_accepted as $testimonial )
                    <tr>
                            <td class="border border-slate-300 text-center">{{$testimonial->std_id}}</td>
                            <td class="border border-slate-300 text-center">{{$testimonial->full_name}}</td>
                            <td class="border border-slate-300 text-center">
                                <span style="color:green">Accepted</span>
                            </td>
                            <td class="border border-slate-300 text-center py-3">
                                
                                <a href="{{route('office.testimonialDetails',['id' =>encrypt($testimonial->id)])}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" > Details</a>
                            </td>
                            
                            <td class="border border-slate-300 text-center">{{date('d-M-Y', strtotime($testimonial->created_at))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
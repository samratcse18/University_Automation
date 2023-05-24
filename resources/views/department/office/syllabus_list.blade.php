@extends('layouts.Dashboard')
@section('content')

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div style="display: flex;justify-content: end;">
            <a href="{{route('dept.deptSyllabusCreateView')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Syllabus</a>
        </div>
        <div>
            <table class="border-collapse border border-slate-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-slate-300 ">Session Year</th>
                        <th class="border border-slate-300 text-center">Syllabus File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($syllabus as $say)
                    <tr>
                        <td>{{$say->session_year}}</td>
                        <td class="text-center">
                            <a href="{{route('dept.syllabusShow',['file_path'=>$say->syllabus_file])}}" class="hover:text-[#006666] hover:underline underline-offset-4">Download</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

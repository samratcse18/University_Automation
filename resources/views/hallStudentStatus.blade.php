@extends('layouts.Dashboard')
@section('content')
    <div class="mt-4 flex w-[300px] flex-row justify-around lg:w-full px-[8px] lg:px-0">
        <li class="flex w-[245px] justify-between"><span>Roll</span><span>:</span></li>
        <input type="email" id="rrr" onkeyup="myfun(value)" placeholder="Search By Roll" name="Email"
            class="mx-[10px] w-[300px] border-2 border-[#006666] px-[2px] focus:outline-none">
        <img src="https://img.icons8.com/color/48/null/search--v1.png" class="h-6 w-6 cursor-pointer" />
    </div>
    <div class="mt-5 h-[2px] w-full bg-[#3E3E3E]"></div>
    <div class="overflow-x-auto px-[8px] text-[14px] lg:overflow-x-hidden lg:px-0 lg:text-[100%]">
    <div class="h-[500px] overflow-y-auto">
        <table class="w-[550px] lg:w-full">
            <thead>
                <tr>
                    <th class="border border-green-600 text-center">Serial</th>
                    <th class="border border-green-600 text-center">Name</th>
                    <th class="border border-green-600 text-center">Roll</th>
                    <th class="border border-green-600 text-center">Email</th>
                    <th class="border border-green-600 text-center">Phone</th>
                    <th class="border border-green-600 text-center">Action</th>
                </tr>
            </thead>
            <tbody id="mehedi">
                @php
                    $i = 0;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td class="border border-green-600 text-center">{{ ++$i }}</td>
                        <td class="border border-green-600 text-center">{{ $item->student->fname }} {{ $item->student->lname }}</td>
                        <td class="border border-green-600 texstudent_idter text-center">{{ $item->student->student_id }}</td>
                        <td class="border border-green-600 text-center">{{ $item->student->email }}</td>
                        <td class="border border-green-600 text-center">{{ $item->student->phone }}</td>
                        <td class="border border-green-600 text-center h-9"><a href="{{ route('admin.hallStatusView', ['id'=>$item->student->id]) }}" class="bg-green-500 px-2 text-white">Update Status</a></td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <script>
        function myfun(e) {
            let div="";
            axios.post("{{ route('admin.searchHallStudent')}}",{"data":e})
            .then((res) => {
                res.data.map((item,index)=>{
                    div+=`<tr>
                        <td class="border border-green-600 text-center">${index+1}</td>
                        <td class="border border-green-600 text-center">${item.fname} ${item.lname}</td>
                        <td class="border border-green-600 text-center">${item.student_id}</td>
                        <td class="border border-green-600 text-center">${item.email}</td>
                        <td class="border border-green-600 text-center">${item.phone}</td>
                        <td class="border border-green-600 text-center h-9"><a href="/home/hall_student_status/view?id=${(item.id)}" class="bg-green-500 px-2 text-white">Update Status</a></td>
                    </tr> `
                });
                const m=document.getElementById('mehedi');
                if (e.length>0) {
                    m.innerHTML=div;
                }
                else{
                    m.innerHTML=`@php
                    $i = 0;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td class="border border-green-600 text-center">{{ ++$i }}</td>
                        <td class="border border-green-600 text-center">{{ $item->student->fname }} {{ $item->student->lname }}</td>
                        <td class="border border-green-600 texstudent_idter">{{ $item->student->student_id }}</td>
                        <td class="border border-green-600 text-center">{{ $item->student->email }}</td>
                        <td class="border border-green-600 text-center">{{ $item->student->phone }}</td>
                        <td class="border border-green-600 text-center h-9"><a href="{{ route('admin.hallStatusView', ['id'=>$item->student->id]) }}" class="bg-green-500 px-2 text-white">Update Status</a></td>
                    </tr> 
                @endforeach`;
                }
            }).catch((err) => {
                console.log(err);
            });
        }
    </script>
@endsection

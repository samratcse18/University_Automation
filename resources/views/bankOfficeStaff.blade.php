@extends('layouts.Dashboard')
@section('content')
    <div class="mt-3 space-y-2">
        <a href="{{ route('bank.addBankOfficeStaff') }}" class="bg-[#006666] px-4 text-[18px] ml-4 lg:ml-0 lg:text-[25px] text-white">Add Staff</a>
        <div class="overflow-x-auto px-3 lg:px-0 lg:overflow-x-hidden ">
            <table class="w-[550px] lg:w-full text-[14px] lg:text-[100%] border-2 border-[#006666]">
                <thead>
                    <tr class="border-2 border-[#006666]">
                        <th class="text-center">First Name</th>
                        <th class="text-center">Last Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Phone</th>
                        <th class="w-[30%] text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr class="border-2 border-[#006666]">
                            <td class="border-2 border-[#006666] text-center font-semibold">{{ $item->fname }}
                            </td>
                            <td class="border-2 border-[#006666] text-center font-semibold">{{ $item->lname }}
                            </td>
                            <td class="border-2 border-[#006666] text-center font-semibold">{{ $item->email }}
                            </td>
                            <td class="border-2 border-[#006666] text-center font-semibold">{{ $item->phone }}
                            </td>
                            <td class="border-0 border-[#006666] text-center flex justify-around">
                                <form action="{{ route('bank.officeStaffEdit') }}" method="post">
                                    @csrf
                                    <input type="number" name="id" value="{{$item->id}}" hidden>
                                    <input type="submit" value="Edit" class="bg-blue-600 px-3 lg:text-[20px] text-white"/>
                                </form>
                                    <input type="submit" onclick="del('{{$item->id}}')" value="Delete" class="bg-red-600 px-3 lg:text-[20px] text-white"/>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function del(e) {
            let result=confirm("Are You Sure!, You Want To Delete");
            if (result) {
                axios.post('{{ route('bank.officeStaffDelete') }}',{"id":e})
                .then((res) => {
                    if (res.data) {
                        location.reload();
                    }
                }).catch((err) => {
                    console.log(err);
                });
            }
            
        }
    </script>
@endsection

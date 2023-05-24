@extends('layouts.Dashboard')
@section('content')
    <div class="mt-3 space-y-2">
        <a href="{{ route('admin.addFaculty') }}"
            class="mx-[8px] bg-[#006666] px-4 text-[20px] text-white lg:mx-0 lg:text-[25px]">Add Faculty</a>
        <div class="px-[8px] lg:px-0  text-[13px] lg:text-[100%]">
            <table class="border-2 border-[#006666] w-full">
                <thead>
                    <tr class="border-2 border-[#006666]">
                        <th class="text-center">Faculty</th>
                        <th class="w-[30%] text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr class="border-2 border-[#006666]">
                            <td class="border-2 border-[#006666] text-center font-semibold uppercase">{{ $item->name }}
                            </td>
                            <td class="flex justify-around border-0 border-[#006666] text-center px-[6px] lg:px-0">
                                <form action="{{ route('admin.editFaculty') }}" method="post">
                                    @csrf
                                    <input type="number" name="id" value="{{ $item->id }}" hidden>
                                    <input type="submit" value="Edit"
                                        class="bg-blue-600 px-3 text-[13px] text-white lg:text-[20px]" />
                                </form>
                                <input type="submit" onclick="del('{{ $item->id }}')" value="Delete"
                                    class="bg-red-600 px-3 text-white lg:text-[20px]" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function del(e) {
            let result = confirm("Are You Sure!, You Want To Delete");
            if (result) {
                axios.post('{{ route('admin.facultyDelete') }}', {
                        "id": e
                    })
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

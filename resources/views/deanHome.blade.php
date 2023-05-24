@extends('layouts.Dashboard')
@section('content')
    <div class="mt-3 space-y-2">
        <a href="{{ route('admin.addDean') }}"
            class="mx-[8px] bg-[#006666] px-4 text-[18px] text-white lg:mx-0 lg:text-[25px]">Add Dean</a>
        <div class="px-[8px] lg:px-0  text-[13px] lg:text-[100%]">
            <table class="border-2 border-[#006666] w-full">
                <thead>
                    <tr class="border-2 border-[#006666]">
                        <th class="text-center">Faculty</th>
                        <th class="text-center">Name</th>
                        <th class="w-[30%] text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr class="border-2 border-[#006666]">
                            <td class="border-2 border-[#006666] text-center font-semibold uppercase">{{ $item->name }}
                            </td>
                            <td class="border-2 border-[#006666] text-center font-semibold">{{ $item->fname }} {{ $item->lname }}
                            </td>
                            <td class="flex justify-around border-0 border-[#006666] text-center px-[6px] lg:px-0">
                                <form action="{{ route('admin.editDean') }}" method="post">
                                    @csrf
                                    <input type="number" name="id" value="{{ $item->id }}" hidden>
                                    <input type="submit" value="Edit" class="bg-blue-600 px-3 text-white lg:text-[20px]" />
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
                axios.post('{{ route('admin.deanDelete') }}', {
                        "id": e
                    })
                    .then((res) => {
                        location.reload();
                    }).catch((err) => {
                        console.log(err);
                    });
            }

        }
    </script>
    {{-- <script>
        const mehedi=document.getElementById('mehedi');
        var gg=moment(mehedi.innerText).locale('bn-bd').format('LL');
        mehedi.innerText=gg;
        console.log(gg);
    </script> --}}
@endsection

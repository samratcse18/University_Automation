@extends('layouts.Dashboard')
@section('content')
    <div class="mt-3 space-y-2">
        <a href="{{ route('admin.addProvost') }}"
            class="mx-[8px] bg-[#006666] px-4 text-[18px] text-white lg:mx-0 lg:text-[25px]">Add Provost</a>
        <div class="px-[8px] text-[14px] lg:px-0 lg:text-[100%]">
            <table class="w-full border-2 border-[#006666]">
                <thead>
                    <tr class="border-2 border-[#006666]">
                        <th class="text-center">Hall</th>
                        <th class="text-center">Name</th>
                        <th class="w-[30%] text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr class="border-2 border-[#006666]">
                            <td class="border-2 border-[#006666] text-center font-semibold uppercase">{{ $item->name }}
                            </td>
                            <td class="border-2 border-[#006666] text-center font-semibold">{{ $item->fname }}
                                {{ $item->lname }}
                            </td>
                            <td class="flex justify-around border-0 border-[#006666] px-2 text-center lg:px-0">
                                <form action="{{ route('admin.editProvost') }}" method="POST">
                                    @csrf
                                    <input type="number" name="id" value="{{ $item->id }}" hidden>
                                    <input type="submit" value="Edit"
                                        class="bg-blue-600 px-3 text-white lg:text-[20px]" />
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
                axios.post('{{ route('admin.provostDelete') }}', {
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

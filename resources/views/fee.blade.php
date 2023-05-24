@extends('layouts.Dashboard')
@section('content')
    <div class="mt-3 space-y-2">
        <a href="{{ route('admin.addFee') }}"
            class="mx-[8px] bg-[#006666] px-4 text-[20px] text-white lg:mx-0 lg:text-[25px]">Add Fee</a>
        <div class="mt-2 space-y-2 px-[8px] lg:px-0">
            <table class="w-full border-2 border-[#006666] text-[10px] lg:text-[100%]">
                <thead>
                    <tr class="border-2 border-[#006666]">
                        <th class="text-center">Fee Title</th>
                            <th class="text-center">Program Level</th>
                        <th class="text-center">Amount</th>
                        <th class="w-[30%] text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr class="border-2 border-[#006666]">
                            <td class="border-2 border-[#006666] text-center font-semibold uppercase">{{ $item->fee_title }}
                                @if ($item->class == 'Under Graduation')
                                    @foreach ((array) json_decode($item->semester) as $item2)
                                        @if ($item2 == '1st Year-1st Semester')
                                            {{ '(H:1)' }}
                                        @else
                                            {{ '(H:2-8)' }}
                                        @break
                                    @endif
                                @endforeach
                            @else
                                @foreach ((array) json_decode($item->semester) as $item2)
                                    @if ($item2 == '1st Semester')
                                        {{ '(M:1)' }}
                                    @else
                                        {{ '(M:2-L)' }}
                                    @break
                                @endif
                            @endforeach
                        @endif
                    </td>
                        <td class="border-2 border-[#006666] text-center font-semibold uppercase">
                            {{ $item->class }}
                        </td>
                    <td class="border-2 border-[#006666] text-center font-semibold uppercase">
                        {{ $item->amount }}
                    </td>
                    <td class="flex justify-around border-0 border-[#006666] text-center">
                        {{-- <form action="{{ route('admin.editFee') }}" method="POST">
                                    @csrf
                                    <input type="number" name="id" value="{{ $item->id }}" hidden>
                                    <input type="submit" value="Edit" class="bg-blue-600 px-3 lg:text-[20px] text-white" />
                                </form> --}}
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
            axios.post('{{ route('admin.deleteFee') }}', {
                    "id": e
                })
                .then((res) => {
                    location.reload();
                }).catch((err) => {
                    console.log(err);
                });
        };
    }
</script>
@endsection

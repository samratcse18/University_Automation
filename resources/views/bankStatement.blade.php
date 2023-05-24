@extends('layouts.Dashboard')
@section('content')
    <div class="mt-4 h-full">
        <div class="h-[67%]">
            <div class="p-4">
                <form action="{{ route('bank.getStatementData') }}" method="POST">
                    @csrf
                    <select name="Session" id="" class="lg:w-[40%] w-[56%] px-2 outline outline-gray-600 focus:outline-4">
                        <option value="" selected disabled>Your Session</option>
                        @foreach ($year as $item)
                            <option value="{{ $item->session }}">{{ $item->session }}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="Enter"
                        class="ml-3 cursor-pointer bg-[#006666] px-4 text-[18px] text-white hover:bg-[#06c7c7]">
                </form>
            </div>
            @if (Session::has('data'))
            @php
                $data = Session::get('data');
                if (count($data)>0) {
                    $i = 0;
                    $session=$data[0]->Session;
                }
                else {
                    $session=null;
                }

            @endphp
                <div class="text-center text-[23px] lg:text-[30px]">Bank | Summary Uni A/C <a
                        href="{{ route('bank.exportExcel', ['session' => $session]) }}"
                        class="cursor-pointer text-[22px] lg:text-[100%] bg-[#006666] px-2 text-white hover:bg-[#06c7c7]">Export Excel</a></div>
                <div class="h-1 w-full bg-[#3E3E3E]"></div>
                <div class="flex justify-between text-[12px] lg:text-[100%]">
                    <span>{{ date('l, jS F Y') }}</span>
                    <span>Total To Enter:500000</span>
                    <span>A/C Number:03959384046</span>
                </div>
                <div id="printableArea" class="h-[225px] overflow-y-auto">
                    <div class="table1 pt-2">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="border border-green-600 text-center">Serial</th>
                                    <th class="border border-green-600 text-center">Roll No</th>
                                    <th class="border border-green-600 text-center">Dept</th>
                                    <th class="border border-green-600 text-center">Session</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="border border-green-600 text-center">{{ ++$i }}</td>
                                        <td class="border border-green-600 text-center">{{ $item->RollNumber }}</td>
                                        <td class="border border-green-600 text-center">{{ $item->Subject }}</td>
                                        <td class="border border-green-600 text-center">{{ $item->Session }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
        @if (Session::has('data'))
        <div class="mt-[14px] lg:mt-[3px] h-[10%] bg-[#006666]"></div>
        @endif
    </div>
@endsection

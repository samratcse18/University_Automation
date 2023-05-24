@extends('layouts.Dashboard')
@section('content')
<div>
    <div class="flex justify-start py-8 bg-zinc-100">
        <a href="{{route('office.letters')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-1/4 text-center"> Back</a>
    </div>
    <div class="flex">

        <div class="w-1/2 grid grid-cols-1 flex flex-col justify-center items-center divide-y">
            <div>
                <h4 class="text-center">Select members</h4>
            </div>
            <div class="flex justify-center bg-zinc-50">
                <form action="{{route('office.letterAddNewMembers')}}" method="post">
                    @csrf
                    <input type="text" name="letter_id" hidden value={{$letter_id}}>
                    <div class="pt-6" id="filter-section-mobile-0">
                        <div class="space-y-2 ">
                            @if(count($members) > 0)
                                @foreach($members as $member)
                                    <div class="flex items-center py-3 px-5 hover:bg-gray-200 rounded bg-white">
                                        <input id="filter-mobile-color-{{$member->id}}" name="member[]" value="{{ $member->id}}" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-mobile-color-{{$member->id}}" class="ml-3 min-w-0 flex-1 text-gray-500">{{$member->email}}</label>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center py-3 px-5 hover:bg-gray-200 rounded bg-white">
                                    <label for="filter-mobile-color" class="ml-3 min-w-0 flex-1 text-gray-500">All-ready Selected </label>
                                </div>
                            @endif    
                        </div>

                    </div>
                    @if(count($members) >0)
                        <button type="submit" class="mt-8 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">Add member</button>
                    @endif
                </form>
            </div>
            
        </div>
        <div class="w-1/2 flex flex-col justify-center">
            <div class="">
                <h4 class="text-center">Selected members</h4>
            </div>
            <div class="divide-y">
                @if(!empty($selected_member))
                    @foreach($selected_member as $member)
                        <h4>{{$member->email}}</h4>
                    @endforeach
                @endif
            </div>
            

        </div>
    </div>
</div>

@endsection

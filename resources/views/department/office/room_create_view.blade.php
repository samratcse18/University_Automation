@extends('layouts.Dashboard')
@section('content')

<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-1 ">
    <div class="pt-4 pl-4 flex justify-start" >
        <a href="{{route('dept.roomlist')}}" class="w-32 text-center bg-[#1AA2A2] hover:bg-[#006666] text-white font-bold py-2 px-4">back</a>
    </div>
    <div class="mt-5 md:col-span-2 md:mt-0">
      <form action="{{route('roomCreateSave')}}" method="POST">
        @csrf
        <div class=" shadow sm:rounded-md">
            <div class="bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1">
                    <div class="col-span-2 sm:col-span-3">
                        <label for="building_name" class="block text-sm font-medium text-gray-700">Building Name</label>
                        <select  name="building_name" id="building_name" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                          <option value="#" selected>select building name</option>
                          <option value="AJC Basu Academic Building">AJC Basu Academic Building</option>
                          <option value="Administrative Building">Administrative Building</option>
                          <option value="Tin shed Building">Tin shed Building</option>
                          <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-3">
                        <label for="room_number" class="block text-sm font-medium text-gray-700">Room Number</label>
                        <input type="text" name="room_number" id="room_number" placeholder="Enter room number" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                <button type="submit" class="w-3/6 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('scriptDevDept')
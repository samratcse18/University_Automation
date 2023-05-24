@extends('layouts.Dashboard')
@section('content')
<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-1 ">
    <div class="pt-4 pl-4 flex justify-start" >
        <a href="#" class="w-32 text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">back</a>
    </div>
    <div class="mt-5 md:col-span-2 md:mt-0">
      <form action="{{ route('office.officeInFoAdd')}}" method="POST" enctype="multipart/form-data">
      @csrf
        <div class=" shadow sm:rounded-md">
            @if($info)
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1">
                        <input type="text" name="dept_name" value="cse" hidden>
                        <div class="col-span-2 sm:col-span-3 pb-3">
                            <label for="dept_headB" class="block text-sm font-medium text-gray-700">Department Head Title (Bangla)</label>
                            <input type="text" name="dept_headB" id="dept_headB"  value="{{$info->dept_headB}}" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                        </div>
                        <div class="col-span-2 sm:col-span-3 pb-3">
                            <label for="dept_head" class="block text-sm font-medium text-gray-700">Department Head Title</label>
                            
                            <input type="text" name="dept_head" id="dept_head"  value="{{$info->dept_head}}" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            
                        </div>
                        
                        <div class="col-span-2 sm:col-span-3 pb-3">
                            <label for="dept_nameB" class="block text-sm font-medium text-gray-700">Department Full Name (Bangla)</label>
                            
                            <input type="text" name="dept_nameB" id="dept_nameB" value="{{$info->dept_nameB}}" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            
                        </div>
                        <div class="col-span-2 sm:col-span-3 pb-3">
                            <label for="dept_nameE" class="block text-sm font-medium text-gray-700">Department Full Name (English)</label>
                            <input type="text" name="dept_nameE" id="dept_nameE" value="{{$info->dept_nameE}}" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            
                            
                        </div>
                        <div class="col-span-2 sm:col-span-3 pb-3">
                            <label for="dept_head_nameB" class="block text-sm font-medium text-gray-700">Department Head Full Name (Bangla)</label>
                            <input type="text" name="dept_head_nameB" id="dept_head_nameB" value="{{$info->dept_head_nameB}}" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                        </div>
                        <div class="col-span-2 sm:col-span-3 pb-3">
                            <label for="dept_head_nameE" class="block text-sm font-medium text-gray-700">Department Head Full Name (English)</label>
                            <input type="text" name="dept_head_nameE" id="dept_head_nameE" value="{{$info->dept_head_nameE}}" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                        </div>
                        <div class="col-span-2 sm:col-span-3">
                            <label for="dept_head_signature" class="block text-sm font-medium text-gray-700">Department Head Signature (.jpg, .png file)</label>
                            <img src="/images/dept/signature/{{$info->dept_head_signature}}" style="width:75px;height:55px" alt="">
                            <!-- <input type="file" name="dept_head_signature" id="dept_head_signature" value="Enter meeting venue" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base"> -->
                        </div>
                    </div>
                    
                </div>
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button type="submit" class="w-3/6 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Update</button>
                </div>
            @else
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1">
                        <input type="text" name="dept_name" value="cse" hidden>
                        <div class="col-span-2 sm:col-span-3 pb-3">
                            <label for="dept_headB" class="block text-sm font-medium text-gray-700">Department Head Title (Bangla)</label>
                            <input type="text" name="dept_headB" id="dept_headB"  placeholder="Enter department head title (Bangla)" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                        </div>
                        <div class="col-span-2 sm:col-span-3 pb-3">
                            <label for="dept_head" class="block text-sm font-medium text-gray-700">Department Head Title</label> 
                            <input type="text" name="dept_head" id="dept_head"  placeholder="Enter department head title" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                        </div>
                        <div class="col-span-2 sm:col-span-3 pb-3">
                            <label for="dept_nameB" class="block text-sm font-medium text-gray-700">Department Full Name (Bangla)</label>
                            <input type="text" name="dept_nameB" id="dept_nameB" placeholder="Enter department full name (bangla)" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            
                        </div>
                        <div class="col-span-2 sm:col-span-3 pb-3">
                            <label for="dept_nameE" class="block text-sm font-medium text-gray-700">Department Full Name (English)</label>
                            <input type="text" name="dept_nameE" id="dept_nameE" placeholder="Enter department full name (english)" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            
                            
                        </div>
                        <div class="col-span-2 sm:col-span-3 pb-3">
                            <label for="dept_head_nameB" class="block text-sm font-medium text-gray-700">Department Head Full Name (Bangla)</label>
                            <input type="text" name="dept_head_nameB" id="dept_head_nameB" placeholder="Enter  department head full name (bangla)" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                        </div>
                        <div class="col-span-2 sm:col-span-3 pb-3">
                            <label for="dept_head_nameE" class="block text-sm font-medium text-gray-700">Department Head Full Name (English)</label>
                            <input type="text" name="dept_head_nameE" id="dept_head_nameE" placeholder="Enter department head full name (english)" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            
                            
                        </div>
                        <div class="col-span-2 sm:col-span-3">
                            <label for="dept_head_signature" class="block text-sm font-medium text-gray-700">Department Head Signature (.jpg, .png file)</label>
                            <input type="file" name="dept_head_signature" id="dept_head_signature" placeholder="Enter meeting venue" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                        </div>
                    </div>
                    
                </div>
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button type="submit" class="w-3/6 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                </div>
            @endif
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

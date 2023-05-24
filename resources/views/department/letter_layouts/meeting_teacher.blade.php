@foreach($teachers as $member)
<div class="flex items-center py-3 px-5 hover:bg-gray-200 rounded bg-white">
    <input id="filter-mobile-color-{{$member->id}}"  name="member[]" value="{{$member->id}}" type="checkbox" class="checkTeacher h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
    <label for="filter-mobile-color-{{$member->id}}" class="ml-3 min-w-0 flex-1 text-gray-500">{{$member->email}}</label>
</div>
@endforeach
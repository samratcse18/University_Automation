@foreach ($data as $item)
    <div class="">
        <input type="checkbox" name="course[]" class="w-4 h-4" id="" value="
        {{$item->course_code}}" checked>{{$item->course_name}} ({{$item->course_code}})
    </div>
@endforeach
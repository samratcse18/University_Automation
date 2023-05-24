@foreach ($data as $item)
    <div class="">
        <input type="checkbox" oninput="sum({{$item->course_credit}},event)" name="course[]" class="w-4 h-4" id="" value="{{$item->course_code}}">{{$item->course_name}} ({{$item->course_code}})
    </div>
@endforeach
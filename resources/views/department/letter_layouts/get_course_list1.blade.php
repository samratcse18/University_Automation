<option value="">select course number</option>
@foreach($semeste_course as $course)
    <option value="{{$course->id}}">{{$course->course_code}}</option>
@endforeach

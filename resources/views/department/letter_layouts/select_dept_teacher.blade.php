<option value="">Select teacher</option>
@foreach($teachers as $teacher)
    <option value="{{$teacher->id}}">{{$teacher->email}}</option>
@endforeach
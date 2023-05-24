<option selected>select room number</option>
@foreach($rooms as $room)
    <option value="{{$room->id}}">{{$room->dept_room_number}}</option>
@endforeach

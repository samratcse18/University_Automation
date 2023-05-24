<option value="#" selected>select upazila</option>
@foreach($upazilas as $upazila)
<option value="{{$upazila->id}}" >{{$upazila->name}}</option>
@endforeach
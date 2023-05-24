<option value='' selected>select session</option>
@foreach($sessions as $session)
    <option value="{{$session->session}}">{{$session->session}}</option>
@endforeach
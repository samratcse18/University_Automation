<option  value="">select session</option>
@if(count($sessions)> 0)
    @foreach($sessions as $session)
        @if($type == '1')
            <option value="{{$session->session}}">{{$session->session}}</option>
        @else
            <option value="{{$session->professional_session}}">{{$session->professional_session}}</option>
        @endif
    @endforeach
    
@endif
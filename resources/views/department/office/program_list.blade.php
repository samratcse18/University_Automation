<option value="" selected>select program</option>

@if(count($dept_degree)> 0)
    @foreach($dept_degree as $degree)
        @if($class == 'Under Graduation')
            <option value="{{$degree->id}}">{{$degree->degree_name}}</option>
        @else
           
                <option value="{{$degree->id}}">
                    @if($degree->special_degree =="null")
                        {{$degree->degree_name}}
                    @else
                        {{$degree->special_degree}}
                    
                    @endif
                </option>
           
        @endif
    @endforeach
    
@endif

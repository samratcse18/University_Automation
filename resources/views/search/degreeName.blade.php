<option value="Select Name" disabled selected>Select Name</option>
@foreach ($degree as $item)
    <option value="{{ $item->degree_name }}"@if (old('Program_Name') == $item->degree_name) {{ 'selected' }} @endif>
        {{ $item->degree_name }}</option>
@endforeach

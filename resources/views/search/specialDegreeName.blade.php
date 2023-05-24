<option value="Select Name" disabled selected>Select Name</option>
@foreach ($degree as $item)
    <option value="{{ $item->special_degree }}"@if (old('Program_Name') == $item->special_degree) {{ 'selected' }} @endif>
        {{ $item->special_degree }}</option>
@endforeach
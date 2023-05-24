<option value="Select Course" disabled selected>Select Course</option>
@foreach ($data as $item)
    <option value="{{ $item->course_name }}"@if (old('course') == $item->course_name) {{ 'selected' }} @endif>
        {{ $item->course_name }}</option>
@endforeach
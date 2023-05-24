@extends('layouts.Dashboard')
@section('content')
    <div class="my-6 lg:my-0">
        <form id="onsubmit" class="mt-2 space-y-2 px-[8px] lg:px-0" enctype="multipart/form-data">
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Program Level</span><span>:</span>
                </li>
                <select name="Program_Level" oninput="handle(event)"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]"
                    id="Program_Level">
                    <option value="Select Program Level" disabled selected>Select Program Level</option>
                    <option value="Under Graduation">Under Graduation</option>
                    <option value="Post Graduation">Post Graduation</option>
                </select>
            </div>
            <div id="Year" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Year-Semester</span><span>:</span></li>
                <select name="Semester" oninput="handle(event)"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="" disabled selected>Select Option</option>
                    <option value="1st Year-1st Semester">1st Year-1st Semester</option>
                    <option value="1st Year-2nd Semester">1st Year-2nd Semester</option>
                    <option value="2nd Year-1st Semester">2nd Year-1st Semester</option>
                    <option value="2nd Year-2nd Semester">2nd Year-2nd Semester</option>
                    <option value="3rd Year-1st Semester">3rd Year-1st Semester</option>
                    <option value="3rd Year-2nd Semester">3rd Year-2nd Semester</option>
                    <option value="4th Year-1st Semester">4th Year-1st Semester</option>
                    <option value="4th Year-2nd Semester">4th Year-2nd Semester</option>
                    <option value="5th Year-1st Semester">5th Year-1st Semester</option>
                    <option value="5th Year-2nd Semester">5th Year-2nd Semester</option>
                </select>
            </div>
            <div id="Semester" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Semester</span><span>:</span></li>
                <select name="Semester" oninput="handle(event)"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="" disabled selected>Select Option</option>
                    <option value="1st Semester">1st Semester</option>
                    <option value="2nd Semester">2nd Semester</option>
                    <option value="3rd Semester">3rd Semester</option>
                    <option value="4th Semester">4th Semester</option>
                    <option value="5th Semester">5th Semester</option>
                    <option value="6th Semester">6th Semester</option>
                    <option value="7th Semester">7th Semester</option>
                    <option value="8th Semester">8th Semester</option>
                    <option value="9th Semester">9th Semester</option>
                    <option value="10th Semester">10th Semester</option>
                </select>
            </div>
            <div id="course_div" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Course</span><span>:</span>
                </li>
                <select name="course" oninput="handle(event)"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]"
                    id="course">
                    <option value="Select Course" disabled selected>Select Course</option>
                </select>
            </div>
            <div id="file_div" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>File</span><span>:</span>
                </li>
                <input type="file" name="file" id="file" oninput="handle(event)"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <img src="{{ asset('images/Spinner.gif') }}"
                class="h-[50px] lg:h-[70px] mx-auto" id="img"
                alt="" hidden>
            <div id="bar" class="rounded-full bg-gray-200 dark:bg-gray-700 w-full" hidden>
                <div id="progress"
                    class="rounded-full bg-[#006666] p-0.5 text-center text-xs font-medium leading-none text-blue-100"
                    style="width: 0%"> 0%</div>
            </div>
            <div id="submit" class="my-5 text-center" hidden>
                <input type="submit" value="Submit"
                    class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
            </div>
            


        </form>
        <script>
            const year = document.getElementById('Year');
            const Semester = document.getElementById('Semester');
            const course = document.getElementById('course');
            const course_div = document.getElementById('course_div');
            const submit = document.getElementById('submit');
            const img = document.getElementById('img');
            const bar = document.getElementById('bar');
            let data = {};

            function handle(e) {
                data = {
                    ...data,
                    [e.target.name]: e.target.value
                };
                if (data.Program_Level == 'Under Graduation') {
                    Semester.hidden = true;
                    year.hidden = false;
                    course_div.hidden = false;
                    file_div.hidden = false;
                    submit.hidden = false;
                } else if (data.Program_Level == 'Post Graduation') {
                    Semester.hidden = false;
                    year.hidden = true;
                    course_div.hidden = false;
                    file_div.hidden = false;
                    submit.hidden = false;
                }
                if (e.target.name == 'Semester') {
                    course.innerHTML = '';
                    axios.post("{{ route('student.course') }}", data)
                        .then((res) => {
                            course.innerHTML = res.data;
                        }).catch((err) => {
                            console.log(err);
                        });
                }
            }

            $(document).ready(() => {
                $('#onsubmit').submit((e) => {
                    e.preventDefault();
                    if (data&&data.Semester == null || data&&data.course == null || data&&data.file ==null ) {
                        toastr.options.timeOut = 5000;
                        toastr.error('Please Fill The All Filed');
                    } else {
                        if ($('#file')[0].files[0].size > 20971520) {
                            toastr.options.timeOut = 5000;
                            toastr.error('The File Size is Too Large, Please Submit Less Than or Equal 20MB');
                        } else {
                            const formData = new FormData();
                            formData.append('Semester', data.Semester);
                            formData.append('course', $('#course').val());
                            formData.append('file', $('#file')[0].files[0]);
                            const config = {
                                onUploadProgress: function(progressEvent) {
                                    var percentCompleted = Math.round((progressEvent.loaded * 100) /
                                        progressEvent.total);
                                        console.log(percentCompleted);
                                    if (percentCompleted) {
                                        bar.hidden=false;
                                        img.hidden=false;
                                        submit.hidden=true;
                                        $("#progress").css("width", `${percentCompleted}%`);
                                        $("#progress").text(`${percentCompleted}%`);
                                    }
                                }
                            }
                            axios.post("{{ route('student.file') }}", formData, config)
                                .then((res) => {
                                    submit.hidden=false;
                                    bar.hidden=true;
                                    img.hidden=true;
                                    $('#file').val(null);
                                    $('#course').val("Select Course");
                                    toastr.options.timeOut = 4000;
                                    toastr.success(res.data);
                                })
                                .catch((err) => {
                                    toastr.options.timeOut = 5000;
                                    toastr.error(
                                        'The File Size is Too Large, Please Submit Less Than or Equal 20MB'
                                    );
                                    submit.hidden=false;
                                    bar.hidden=true;
                                    img.hidden=true;
                                });
                        }
                    }
                });
            })
        </script>
    </div>
@endsection

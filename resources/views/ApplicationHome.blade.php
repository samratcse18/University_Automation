@extends('layouts/Dashboard')
@section('content')
    <form onsubmit="sub(event)" class="my-5 space-y-2 overflow-x-auto text-center">
        <div class="flex w-[400px] justify-between px-2 lg:w-full lg:px-16">
            <label for="" class="text-lg font-bold">Your Application</label>
            <div class="flex justify-between space-x-2">
                <span>:</span>
                <select name="application" class="w-[200px] border-2 border-black focus:outline-none" id="">
                    <option value="Select Option" disabled selected>Select Option</option>
                    <option value="Certificate">Certificate</option>
                    <option value="Testimonial">Testimonial</option>
                    <option value="Book ">Book </option>
                </select>
            </div>
        </div>
        <div class="flex w-[400px] justify-between px-2 lg:w-full lg:px-16">
            <label for="" class="text-lg font-bold">Your Department</label>
            <div class="flex justify-between space-x-2">
                <span>:</span>
                <select name="department" class="w-[200px] border-2 border-black focus:outline-none" id="">
                    <option value="Select Option" disabled selected>Select Option</option>
                    <option value="mehedi">CSE</option>
                    <option value="mehedi">EEE</option>
                    <option value="mehedi">ETE</option>
                    <option value="mehedi">CE</option>
                    <option value="mehedi">FAE</option>
                </select>
            </div>
        </div>
        <div class="flex w-[400px] justify-between px-2 lg:w-full lg:px-16">
            <label for="" class="text-lg font-bold">Your Year</label>
            <div class="flex justify-between space-x-2">
                <span>:</span>
                <select name="Year" class="w-[200px] border-2 border-black focus:outline-none" id="">
                    <option value="Select Option" disabled selected>Select Option</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
        </div>
        <div class="flex w-[400px] justify-between px-2 lg:w-full lg:px-16">
            <label for="" class="text-lg font-bold">Your Semester</label>
            <div class="flex justify-between space-x-2">
                <span>:</span>
                <select name="Semester" class="w-[200px] border-2 border-black focus:outline-none" id="">
                    <option value="Select Option" disabled selected>Select Option</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>
        </div>
        <div class="flex w-[400px] justify-between px-2 lg:w-full lg:px-16">
            <label for="" class="text-lg font-bold">Your ID</label>
            <div class="flex justify-between space-x-2">
                <span>:</span>
                <input name="id" type="text" class="w-[200px] border-2 border-black px-2 focus:outline-none"
                    placeholder="Enter Your Id">
            </div>
        </div>
        <div class="flex w-[400px] justify-between px-2 lg:w-full lg:px-16">
            <label for="" class="text-lg font-bold">Your Text (Optional)</label>
            <div class="flex justify-between space-x-2">
                <span>:</span>
                <textarea name="text"
                    class="w-[200px] border-2 border-black px-2 placeholder:placeholder-gray-400 focus:outline-none"
                    placeholder="Write your text here...."></textarea>
            </div>
        </div>
        <div class="">
            <img src="{{ asset('images/Spinner.gif') }}" class="invisible mx-auto h-[50px] w-[130px]" id="img"
                alt="">
            <button type="submit" id="btn" class="visible w-[120px] bg-[#006666] p-2">Submit</button>
        </div>
    </form>
    <script>
        function sub(e) {
            e.preventDefault();
            document.getElementById("img").classList.replace("invisible", "visible");
            document.getElementById("btn").classList.replace("visible", "invisible");
            let data = {
                application: "",
                department: "",
                year:"",
                semester:"",
                id: "",
                text: ""
            }

            data = {
                ...data,
                application: e.target.application.value,
                department: e.target.department.value,
                year: e.target.Year.value,
                semester: e.target.Semester.value,
                id: e.target.id.value,
                text: e.target.text.value
            }
            if (data.application && data.department && data.id && data.year&&data.semester) {
                axios.post(`{{ route('student.applicationData') }}`, data)
                    .then((res) => {
                        e.target.application.value="Select Option";
                        e.target.department.value="Select Option";
                        e.target.Year.value="Select Option";
                        e.target.Semester.value="Select Option";
                        e.target.id.value=null;
                        e.target.text.value=null;
                        toastr.options.timeOut = 10000;
                        toastr.success(res.data);
                        document.getElementById("img").classList.replace("visible", "invisible");
                        document.getElementById("btn").classList.replace("invisible", "visible");
                    }).catch((err) => {
                        console.log(err);
                    });
            } else {
                toastr.options.timeOut = 10000;
                toastr.error('Please Fill The All File');
                document.getElementById("img").classList.replace("visible", "invisible");
                document.getElementById("btn").classList.replace("invisible", "visible");
            }
        }
    </script>
@endsection

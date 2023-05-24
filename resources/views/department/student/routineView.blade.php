@extends('layouts.Dashboard')

@section('content')
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-1">
            <div>
                <div class="bg-[#b1b1b1] pb-2">
                    <div id="oneday" class="flex gap-x-3 border-b bg-[#b1b1b1] py-1 text-center">
                        <div class="w-[100px] self-center py-2 px-1 capitalize"
                            style=" @if (date('D') == 'Sun') background-color:green @endif">sunday</div>
                        @foreach ($sunday as $mon)
                            <div id="divth{{ $loop->index }}" class="routineBtn rounded-md bg-[#505250] p-2 text-white"
                                data-target='#model-{{ $mon->class_routine_id }}' clsDay="{{ $mon->routine_day }}"
                                startdate="{{ $mon->class_time }}" enddata="{{ $mon->class_end_time }}">

                                <p id="start" style="font-size:0.7rem" class="routine">
                                    {{ date('h:m a', strtotime($mon->class_time)) }}-{{ date('h:m a', strtotime($mon->class_end_time)) }}
                                </p>

                                <p style="font-size:0.7rem">{{ $mon->course_code }}</p>

                            </div>

                            <div id="model-{{ $mon->class_routine_id }}"
                                class="model fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50">

                                <div style="top:45%"
                                    class="model-content relative m-auto max-w-md rounded-md bg-white p-4 shadow-lg">

                                    <div class="flex justify-end">

                                        <button class="btn-red-500 close-model-btn"
                                            aria-label="Close model-{{ $mon->class_routine_id }}"
                                            title="Closes the current model">Close</button>

                                    </div>

                                    <div>

                                        <p>{{ $mon->course_code }} : {{ $mon->course_name }}</p>

                                        <p>Room Number : {{ $mon->dept_room_number }}</p>

                                        <p>{{ $mon->teacher_fname }} {{ $mon->teacher_lname }}</p>

                                        <p>Dept : {{ $mon->teacher_dept }}</p>

                                    </div>

                                </div>

                            </div>
                        @endforeach



                    </div>

                    <div id="twoday" class="flex gap-x-3 border-b bg-[#b1b1b1] py-1 text-center">

                        <div class="w-[100px] self-center py-2 px-1 capitalize"
                            style=" @if (date('D') == 'Mon') background-color:green @endif">monday</div>

                        @foreach ($monday as $mon)
                            <div id="divth{{ $loop->index }}" class="routineBtn rounded-md bg-[#505250] p-2 text-white"
                                data-target='#model-{{ $mon->class_routine_id }}' clsDay="{{ $mon->routine_day }}"
                                startdate="{{ $mon->class_time }}" enddata="{{ $mon->class_end_time }}">

                                <p id="start" style="font-size:0.7rem" class="routine">
                                    {{ date('h:m a', strtotime($mon->class_time)) }}-{{ date('h:m a', strtotime($mon->class_end_time)) }}
                                </p>

                                <p style="font-size:0.7rem">{{ $mon->course_code }}</p>

                            </div>

                            <div id="model-{{ $mon->class_routine_id }}"
                                class="model fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50">

                                <div style="top:45%"
                                    class="model-content relative m-auto max-w-md rounded-md bg-white p-4 shadow-lg">

                                    <div class="flex justify-end">

                                        <button class="btn-red-500 close-model-btn"
                                            aria-label="Close model-{{ $mon->class_routine_id }}"
                                            title="Closes the current model">Close</button>

                                    </div>

                                    <div>

                                        <p>{{ $mon->course_code }} : {{ $mon->course_name }}</p>

                                        <p>Room Number : {{ $mon->dept_room_number }}</p>

                                        <p>{{ $mon->teacher_fname }} {{ $mon->teacher_lname }}</p>

                                        <p>Dept : {{ $mon->teacher_dept }}</p>

                                    </div>

                                </div>

                            </div>
                        @endforeach



                    </div>

                    <div id="threeday" class="flex gap-x-3 border-b bg-[#b1b1b1] py-1 text-center">

                        <div class="w-[100px] self-center py-2 px-1 capitalize"
                            style=" @if (date('D') == 'Tue') background-color:green @endif">tuesday</div>

                        @foreach ($tuesday as $mon)
                            <div id="divth{{ $loop->index }}" class="routineBtn rounded-md bg-[#505250] p-2 text-white"
                                data-target='#model-{{ $mon->class_routine_id }}' clsDay="{{ $mon->routine_day }}"
                                startdate="{{ $mon->class_time }}" enddata="{{ $mon->class_end_time }}">

                                <p id="start" style="font-size:0.7rem" class="routine">
                                    {{ date('h:m a', strtotime($mon->class_time)) }}-{{ date('h:m a', strtotime($mon->class_end_time)) }}
                                </p>

                                <p style="font-size:0.7rem">{{ $mon->course_code }}</p>

                            </div>

                            <div id="model-{{ $mon->class_routine_id }}"
                                class="model fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50">

                                <div style="top:45%"
                                    class="model-content relative m-auto max-w-md rounded-md bg-white p-4 shadow-lg">

                                    <div class="flex justify-end">

                                        <button class="btn-red-500 close-model-btn"
                                            aria-label="Close model-{{ $mon->class_routine_id }}"
                                            title="Closes the current model">Close</button>

                                    </div>

                                    <div>

                                        <p>{{ $mon->course_code }} : {{ $mon->course_name }}</p>

                                        <p>Room Number : {{ $mon->dept_room_number }}</p>

                                        <p>{{ $mon->teacher_fname }} {{ $mon->teacher_lname }}</p>

                                        <p>Dept : {{ $mon->teacher_dept }}</p>

                                    </div>

                                </div>

                            </div>
                        @endforeach



                    </div>

                    <div id="fourday" class="flex gap-x-3 border-b bg-[#b1b1b1] py-1 text-center">

                        <div class="w-[100px] self-center py-2 px-1 capitalize"
                            style=" @if (date('D') == 'Wed') background-color:green @endif">wednesday</div>

                        @foreach ($wednesday as $mon)
                            <div id="divth{{ $loop->index }}" class="routineBtn rounded-md bg-[#505250] p-2 text-white"
                                data-target='#model-{{ $mon->class_routine_id }}' clsDay="{{ $mon->routine_day }}"
                                startdate="{{ $mon->class_time }}" enddata="{{ $mon->class_end_time }}">

                                <p id="start" style="font-size:0.7rem" class="routine">
                                    {{ date('h:m a', strtotime($mon->class_time)) }}-{{ date('h:m a', strtotime($mon->class_end_time)) }}
                                </p>

                                <p style="font-size:0.7rem">{{ $mon->course_code }}</p>

                            </div>

                            <div id="model-{{ $mon->class_routine_id }}"
                                class="model fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50">

                                <div style="top:45%"
                                    class="model-content relative m-auto max-w-md rounded-md bg-white p-4 shadow-lg">

                                    <div class="flex justify-end">

                                        <button class="btn-red-500 close-model-btn"
                                            aria-label="Close model-{{ $mon->class_routine_id }}"
                                            title="Closes the current model">Close</button>

                                    </div>

                                    <div>

                                        <p>{{ $mon->course_code }} : {{ $mon->course_name }}</p>

                                        <p>Room Number : {{ $mon->dept_room_number }}</p>

                                        <p>{{ $mon->teacher_fname }} {{ $mon->teacher_lname }}</p>

                                        <p>Dept : {{ $mon->teacher_dept }}</p>

                                    </div>

                                </div>

                            </div>
                        @endforeach



                    </div>

                    <div id="fiveday" class="flex gap-x-3 border-b bg-[#b1b1b1] py-1 text-center">

                        <div class="w-[100px] self-center py-2 px-1 capitalize"
                            style=" @if (date('D') == 'Thu') background-color:green @endif">thursday</div>

                        @foreach ($thursday as $mon)
                            <div id="divth{{ $loop->index }}" class="routineBtn rounded-md bg-[#505250] p-2 text-white"
                                data-target='#model-{{ $mon->class_routine_id }}' clsDay="{{ $mon->routine_day }}"
                                startdate="{{ $mon->class_time }}" enddata="{{ $mon->class_end_time }}">

                                <p id="start" style="font-size:0.7rem" class="routine">
                                    {{ date('h:m a', strtotime($mon->class_time)) }}-{{ date('h:m a', strtotime($mon->class_end_time)) }}
                                </p>

                                <p style="font-size:0.7rem">{{ $mon->course_code }}</p>

                            </div>

                            <div id="model-{{ $mon->class_routine_id }}"
                                class="model fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50">

                                <div style="top:45%"
                                    class="model-content relative m-auto max-w-md rounded-md bg-white p-4 shadow-lg">

                                    <div class="flex justify-end">

                                        <button class="btn-red-500 close-model-btn"
                                            aria-label="Close model-{{ $mon->class_routine_id }}"
                                            title="Closes the current model">Close</button>

                                    </div>

                                    <div>

                                        <p>{{ $mon->course_code }} : {{ $mon->course_name }}</p>

                                        <p>Room Number : {{ $mon->dept_room_number }}</p>

                                        <p>{{ $mon->teacher_fname }} {{ $mon->teacher_lname }}</p>

                                        <p>Dept : {{ $mon->teacher_dept }}</p>

                                    </div>

                                </div>

                            </div>
                        @endforeach



                    </div>







                </div>

            </div>



        </div>

    </div>
@endsection

@section('scriptDevDept')
    <script>
        const button = document.querySelectorAll('.routineBtn');

        button.forEach((b) => {

            b.addEventListener('click', () => {

                var targert = b.getAttribute('data-target');

                var modelid = targert.substring(1);

                var clickmodel = document.getElementById(modelid);

                clickmodel.classList.remove('hidden');

            })

        })

        const closebutton = document.querySelectorAll('.close-model-btn');

        closebutton.forEach((c) => {

            c.addEventListener('click', () => {

                var m = c.getAttribute('aria-label');

                console.log(m.substring(6))

                var l = document.getElementById(m.substring(6));

                l.classList.add('hidden')

                // console.log(l.classList.add('hidden'))

            })

        });

        var date_ = new Date();

        const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

        var day = days[date_.getDay()];

        var timeSection = document.querySelectorAll('.routineBtn');

        var tims = new Date();

        var today = tims.toJSON().slice(0, 10)

        for (var l of timeSection) {

            var routine_day = l.getAttribute('clsDay');

            var endString = today + ' ' + l.getAttribute('enddata');

            var startString = today + ' ' + l.getAttribute('startdate');

            var startTime = new Date(startString);

            var endTime = new Date(endString);

            if ((tims.getTime() >= startTime.getTime() && tims.getTime() <= endTime.getTime()) && day == routine_day) {

                l.classList.add('bg-[#2912a7]')

            }



        }

        if (day == "Sun") {

            $('#oneday').addClass('bg-[#ffcb6b]')

        }

        if (day == "Mon") {

            $('#twoday').addClass('bg-[#ffcb6b]')

        }

        if (day == "Tue") {

            $('#threeday').addClass('bg-[#ffcb6b]')

        }

        if (day == "Wed") {

            $('#fourday').addClass('bg-[#ffcb6b]')

        }

        if (day == "Thu") {

            $('#fiveday').addClass('bg-[#ffcb6b]')

        }



        // 
    </script>
@endsection

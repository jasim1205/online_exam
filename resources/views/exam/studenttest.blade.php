@extends('layout.app')
@section('title', trans('Exam'))
@section('page', trans('Create'))
@section('content')
<style>
    .question-page{
        -webkit-user-select: none; /* For Chrome, Safari, Edge, and Opera */
        -moz-user-select: none;    /* For Firefox */
        -ms-user-select: none;     /* For Internet Explorer */
        user-select: none;
    }
</style>
    <div class="page-wrapper question-page">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title text-center">{{ $test->title }}</h3>
                        <h3 class="page-title text-center">{{ $test->subject?->name }}</h3>
                        <h4 class="page-title text-center">{{ $test->examtype?->name }}-{{ $test->total_marks }}</h4>
                        <h5 class="duration" id="duration">{{ $test->duration }}</h5>
                        <div class="countdown-timer" id="countdown"></div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form class="form" method="post" enctype="multipart/form-data"
                        action="{{ route('student_submit') }}">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="exam_id" value="{{ $test->id }}">
                            <input type="hidden" name="total_obtain_marks" value="">
                            <div class="col-md-12">
                                @foreach ($questions as $index => $item)
                                    <p><i class="la la-arrow-right"></i> {{ $item->question }}
                                        <input type="hidden" name="question_id[]" value="{{ $item->id }}">
                                    </p>
                                    <ul style="list-style: none;">
                                        @foreach ($item->option as $optionIndex => $value)
                                            <li>
                                                <input type="radio" name="option_id[{{ $index }}]"
                                                    id="option_{{ $index }}_{{ $optionIndex }}"
                                                    value="{{ $value->id }}">
                                                <label
                                                    for="option_{{ $index }}_{{ $optionIndex }}">{{ $value->option_text }}</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <button type="submit" class="btn btn-primary px-5">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let duration = parseInt($('#duration').text());
            let totalTime = duration * 60; // Convert minutes to seconds
            const localStorageKey = 'endTime';

            // Check if an end time is stored in local storage
            if (!localStorage.getItem(localStorageKey)) {
                // Calculate end time and store it in local storage
                let endTime = Math.floor(Date.now() / 1000) + totalTime; // Current time + total time
                localStorage.setItem(localStorageKey, endTime);
            }

            // Function to update the countdown
            function updateCountdown() {
                let endTime = parseInt(localStorage.getItem(localStorageKey));
                let currentTime = Math.floor(Date.now() / 1000); // Current time in seconds
                let remainingTime = endTime - currentTime;

                if (remainingTime > 0) {
                    let minutes = Math.floor(remainingTime / 60);
                    let seconds = remainingTime % 60;

                    seconds = seconds < 10 ? '0' + seconds : seconds;
                    $('#countdown').text(minutes + ':' + seconds);
                } else {
                    clearInterval(countdownInterval);
                    $('#countdown').text("Time's up!");
                    localStorage.removeItem(localStorageKey); // Clear the stored end time
                    // Optionally submit the form
                    $('form').submit(); // Uncomment to auto-submit
                }
            }

            // Update countdown every second
            let countdownInterval = setInterval(updateCountdown, 1000);
            updateCountdown(); // Call the function immediately to set the initial state
        });


        $(document).ready(function() {
            // Get the window height for top boundary detection
            const topBoundary = 0; // Topmost boundary
            const dashboardUrl = "{{ route('dashboard') }}"; // Replace 'dashboard' with your route name

            $(window).on('mousemove', function(event) {
                if (event.clientY <= topBoundary) {
                    // alert("You have moved out of the exam area. Redirecting to the dashboard.");
                    window.location.href = dashboardUrl; // Redirect to dashboard
                }
            });
        });



        $(document).ready(function() {
            // Disable specific key combinations
            $(document).on('keydown', function(event) {
                // Check for forbidden keys
                if (event.key === "Control" || event.key === "Shift" || event.key === "PrintScreen") {
                    alert("Key usage is restricted during the test!");
                    event.preventDefault();
                    return false;
                }

                // Prevent Ctrl+P (Print) and other Ctrl combinations
                if (event.ctrlKey) {
                    alert("Key combinations with Ctrl are not allowed during the test!");
                    event.preventDefault();
                    return false;
                }
            });

            // Disable PrintScreen by clearing the clipboard
            $(document).on('keyup', function(event) {
                if (event.key === "PrintScreen") {
                    navigator.clipboard.writeText(""); // Clear clipboard
                    alert("Screenshots are not allowed!");
                }
            });

            $(document).ready(function() {
                // Disable text selection
                $(document).on('selectstart', function(event) {
                    event.preventDefault();
                });

                // Disable right-click context menu
                $(document).on('contextmenu', function(event) {
                    event.preventDefault();
                    alert("Right-click is disabled during the test!");
                });
            });
        });
    </script>


@endsection

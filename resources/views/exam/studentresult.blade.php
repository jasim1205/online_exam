@extends('layout.app')
@section('title', trans('Exam'))
@section('page', trans('Create'))
@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title text-center">{{$test->title}}</h3>
                    <h3 class="page-title text-center">{{$test->subject?->name}}</h3>
                    <h4 class="page-title text-center">{{$test->examtype?->name}}-{{$test->total_marks}}</h4>
                    <h5>Total Obtain:{{$submit->total_obtain_marks}}</h5>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="form" method="post" enctype="multipart/form-data" action="{{route('student_submit')}}">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="exam_id" value="{{$test->id}}">
                        <div class="col-md-12">
                            @foreach ($questions as $index => $item)
                                <p><i class="la la-arrow-right"></i> {{$item->question}}
                                    <input type="hidden" name="question_id[]" value="{{$item->id}}">
                                </p>
                                <ul>
                                    @foreach ($item->option as $optionIndex => $value)
                                        <li>
                @php
                    // Get the user's submitted answer for this question, if available
                    $submittedAnswer = isset($answers[$item->id]) ? $answers[$item->id]->option_id : null;

                    // Check if this option is the correct answer
                    $isCorrect = $value->option == $item->option_ans;

                    // Check if this option is the one the user selected
                    $isUserAnswer = $value->option == $submittedAnswer;
                @endphp

                                            {{-- <input type="radio" name="option_id[{{$index}}]" id="option_{{$index}}_{{$optionIndex}}" value="{{$value->id}}"> --}}
                {{-- Show correct answer with check mark --}}
                @if ($isUserAnswer && $isCorrect)
                    <i class="las la-check" style="color: green;"></i> {{-- Correct answer --}}
                @elseif($isUserAnswer && !$isCorrect)
                    <i class="las la-times-circle" style="color: red;"></i> {{-- Incorrect user answer --}}
                @endif
                                            <label for="option_{{$index}}_{{$optionIndex}}">{{$value->option_text}}</label>
                                            @if($value->option == $item->option_ans)
                                                <i class="las la-hand-point-left"></i>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="col-md-6 col-12">
                        <button type="submit" class="btn btn-primary px-5">Save</button>
                    </div> --}}
                </form>
                
            </div>
        </div>
    </div>
</div>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                // $('form').submit(); // Uncomment to auto-submit
            }
        }

        // Update countdown every second
        let countdownInterval = setInterval(updateCountdown, 1000);
        updateCountdown(); // Call the function immediately to set the initial state
    });
</script> --}}

@endsection

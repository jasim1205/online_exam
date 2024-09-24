@extends('layout.app')
@section('title',trans('Exam'))
@section('page',trans('Create'))
@section('content')

    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Exam-Type Add</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="card">
                <div class="card-body">
                    <form class="form" method="post" enctype="multipart/form-data" action="{{route('exam.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" id="title" class="form-control" value="{{ old('title')}}" name="title">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="">Total Marks</label>
                                    <input type="text" id="" class="form-control" value="{{ old('total_marks')}}" name="total_marks">
                                    @error('total_marks')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="">Duration</label>
                                    <input type="text" id="" class="form-control" value="{{ old('duration')}}" name="duration">
                                    @error('duration')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="">Start Deadline</label>
                                    <input type="date" id="" class="form-control" value="{{ old('start_deadline')}}" name="start_deadline">
                                    @error('start_deadline')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="">End Deadline</label>
                                    <input type="date" id="" class="form-control" value="{{ old('end_deadline')}}" name="end_deadline">
                                    @error('end_deadline')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="class">Class</label>
                                    <select name="class_id" id="" class="form-control">
                                        <option value="">Class Select</option>
                                        @foreach($classlist as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('class')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="class">Subjec</label>
                                    <select name="subject_id" id="" class="form-control">
                                        <option value="">Subject Select</option>
                                        @foreach($subject as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('subject')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="class">Exam-Type</label>
                                    <select name="examtype_id" id="examtype_id" class="form-control">
                                        <option value="">Exam-type Select</option>
                                        @foreach($examtype as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('examtype')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <h3 class="text-center">Question</h3>
                        </div>
                        <div class="row" id="AddQuestionRow">
                            <h5>Mcq Question</h5>
                            <span onclick="addQuestion();" class="add-row text-primary ms-4 pt-1">
                                    <i class="fa fa-plus"></i>
                                </span>
                            <div class="col-md-12 my-1">
                                <label for="class">Question</label>
                                <input type="text" id="question" class="form-control" value="{{ old('question')}}" name="question[]">
                            </div>
                            <div class="col-md-3 my-1">
                                <label for="class">Option-A</label>
                                <input type="text" id="" class="form-control" value="{{ old('option_a')}}" name="option_a[]">
                            </div>
                            <div class="col-md-3 my-1">
                                <label for="class">Option-B</label>
                                <input type="text" id="" class="form-control" value="{{ old('option_b')}}" name="option_b[]">
                            </div>
                            <div class="col-md-3 my-1">
                                <label for="class">Option-C</label>
                                <input type="text" id="" class="form-control" value="{{ old('option_c')}}" name="option_c[]">
                            </div>
                            <div class="col-md-3 my-1">
                                <label for="class">Option-D</label>
                                <input type="text" id="" class="form-control" value="{{ old('option_d')}}" name="option_d[]">
                            </div>
                            <div class="col-md-3 my-1">
                                <label for="class">Answer</label>
                                <select name="option_ans[]" id="" class="form-control form-select">
                                    <option value="">Answer Select</option>
                                    <option value="1">A</option>
                                    <option value="2">B</option>
                                    <option value="3">C</option>
                                    <option value="4">D</option>
                                </select>
                            </div>
                            <div class="col-md-3 my-1">
                                <label for="class">Marks</label>
                                <input type="text" id="" class="form-control" value="{{ old('marks')}}" name="marks[]">
                                
                            </div>
                        </div>
                        <div class="row" id="Descriptive">
                            <h5>Descriptive Question</h5>
                            <span onclick="addDescriptive();" class="add-row text-primary ms-4 pt-1">
                                <i class="fa fa-plus"></i>
                            </span>
                            <div class="col-md-12 my-1">
                                <label for="class">Question</label>
                                <input type="text" id="descriptive_question" class="form-control" value="{{ old('descriptive_question')}}" name="descriptive_question[]">
                            </div>
                            <div class="col-md-3 my-1">
                                <label for="class">Marks</label>
                                <input type="text" id="" class="form-control" value="{{ old('marks')}}" name="marks[]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <button type="submit" class="btn btn-primary px-5">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var oldQuestionRowId = 1;
        function addQuestion() {
            var QuestionRow = `<div class="row mt-3">
                <hr />
                <div class="col-md-12 my-1">
                    <label for="class">Question</label>
                    <input type="text" id="question" class="form-control" value="{{ old('question')}}" name="question[]">
                </div>
                <div class="col-md-3 my-1">
                    <label for="class">Option-A</label>
                    <input type="text" id="" class="form-control" value="{{ old('option_a')}}" name="option_a[]">
                </div>
                <div class="col-md-3 my-1">
                    <label for="class">Option-B</label>
                    <input type="text" id="" class="form-control" value="{{ old('option_b')}}" name="option_b[]">
                </div>
                <div class="col-md-3 my-1">
                    <label for="class">Option-C</label>
                    <input type="text" id="" class="form-control" value="{{ old('option_c')}}" name="option_c[]">
                </div>
                <div class="col-md-3 my-1">
                    <label for="class">Option-D</label>
                    <input type="text" id="" class="form-control" value="{{ old('option_d')}}" name="option_d[]">
                </div>
                <div class="col-md-3 my-1">
                    <label for="class">Answer</label>
                    <select name="option_ans[]" id="" class="form-control form-select">
                        <option value="">Answer Select</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                        <option value="4">D</option>
                    </select>
                </div>
                <div class="col-md-3 my-1">
                    <label for="class">Marks</label>
                    <input type="text" id="" class="form-control" value="{{ old('marks')}}" name="marks[]">
                    
                </div>
                <div class="col-md-12 col-12 mt-3">
                    <span onclick="removeAssetRow(this);" class="delete-row text-danger">
                        <i class="bi bi-trash-fill"></i> Remove
                    </span>
                </div>
            </div>`;

        $('#AddQuestionRow').after(QuestionRow);
        oldQuestionRowId++;
        };

        function removeAssetRow(spanElement) {
        $(spanElement).closest('.row').remove();
        };



        var oldDescriptiveRowId = 1;
        function addDescriptive() {
            var Descriptive = `<div class="row mt-3">
                <hr />
                <div class="col-md-12 my-1">
                    <label for="class">Question</label>
                    <input type="text" id="descriptive_question" class="form-control" value="{{ old('descriptive_question')}}" name="descriptive_question[]">
                </div>
                <div class="col-md-3 my-1">
                    <label for="class">Marks</label>
                    <input type="text" id="" class="form-control" value="{{ old('marks')}}" name="marks[]">
                </div>
                <div class="col-md-12 col-12 mt-3">
                    <span onclick="removeAssetRow(this);" class="delete-row text-danger">
                        <i class="bi bi-trash-fill"></i> Remove
                    </span>
                </div>
            </div>`;

        $('#Descriptive').after(Descriptive);
        oldDescriptiveRowId++;
        };

        function removeAssetRow(spanElement) {
        $(spanElement).closest('.row').remove();
        };



        $(document).ready(function(){
            $('#Descriptive').hide();
            $('#examtype_id').change(function(){
                if($(this).val()== '2'){
                    $('#Descriptive').show();
                    $('#AddQuestionRow').hide();
                }else{
                    $('#AddQuestionRow').show();
                    $('#Descriptive').hide();
                }
            });
        });
    </script>
@endsection

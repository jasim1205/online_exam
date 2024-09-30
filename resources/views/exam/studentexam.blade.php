@extends('layout.app')
@section('title',trans('Exam'))
@section('page',trans('List'))
@section('content')

    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Exam List</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="" class="btn add-btn"><i class="fa fa-plus"></i> Add New Exam-Type</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Class')}}</th>
                                    <th scope="col">{{__('Subject')}}</th>
                                    <th scope="col">{{__('Exam-Type')}}</th>
                                    <th scope="col">{{__('Marks')}}</th>
                                    <th scope="col">{{__('Duration')}}</th>
                                    <th scope="col">{{__('Start Date')}}</th>
                                    <th scope="col">{{__('End Date')}}</th>
                                    <th class="white-space-nowrap">{{__('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($exam as $p)
                                    <tr>
                                        <th scope="row">{{ ++$loop->index }}</th>
                                        <td>{{$p->title}}</td>
                                        <td>{{$p->classlist?->name}}</td>
                                        <td>{{$p->subject?->name}}</td>
                                        <td>{{$p->examtype?->name}}</td>
                                        <td>{{$p->total_marks}}</td>
                                        <td>{{$p->duration}}</td>
                                        <td>{{$p->start_deadline}}</td>
                                        <td>{{$p->end_deadline}}</td>
                                        <td class="white-space-nowrap">
                                            <div class="btn-group" role="group">
                                                @if($p->submission()->where('user_id', currentUserId())->count() == 1)
                                                    <!-- If the student has submitted, show the result link -->
                                                    <a href="{{ route('student.result', encryptor('encrypt', $p->id)) }}">
                                                        Result
                                                    </a>
                                                @else
                                                <!-- If the student has not submitted, check the deadline -->
                                                    @if($p->end_deadline->isToday())
                                                        <!-- If the exam deadline is today, show the exam link -->
                                                        <a href="{{ route('student.test', encryptor('encrypt', $p->id)) }}">
                                                            Exam
                                                        </a>
                                                    @elseif($p->end_deadline < now())
                                                        <!-- If the exam deadline has passed, disable the exam link -->
                                                        <a href="javascript:void(0)" class="disabled" style="pointer-events: none; color: rgb(230, 22, 22);">
                                                            Exam (Deadline Closed)
                                                        </a>
                                                    @else
                                                        <!-- If the exam is still open (i.e. current date is less than the deadline), show the exam link -->
                                                        <a href="{{ route('student.test', encryptor('encrypt', $p->id)) }}">
                                                            Exam
                                                        </a>
                                                    @endif
                                                @endif


                                                {{-- <form id="deleteForm_{{ $p->id }}" action="{{ route('exam.destroy', encryptor('encrypt', $p->id)) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="javascript:void(0);" onclick="confirmDelete('{{ $p->id }}')">
                                                        <i class="fa fa-trash m-1"></i>
                                                    </a>
                                                </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="8" class="text-center">No Data Found</th>
                                    </tr>
                                    @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this item?')) {
            document.getElementById('deleteForm_' + id).submit();
        }
    }
</script>
@endsection

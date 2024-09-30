@extends('layout.app')
@section('title',trans('Result'))
@section('page',trans('List'))
@section('content')

    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Result List</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        </ul>
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
                                    <th scope="col">{{__('Exam Name')}}</th>
                                    <th scope="col">{{__('Class')}}</th>
                                    <th scope="col">{{__('Subject')}}</th>
                                    <th scope="col">{{__('Exam-Type')}}</th>
                                    <th scope="col">{{__('Marks')}}</th>
                                    <th scope="col">{{__('Obtain Marks')}}</th>
                                    <th class="white-space-nowrap">{{__('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($submit as $p)
                                    <tr>
                                        <th scope="row">{{ ++$loop->index }}</th>
                                        <td>{{$p->user?->name}}</td>
                                        <td>{{$p->exam?->title}}</td>
                                        <td>{{$p->exam?->classlist?->name}}</td>
                                        <td>{{$p->exam?->subject?->name}}</td>
                                        <td>{{$p->exam?->examtype?->name}}</td>
                                        <td>{{$p->exam?->total_marks}}</td>
                                        <td>{{$p->total_obtain_marks}}</td>
                                        <td class="white-space-nowrap">
                                            <div class="btn-group" role="group">
                                                <a href="{{route('individual.result',encryptor('encrypt',$p->id))}}">
                                                <i class="fa fa-edit m-1"></i>
                                                </a>
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

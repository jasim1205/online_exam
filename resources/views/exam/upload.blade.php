@extends('layout.app')
@section('title', trans('Exam Upload'))
@section('page', trans('List'))
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 offset-2">
                    <div class="card">
                        <form action="{{ route('exam_upload_store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="exam_file" accept=".pdf" required>
                            <button type="submit">Upload</button>
                        </form>

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

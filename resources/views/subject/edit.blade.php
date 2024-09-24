@extends('layout.app')

@section('title',trans('Subject'))
@section('page',trans('Update'))

@section('content')
<div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Subject Update</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="card">
                <div class="card-body">
                     <form class="form" method="post" action="{{route('subject.update',encryptor('encrypt',$subject->id))}}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input type="text" id="name" class="form-control" value="{{ old('name',$subject->name)}}" name="name">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
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

@endsection

@extends('layout.app')
@section('content')

 <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome {{$user->name}}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
        
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-book"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{$exam}}</h3>
                                <span>Total Exam</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-edit"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{$submit}}</h3>
                                <span>Total Attend</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{$total_marks}}</h3>
                                <span>Total Marks</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{$total_obtain}}</h3>
                                <span>Otain Marks</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
<!-- /Page Wrapper -->
@endsection
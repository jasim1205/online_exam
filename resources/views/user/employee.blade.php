@extends('layout.app')
@section('title',trans('Employees'))
@section('page',trans('List'))
@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Employees</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
            <nav
                aria-label="breadcrumb"
                class="breadcrumb-header float-start float-lg-end"
            >
                <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Employees
                </li>
                </ol>
            </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            {{-- <div class="card-header d-flex">
                <a class="btn btn-primary" href="{{route('user.create')}}"><i class="fa fa-plus"></i></a>
            </div> --}}
            <div class="card-header">
                <form action="{{ route('voucher.employee_report') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary px-5 py-2 my-3">Generate Report</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th scope="col">{{__('#SL')}}</th>
                        <th scope="col">{{__('Name')}}</th>
                        <th scope="col">{{__('Employee ID')}}</th>
                        <th scope="col">{{__('Email')}}</th>
                        <th scope="col">{{__('Contact')}}</th>
                        {{-- <th scope="col">{{__('Role')}}</th> --}}
                        <th scope="col">{{__('Status')}}</th>
                        <th class="white-space-nowrap">{{__('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <th scope="row">{{ ++$loop->index }}</th>
                        <td>
                            <img width="40px" src="{{asset('public/uploads/employee/'.$employee->image)}}" alt="" class="rounded-circle">
                            {{$employee->name}}
                        </td>
                        <td>{{$employee?->employee_id}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->contact_no}}</td>
                        {{-- <td>{{$employee->role?->name}}</td> --}}
                        <td>@if($employee->status == 1) {{__('Active') }} @else {{__('Inactive') }} @endif</td>
                        <!-- or <td>{{ $employee->status == 1?"Active":"Inactive" }}</td>-->
                        <td class="white-space-nowrap">
                            <a href="{{route('user.edit',encryptor('encrypt',$employee->id))}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            {{-- <a href="javascript:void()" onclick="$('#form{{$employee->id}}').submit()">
                                <i class="fa fa-trash"></i>
                            </a>
                            <form id="form{{$employee->id}}" action="{{route('user.destroy',encryptor('encrypt',$employee->id))}}" method="post">
                                @csrf
                                @method('delete')
                            </form> --}}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <th colspan="7" class="text-center">No Data Found</th>
                    </tr>
                    @endforelse
                </tbody>
            </table>
               <div class="text-end">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

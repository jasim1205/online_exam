@extends('layout.app')
@section('title',trans('Student'))
@section('page',trans('List'))
@section('content')
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Student List</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{route('user.create')}}" class="btn add-btn"><i class="fa fa-plus"></i> Add User</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Email')}}</th>
                                    <th scope="col">{{__('Contact')}}</th>
                                    <th scope="col">{{__('Role')}}</th>
                                    
                                    <th scope="col">{{__('Status')}}</th>
                                    <th class="white-space-nowrap">{{__('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($student as $p)
                                    <tr>
                                        <th scope="row">{{ ++$loop->index }}</th>
                                        <td>
                                            <img width="40px" src="{{asset('public/uploads/employee/'.$p->image)}}" alt="" class="rounded-circle">
                                            {{$p->name}}
                                        </td>
                                        <td>{{$p->email}}</td>
                                        <td>{{$p->contact_no}}</td>
                                        <td>{{$p->role?->name}}</td>
                                        <td>@if($p->status == 1) {{__('Active') }} @else {{__('Inactive') }} @endif</td>
                                        <!-- or <td>{{ $p->status == 1?"Active":"Inactive" }}</td>-->
                                        <td class="white-space-nowrap">
                                            {{-- <a href="{{route('user.edit',encryptor('encrypt',$p->id))}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="javascript:void()" onclick="$('#form{{$p->id}}').submit()">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="form{{$p->id}}" action="{{route('user.destroy',encryptor('encrypt',$p->id))}}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form> --}}
                                            <div class="btn-group" role="group">   
                                                <a href="{{route('user.edit',encryptor('encrypt',$p->id))}}">
                                                    <i class="fa fa-edit m-1"></i></a>
                                                {{-- <form id="deleteForm_{{ $p->id }}" action="{{ route('user.destroy', encryptor('encrypt', $p->id)) }}" method="post">
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#table1 tbody tr');

        function filterRows() {
            const searchValue = searchInput.value.trim().toLowerCase();

            tableRows.forEach(row => {
                const Title = row.cells[1].textContent.trim().toLowerCase();
                if (Title.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterRows);
    });
    
</script>
@endsection

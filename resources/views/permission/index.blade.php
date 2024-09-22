@extends('layout.app')
@section('title',trans('Permission'))
@section('page',trans('List'))
@section('content')
<style>
.list-group-collapse li>ul li:first-child {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
.list-group-collapse li>ul{
  margin-left: 16px;
  margin-right: 16px;
  margin-bottom: 11px;
}
</style>

    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Permission</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="card">
                <div class="card-header">
                    <h4>{{$role->name}}</h4>
                    @php 
                        $routes=array();
                        $auto_accept=array('GET',"DELETE");
                        $permissions=array();
                        foreach($permission as $perm){
                            $permissions[$perm->name]=$perm->name;
                        }
                    @endphp
                    @foreach(Illuminate\Support\Facades\Route::getRoutes() as $v)
                        @if($v->getPrefix()=="/admin")
                            @php
                                $rl=explode('.',$v->getName());
                                if(isset($rl[1]))
                                    $routes[$rl[0]][]=array("method"=>$v->methods[0],"function"=>$rl[1]);
                            @endphp
                        @endif
                    @endforeach
                </div>
                <div class="card-body">
                     <form action="{{route('permission.save',encryptor('encrypt',$role->id))}}" method="post">
                @csrf
                <div class="row">
                @forelse($routes as $k=>$r)
                    <div class="col-6 col-sm-3 col-md-2">
                        <input type="checkbox" onchange="checkAll(this)"> {{__($k)}}
                        @if($r)
                            <ul class="list-group">
                                @foreach($r as $name)
                                    @if(in_array($name['method'],$auto_accept))
                                    <li class="list-group-item">
                                        @if(in_array($k.'.'.$name['function'],$permissions))
                                            <input type="checkbox" checked name="permission[]" value="{{$k.'.'.$name['function']}}"> {{__($name['function'])}}
                                        @else
                                        <input type="checkbox" name="permission[]" value="{{$k.'.'.$name['function']}}"> {{__($name['function'])}}
                                        @endif
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @empty

                @endforelse
                </div>
                <div class="row">
                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-primary"> Save</button>
                    </div>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function checkAll(e){
        if($(e).prop('checked')==true)
            $(e).next('.list-group').find('input').attr('checked','checked');
        else
            $(e).next('.list-group').find('input').removeAttr('checked','checked');
    }

</script>
@endpush
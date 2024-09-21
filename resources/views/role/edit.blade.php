@extends('layout.app')

@section('title',trans('Role'))
@section('page',trans('Update'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
             <div class="card-header">
                <h4 class="card-title">Edit Role</h4>
             </div>
                <div class="card-body">
                    <form class="form" method="post" action="{{route('role.update',encryptor('encrypt',$role->id))}}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$role->id)}}">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="Identity">Identity (only Alpha Character)<i class="text-danger">*</i></label>
                                    <input type="text" id="Identity" pattern="[A-Za-z]+" class="form-control" value="{{ old('Identity',$role->identity)}}" name="Identity">
                                    @if($errors->has('Identity'))
                                        <span class="text-danger"> {{ $errors->first('Identity') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input type="text" id="Name" class="form-control" value="{{ old('Name',$role->name)}}" name="Name">
                                    @if($errors->has('Name'))
                                        <span class="text-danger"> {{ $errors->first('Name') }}</span>
                                    @endif
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
</div>
@endsection

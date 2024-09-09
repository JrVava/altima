@extends('layouts.app-layout')

@section('title', 'Edit Role')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Role</h4>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="forms-sample" method="post" action="{{ route('roles.update') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $role->id }}">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Name" name="name" value="{{ old('name', $role->name) }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><strong>Role Type</strong></label>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="permission[]"
                                            class="form-check-input @error('permission') is-invalid @enderror"
                                            value="{{ $permission->id }}" @if (in_array($permission->id, $rolePermissions)) checked @endif>
                                        <label class="form-check-label text-muted">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                            </div>
                        @endforeach
                        @error('permission')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <a href="{{ route('roles') }}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
@endsection

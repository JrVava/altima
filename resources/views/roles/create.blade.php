@extends('layouts.app-layout')

@section('title', 'Create Role')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create New Role</h4>
        <form class="forms-sample" method="post" action="{{ route('roles.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><Strong>Permission</Strong></label>
            </div>
            <div class="form-group">
                <label><strong>Role Type</strong></label>
                <div class="row">
                    @foreach ($roles as $roleItem)
                        <div class="col-md-3">
                            <h5>{{ $roleItem->name }}</h5>
                                @foreach ($permissions as $permission)
                                    @if ($roleItem->hasPermissionTo($permission->name))
                                        <div class="form-check">
                                            <input type="checkbox" 
                                                name="permission[]" 
                                                class="form-check-input @error('permissions') is-invalid @enderror" 
                                                value="{{ $permission->id }}"
                                                >
                                            <label class="form-check-label text-muted">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <a href="{{ route('roles') }}" class="btn btn-light">Cancel</a>
        </form>
    </div>
</div>
@endsection

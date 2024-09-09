@extends('layouts.app-layout')

@section('title', 'Create User')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create New User</h4>
        <form class="forms-sample" method="post" action="{{ route('user.store') }}">
            @csrf
            <div class="row">
                <!-- Name Field -->
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="user_name">User Name</label><span class="required">*</span>
                        <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name"
                            placeholder="User Name" name="user_name" value="{{ old('user_name') }}">
                        @error('user_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Position Code Field -->
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="position_code">Position Code</label><span class="required">*</span>
                        <input type="text" class="form-control @error('position_code') is-invalid @enderror"
                            id="position_code" placeholder="Position Code" name="position_code"
                            value="{{ old('position_code') }}">
                        @error('position_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Emp Code Field -->
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="emp_code">Emp Code</label><span class="required">*</span>
                        <input type="text" class="form-control @error('emp_code') is-invalid @enderror"
                            id="emp_code" placeholder="Emp Code" name="emp_code" value="{{ old('emp_code') }}">
                        @error('emp_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Position Name Field -->
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="position_name">Position Name</label><span class="required">*</span>
                        <input type="text" class="form-control @error('position_name') is-invalid @enderror"
                            id="position_name" placeholder="Position Name" name="position_name"
                            value="{{ old('position_name') }}">
                        @error('position_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- HQ Code Field -->
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="hq_code">HQ Code</label><span class="required">*</span>
                        <input type="text" class="form-control @error('hq_code') is-invalid @enderror" id="hq_code"
                            placeholder="HQ Code" name="hq_code" value="{{ old('hq_code') }}">
                        @error('hq_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- HQ Name Field -->
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="hq_name">HQ Name</label><span class="required">*</span>
                        <input type="text" class="form-control @error('hq_name') is-invalid @enderror" id="hq_name"
                            placeholder="HQ Name" name="hq_name" value="{{ old('hq_name') }}">
                        @error('hq_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Role Field -->
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="role">Role</label><span class="required">*</span>
                        <input type="text" class="form-control @error('role') is-invalid @enderror" id="role"
                            placeholder="Role" name="role" value="{{ old('role') }}">
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="col-md-12 mb-3 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('users') }}" class="btn btn-light">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

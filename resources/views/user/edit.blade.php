@extends('layouts.app-layout')

@section('title', 'Eidt User')

@section('content')
<style>
    .form-control[readonly] {
            background-color: #d3d7da;
            /* Light grey background */
            opacity: 1;
            /* Ensure the text is not faded */
        }
</style>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit User</h4>
        <form class="forms-sample" method="post" action="{{ route('user.update') }}">
            @csrf
            <div class="row">
                <!-- Name Field -->
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="user_name">User Name</label><span class="required">*</span>
                        <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name"
                            placeholder="User Name" name="user_name" value="@if(isset($user->user_name)){{$user->user_name}}@else{{ old('user_name') }}@endif">
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
                            value="@if(isset($user->position_code)){{$user->position_code}}@else{{ old('position_code') }}@endif" readonly>
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
                            id="emp_code" placeholder="Emp Code" name="emp_code" value="@if(isset($user->emp_code)){{$user->emp_code}}@else{{ old('emp_code') }}@endif">
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
                            value="@if(isset($user->position_name)){{$user->position_name}}@else{{old('position_name')}}@endif">
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
                            placeholder="HQ Code" name="hq_code" value="@if(isset($user->hq_code)){{$user->hq_code}}@else{{ old('hq_code') }}@endif">
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
                            placeholder="HQ Name" name="hq_name" value="@if(isset($user->hq_name)){{$user->hq_name}}@else{{ old('hq_name') }}@endif">
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
                            placeholder="Role" name="role" value="@if(isset($user->role)){{$user->role}}@else{{ old('role') }}@endif">
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

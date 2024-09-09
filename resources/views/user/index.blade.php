@extends('layouts.app-layout')

@section('title', 'Users')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Users</h4>
                <div class="d-flex align-items-center">
                    @can('user-create')
                        <a class="btn btn-primary me-2" href="{{ route('user.create') }}"> Create New User</a>
                        <label for="file-upload" class="btn btn-primary d-flex align-items-center justify-content-center"
                            style="width:157px; height:44px;">
                            <i class="mdi mdi-upload me-2"></i> Upload User 
                        </label>
                        <small class="form-text text-muted text-danger ms-2">Max File size: {{ getFileSizeInReadable(ini_get('upload_max_filesize')) }}</small>
                        <form method="post" action="{{ route('upload-user') }}" id="upload-user-form" enctype="multipart/form-data">
                            @csrf
                        <input id="file-upload" type="file" name="users_list" class="d-none upload-user">
                        </form>
                    @endcan
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User Name</th>
                                <th>Position code</th>
                                <th>Emp Code</th>
                                <th>Position Name</th>
                                <th>HQ Code</th>
                                <th>HQ Name</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>

                                    <td> {{ ++$key }}</td>
                                    <td>{{ $user->user_name }}</td>
                                    <td>
                                        {{ $user->position_code }}
                                    </td>
                                    <td>
                                        {{ $user->emp_code }}
                                    </td>
                                    <td>
                                        {{ $user->position_name }}
                                    </td>
                                    <td>
                                        {{ $user->hq_code }}
                                    </td>
                                    <td>
                                        {{ $user->hq_name }}
                                    </td>
                                    <td>
                                        {{ $user->role }}
                                    </td>

                                    <td>
                                        <a href="{{ route('user.edit',['position_code'=>$user->position_code]) }}" title="Edit"><i class="mdi mdi-lead-pencil"></i></a>
                                        <a href="{{ route('user.delete', ['position_code' => $user->position_code]) }}" title="Delete">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
            {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
    @section('script')
    <script>
        $(document).ready(function(){
            $('.upload-user').on('change',function(){
                $('#upload-user-form').submit()
            })
        })
    </script>
    @endsection
@endsection

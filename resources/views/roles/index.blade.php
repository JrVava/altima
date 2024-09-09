@extends('layouts.app-layout')

@section('title', 'Roles')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Roles</h4>
                @can('role-create')
                    <a class="btn btn-primary me-2" href="{{ route('roles.create') }}"> Create New Role</a>
                @endcan

                </p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('role-edit')
                                            <a href="{{ route('roles.edit', $role->id) }}" title="Edit">
                                                <i class="mdi mdi-lead-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('role-delete')
                                            <a href="{{ route('roles.destroy', ['id' => $role->id]) }}" title="Delete">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

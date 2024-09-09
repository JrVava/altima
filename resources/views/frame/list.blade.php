@extends('layouts.app-layout')

@section('title', 'Frames')

@section('content')
<style>
    .frame-image{
        width: 100px !important;
        height: 150px !important;
        border-radius: 0px !important; 
    }
</style>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Frame</h4>
                @if($frameCount < 3)
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary me-2" href="{{ route('frame.create') }}"> Create New Frame</a>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Frame</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($frames as $key => $frame)
                            <tr>
                                <td>
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    <img src="{{ asset('frame/'.$frame->frame) }}" class="frame-image" width="300" height="300">
                                </td>
                                <td>
                                    <a href="{{ route('frame.edit',['id'=>$frame->id]) }}" title="Edit"><i class="mdi mdi-lead-pencil"></i></a>
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

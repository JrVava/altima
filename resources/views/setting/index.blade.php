@extends('layouts.app-layout')

@section('title', 'Add Frame')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Profile</h4>
            <form class="forms-sample mt-3" method="post" action="{{ route('frame.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Profile Image -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group text-center">
                            <input type="file" class="d-none" id="profile" name="profile" accept="image/*" onchange="previewImage(event)">
                            <img id="profilePreview" src="https://via.placeholder.com/150" alt="Image Preview" class="rounded-circle" width="150" height="150" onclick="document.getElementById('profile').click();">
                            <br>
                            <small class="form-text text-muted text-danger">Max File size:
                                {{ getFileSizeInReadable(ini_get('upload_max_filesize')) }}</small>
                            @error('profile')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@section('script')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('profilePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
@endsection

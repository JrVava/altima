@extends('layouts.app-layout')

@section('title', 'Edit Frame')

@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Frame</h4>
            <span class="text-danger mb-5">Default Top is 80 and left is 10</span>
            <form class="forms-sample mt-3" method="post" action="{{ route('frame.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $frame->id }}">
                <div class="row">
                    <!-- Name Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="frame">Frame</label><span class="required">*</span>
                            <input type="file" class="form-control frame @error('frame') is-invalid @enderror"
                                id="frame" name="frame">
                            <small class="form-text text-muted text-danger">Max File size:
                                {{ getFileSizeInReadable(ini_get('upload_max_filesize')) }}</small>
                            @error('frame')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3 d-none preview-div">
                        <div class="form-group">
                            <label for="frame">Preview Frame</label>
                            <br>
                            <img src="" alt="preview" id="preview"  width="500" height="800">
                            <input type="hidden" name="old_frame" value="{{ $frame->frame }}">
                        </div>
                    </div>

                    <!-- Position Code Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="left">Left</label>
                            <input type="text" class="form-control @error('left') is-invalid @enderror"
                                id="left" placeholder="Position Code" name="left"
                                value="{{ $frame->left }}">
                            @error('left')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Emp Code Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="top">Top</label>
                            <input type="text" class="form-control @error('top') is-invalid @enderror"
                                id="top" placeholder="Emp Code" name="top" value="{{ $frame->top }}">
                            @error('top')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit and Cancel Buttons -->
                    <div class="col-md-12 mb-3 text-end">
                        <!-- Loading Message -->
                        <div id="loading-message" class="text-primary mb-2 d-none">Please wait, preview is loading...</div>
                        
                        <button type="button" class="btn btn-warning preview">Preview</button>
                        <button type="submit" class="btn btn-primary save">Save</button>
                        <a href="{{ route('users') }}" class="btn btn-light cancel">Cancel</a>
                    </div>
                </div>
            </form>
            <img src="" alt="preview" id="preview" class="d-none" width="500" height="800">
        </div>
    </div>

@section('script')
    <script>
        $(document).ready(function() {
            $('.preview').on('click', function() {
                var formData = new FormData();
                var file = $('#frame')[0].files[0];
                formData.append('frame', file);
                formData.append('left', $('#left').val());
                formData.append('top', $('#top').val());
                formData.append('_token', "{{ csrf_token() }}");

                // Disable buttons and show loading message
                $('.save').prop('disabled', true);
                $('.cancel').prop('disabled', true);
                $('#loading-message').removeClass('d-none');
                $('#loading-overlay').removeClass('d-none'); 
                $.ajax({
                    url: "{{ route('frame.preview') }}",
                    type: "POST",
                    data: formData,
                    processData: false, 
                    contentType: false, 
                    success: function(res) {
                        // Enable buttons and hide loading message
                        $('.save').prop('disabled', false);
                        $('.cancel').prop('disabled', false);
                        $('#loading-message').addClass('d-none');
                        $('#loading-overlay').addClass('d-none'); 
                        // Display preview
                        $('.preview-div').removeClass('d-none');
                        $('#preview').attr('src', res.image);
                    }
                });
            });
        });
    </script>
@endsection
@endsection

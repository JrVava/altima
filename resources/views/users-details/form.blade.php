@php
    $user = Auth::user();
@endphp
@extends('layouts.app-layout')

@section('title', $user->user_name)

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
    <!-- Loading Overlay -->


    <style>
        body {
            position: relative;
            background-image: url({{ asset('assets/img/1.png') }});
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            color: #000;
            animation: backgroundPulse 3s infinite;
            /* Optional: set text color for contrast */
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.5);
            /* White overlay with 50% opacity */
            z-index: -1;
            /* Ensure the overlay is behind the content */
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
        }

        .form-control {
            border: 2px solid #01a4d7;
            border-radius: 10px;
            padding: 12px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #01a4d7;
            outline: none;
            box-shadow: 0 0 5px #01a4d7;
        }

        .selectable-img {
            cursor: pointer;
            border: 2px solid transparent;
            margin-right: 10px;
        }

        .selectable-img.selected {
            border: 4px solid #01a4d7;
        }

        .modal-lg {
            max-width: 90%;
        }

        .selectable-img {
            max-width: 30%;
            flex-grow: 1;
            margin: 0 5px;
        }

        .modal-body {
            max-height: 80vh;
            overflow-y: auto;
        }

        .custom-ok-button {
            background-color: #01a4d7 !important;
            color: #ffffff !important;
            border-color: #01a4d7 !important;
        }

        button.swal2-confirm.custom-ok-button.swal2-styled {
            background-color: #01a4d7 !important;
            color: #ffffff !important;
            border-color: #01a4d7 !important;
        }

        .form-control[readonly] {
            background-color: #d3d7da;
            /* Light grey background */
            opacity: 1;
            /* Ensure the text is not faded */
        }
    </style>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Welcome, {{ $user->user_name }} </h4>
            <form class="forms-sample" method="post" action="{{ route('update.user') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="row">
                    <!-- Name Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="user_name">User Name</label><span class="required">*</span>
                            <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                                id="user_name" placeholder="User Name" name="user_name"
                                value="{{ isset($user) ? $user->user_name : old('user_name') }}" readonly>
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
                                value="{{ isset($user) ? $user->position_code : old('position_code') }}" readonly>
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
                                id="emp_code" placeholder="Emp Code" name="emp_code"
                                value="{{ isset($user) ? $user->emp_code : old('emp_code') }}" readonly>
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
                                value="{{ isset($user) ? $user->position_name : old('position_name') }}" readonly>
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
                                placeholder="HQ Code" name="hq_code"
                                value="{{ isset($user) ? $user->hq_code : old('hq_code') }}" readonly>
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
                                placeholder="HQ Name" name="hq_name"
                                value="{{ isset($user) ? $user->hq_name : old('hq_name') }}" readonly>
                            @error('hq_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Role Field -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="doctor_name">Doctor Name</label><span class="required">*</span>
                            <input type="text" class="form-control @error('doctor_name') is-invalid @enderror"
                                id="doctor_name" placeholder="Doctor Name" name="doctor_name"
                                value="{{ isset($user->userDetail) ? $user->userDetail->doctor_name : old('doctor_name') }}">
                            @error('doctor_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="speciality">Speciality</label><span class="required">*</span>
                            <input type="text" class="form-control @error('speciality') is-invalid @enderror"
                                id="speciality" placeholder="Speciality Name" name="speciality"
                                value="{{ isset($user->userDetail) ? $user->userDetail->speciality : old('speciality') }}">
                            @error('speciality')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="place">Place</label><span class="required">*</span>
                            <input type="text" class="form-control @error('place') is-invalid @enderror"
                                id="place" placeholder="Place" name="place"
                                value="{{ isset($user->userDetail) ? $user->userDetail->place : old('place') }}">
                            @error('speciality')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="poster">Poster</label><span class="required">*</span>
                            <input type="file" class="form-control poster @error('poster') is-invalid @enderror"
                                id="poster" name="poster">
                            <small class="form-text text-muted text-danger">Max File size:
                                {{ getFileSizeInReadable(ini_get('upload_max_filesize')) }}</small>

                            <div id="loading-message" class="text-primary mb-2 d-none">
                                <strong>Please wait, preview is loading...</strong>
                            </div>
                            @error('poster')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="selected_frame" id="selected_frame">
                    <!-- Submit and Cancel Buttons -->
                    <div class="col-md-12 mb-3 text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        @if (isset($user->userDetail))
                            <a href="{{ route('download', ['user_id' => $user->id]) }}" class="btn btn-light">Download
                                Poster</a>
                        @endif
                        <a class="btn btn-danger" style="color:white" href="{{ route('logout') }}">Logout </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('users-details.modal')

@section('script')
    <script>
        $(document).ready(function() {
            @if (session('success'))
                Swal.fire({
                    text: "{{ session('success') }}", // Display the success message
                    showClass: {
                        popup: `
                        animate__animated
                        animate__fadeInUp
                        animate__faster
                        `
                    },
                    hideClass: {
                        popup: `
                        animate__animated
                        animate__fadeOutDown
                        animate__faster
                    `
                    },
                    customClass: {
                        confirmButton: 'custom-ok-button'
                    }
                });
            @endif


            $('.poster').on('change', function() {
                $('.validation-error').remove();

                // Get the values of the fields
                var doctorName = $('#doctor_name').val();
                var speciality = $('#speciality').val();
                var place = $('#place').val();
                var isValid = true;

                // Validate each field and display an error message if empty
                if (!doctorName) {
                    $('#doctor_name').after(
                        '<span class="text-danger validation-error">Doctor Name is required.</span>');
                    isValid = false;
                }

                if (!speciality) {
                    $('#speciality').after(
                        '<span class="text-danger validation-error">Speciality is required.</span>');
                    isValid = false;
                }

                if (!place) {
                    $('#place').after(
                        '<span class="text-danger validation-error">Place is required.</span>');
                    isValid = false;
                }

                // Stop execution if validation fails
                if (!isValid) {
                    return;
                }

                var formData = new FormData();
                var file = $('#poster')[0].files[0];

                // Append the file to the FormData object
                formData.append('poster', file);
                formData.append('doctor_name', $('#doctor_name').val());
                formData.append('speciality', $('#speciality').val());
                formData.append('place', $('#place').val());
                formData.append('_token', "{{ csrf_token() }}"); // Append CSRF token to the FormData
                $('#loading-message').removeClass('d-none');
                $('#loading-overlay').removeClass('d-none');
                $.ajax({
                    url: "{{ route('poster.preview') }}",
                    type: "POST",
                    data: formData,
                    processData: false, // Prevent jQuery from automatically processing the data
                    contentType: false, // Prevent jQuery from setting the Content-Type header
                    success: function(res) {
                        $('#loading-message').addClass('d-none');
                        $.each(res.frameData, function(index, imageUrl) {
                            $('#poster' + (index + 1)).attr('src', imageUrl.base64Image)
                                .attr('data-id', imageUrl.id);
                        });
                        // You can show the modal here if needed
                        $('#myModal').modal('show');
                        $('#loading-overlay').addClass('d-none');
                    }
                });
            });
            $('.selectable-img').on('click', function() {
                $('.selectable-img').removeClass('selected'); // Deselect all images
                $(this).addClass('selected'); // Select the clicked image
                var selectedImageId = $(this).data('id'); // Get the selected image's data-id value
                $('#selected_frame').val(selectedImageId);
            });
            $('#myModal').on('hide.bs.modal', function() {});
        });
    </script>
@endsection
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .bg-image-vertical {
            position: relative;
            overflow: hidden;
            background-repeat: no-repeat;
            background-position: left center;
            background-size: cover;
            height: 100vh;
        }

        .h-custom-2 {
            height: calc(100% - 80px);
        }

        .form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100vh;
            padding: 0 30px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container form {
            width: 100%;
        }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6 px-0 d-none d-lg-block bg-image-vertical"
                    style="background-image: url({{ asset('assets/img/1.png') }});">
                </div>
                <div class="col-lg-6 col-md-8 col-12 text-black">
                    <div class="form-container">
                        <div class="logo">
                            <img src="{{ asset('assets/img/logo.png') }}" width="400" class="img-fluid">
                        </div>

                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <!-- <h3 class="fw-normal" style="letter-spacing: 1px;">Log in</h3> -->

                            <div class="form-outline mb-4">
                                <label class="form-label" for="emp_code">User Name</label>
                                <input type="text" id="emp_code" name="emp_code" class="form-control form-control-lg" />
                                @if ($errors->has('emp_code'))
                                      <span class="text-danger">{{ $errors->first('emp_code') }}</span>
                                  @endif
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                            </div>

                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit" style="width: 100%;">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

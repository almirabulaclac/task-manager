@extends('layouts.app')

@section('title', 'Login | Flowboard')

@section('content')

{{--@if(session('success'))
    <script>
        alert("{!! session('success') !!}");
    </script>
@endif--}}

@if(session('success'))
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! session('success') !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Show Modal Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    </script>
@endif


@if ($errors->has('email_address'))
    <script>
        alert("{{ $errors->first('email_address') }}");
    </script>
@endif

@if(session('status'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050">
            <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('status') }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var successToast = new bootstrap.Toast(document.getElementById("successToast"));
                successToast.show();
            });
        </script>
    @endif

<div class="row d-flex justify-content-between align-items-center vh-100">
    <!-- Image on the left -->
    <div class="col-md-6 col-lg-6 col-xl-6">
        <img src="{{ asset('images/illust-cropped.svg') }}" alt="" class="img-fluid">
        <p class="text-center">
            Start your journey with us. Submit your application, upload your documents, and stay updated — all in one place.
        </p>
    </div>

    <!-- Login Form on the right -->
    <div class="col-12 col-md-6 col-lg-6 col-xl-5">
        <div class="card shadow-lg p-4" 
            style="border-radius: 1rem; transition: 0.3s; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);">
            <div class="card-body pb-0 text-center">
                <h3 class="mb-5 sour-gummy">ACCOUNT LOGIN</h3>
                <form action="{{-- route('applicant.login') --}}" method="POST">
                    @csrf

                    <!-- Email Input with Floating Label -->
                    <div class="form-floating mb-4">
                        <input type="email" id="email_address" name="email_address" class="form-control form-control-lg" placeholder="Email" style="font-size: 15px;">
                        <label for="email_address">Email</label>
                    </div>

                    <!-- Password Input with Floating Label -->
                    <div class="form-floating mb-2">
                        <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" style="font-size: 15px;">
                        <label for="password">Password</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="rememberPW"/>
                            <label class="form-check-label" for="rememberPW"><small> Remember me </small></label>
                        </div>
                        <a href="{{-- route('applicant.forgot_password') --}}" class="ms-auto" style="text-decoration: none;"><small>Forgot password?</small></a>
                      </div>

                    <button class="form-control btn btn-primary btn-lg btn-block my-btn" type="submit" name="login" id="login" style="background-color: #00246B;">
                        <b>LOGIN</b>
                    </button>
                </form>
                <br>

                <div class="text-center">
                    <p>Start your journey— <a href="{{-- route('register.form') --}}" style="text-decoration: none;">Register now!</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

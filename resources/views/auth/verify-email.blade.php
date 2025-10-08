<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Email Verification - Permission</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ url('') }}/assets/img/favicon.png" rel="icon">
    <link href="{{ url('') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ url('') }}/assets/css/style.css" rel="stylesheet">

</head>

<body>

    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <!-- Logo Section -->
                            <div class="d-flex justify-content-center py-4">
                                <a href="{{ route('login') }}" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ url('') }}/assets/img/logo.png" alt="Permission Logo">
                                    <span class="d-none d-lg-block">Permission</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">📧 Verify Your Email</h5>
                                        <p class="text-center small">Enter the verification code sent to your email</p>
                                    </div>

                                    @include('message')

                                    <div class="text-center mb-3">
                                        <p class="mb-1">We've sent a 6-digit verification code to:</p>
                                        <p class="fw-bold text-primary">{{ $email }}</p>
                                    </div>

                                    <form class="row g-3" method="POST" action="{{ route('email.verify.store') }}">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $email }}">

                                        <div class="col-12">
                                            <label for="otp_code" class="form-label">Verification Code</label>
                                            <input type="text" class="form-control text-center" name="otp_code" id="otp_code"
                                                maxlength="6" placeholder="000000"
                                                style="font-size: 24px; letter-spacing: 5px; font-weight: bold;"
                                                required autocomplete="off">
                                            @error('otp_code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">
                                                <i class="bi bi-check-circle"></i> Verify Email
                                            </button>
                                        </div>
                                    </form>

                                    <hr>

                                    <div class="text-center">
                                        <p class="text-muted small mb-2">Didn't receive the code?</p>
                                        <form method="POST" action="{{ route('email.verify.resend') }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="email" value="{{ $email }}">
                                            <button type="submit" class="btn btn-link p-0">
                                                <i class="bi bi-arrow-clockwise"></i> Resend Code
                                            </button>
                                        </form>
                                    </div>

                                    <div class="text-center mt-3">
                                        <p class="small">
                                            <a href="{{ route('login') }}" class="text-decoration-none">
                                                <i class="bi bi-arrow-left"></i> Back to Login
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ url('') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ url('') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/assets/vendor/chart.js/chart.min.js"></script>
    <script src="{{ url('') }}/assets/vendor/echarts/echarts.min.js"></script>
    <script src="{{ url('') }}/assets/vendor/quill/quill.min.js"></script>
    <script src="{{ url('') }}/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="{{ url('') }}/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{ url('') }}/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ url('') }}/assets/js/main.js"></script>

    <!-- Auto-focus and format OTP input -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const otpInput = document.getElementById('otp_code');
            if (otpInput) {
                otpInput.focus();

                // Only allow numbers
                otpInput.addEventListener('input', function(e) {
                    e.target.value = e.target.value.replace(/[^0-9]/g, '');
                });
            }
        });
    </script>

</body>

</html>

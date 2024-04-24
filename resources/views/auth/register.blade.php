<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title',"NhaKhoaLaravel")</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('/img/favicon.png')}}" rel="icon">
  <link href="{{asset('/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="{{asset('/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                    <img src="assets/img/logo.png" alt="">
                    <span class="d-none d-lg-block">Trang Đăng Ký</span>
                </a>
            </div><!-- End Logo -->

            <div class="card mb-3">
                <div class="card-body">
                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Tạo Tài Khoản</h5>
                        <p class="text-center small">Nhập Thông Tin Cá Nhân Của Bạn Để Tạo Tài Khoản</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-12">
                            <label for="name" class="form-label">{{ __('Tên') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="invalid-feedback">Vui Lòng Nhập Tên!</div>
                        </div>
                        <div class="col-12">
                            <label for="yourUsername" class="form-label">Tên Tài Khoản</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="invalid-feedback">Vui Lòng Nhập Tên Tài Khoản.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="yourPassword" class="form-label">Mật Khẩu</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="invalid-feedback">Vui Lòng Nhập Mật Khẩu Của Bạn!</div>
                        </div>

                        <div class="col-12">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ __('Đăng Ký') }}</button>
                        </div>
                        <div class="col-12">
                            <p class="small mb-0">Bạn Đã Có Tài Khoản Rồi? <a href="{{route('login')}}">Đăng Nhập</a></p>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{asset('/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/chart.js/chart.umd.js')}}"></script>
<script src="{{asset('/echarts/echarts.min.js')}}"></script>
<script src="{{asset('/quill/quill.min.js')}}"></script>
<script src="{{asset('/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{asset('/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('/php-email-form/validate.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{asset('js/main.js')}}"></script>

</body>

</html>
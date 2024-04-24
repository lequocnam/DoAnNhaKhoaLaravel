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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">
  <!-- Template Main CSS File -->
  <link href="{{asset('/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    #button-add{
    float: right;
    }
    </style>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('admin.home.index')}}" class="logo d-flex align-items-center">
        <img src="{{asset('/img/logo.png')}}" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ '/hinhanh/'.$adminAvatar }}"alt="Avatar">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{$adminName}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{$adminName}}</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>          
            <li id="logout-btn">
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Thoát ra</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
  <script>
    document.getElementById("logout-btn").addEventListener("click", function(event) {
      event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a
  
      // Gửi yêu cầu đăng xuất
      fetch("{{ route('logout') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        redirect: "follow"
      })
      .then(response => {
        // Chuyển hướng đến trang đăng nhập sau khi đăng xuất thành công
        window.location.href = "{{ route('login') }}";
      })
      .catch(error => console.error("Error logging out:", error));
    });
  </script>
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{route('admin.home.index')}}">
          <i class="bi bi-grid"></i>
          <span>Bảng điều khiển</span>
        </a>
      </li><!-- End Bảng điều khiển Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Danh sách</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
<a href="{{route('admin.benhnhan.index')}}">
  <i class="bi bi-circle"></i><span>Danh Sách bệnh nhân</span></a>          
          </li>
          <li>
            <a href="{{route('admin.hoadon.index')}}">
              <i class="bi bi-circle"></i><span>Danh Sách hóa đơn</span>
            </a>
          </li>

          <li>
            <a href="{{route('admin.lichhen.index')}}">
              <i class="bi bi-circle"></i><span>Danh Sách lịch hẹn</span>
            </a>
          </li>

          <li>
            <a href="{{route('admin.nhanvien.index')}}">
              <i class="bi bi-circle"></i><span>Danh Sách nhân viên</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.dichvusanpham.index')}}">
              <i class="bi bi-circle"></i><span>Danh Sách Dịch Vụ / Sản Phẩm</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.phongkham.index')}}">
              <i class="bi bi-circle"></i><span>Danh Sách phòng khám</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
@yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by Namlq22</a>
    </div>
  </footer><!-- End Footer -->

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
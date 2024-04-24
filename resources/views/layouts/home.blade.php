<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title',"NhaKhoaLaravel")</title>
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
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{asset('/img/logo.png')}}" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        @guest
        <div class="auth-links">
          <a class="nav-link active" href="{{ route('login') }}">  Đăng Nhập</a>                      
        </div>
        @guest
        <div class="auth-links">
          <a class="nav-link active" href="{{ route('register') }}">  Đăng Ký</a>                    
        </div>
        @else
        <form id="logout" action="{{ route('logout') }}" method="post">
          <a role="button" class="nav-link-active" onclick="document.getElementById('logout').submit()">Logout</a>
          @csrf
        </form>
        @endguest
        @else
        <form id="logout" action="{{ route('logout') }}" method="post">
          <a role="button" class="nav-link-active" onclick="document.getElementById('logout').submit()">Logout</a>
          @csrf
        </form>
        @endguest
      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Danh sách</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
<a href="{{route('employee.benhnhan.index')}}">
  <i class="bi bi-circle"></i><span>Danh Sách bệnh nhân</span></a>          
          </li>
          <li>
            <a href="{{route('employee.hoadon.index')}}">
              <i class="bi bi-circle"></i><span>Danh Sách hóa đơn</span>
            </a>
          </li>
          <li>
            <a href="{{route('employee.lichhen.index')}}">
              <i class="bi bi-circle"></i><span>Danh Sách lịch hẹn</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->
  
      <li class="nav-heading">Trang Làm Việc</li>

      <!--End Quản lý lịch làm việc Page Nav-->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('employee.thembenhnhan.index')}}">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Quản lý bệnh nhân trực tiếp</span>
        </a>
      </li>
       <!--End Quản lý bệnh nhân trực tiếp Page Nav-->
<li class="nav-item">
        <a class="nav-link collapsed" href="{{route('employee.tuvanvakhambenh.index')}}">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Tư vấn và khám chữa bệnh</span>
        </a>
      </li>
       <!--End Tư vấn và khám chữa bệnh Page Nav-->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('employee.xulyhoadon.index')}}">
          <i class="bi bi-pencil"></i>
          <span>Xử lý hóa đơn</span>
        </a>
      </li>
      <!--End Xử lý hóa đơn Page Nav-->   
      </li><!-- End Đăng nhập Page Nav -->
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
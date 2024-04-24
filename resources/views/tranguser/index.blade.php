<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Nha Khoa Laravel</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="asset/img/favicon.png" rel="icon">
  <link href="asset/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('/tranguser/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{asset('/tranguser/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('/tranguser/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('/tranguser/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('/tranguser/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('/tranguser/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('/tranguser/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('/tranguser/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="{{asset('/tranguser/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>


  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
  
      <h1 class="logo me-auto">Nha Khoa</h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="asset/img/logo.png" alt="" class="img-fluid"></a>-->
  
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li>Trang Chủ</li>
          <li>Dịch Vụ</li>
          <li>
            @guest
            <div class="auth-links">
              <a href="{{ route('login') }}">  Đăng Nhập (Dành Cho Nhân Viên)</a>                    
            </div>
            @else
            <form id="logout" action="{{ route('logout') }}" method="post">
              <a role="button" class="nav-link-active" onclick="document.getElementById('logout').submit()">Logout</a>
              @csrf
            </form>
            @endguest</li>
        </ul>
  
      </nav><!-- .navbar -->
  
      
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container">
      <h1>Chào Mừng Đến Với Phòng Khám Nha Khoa</h1>
    </div>
  </section><!-- End Hero -->
  <style>
    .icon-box {
      margin-bottom: 20px; /* Điều chỉnh khoảng cách giữa các dịch vụ */
      padding: 20px; /* Thêm padding để tăng khoảng cách nếu cần thiết */
    }
  </style>
  <?php
  // Kết nối vào cơ sở dữ liệu
  $servername = env('DB_HOST', '127.0.0.1');
  $username = env('DB_USERNAME', 'root');
  $password = env('DB_PASSWORD', '');
  $dbname = env('DB_DATABASE', 'nhakhoalaravel');
  $dbport = env('DB_PORT','4306');
  $conn = new mysqli($servername, $username, $password, $dbname, $dbport);
  
  // Kiểm tra kết nối
  if ($conn->connect_error) {
      die("Kết nối thất bại: " . $conn->connect_error);
  }
  
  // Truy vấn SQL để lấy số lớn nhất
  $sql = "SELECT malichhen FROM lichhens WHERE malichhen REGEXP '^LH[0-9]+$' ORDER BY CAST(SUBSTRING(malichhen, 3) AS UNSIGNED) DESC LIMIT 1";
  $result = $conn->query($sql);
  
  // Khởi tạo biến $lastId với giá trị mặc định
  $lastId = "LH0001";
  
  // Kiểm tra kết quả truy vấn
  if ($result && $result->num_rows > 0) {
      // Lấy giá trị ID cuối cùng
      $row = $result->fetch_assoc();
      $lastId = $row["malichhen"];
      // Tách số từ chuỗi và tăng giá trị
      $numbers = (int)substr($lastId, 2);
      $numbers++; // Tăng giá trị số lên 1 đơn vị
      // Định dạng lại số với 4 chữ số
      $lastId = 'LH' . sprintf("%04d", $numbers);
  }
  
  // Đóng kết nối
  $conn->close();
  ?>

@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
  <main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>Tại Sao Chọn Nha Khoa Của Chúng Tôi</h3>
              <p>
                Nha khoa của chúng tôi là một trong những nha khoa đáp ứng các tiêu chí hàng đầu về lĩnh vực y tế, kèm theo đó là những bác sĩ, dụng cụ y khoa
                chất lượng, đặt biệt là giá tiền phù hợp với mọi người
              </p>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bi bi-person-circle"></i>
                    <h4>Về Bác Sĩ</h4>
                    <p>Bác sĩ của nha khoa chúng tôi được đào tạo chuyên môn, có nhiều kinh nghiệm trong lĩnh vực này</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-cube-alt"></i>
                    <h4>Về Dụng Cụ Y Khoa</h4>
                    <p>Chúng tôi luôn quan tâm đến chất lượng của các dụng cụ y khoa vì nó rất quan trọng trong lĩnh vực này</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bi bi-currency-dollar"></i>
                    <h4>Về Giá Tiền</h4>
                    <p>Chúng tôi luôn cố gắng đưa ra mức giá hợp lý để giúp cho mọi người có thể sử dụng các dịch vụ của chúng tôi thoải mái</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">
        <div class="section-title">
          <h2>Dịch Vụ và Giá Tiền</h2>
        </div>
        <div class="row">
          @foreach ($viewData["dichvusanphams"] as $dichvu)
            <div class="col-lg-6 col-md-6">
              <div class="icon-box mb-3">
                <div class="icon"><img src="{{ '/hinhanh/'.$dichvu->anh }}" alt="img" class="card-img-top img-card"></div>
                <h4>{{ $dichvu->ten }}</h4>
                <p>{{ number_format($dichvu->dongia).' '.'VNĐ' }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section><!-- End Services Section -->
    <section id="appointment" class="appointment section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Tạo Lịch Hẹn</h2>
          <p>Sau Khi Tạo Lịch Hẹn Nhân Viên Sẽ Liên Hệ Dựa Trên Thông Tin Mà Bạn Đã Gửi Để Xác Nhận Các Yêu Cầu Và Sắp Xếp Lịch Cho Bạn</p>
        </div>

        <form method="POST" action="{{route('tranguser.data2')}}">
          @csrf
          <div class="row">
              <input name="malichhen" required type="hidden"  value="{{ $lastId }}" class="form-control">
              <br>
              <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Khách Hàng:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                      <input name="ten" type="text" required class="form-control">
                  </div>
              </div>
              <br>
              <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Giới Tính:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                    <input type="radio" name="gioitinh" value="Nam" checked>Nam
                    <input type="radio" name="gioitinh" value="Nữ">Nữ
                  </div>
              </div>
              <br>
              <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Số Điện Thoại:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                      <input name="sodienthoai" required type="text" class="form-control">
                  </div>
              </div>       
              <br>
              <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Địa Chỉ:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                      <input name="diachi" required type="text" class="form-control">
                  </div>
              </div>  
              <br>
              <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nội Dung Khám:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                      <input name="noidungkham" required type="text" class="form-control">
                  </div>
              </div> 
              <br>                                        
              <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ngày Dự Kiến:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                    <input name="ngaydukien" id="ngaydukien" required type="date" class="form-control">
                  </div>
              </div> 
          </div>   
          <button type="submit" class="btn btn-primary">Lưu</button>
      </form>
      </div>
    </section><!-- End Appointment Section -->
    <script>
      window.onload = function() {
          var today = new Date().toISOString().split('T')[0];
          document.getElementById("ngaydukien").setAttribute('min', today);
          document.getElementById("ngaydukien").value = today;
      };
  </script>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('/tranguser/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('/tranguser/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('/tranguser/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('/tranguser/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('/tranguser/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('/tranguser/js/main.js')}}"></script>

</body>

</html>
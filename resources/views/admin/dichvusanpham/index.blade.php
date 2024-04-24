@extends('layouts.admin')
@section('title', "Trang Danh Sách Dịch Vụ Sản Phẩm")
@section('content')
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
$sql = "SELECT madichvusanpham FROM dichvusanphams WHERE madichvusanpham REGEXP '^DVSP[0-9]+$' ORDER BY CAST(SUBSTRING(madichvusanpham, 3) AS UNSIGNED) DESC LIMIT 1";
$result = $conn->query($sql);

// Khởi tạo biến $lastId với giá trị mặc định
$lastId = "DVSP0001";

// Kiểm tra kết quả truy vấn
if ($result && $result->num_rows > 0) {
    // Lấy giá trị ID cuối cùng
    $row = $result->fetch_assoc();
    $lastId = $row["madichvusanpham"];
    // Tách số từ chuỗi và tăng giá trị
    $numbers = (int)substr($lastId, 2);
    $numbers++; // Tăng giá trị số lên 1 đơn vị
    // Định dạng lại số với 4 chữ số
    $lastId = 'DVSP' . sprintf("%04d", $numbers);
}

// Đóng kết nối
$conn->close();
?>
@if(session('success'))
<div class="alert alert-success" id="success-alert">
    {{ session('success') }}
</div>

<script>
    setTimeout(function() {
        $('#success-alert').fadeOut('fast');
    }, 5000); // 5000 milliseconds = 5 seconds
</script>
@endif
  <div class="pagetitle">
   
    <h1>Danh Sách Dịch Vụ Sản Phẩm</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home.index')}}">Home</a></li>
        <li class="breadcrumb-item active">Danh Sách Dịch Vụ Sản Phẩm</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Bảng Dịch Vụ Sản Phẩm</h5>
    
<button class="btn btn-primary" id="button-add" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">Thêm Dịch Vụ Sản Phẩm mới</button>
<form method="POST" action="{{ route('admin.dichvusanpham.data') }}" enctype="multipart/form-data">
  @csrf
  <div class="modal fade" id="ExtralargeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm Dịch Vụ Sản Phẩm</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Mã Dịch Vụ Sản Phẩm:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
            <input name="madichvusanpham" readonly required type="text" value="{{ old('madichvusanpham')}} <?php echo $lastId ?>"
            class="form-control">
            </div>        
            </div>
        <br>
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">File Ảnh:</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
          <input name="anh" required type="file" value="{{ old('anh')}}"
          class="form-control">
          </div>        
          </div>
      <br>
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Dịch Vụ Sản Phẩm:</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
          <input name="ten" required type="text" value="{{ old('ten') }}"
          class="form-control">
          </div>
          </div>
          <br>
              <div class="mb-3 row">
                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Đơn Giá:</label>
                <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="dongia" required type="number" value="{{ old('dongia') }}"
                class="form-control">
                </div>
                </div>       
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bỏ qua</button>
          <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
      </div>
    </div>
    </div>
    </div>
  </div>
  </form>




    <!-- Table with hoverable rows -->
   <br>
   <br>
    <table class="table datatable">
      <thead>
        <tr>
          <th scope="col">Số thứ tự</th>
          <th scope="col">Mã Dịch Vụ Sản Phẩm</th>
          <th scope="col">Ảnh</th>
          <th scope="col">Tên Dịch Vụ Sản Phẩm</th>
          <th scope="col">Đơn Giá</th>
          <th scope="col">Chỉnh sửa</th>
        </tr>
      </thead>
      <tbody>
        @php
            $counter = 0;
        @endphp
        @if(isset($viewData['dichvusanphams']))
        @foreach ($viewData['dichvusanphams'] as $dichvusanpham)
        <tr>
          <th scope="row">{{ $counter + 1 }}</th>
          <td>{{$dichvusanpham->getmadichvusanpham()}}</td>
          <td><img src="{{ '/hinhanh/'.$dichvusanpham->anh }}" style="width: 70px; height:70px;" alt="img" /></td>
          <td>{{$dichvusanpham->getten()}}</td>
          <td>{{number_format($dichvusanpham->getdongia())}}</td>
          <td>
            <div class="d-flex justify-content-between">
            <button  data-bs-toggle="modal" data-bs-target="#edit{{ $dichvusanpham->id }}" class="btn btn-primary"><i class="bi-pencil"></i></button>
            
            <button  data-bs-toggle="modal" data-bs-target="#delete{{ $dichvusanpham->id }}" class="btn btn-danger"><i class="bi-trash"></i></button>

            </div>
           
            <form method="POST" action="{{ route('admin.dichvusanpham.update',['id' => $dichvusanpham->getid()]) }}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="modal fade" id="edit{{ $dichvusanpham->id }}" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Hồ sơ Dịch Vụ Sản Phẩm</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="mb-3 row">
                    <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Mã Dịch Vụ Sản Phẩm:</label>
                    <div class="col-lg-10 col-md-6 col-sm-12">
                    <input name="madichvusanpham" type="text"  value="{{$dichvusanpham->getmadichvusanpham()}}"
                    class="form-control">
                    </div>        
                    </div>
                <br>
                <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ảnh:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                      <input name="anh" type="file" class="form-control" id="inputImage">
                      <img src="{{ '/hinhanh/'.$dichvusanpham->anh }}" style="width: 70px; height:70px;" alt="img" />
                  </div>        
              </div>
              <br>
                <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Dịch Vụ Sản Phẩm:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                  <input name="ten" type="text"  value="{{$dichvusanpham->getten()}}"
                  class="form-control">
                  </div>
                  </div>
                      <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Đơn Giá:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                        <input name="dongia" type="number" value="{{$dichvusanpham->getdongia()}}"
                        class="form-control">
                        </div>
                        </div>                      
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bỏ qua</button>
                  <button type="submit" class="btn btn-primary">Xong</button>
                </div>
              </div>
            </div>
          </div>
          </div>
          </form>
        
           <form method="POST" action="{{ route('admin.dichvusanpham.delete',['id' => $dichvusanpham->getid()]) }}">
          @csrf
          @method('delete')
          <div class="modal fade" id="delete{{ $dichvusanpham->id }}" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Thông Báo</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    Bạn có muốn xóa Dịch Vụ Sản Phẩm này ra khỏi danh sách Dịch Vụ Sản Phẩm không?
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bỏ qua</button>
                  <button type="submit" class="btn btn-primary">Xóa</button>
                </div>
              </div>
            </div>
          </div>
          </div>
          </form>
   
             
          </td>
        </tr>
        @php
            $counter++;
        @endphp
        @endforeach
@endif       
      </tbody>
    </table>
    <script>
      // Đặt giá trị của thẻ input file khi trang được tải lên
      window.addEventListener('DOMContentLoaded', function() {
          var inputImage = document.getElementById('inputImage');
          var selectedImageName = document.getElementById('selectedImageName');
          var imageName = "{{ $dichvusanpham->getanh() }}"; // Lấy tên tệp ảnh từ dữ liệu
  
          if (imageName) {
              inputImage.value = imageName; // Đặt giá trị của thẻ input file
              selectedImageName.textContent = imageName; // Hiển thị tên tệp ảnh đã chọn
          }
      });
      
  </script>
@endsection
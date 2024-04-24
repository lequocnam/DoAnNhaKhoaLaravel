@extends('layouts.app');
@section('title','Trang Xử Lý Hóa Đơn')
@section('content')
@if($errors->any())
      <ul class="alert alert-danger list-unstyled">
      @foreach($errors->all() as $error)
      <li>- {{ $error }}</li>
      @endforeach
      </ul>
      @endif
      <?php
      // Kết nối vào cơ sở dữ liệu
      $servername = env('DB_HOST', '127.0.0.1');
      $username = env('DB_USERNAME', 'root');
      $password = env('DB_PASSWORD', '');
      $dbname = env('DB_DATABASE', 'nhakhoalaravel');
      $dbport = env('DB_PORT','4306');
      $conn = new mysqli($servername, $username, $password, $dbname,$dbport);
      // Truy vấn SQL để lấy ID cuối cùng
      $sql = "SELECT mahoadon FROM hoadons ORDER BY mahoadon DESC LIMIT 1";
      $result = $conn->query($sql);
      
      // Kiểm tra kết quả truy vấn
      if ($result->num_rows > 0) {
          // Lấy giá trị ID cuối cùng
          $row = $result->fetch_assoc();
          preg_match("/[a-zA-Z]+/", $row["mahoadon"], $matches1);
          $letters = $matches1[0];
          preg_match("/[0-9]+/", $row["mahoadon"], $matches2);
          $numbers = intval($matches2[0]);
      $lastId= $letters . ($numbers + 1);
      } else {
          $lastId = "Không có dữ liệu";
      }
      
      // Đóng kết nối
      $conn->close();
      ?>

<style>
    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 15px; /* Để tạo khoảng cách giữa các dòng */
      }
    
      .form-group {
        flex: 1;
        margin-right: 15px; /* Khoảng cách giữa các cặp label và input */
      }
      .form-label {
        width: 100%; /* Đảm bảo rằng label chiếm toàn bộ chiều rộng của form-group */
        margin-bottom: 5px; /* Khoảng cách giữa label và input */
        font-size: 1.1em; /* Kích thước chữ to hơn một chút */
        font-weight: bold; /* Chữ in đậm */
      }
    
      .form-input {
        width: 100%; /* Đảm bảo rằng input chiếm toàn bộ chiều rộng của form-group */
      }
      .form-row {
      display: flex;
      justify-content: space-between;
    }
    
    .row {
      flex: 1;
      margin-right: 10px; /* Khoảng cách giữa các cột */
    }
    </style>
   
<div class="pagetitle">
    <h1>Xử Lý Hóa Đơn</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Xử Lý Hóa Đơn</li>
      </ol>
    </nav>
  </div>
  @if ($errors->any())
<ul class="alert alert-danger list-unstyled">
@foreach ($errors->all() as $error)
<li>- {{ $error }}</li>
@endforeach
</ul>
@endif    
 <?php
$content= Cart::content();
?>
<div class="card">
      <div class="card-body">
<h5 class="card-title">Danh Sách Hóa Đơn</h5>
<a href="{{route('employee.dichvusanpham.index')}}" class="btn btn-primary" >Danh Sách Dịch Vụ Sản Phẩm</a>
<table id="myTable" class="table">
    <thead>
      <tr>
        <th scope="col">Số Thứ Tự</th>
        <th scope="col">Ảnh</th>
        <th scope="col">Tên Dịch Vụ / Sản Phẩm</th>
        <th scope="col">Đơn Giá</th>
        <th scope="col">Số Lượng</th>
        <th scope="col">Ghi Chú</th>
        <th scope="col">Tổng Tiền</th>
        <th scope="col">Thao Tác</th>
      </tr>
    </thead>
    <tbody>
      @php
      $counter = 0;
  @endphp
      @foreach($content as $dichvusanpham)
        <tr>
          <th scope="row">{{ $counter + 1 }}</th>
          <th><img src="{{ '/hinhanh/'.$dichvusanpham->options->anh }}" style="height: 70px; width:70px" alt="img" id="a" class="card-img-top img-card"></th>
          <td>{{$dichvusanpham->name}}</td>
          <td>{{number_format($dichvusanpham->price).' '.'vnđ'}}</td>
          <td>
<div class="input-group">
  <form action="{{route('employee.xulyhoadon.updatesoluong')}}" method="POST">
    @csrf
    <input type="number"  name="quantity" value="{{$dichvusanpham->qty}}">
  <input type="hidden" name="rowidhidden" value="{{$dichvusanpham->rowId}}">
  <button type="submit" class="btn btn-secondary">Cập Nhật</button>
  </form>
</div>           
          </td>
          <td>{{number_format($dichvusanpham->price*$dichvusanpham->qty)}}</td>
          <td><a href="{{route('employee.xulyhoadon.delete', $dichvusanpham->rowId)}}" class="btn btn-danger">X</a></td>
        </tr>
        @php
      $counter ++;
  @endphp
        @endforeach
    </tbody>
  </table>
  <label class="form-label">Tổng Tiền:</label>
  <input type="text" name="tongtien" class="form-input form-control" style="width: 30%" id="tongtien" value="{{number_format(cart::subtotal())}}" readonly>
  <a href="{{route('employee.thanhtoan.index') }}" class="btn btn-success" >Trang Thanh Toán</a>
</div>
</div>
@endsection <!-- Đóng section -->
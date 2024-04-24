@extends('layouts.app');
@section('title',"Trang Thanh Toán")
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
    $conn = new mysqli($servername, $username, $password, $dbname, $dbport);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Truy vấn SQL để lấy số lớn nhất
    $sql = "SELECT mahoadon FROM hoadons WHERE mahoadon REGEXP '^HD[0-9]+$' ORDER BY CAST(SUBSTRING(mahoadon, 3) AS UNSIGNED) DESC LIMIT 1";
    $result = $conn->query($sql);

    // Khởi tạo biến $lastId với giá trị mặc định
    $lastId = "HD0001";

    // Kiểm tra kết quả truy vấn
    if ($result && $result->num_rows > 0) {
        // Lấy giá trị ID cuối cùng
        $row = $result->fetch_assoc();
        $lastId = $row["mahoadon"];
        // Tách số từ chuỗi và tăng giá trị
        $numbers = (int)substr($lastId, 2);
        $numbers++; // Tăng giá trị số lên 1 đơn vị
        // Định dạng lại số với 4 chữ số
        $lastId = 'HD' . sprintf("%04d", $numbers);
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
          <h5>Thông Tin Khám Bệnh</h5>
            <form method="post" action="{{route('employee.xulyhoadon.luuDuLieu')}}">
                @csrf
                <div class="form-row">
            <div class="form-group col-md-6">
                <label class="form-label">Tên Bệnh Nhân:</label>
                <select name="tenbenhnhan" id="tenbenhnhan" class="form-select" required onchange="updateInputValue()">
                    <option disabled selected>--Chọn--</option>
                    @foreach ($viewData["benhnhans"] as $benhnhan)
                        <option value="{{ $benhnhan->getten() }}" 
                          data-mabenhnhan="{{ $benhnhan->getmabenhnhan() }}"
                          data-cmnd="{{ $benhnhan->getcmnd() }}"
                          data-diachi="{{ $benhnhan->getdiachi() }}"
                          >{{ $benhnhan->getten() }}</option>
                    @endforeach
                </select>
                <label for="">CMND:</label>
                <input type="text" name="cmnd" id="cmnd" class="form-control" readonly>
                <label for="">Địa Chỉ</label>
                <input type="text" name="diachi" id="diachi" class="form-control" readonly>      
                <input type="hidden" name="mabenhnhan" id="mabenhnhan" class="form-control" readonly>
                
                <script>
                  function updateInputValue() {
                      var selectElement = document.getElementById("tenbenhnhan");
                      var mabenhnhanInput = document.getElementById("mabenhnhan");
                      var cmndInput = document.getElementById("cmnd");
                      var diachiInput = document.getElementById("diachi");
                      var selectedOption = selectElement.options[selectElement.selectedIndex];
              
                      // Lấy giá trị của các thuộc tính từ option được chọn
                      var selectedMabenhnhan = selectedOption.getAttribute("data-mabenhnhan");
                      var selectedCmnd = selectedOption.getAttribute("data-cmnd");
                      var selectedDiachi = selectedOption.getAttribute("data-diachi");
              
                      // Gán giá trị vào các input tương ứng
                      mabenhnhanInput.value = selectedMabenhnhan;
                      cmndInput.value = selectedCmnd;
                      diachiInput.value = selectedDiachi;
                  }
              </script>
                <input type="hidden" name="mahoadon" value="{{ $lastId }}">
            </div>
            <div class="form-group col-md-6">
                <label class="form-label">Bác Sĩ:</label>
                <select name="tennhanvien" class="form-select" required>
                    <option value="" disabled selected>--Chọn--</option>
                    @foreach ($viewData["nhanviens"] as $nhanvien)
            @if ($nhanvien->loai == "Bác Sĩ")
                <option value="{{ $nhanvien->getten() }}">{{ $nhanvien->getten() }}</option>
            @endif
        @endforeach
                </select>
            </div>
        </div>
<h5 class="card-title">Danh Sách Hóa Đơn</h5>
<table id="myTable" class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Số thứ tự</th>
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
          <td><input type="number"  name="quantity" value="{{$dichvusanpham->qty}}"></td>
          <td><textarea name="ghichu[{{ $dichvusanpham->id }}]" cols="30" rows="5" required></textarea></td>
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
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Hình Thức Thanh Toán:</label>
        <div class="col-lg-10 col-md-6 col-sm-12">
          <input checked type="radio" value="Tiền Mặt" name="httt" {{ old('httt') == 'Tiền Mặt' ? 'checked' : '' }}>Tiền Mặt
          <input type="radio" value="Thẻ ATM" name="httt" {{ old('httt') == 'Thẻ ATM' ? 'checked' : '' }}>Thẻ ATM
        </div>
        <button type="submit" class="btn btn-success">Thanh Toán</button>
        <a href="{{route('employee.xulyhoadon.index')}}" class="btn btn-danger" >Quay Lại</a>
    </form>
</div>
</div>
@endsection <!-- Đóng section -->
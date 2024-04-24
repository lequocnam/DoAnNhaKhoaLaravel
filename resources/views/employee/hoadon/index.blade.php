@extends('layouts.app')
@section('title', "Trang Danh Sách Hóa Đơn")
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
  <div class="pagetitle">
   
    <h1>Danh Sách Hóa Đơn</h1>
    <nav>
      <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Danh Sách Hóa Đơn</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Danh Sách Hóa Đơn</h5>
    
    <!-- Table with hoverable rows -->
    <form action="{{ route('employee.hoadon.searchByDate') }}" method="GET">
      <div class="d-flex flex-row align-items-end">
          <div class="p-2">
              <label for="start-date" class="d-block">Ngày Bắt Đầu:</label>
              <input type="date" id="start-date" class="form-control" name="start_date" value="{{ $startDate ?? '' }}">
          </div>
    
          <div class="p-2">
              <label for="end-date" class="d-block">Ngày Kết Thúc:</label>
              <input type="date" id="end-date" class="form-control" name="end_date" value="{{ $endDate ?? '' }}">
          </div>
    
          <div class="p-2">
              <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
          </div>
      </div>
  </form>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const startDateInput = document.getElementById('start-date');
      const endDateInput = document.getElementById('end-date');
  
      // Chỉ thiết lập ngày hiện tại làm giá trị mặc định nếu người dùng chưa chọn ngày
      const today = new Date().toISOString().split('T')[0];
      if (!startDateInput.value) {
        startDateInput.value = today;
      }
      
      // Cập nhật ngày kết thúc dựa trên ngày bắt đầu
      function updateEndDate() {
        if (endDateInput.value < startDateInput.value) {
          endDateInput.value = startDateInput.value;
        }
        endDateInput.min = startDateInput.value; // Ngày kết thúc không được nhỏ hơn ngày bắt đầu
      }
  
      // Lắng nghe sự kiện thay đổi trên ngày bắt đầu
      startDateInput.addEventListener('change', updateEndDate);
  
      // Gọi hàm một lần để thiết lập giá trị ban đầu cho ngày kết thúc
      updateEndDate();
    });
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <table id="myTable" class="table datatable">
    <thead>
      <tr>
        <th scope="col">Số Thứ Tự</th>
        <th scope="col">Mã Hóa Đơn</th>
        <th scope="col">Tên Bệnh Nhân</th>
        <th scope="col">Ngày Hóa Đơn</th>
        <th scope="col">Tổng Tiền</th>
        <th scope="col">Hình Thức Thanh Toán</th>
        <th scope="col">Tình Trạng</th>
        <th scope="col">Thao Tác</th>
      </tr>
    </thead>
    <tbody>
      @php
      $counter = 0;
      @endphp
      @foreach ($all_hoadon as $hoadon)
      <tr>
        <th scope="row">{{ $counter + 1 }}</th>
        <td>{{ $hoadon->mahoadon }}</td>
        <td>{{ $hoadon->tenbenhnhan }}</td>
        <td>{{ $hoadon->created_at }}</td>
        <td>{{ number_format($hoadon->tongtien) . ' vnđ' }}</td>
        <td>{{ $hoadon->httt }}</td>
        <td>
          @if ($hoadon->tinhtrang == 'Chưa Xử Lý')
          Chưa Xử Lý
          @else
          Đã thanh toán
          @endif
        </td>
        <td>
          <div class="d-flex justify-content-between">
            @if ($hoadon->tinhtrang == 'Chưa Xử Lý')
            <button class="btn btn-success btn-mark-paid" data-id="{{ $hoadon->id }}">Đánh dấu đã thanh toán</button>
            @endif
            <span style="margin-left: 10px; margin-right: 10px;"></span>
            <a href="{{ route('employee.hoadonchitiet.index', ['id' => $hoadon->mabenhnhan, 'idhd' => $hoadon->mahoadon]) }}" class="btn btn-primary"><i class="bi-eye"></i></a>
            <span style="margin-left: 10px; margin-right: 10px;"></span>
            <button data-bs-toggle="modal" data-bs-target="#delete{{ $hoadon->id }}" class="btn btn-danger"><i class="bi-trash"></i></button>
          </div>
          <form method="POST" action="{{ route('employee.hoadon.delete',['id' => $hoadon->id]) }}">
            @csrf
            @method('delete')
            <div class="modal fade" id="delete{{ $hoadon->id }}" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Thông Báo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      Bạn có muốn xóa Dịch Vụ Sản Phẩm này ra khỏi danh sách Dịch Vụ Sản Phẩm không?
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bỏ qua</button>
                    <button type="submit" class="btn btn-primary">Xóa</button>
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
    </tbody>
  </table>
  <label for="">Tổng Tiền</label>
  <input type="text" readonly name="tongtien" value="{{number_format($tongtien).' '.'vnđ'}}">
  <script>
    jQuery(document).ready(function($) {
        $('.btn-mark-paid').on('click', function() {
            var hoaDonId = $(this).data('id');
    
            // Gửi yêu cầu AJAX để đánh dấu hóa đơn đã thanh toán
            $.ajax({
                url: "{{ route('employee.hoadon.markAsPaid') }}",
                method: 'POST',
                data: {
                    id: hoaDonId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // Cập nhật trạng thái của hóa đơn trong DOM
                    $('.btn-mark-paid[data-id="' + hoaDonId + '"]').closest('tr').find('td:nth-child(7)').text('Đã thanh toán');
    
                    // Sau khi cập nhật trạng thái, tải lại trang
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
    </script>


@endsection
@extends('layouts.admin')
@section('title',"Trang Danh Sách Phòng Khám")
@section('content')
<?php
// Kết nối vào cơ sở dữ liệu
$servername = env('DB_HOST', '127.0.0.1');
$username = env('DB_USERNAME', 'root');
$password = env('DB_PASSWORD', '');
$dbname = env('DB_DATABASE', 'nhakhoalaravel');
$dbport = env('DB_PORT','4306');
$conn = new mysqli($servername, $username, $password, $dbname,$dbport);
// Truy vấn SQL để lấy ID cuối cùng
$sql = "SELECT maphongkham FROM phongkhams ORDER BY maphongkham DESC LIMIT 1";
$result = $conn->query($sql);

// Kiểm tra kết quả truy vấn
if ($result->num_rows > 0) {
    // Lấy giá trị ID cuối cùng
    $row = $result->fetch_assoc();
    preg_match("/[a-zA-Z]+/", $row["maphongkham"], $matches1);
    $letters = $matches1[0];
    preg_match("/[0-9]+/", $row["maphongkham"], $matches2);
    $numbers = intval($matches2[0]);
$lastId= $letters . ($numbers + 1);
} else {
    $lastId = "Không có dữ liệu";
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
   
    <h1>Danh Sách Phòng Khám</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home.index')}}">Home</a></li>
        <li class="breadcrumb-item active">Danh Sách Phòng Khám</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Bảng Danh Sách Phòng Khám</h5>
    
<button class="btn btn-primary" id="button-add" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">Thêm Phòng Khám mới</button>
<form method="POST" action="{{ route('admin.phongkham.data') }}">
  @csrf
  <div class="modal fade" id="ExtralargeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm Phòng Khám</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Mã Phòng Khám:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
            <input name="maphongkham" readonly required type="text" value="{{ old('maphongkham')}} <?php echo $lastId ?>"
            class="form-control">
            </div>        
            </div>
        <br>
              <div class="mb-3 row">
                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Phòng Khám:</label>
                <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="tenphongkham" required type="text"   value="{{ old('tenphongkham') }}"
                class="form-control">
                </div>
                </div>   
           
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bỏ Qua</button>
          <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
      </div>
    </div>
    </div>
    </div>
  </div>
  </form>



<br>
<br>
    <!-- Table with hoverable rows -->
    <table id="myTable" class="table datatable">
      <thead>
        <tr>
          <th scope="col">Số Thứ Tự</th>
          <th scope="col">Mã Phòng Khám</th>
          <th scope="col">Tên Phòng Khám</th>
          <th scope="col">Chỉnh Sửa</th>
        </tr>
      </thead>
      <tbody>
        @php
            $counter = 0;
        @endphp
        @if(isset($viewData['phongkhams']))
        @foreach ($viewData['phongkhams'] as $phongkham)
        <tr>
          <th scope="row">{{ $counter + 1 }}</th>
          <td>{{$phongkham->getmaphongkham()}}</td>
          <td>{{$phongkham->gettenphongkham()}}</td>
          <td>
           
            <div class="d-flex justify-content-between">
            <button  data-bs-toggle="modal" data-bs-target="#edit{{ $phongkham->id }}" class="btn btn-primary"><i class="bi-pencil"></i></button>
        
            <button  data-bs-toggle="modal" data-bs-target="#delete{{ $phongkham->id }}" class="btn btn-danger"><i class="bi-trash"></i></button>

        
        
            </div>
            <form method="POST" action="{{ route('admin.phongkham.update',['id' => $phongkham->getid()]) }}">
      
      
            @csrf
          @method('put')
          <div class="modal fade" id="edit{{ $phongkham->id }}" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Chi Tiết Phòng Khám</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="mb-3 row">
                    <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Mã Phòng Khám:</label>
                    <div class="col-lg-10 col-md-6 col-sm-12">
                    <input name="maphongkham" type="text"  value="{{$phongkham->getmaphongkham()}}"
                    class="form-control">
                    </div>        
                    </div>
                <br>                          
                      <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Phòng Khám:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                        <input name="tenphongkham" type="text"   value="{{$phongkham->gettenphongkham()}}"
                        class="form-control">
                        </div>
                        </div>                                             
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bỏ Qua</button>
                  <button type="submit" class="btn btn-primary">Xong</button>
                </div>
              </div>
            </div>
          </div>
          </div>
          </form>
          
       
           <form method="POST" action="{{ route('admin.phongkham.delete',['id' => $phongkham->getid()]) }}">
          @csrf
          @method('delete')
          <div class="modal fade" id="delete{{ $phongkham->id }}" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Thông Báo</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    Bạn có muốn xóa Phòng Khám này ra khỏi danh sách Phòng Khám không?
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bỏ Qua</button>
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
@endsection
@extends('layouts.app')
@section('title', "Trang Danh Sách Bệnh Nhân")
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
$sql = "SELECT mabenhnhan FROM benhnhans WHERE mabenhnhan REGEXP '^BN[0-9]+$' ORDER BY CAST(SUBSTRING(mabenhnhan, 3) AS UNSIGNED) DESC LIMIT 1";
$result = $conn->query($sql);

// Khởi tạo biến $lastId với giá trị mặc định
$lastId = "BN0001";

// Kiểm tra kết quả truy vấn
if ($result && $result->num_rows > 0) {
    // Lấy giá trị ID cuối cùng
    $row = $result->fetch_assoc();
    $lastId = $row["mabenhnhan"];
    // Tách số từ chuỗi và tăng giá trị
    $numbers = (int)substr($lastId, 2);
    $numbers++; // Tăng giá trị số lên 1 đơn vị
    // Định dạng lại số với 4 chữ số
    $lastId = 'BN' . sprintf("%04d", $numbers);
}

// Đóng kết nối
$conn->close();
?>
<style>
  #myTable {
    width: 100%;
    border-collapse: collapse;
  }
  
  #myTable th {
    background-color: #f2f2f2; /* Màu xám nhạt cho phần tiêu đề */
    text-align: left;
  }
  
  #myTable th,
  #myTable td {
    padding: 8px;
  }
  
  #myTable tbody tr:nth-child(even) {
    background-color: #f2f2f2; /* Tạo hiệu ứng xen kẽ màu cho hàng của tbody */
  }
  
  #myTable tbody tr:hover {
    background-color: #ddd; /* Hiển thị màu sáng hơn khi hover */
  }
  
  
  </style>
  <div class="pagetitle">
   
    <h1>Danh Sách Bệnh Nhân</h1>
    <nav>
      <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Danh Sách Bệnh Nhân</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Bảng Bệnh Nhân</h5>
    
<button class="btn btn-primary" id="button-add" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">Thêm Bệnh Nhân Mới</button>
<form method="POST" action="{{ route('employee.benhnhan.data') }}">
  @csrf
  <div class="modal fade" id="ExtralargeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm Bệnh Nhân</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Mã Bệnh Nhân:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
            <input name="mabenhnhan" readonly type="text" value="{{$lastId}}"  class="form-control">
            </div>        
            </div>
        <br>
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Bệnh Nhân:</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
          <input name="ten" required type="text" value="{{ old('ten') }}"
          class="form-control">
          </div>
          </div>
          <br>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Giới Tính:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input checked type="radio" value="Nam" name="gioitinh" {{ old('gioitinh') == 'Nam' ? 'checked' : '' }}>Nam
              <input type="radio" value="Nữ" name="gioitinh" {{ old('gioitinh') == 'Nữ' ? 'checked' : '' }}>Nữ
            </div>
            </div>
            <br>
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ngày Sinh:</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="ngaysinh" required type="date" value="{{ old('ngaysinh') }}"
              class="form-control">
              </div>
              </div>       
              <br>
              <div class="mb-3 row">
                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Số Điện Thoại:</label>
                <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="sodienthoai" required type="text" value="{{ old('sodienthoai') }}"
                class="form-control">
                </div>
                </div>       
                <br>
              <div class="mb-3 row">
                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">CMND:</label>
                <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="cmnd" required type="text" value="{{ old('cmnd') }}"
                class="form-control">
                </div>
                </div>   
               
                <br>
              <div class="mb-3 row">
                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Địa Chỉ:</label>
                <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="diachi" required type="text" value="{{ old('diachi') }}"
                class="form-control">
                </div>
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
  </form>
<br>
<br>
    <!-- Table with hoverable rows -->
   
    <table id="myTable" class="table datatable">
      <thead>
        <tr>
          <th scope="col">Số Thứ Tự</th>
          <th scope="col">Mã Bệnh Nhân</th>
          <th scope="col">Tên Bệnh Nhân</th>
          <th scope="col">Giới Tính</th>
          <th scope="col">Ngày Sinh</th>
          <th scope="col">Số Điện Thoại</th>
          <th scope="col">CMND</th>
          <th scope="col">Địa Chỉ</th>
          <th scope="col">Chỉnh Sửa</th>
        </tr>
      </thead>
      <tbody>
        @php
            $counter = 0;
        @endphp
        @foreach ($viewData['benhnhans'] as $benhnhan)
        <tr>
          <td scope="row">{{ $counter + 1 }}</td>
          <td>{{$benhnhan->mabenhnhan}}</td>
          <td>{{$benhnhan->ten}}</td>
          <td>{{$benhnhan->gioitinh}}</td>
          <td>{{$benhnhan->ngaysinh}}</td>
          <td>{{$benhnhan->sodienthoai}}</td>
          <td>{{$benhnhan->cmnd}}</td>
          <td>{{$benhnhan->diachi}}</td>
          <td>
            <div class="d-flex justify-content-between">

            <button  data-bs-toggle="modal" data-bs-target="#edit{{ $benhnhan->id }}" class="btn btn-primary"><i class="bi-pencil"></i></button>
          
            <button  data-bs-toggle="modal" data-bs-target="#delete{{ $benhnhan->id }}" class="btn btn-danger"><i class="bi-trash"></i></button>

            <button  data-bs-toggle="modal" data-bs-target="#ExtralargeModal{{ $counter + 1 }}" class="btn btn-primary"><i class="bi-eye"></i></button>
            </div>
            <form method="POST" action="{{ route('employee.benhnhan.update',['id' => $benhnhan->id]) }}">
          @csrf
          @method('put')
          <div class="modal fade" id="edit{{ $benhnhan->id }}" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Hồ Sơ Bệnh Nhân</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="mb-3 row">
                    <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Mã Bệnh Nhân:</label>
                    <div class="col-lg-10 col-md-6 col-sm-12">
                    <input name="mabenhnhan" type="text"  value="{{$benhnhan->mabenhnhan}}"
                    class="form-control">
                    </div>        
                    </div>
                <br>
                <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Bệnh Nhân:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                  <input name="ten" type="text"  value="{{$benhnhan->ten}}"
                  class="form-control">
                  </div>
                  </div>
                  <br>
                    <div class="mb-3 row">
                      <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Giới Tính:</label>
                      <div class="col-lg-10 col-md-6 col-sm-12">
                        <input type="radio" value="Nam" name="gioitinh" {{ $benhnhan->gioitinh === 'Nam' ? 'checked' : '' }}>Nam
                      <input type="radio" value="Nữ" name="gioitinh" {{ $benhnhan->gioitinh === 'Nữ' ? 'checked' : '' }}>Nữ
                      <input type="hidden" name="gioitinh_default" value="{{ $benhnhan->gioitinh }}">
                      </div>
                      </div>          
                    <br>
                    <div class="mb-3 row">
                      <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ngày Sinh:</label>
                      <div class="col-lg-10 col-md-6 col-sm-12">
                      <input name="ngaysinh" type="date" value="{{$benhnhan->ngaysinh}}"
                      class="form-control">
                      </div>
                      </div>       
                      <br>
                      <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Số Điện Thoại:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                        <input name="sodienthoai" type="text" value="{{$benhnhan->sodienthoai}}"
                        class="form-control">
                        </div>
                        </div>       
                        <br>
                      <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">CMND:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                        <input name="cmnd" type="text" value="{{$benhnhan->cmnd}}"
                        class="form-control">
                        </div>
                        </div>   
                        <br>
                      <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Địa Chỉ:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                        <input name="diachi" type="text" value="{{$benhnhan->diachi}}"
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
          
         
           <form method="POST" action="{{ route('employee.benhnhan.delete',['id' => $benhnhan->getid()]) }}">
          @csrf
          @method('delete')
          <div class="modal fade" id="delete{{ $benhnhan->id }}" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Thông Báo</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    Bạn có muốn xóa Bệnh Nhân này ra khỏi danh sách Bệnh Nhân không?
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bỏ Qua</button>
                  <button type="submit" class="btn btn-primary">Xóa</button>
                </div>
              </div>
            </div>
          </div>
          </div>
          </form>
       
              <div class="modal fade" id="ExtralargeModal{{ $counter + 1 }}" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Hồ Sơ Bệnh Nhân</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="mb-3 row">
                          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Mã Bệnh Nhân:</label>
                          <div class="col-lg-10 col-md-6 col-sm-12">
                          <input name="mabenhnhan" type="text" readonly value="{{$benhnhan->mabenhnhan}}"
                          class="form-control">
                          </div>        
                          </div>
                      <br>
                      <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Bệnh Nhân:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                        <input name="ten" type="text" readonly value="{{$benhnhan->ten}}"
                        class="form-control">
                        </div>
                        </div>
                        <br>
                        <form>
                          <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Giới Tính:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                              <input type="radio" disabled name="gioitinh" {{ $benhnhan->gioitinh === 'Nam' ? 'checked' : '' }}>Nam
                            <input type="radio" disabled name="gioitinh" {{ $benhnhan->gioitinh === 'Nữ' ? 'checked' : '' }}>Nữ
                            </div>
                            </div>
                        </form>                       
                          <br>
                          <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ngày Sinh:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="ngaysinh" readonly type="date" value="{{$benhnhan->ngaysinh}}"
                            class="form-control">
                            </div>
                            </div>       
                            <br>
                            <div class="mb-3 row">
                              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Số Điện Thoại:</label>
                              <div class="col-lg-10 col-md-6 col-sm-12">
                              <input name="sodienthoai" readonly type="text" value="{{$benhnhan->sodienthoai}}"
                              class="form-control">
                              </div>
                              </div>       
                              <br>
                            <div class="mb-3 row">
                              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">CMND:</label>
                              <div class="col-lg-10 col-md-6 col-sm-12">
                              <input name="cmnd" type="text" readonly value="{{$benhnhan->cmnd}}"
                              class="form-control">
                              </div>
                              </div>   
                              <br>
                            <div class="mb-3 row">
                              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Địa Chỉ:</label>
                              <div class="col-lg-10 col-md-6 col-sm-12">
                              <input name="diachi" type="text" readonly value="{{$benhnhan->diachi}}"
                              class="form-control">
                              </div>
                              </div>          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Xong</button>
                    </div>
                  </div>
                </div>
              </div>
              </div>
          </td>
        </tr>
        @php
            $counter++;
        @endphp
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
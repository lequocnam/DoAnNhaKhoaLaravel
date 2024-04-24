@extends('layouts.admin')
@section('title', 'Trang Danh Sách Nhân Viên')
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
$sql = "SELECT manhanvien FROM nhanviens WHERE manhanvien REGEXP '^NV[0-9]+$' ORDER BY CAST(SUBSTRING(manhanvien, 3) AS UNSIGNED) DESC LIMIT 1";
$result = $conn->query($sql);

// Khởi tạo biến $lastId với giá trị mặc định
$lastId = "NV0001";

// Kiểm tra kết quả truy vấn
if ($result && $result->num_rows > 0) {
    // Lấy giá trị ID cuối cùng
    $row = $result->fetch_assoc();
    $lastId = $row["manhanvien"];
    // Tách số từ chuỗi và tăng giá trị
    $numbers = (int)substr($lastId, 2);
    $numbers++; // Tăng giá trị số lên 1 đơn vị
    // Định dạng lại số với 4 chữ số
    $lastId = 'NV' . sprintf("%04d", $numbers);
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
   
    <h1>Danh Sách Nhân Viên</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home.index')}}">Home</a></li>
        <li class="breadcrumb-item active">Danh Sách Nhân Viên</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Bảng Bệnh Nhân</h5>
    <button class="btn btn-primary" id="button-add" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">Thêm Nhân Viên mới</button>
<form method="POST" action="{{ route('admin.nhanvien.data') }}" enctype="multipart/form-data">
  @csrf
  <div class="modal fade" id="ExtralargeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm Nhân Viên</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Mã Nhân Viên:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
            <input name="manhanvien" readonly required type="text" value="{{ old('manhanvien')}} <?php echo $lastId ?>"
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
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Nhân Viên:</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
          <input name="ten" required type="text" value="{{ old('ten') }}"
          class="form-control">
          </div>
          </div>
          <br>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Giới tính:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input checked type="radio" value="Nam" name="gioitinh" {{ old('gioitinh') == 'Nam' ? 'checked' : '' }}>Nam
              <input type="radio" value="Nữ" name="gioitinh" {{ old('gioitinh') == 'Nữ' ? 'checked' : '' }}>Nữ
            </div>
            </div>
            <br>
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ngày sinh:</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="ngaysinh" required type="date" value="{{ old('ngaysinh') }}"
              class="form-control">
              </div>
              </div>       
              <br>
              <div class="mb-3 row">
                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Số điện thoại:</label>
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
                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Địa chỉ:</label>
                <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="diachi" required type="text" value="{{ old('diachi') }}"
                class="form-control">
                </div>
                </div>  
                <div class="mb-3 row">
                    <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Email:</label>
                    <div class="col-lg-10 col-md-6 col-sm-12">
                    <input name="email" required type="text" value="{{ old('email') }}"
                    class="form-control">
                    </div>
                    </div> 
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Loại:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                    <select name="loai" class="form-control">
                        <option value="Chọn">--Chọn--</option>
                        <option value="Bác Sĩ" {{ old('loai') == 'Bác Sĩ' ? 'selected' : '' }}>Bác Sĩ</option>
                        <option value="Thu Ngân" {{ old('loai') == 'Thu Ngân' ? 'selected' : '' }}>Thu Ngân</option>
                        <option value="Bảo Vệ" {{ old('loai') == 'Bảo Vệ' ? 'selected' : '' }}>Bảo Vệ</option>
                    </select>
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

  </div>
<br>
<br>
    <table id="myTable" class="table datatable">
      <thead>
        <tr>
          <th scope="col"  >Số thứ tự</th>
          <th scope="col"  >Mã Nhân Viên</th>
          <th scope="col">Ảnh</th>
          <th scope="col"  >Tên Nhân Viên</th>
          <th scope="col"  >Giới tính</th>
          <th scope="col"  >Ngày sinh</th>
          <th scope="col"  >Số điện thoại</th>
          <th scope="col"  >CMND</th>
          <th scope="col"  >Địa chỉ</th>
          <th scope="col"  >Email</th>
          <th scope="col"  >Loại</th>
          <th scope="col"  >Chỉnh sửa</th>
        </tr>
      </thead>
      <tbody>
        @php
            $counter = 0;
        @endphp
        @if(isset($viewData['nhanviens']))
        @foreach ($viewData['nhanviens'] as $nhanvien)
        <tr>
          <td scope="row">{{ $counter + 1 }}</td>
          <td>{{$nhanvien->getmanhanvien()}}</td>
          <td><img src="{{ '/hinhanh/'.$nhanvien->anh }}" style="width: 70px; height:70px;" alt="img" /></td>
          <td>{{$nhanvien->getten()}}</td>
          <td>{{$nhanvien->getgioitinh()}}</td>
          <td>{{$nhanvien->getngaysinh()}}</td>
          <td>{{$nhanvien->getsodienthoai()}}</td>
          <td>{{$nhanvien->getcmnd()}}</td>
          <td>{{$nhanvien->getdiachi()}}</td>
          <td>{{$nhanvien->getemail()}}</td>
          <td>{{$nhanvien->getloai()}}</td>
          <td>
            <div class="d-flex justify-content-between">
            <button  data-bs-toggle="modal" data-bs-target="#edit{{ $nhanvien->id }}" class="btn btn-primary"><i class="bi-pencil"></i></button>

            <button  data-bs-toggle="modal" data-bs-target="#delete{{ $nhanvien->id }}" class="btn btn-danger"><i class="bi-trash"></i></button>
            </div>
          </td>
            <form method="POST" action="{{ route('admin.nhanvien.update',['id' => $nhanvien->getid()]) }}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="modal fade" id="edit{{ $nhanvien->id }}" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Hồ sơ Nhân Viên</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="mb-3 row">
                    <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Mã Nhân Viên:</label>
                    <div class="col-lg-10 col-md-6 col-sm-12">
                    <input name="manhanvien" type="text"  value="{{$nhanvien->getmanhanvien()}}"
                    class="form-control">
                    </div>        
                    </div>
                    <br>
                    <div class="mb-3 row">
                      <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ảnh:</label>
                      <div class="col-lg-10 col-md-6 col-sm-12">
                          <input name="anh" type="file" class="form-control" id="inputImage" value="{{$nhanvien->anh}}">
                          <img src="{{ '/hinhanh/'.$nhanvien->anh }}" style="width: 70px; height:70px;" alt="img" />
                      </div>        
                  </div>
                <br>
                <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Nhân Viên:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                  <input name="ten" type="text"  value="{{$nhanvien->getten()}}"
                  class="form-control">
                  </div>
                  </div>
                  <br>
                    <div class="mb-3 row">
                      <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Giới tính:</label>
                      <div class="col-lg-10 col-md-6 col-sm-12">
                        <input type="radio" value="Nam" name="gioitinh" {{ $nhanvien->getgioitinh() === 'Nam' ? 'checked' : '' }}>Nam
                      <input type="radio" value="Nữ" name="gioitinh" {{ $nhanvien->getgioitinh() === 'Nữ' ? 'checked' : '' }}>Nữ
                      <input type="hidden" name="gioitinh_default" value="{{ $nhanvien->getgioitinh() }}">
                      </div>
                      </div>          
                    <br>
                    <div class="mb-3 row">
                      <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ngày sinh:</label>
                      <div class="col-lg-10 col-md-6 col-sm-12">
                      <input name="ngaysinh" type="date" value="{{$nhanvien->getngaysinh()}}"
                      class="form-control">
                      </div>
                      </div>       
                      <br>
                      <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Số điện thoại:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                        <input name="sodienthoai" type="text" value="{{$nhanvien->getsodienthoai()}}"
                        class="form-control">
                        </div>
                        </div>       
                        <br>
                      <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">CMND:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                        <input name="cmnd" type="text" value="{{$nhanvien->getcmnd()}}"
                        class="form-control">
                        </div>
                        </div>   
                        <br>
                      <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Địa chỉ:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                        <input name="diachi" type="text" value="{{$nhanvien->getdiachi()}}"
                        class="form-control">
                        </div>
                        </div>    
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Email:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="email" required type="text" value="{{$nhanvien->email}}"
                            class="form-control">
                            </div>
                            </div> 
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Loại:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                        <select name="loai" class="form-control">
                            <option value="Bác Sĩ" {{ $nhanvien->getloai() == 'Bác Sĩ' ? 'selected' : '' }}>Bác Sĩ</option>
                            <option value="Thu Ngân" {{ $nhanvien->getloai() == 'Thu Ngân' ? 'selected' : '' }}>Thu Ngân</option>
                            <option value="Bảo Vệ" {{ $nhanvien->getloai() == 'Bảo Vệ' ? 'selected' : '' }}>Bảo Vệ</option>
                        </select>
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
        
           <form method="POST" action="{{ route('admin.nhanvien.delete',['id' => $nhanvien->getid()]) }}" enctype="multipart/form-data">
          @csrf
          @method('delete')
          <div class="modal fade" id="delete{{ $nhanvien->id }}" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Thông Báo</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    Bạn có muốn xóa Nhân Viên này ra khỏi danh sách Nhân Viên không?
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bỏ qua</button>
                  <button type="submit" class="btn btn-primary">Xóa</button>
                </div>
              </div>
            </div>
          </div>
          </div>
          </form>
        </tr>
        @php
            $counter++;
        @endphp
        @endforeach
@endif       
      </tbody>
    </table>
  </div>
</div>
@endsection
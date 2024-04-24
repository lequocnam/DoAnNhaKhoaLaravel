@extends('layouts.admin')
@section('title', "Trang Danh Sách Lịch Hẹn")
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
  <div class="pagetitle">
   
    <h1>Danh Sách Lịch Hẹn</h1>
    <nav>
      <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Danh Sách Lịch Hẹn</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
<div class="card">
  <div class="card-body">
    
<button class="btn btn-primary" id="button-add" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">Thêm Lịch Hẹn mới</button>
<form method="POST" action="{{ route('admin.lichhen.data') }}">
  @csrf
  <div class="modal fade" id="ExtralargeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm Lịch Hẹn</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Mã Lịch Hẹn:</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="malichhen" required type="text"  value="{{old('malichhen')}} <?php echo $lastId ?>"
              class="form-control">
              </div>        
              </div>
          <br>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Khách Hàng:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
            <input name="ten" type="text" required  value="{{old('ten')}}"
            class="form-control">
            </div>
            </div>
            <br>
            <form>
              <div class="mb-3 row">
                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Giới Tính:</label>
                <div class="col-lg-10 col-md-6 col-sm-12">
                  <input type="radio" checked  name="gioitinh" value="Nam" {{ old('gioitinh') === 'Nam' ? 'checked' : '' }}>Nam
                <input type="radio"  name="gioitinh" value="Nữ" {{ old('gioitinh') === 'Nữ' ? 'checked' : '' }}>Nữ
                </div>
                </div>
            </form>                                                       
                <br>
                <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Số Điện Thoại:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                  <input name="sodienthoai" required type="text" value="{{old('sodienthoai')}}"
                  class="form-control">
                  </div>
                  </div>       
                  <br>
                <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Địa Chỉ:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                  <input name="diachi" required type="text"  value="{{old('diachi')}}"
                  class="form-control">
                  </div>
                  </div>  
                  <br>
                  <div class="mb-3 row">
                    <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nội Dung Khám:</label>
                    <div class="col-lg-10 col-md-6 col-sm-12">
                    <input name="noidungkham" required type="text" value="{{old('noidungkham')}}"
                    class="form-control">
                    </div>
                    </div> 
                    <br>                                        
              <div class="mb-3 row">
                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ngày Hẹn:</label>
                <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="ngayhen" required  type="date" value="{{old('ngayhen')}}"
                class="form-control">
                </div>
                </div> 
                <br>
                <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ngày Dự Kiến:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                  <input name="ngaydukien" required type="date" value="{{old('ngaydukien')}}"
                  class="form-control">
                  </div>
                  </div> 
                <br>
                <div class="mb-3 row">
                  <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Trạng Thái:</label>
                  <div class="col-lg-10 col-md-6 col-sm-12">
                  <input name="trangthai" required type="text" value="{{old('trangthai')}}"
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
          <th scope="col" >Số Thứ Tự</th>
          <th scope="col" >Mã Lịch Hẹn</th>
          <th scope="col" >Tên Khách Hàng</th>
          <th scope="col" >Giới Tính</th>
          <th scope="col" >Số Điện Thoại</th>
          <th scope="col" >Địa Chỉ</th>
          <th scope="col" >Nội Dung Khám</th>
          <th scope="col" >Ngày Hẹn</th>
          <th scope="col" >Ngày Dự Kiến</th>
          <th scope="col" >Trạng Thái</th>
          <th scope="col" >Chỉnh Sửa</th>
        </tr>
      </thead>
      <tbody>
        @php
            $counter = 0;
        @endphp
        @if(isset($viewData['lichhens']))
        @foreach ($viewData['lichhens'] as $lichhen)
        <tr>
          <th scope="row">{{ $counter + 1 }}</th>
          <td>{{$lichhen->getmalichhen()}}</td>
          <td>{{$lichhen->getten()}}</td>
          <td>{{$lichhen->getgioitinh()}}</td>
          <td>{{$lichhen->getsodienthoai()}}</td>
          <td>{{$lichhen->getdiachi()}}</td>
          <td>{{$lichhen->getnoidungkham()}}</td>
          <td>{{$lichhen->getngayhen()}}</td>
          <td>{{$lichhen->getngaydukien()}}</td>
          <td>{{$lichhen->gettrangthai()}}</td>
          <td>
            <div class="d-flex justify-content-between">
            <button  data-bs-toggle="modal" data-bs-target="#edit{{ $lichhen->id }}" class="btn btn-primary"><i class="bi-pencil"></i></button>
          
            <button  data-bs-toggle="modal" data-bs-target="#delete{{ $lichhen->id }}" class="btn btn-danger"><i class="bi-trash"></i></button>

            </div>
          
            <form method="POST" action="{{ route('admin.lichhen.update',['id' => $lichhen->getid()]) }}">
          @csrf
          @method('put')
          <div class="modal fade" id="edit{{ $lichhen->id }}" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Hồ Sơ Lịch Hẹn</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="mb-3 row">
                      <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Mã Lịch Hẹn:</label>
                      <div class="col-lg-10 col-md-6 col-sm-12">
                      <input name="malichhen" type="text"  value="{{$lichhen->getmalichhen()}}"
                      class="form-control">
                      </div>        
                      </div>
                  <br>
                  <div class="mb-3 row">
                    <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Khách Hàng:</label>
                    <div class="col-lg-10 col-md-6 col-sm-12">
                    <input name="ten" type="text"  value="{{$lichhen->getten()}}"
                    class="form-control">
                    </div>
                    </div>
                    <br>
                    <form>
                      <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Giới Tính:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                          <input type="radio"  name="gioitinh" value="Nam" {{ $lichhen->getgioitinh() === 'Nam' ? 'checked' : '' }}>Nam
                        <input type="radio"  name="gioitinh"  value="Nữ" {{ $lichhen->getgioitinh() === 'Nữ' ? 'checked' : '' }}>Nữ
                        <input type="hidden" name="gioitinh_default" value="{{ $lichhen->getgioitinh() }}">
                        </div>
                        </div>
                    </form>                                                       
                        <br>
                        <div class="mb-3 row">
                          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Số Điện Thoại:</label>
                          <div class="col-lg-10 col-md-6 col-sm-12">
                          <input name="sodienthoai" type="text" value="{{$lichhen->getsodienthoai()}}"
                          class="form-control">
                          </div>
                          </div>       
                          <br>
                        <div class="mb-3 row">
                          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Địa Chỉ:</label>
                          <div class="col-lg-10 col-md-6 col-sm-12">
                          <input name="diachi" type="text"  value="{{$lichhen->getdiachi()}}"
                          class="form-control">
                          </div>
                          </div>  
                          <br>
                          <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nội Dung Khám:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="noidungkham"  type="text" value="{{$lichhen->getnoidungkham()}}"
                            class="form-control">
                            </div>
                            </div> 
                            <br>                                        
                      <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ngày Hẹn:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                        <input name="ngayhen"  type="date" value="{{$lichhen->getngayhen()}}"
                        class="form-control">
                        </div>
                        </div> 
                        <br>
                        <div class="mb-3 row">
                          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ngày Dự Kiến:</label>
                          <div class="col-lg-10 col-md-6 col-sm-12">
                          <input name="ngaydukien" type="date" value="{{$lichhen->getngaydukien()}}"
                          class="form-control">
                          </div>
                          </div> 
                        <br>
                        <div class="mb-3 row">
                          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Trạng Thái:</label>
                          <div class="col-lg-10 col-md-6 col-sm-12">
                          <input name="trangthai" type="text" value="{{$lichhen->gettrangthai()}}"
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
          
       
           <form method="POST" action="{{ route('admin.lichhen.delete',['id' => $lichhen->getid()]) }}">
          @csrf
          @method('delete')
          <div class="modal fade" id="delete{{ $lichhen->id }}" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Thông Báo</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    Bạn có muốn xóa Lịch Hẹn này ra khỏi danh sách Lịch Hẹn không?
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
  </div>
</div>
@endsection
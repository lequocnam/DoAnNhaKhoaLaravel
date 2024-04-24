@extends('layouts.app');
@section('title',"Trang Thêm Bệnh Nhân Trực Tiếp")
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
$sql = "SELECT mabenhnhan FROM benhnhans ORDER BY mabenhnhan DESC LIMIT 1";
$result = $conn->query($sql);

// Kiểm tra kết quả truy vấn
if ($result->num_rows > 0) {
    // Lấy giá trị ID cuối cùng
    $row = $result->fetch_assoc();
    preg_match("/[a-zA-Z]+/", $row["mabenhnhan"], $matches1);
    $letters = $matches1[0];
    preg_match("/[0-9]+/", $row["mabenhnhan"], $matches2);
    $numbers = intval($matches2[0]);
$lastId= $letters . ($numbers + 1);
} else {
    $lastId = "Không có dữ liệu";
}

// Đóng kết nối
$conn->close();
?>
    <div class="pagetitle">
        <h1>Quản lý khách hàng</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home.index')}}">Home</a></li>
            <li class="breadcrumb-item active">Quản lý bệnh nhân</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
    
            
                
                <div class="card">
                    <div class="card-body">
                      <h3 class="card-title">
                        <form method="POST" action="{{ route('employee.thembenhnhan.datatructiep') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Mã Bệnh Nhân:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="mabenhnhan" readonly required type="text" value="{{ old('mabenhnhan')}} <?php echo $lastId ?>"
                                class="form-control">
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
                                            <div>
                                              <button type="submit" class="btn btn-primary mb-3">Thêm</button>
                                              <button type="reset" class="btn btn-danger mb-3">Hoàn tác</button>
                                             </div>  
                </form>      
        <h5 class="card-title">Bảng bệnh nhân</h5>
  
        <!-- Table with hoverable rows -->
        <script>
          var ascending = true; // Theo dõi trạng thái sắp xếp hiện tại
  
          function sortTable(columnIndex) {
              var table, rows, switching, i, x, y, shouldSwitch;
              table = document.getElementById("myTable");
              switching = true;
              
              while (switching) {
                  switching = false;
                  rows = table.rows;
                  
                  for (i = 1; i < (rows.length - 1); i++) {
                      shouldSwitch = false;
                      
                      x = rows[i].getElementsByTagName("TD")[columnIndex];
                      y = rows[i + 1].getElementsByTagName("TD")[columnIndex];
                      
                      if (ascending) {
                          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                              shouldSwitch = true;
                              break;
                          }
                      } else {
                          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                              shouldSwitch = true;
                              break;
                          }
                      }
                  }
                  
                  if (shouldSwitch) {
                      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                      switching = true;
                  }
              }
  
              ascending = !ascending; // Đảo ngược trạng thái sắp xếp sau khi hoàn thành
          }
      </script>
        <table id="myTable" class="table datatable">
          <thead>
            <tr>
              <th scope="col">Số thứ tự</th>
              <th scope="col">Mã bệnh nhân</th>
              <th scope="col">Tên bệnh nhân</th>
              <th scope="col">Giới tính</th>
              <th scope="col">Ngày sinh</th>
              <th scope="col">Số điện thoại</th>
              <th scope="col">CMND</th>
              <th scope="col">Địa chỉ</th>
              <th scope="col">Ngày khám</th>
              <th scope="col">Chỉnh sửa</th>
            </tr>
          </thead>
          <tbody>
            @php
            $counter = 0;
        @endphp
            @foreach($viewData['benhnhans'] as $benhnhan)
            @if($benhnhan->getngayhientai()->format('Y-m-d') == date('Y-m-d'))
              <tr>
                <th scope="row">{{ $counter + 1 }}</th>
                <td>{{$benhnhan->getmabenhnhan()}}</td>
                <td>{{$benhnhan->getten()}}</td>
                <td>{{$benhnhan->getgioitinh()}}</td>
                <td>{{$benhnhan->getngaysinh()}}</td>
                <td>{{$benhnhan->getsodienthoai()}}</td>
                <td>{{$benhnhan->getcmnd()}}</td>
                <td>{{$benhnhan->getdiachi()}}</td>
                <td>{{ htmlspecialchars($benhnhan->getngayhientai()->format('Y-m-d')) }}</td>
                <td>
                  <div class="d-flex justify-content-between">
                    <button  data-bs-toggle="modal" data-bs-target="#edit{{ $benhnhan->id }}" class="btn btn-primary"><i class="bi-pencil"></i></button>
                   <form method="POST" action="{{ route('employee.thembenhnhan.update',['id' => $benhnhan->getid()]) }}">
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
                            <input name="mabenhnhan" type="text"  value="{{$benhnhan->getmabenhnhan()}}"
                            class="form-control">
                            </div>        
                            </div>
                        <br>
                        <div class="mb-3 row">
                          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Bệnh Nhân:</label>
                          <div class="col-lg-10 col-md-6 col-sm-12">
                          <input name="ten" type="text"  value="{{$benhnhan->getten()}}"
                          class="form-control">
                          </div>
                          </div>
                          <br>
                            <div class="mb-3 row">
                              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Giới Tính:</label>
                              <div class="col-lg-10 col-md-6 col-sm-12">
                                <input type="radio" value="Nam" name="gioitinh" {{ $benhnhan->getgioitinh() === 'Nam' ? 'checked' : '' }}>Nam
                              <input type="radio" value="Nữ" name="gioitinh" {{ $benhnhan->getgioitinh() === 'Nữ' ? 'checked' : '' }}>Nữ
                              <input type="hidden" name="gioitinh_default" value="{{ $benhnhan->getgioitinh() }}">
                              </div>
                              </div>          
                            <br>
                            <div class="mb-3 row">
                              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ngày Sinh:</label>
                              <div class="col-lg-10 col-md-6 col-sm-12">
                              <input name="ngaysinh" type="date" value="{{$benhnhan->getngaysinh()}}"
                              class="form-control">
                              </div>
                              </div>       
                              <br>
                              <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Số Điện Thoại:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="sodienthoai" type="text" value="{{$benhnhan->getsodienthoai()}}"
                                class="form-control">
                                </div>
                                </div>       
                                <br>
                              <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">CMND:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="cmnd" type="text" value="{{$benhnhan->getcmnd()}}"
                                class="form-control">
                                </div>
                                </div>   
                                <br>
                              <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Địa Chỉ:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="diachi" type="text" value="{{$benhnhan->getdiachi()}}"
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

                    <button  data-bs-toggle="modal" data-bs-target="#delete{{ $benhnhan->id }}" class="btn btn-danger"><i class="bi-trash"></i></button>
                  </div>
               <form method="POST" action="{{ route('employee.thembenhnhan.delete',['id' => $benhnhan->getid()]) }}">
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
              </form></td>
              </tr>
              @php
              $counter++;
          @endphp
            @endif
          @endforeach
          </tbody>
        </table>
</div>
@endsection
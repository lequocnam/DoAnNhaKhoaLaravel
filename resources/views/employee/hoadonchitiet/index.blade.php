@extends('layouts.app')
@section('title', "Trang Danh Sách Hóa Đơn Chi Tiết")
@section('content')
  <div class="pagetitle">
   
    <h1>Danh Sách Hóa Đơn</h1>
    <nav>
      <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{route('employee.hoadon.index')}}">Danh Sách Hóa Đơn</a></li>
        <li class="breadcrumb-item active">Danh Sách Hóa Đơn Chi Tiết</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Thông Tin Bệnh Nhân</h5>
    <div class="row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Mã Bệnh Nhân:</label>
                          <div class="col-lg-10 col-md-6 col-sm-12">
                          <input name="mabenhnhan" type="text" readonly value="{{$benhnhan->getmabenhnhan()}}"
                          class="form-control">
                          </div>        
                          </div>
                      <br>
                      <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tên Bệnh Nhân:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                        <input name="ten" type="text" readonly value="{{$benhnhan->getten()}}"
                        class="form-control">
                        </div>
                        </div>
                        <br>
                        <form>
                          <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Giới Tính:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                              <input type="radio" disabled name="gioitinh" {{ $benhnhan->getgioitinh() === 'Nam' ? 'checked' : '' }}>Nam
                            <input type="radio" disabled name="gioitinh" {{ $benhnhan->getgioitinh() === 'Nữ' ? 'checked' : '' }}>Nữ
                            </div>
                            </div>
                        </form>                       
                          <br>
                          <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ngày Sinh:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="ngaysinh" readonly type="date" value="{{$benhnhan->getngaysinh()}}"
                            class="form-control">
                            </div>
                            </div>       
                            <br>
                            <div class="mb-3 row">
                              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Số Điện Thoại:</label>
                              <div class="col-lg-10 col-md-6 col-sm-12">
                              <input name="sodienthoai" readonly type="text" value="{{$benhnhan->getsodienthoai()}}"
                              class="form-control">
                              </div>
                              </div>       
                              <br>
                            <div class="mb-3 row">
                              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">CMND:</label>
                              <div class="col-lg-10 col-md-6 col-sm-12">
                              <input name="cmnd" type="text" readonly value="{{$benhnhan->getcmnd()}}"
                              class="form-control">
                              </div>
                              </div>   
                              <br>
                            <div class="mb-3 row">
                              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Địa Chỉ:</label>
                              <div class="col-lg-10 col-md-6 col-sm-12">
                              <input name="diachi" type="text" readonly value="{{$benhnhan->getdiachi()}}"
                              class="form-control">
                              </div>
                              </div>       
    <!-- Table with hoverable rows -->
   
    <div class="card-body">
<h5 class="card-title">Thông Tin Chi Tiết Hóa Đơn</h5>
  </div>
  <input type="text" id="searchInput" placeholder="Nhập từ khóa để tìm kiếm...">

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('tbody tr');
  
        searchInput.addEventListener('input', function () {
            const searchText = searchInput.value.toLowerCase();
  
            rows.forEach(row => {
                const textContent = row.textContent.toLowerCase();
                if (textContent.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
  </script>
    <table id="myTable" class="table datatable">
      <thead>
        <tr>
          <th scope="col">Số Thứ Tự</th>
          <th scope="col">Mã Hóa Đơn</th>
          <th scope="col">Tên Bệnh Nhân</th>
          <th scope="col">Đơn Giá</th>
          <th scope="col">Số Lượng</th>
          <th scope="col">Tổng Tiền</th>
        </tr>
      </thead>
      <tbody>
        @php
            $counter = 0;
        @endphp
        @foreach ($all_hoadon as $hoadon)
        <tr>
          <th scope="row">{{ $counter + 1 }}</th>
          <td>{{$hoadon->mahoadon}}</td>
          <td>{{$hoadon->tenbenhnhan}}</td>
          <td>{{$hoadon->dongia}}</td>
          <td>{{$hoadon->soluong}}</td>
          <td>{{$hoadon->soluong*$hoadon->dongia}}</td>
        </tr>
        @php
            $counter++;
        @endphp
        @endforeach
      </tbody>
    </table>
    <label for="">Tổng Tiền</label>
    <input type="text" readonly name="tongtien" value="{{number_format($tongtien).' '.'vnđ'}}">
    </div>
    </div> 
@endsection
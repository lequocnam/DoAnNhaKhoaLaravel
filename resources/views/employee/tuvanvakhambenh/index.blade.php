@extends('layouts.app');
@section('title','Trang Tư Vấn và khám bệnh')
@section('content')
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="card">
<div class="card-body">

  <a href="{{route('employee.xulyhoadon.index')}}" class="btn btn-primary ml-2 text-white">Thêm Hóa Đơn</a>
  <!-- Table with hoverable rows -->
 
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
      <th scope="col">Chỉnh Sửa</th>
    </tr>
  </thead>
  <tbody>
    @php
        $counter = 0;
    @endphp
    @foreach ($all_hoadon as $hoadon)
    <tr>
      <td scope="row">{{ $counter + 1 }}</td>
      <td>{{$hoadon->mahoadon}}</td>
      <td>{{$hoadon->tenbenhnhan}}</td>
      <td>{{$hoadon->created_at}}</td>
      <td>{{number_format($hoadon->tongtien).' '.'vnđ'}}</td>
      <td>{{$hoadon->httt}}</td>
      <td>   
          @if($hoadon->tinhtrang == 'Chưa Xử Lý')
              Chưa Xử Lý
          @else
              Đã thanh toán
          @endif
      </td>
      <td> @if($hoadon->tinhtrang == 'Chưa Xử Lý')
        <button class="btn btn-success btn-mark-paid" data-id="{{ $hoadon->id }}">Đánh dấu đã thanh toán</button>
        @endif</td>
    </tr>
    @php
        $counter++;
    @endphp
    @endforeach
  </tbody>
</table>

</div>
</div>
<script>
  jQuery(document).ready(function($) {
    $(document).on('click', '.btn-mark-paid', function() {
          var hoaDonId = $(this).data('id');
  
          // Gửi yêu cầu AJAX để đánh dấu hóa đơn đã thanh toán
          $.ajax({
              url: "{{ route('employee.tuvanvakhambenh.markAsPaid') }}",
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
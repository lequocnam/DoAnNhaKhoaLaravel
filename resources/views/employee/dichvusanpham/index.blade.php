
@extends('layouts.app')
@section('title',"Trang Danh Sách Dịch Vụ Sản Phẩm")
@section('content')
<style>
.img-card {
    display: block; /* Đảm bảo ảnh được hiển thị dưới dạng block */
    margin-left: auto; /* Căn giữa ảnh theo chiều ngang */
    margin-right: auto; /* Căn giữa ảnh theo chiều ngang */
    width: 100%; /* Điều chỉnh chiều rộng của ảnh về 100% của container chứa nó */
    height: 200px; /* Thiết lập chiều cao cố định cho tất cả các ảnh */
    object-fit: cover; /* Điều chỉnh ảnh để bảo toàn tỉ lệ mà không bị méo, có thể cắt bớt phần dư thừa */
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="alert alert-success" id="success-alert">
    {{ Session::get('message') }}
</div>

<script>
    $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });
</script>
<div class="pagetitle">
    <h1>Danh Sách Sản Phẩm</h1>
    <nav>
      <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Danh Sách Sản Phẩm</li>
      </ol>
    </nav>
  </div>
  <div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-10">
            <div class="col">
                <!-- Phần hóa đơn -->
                <div class="rounded-full bg-blue-200 px-4 py-2 flex items-center justify-content-end">
                    <a href="{{route('employee.xulyhoadon.index')}}" class="btn btn-primary ml-2 text-white">
                        <i class="ri-shopping-bag-line text-blue"></i>
                        Hóa Đơn({{\Gloudemans\Shoppingcart\Facades\Cart::content()->count()
                        }})
                    </a> 
                    <!-- Nút Hóa đơn -->
                    <!-- Biểu tượng giỏ hàng -->
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($viewData['dichvusanphams'] as $dichvusanpham)
            <div class="col-md-4 col-lg-3 mb-2">
                <div class="card">
                    <img src="{{ '/hinhanh/'.$dichvusanpham->anh }}" id="a" alt="img" class="card-img-top img-card">
                    <div class="row justify-content-center">
                        <div class="col">
                            <p class="text-center">{{ $dichvusanpham->getten() }}</p>
                        </div>
                    </div>
                    <div class="card-body text-center">        
                        <form action="{{route('employee.xulyhoadon.add')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <input type="number" name="quantity" class="form-control" value="1" min="1">
                                    <input type="hidden" name="id_hidden" class="form-control" value="{{$dichvusanpham->getid()}}">
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary">Thêm Vào Hóa Đơn</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
    @endsection
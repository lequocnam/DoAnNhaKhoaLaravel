<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Data\DataBenhNhanController;
use App\Http\Controllers\Admin\Data\DataNhanVienController;
use App\Http\Controllers\Admin\Data\DataDichVuSanPhamController;
use App\Http\Controllers\Admin\Data\DataLichHenController;
use App\Http\Controllers\Admin\Data\DataHoaDonController;
use App\Http\Controllers\Admin\Data\DataHoaDonchitietController;
use App\Http\Controllers\Admin\Data\DataPhongKhamController;
use App\Http\Controllers\XuLyHoaDonController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Trang welcome

Route::get('/', [DataDichVuSanPhamController::class, 'indexuser'])->name('tranguser.index');
Route::post('/', [DatalichhenController::class, 'data2'])->name('tranguser.data2');

Route::get('/home', function () {
   $viewData=[];
   $viewData["title"] = "Nha Khoa - Laravel";
   return view('home') -> with("viewData",$viewData);
});
//Trang Điều Khiển Do Nhân Viên

// Bệnh Nhân Do Nhân Viên
Route::prefix('employee')->group(function () {
   Route::get('/', [DatahoadonController::class, 'index2'])->name('employee.tuvanvakhambenh.index');
   // Hóa Đơn
  Route::get('/hoadon', [DatahoadonController::class, 'index1'])->name('employee.hoadon.index');
  Route::get('/hoadon/search', [DatahoadonController::class, 'searchByDate1'])->name('employee.hoadon.searchByDate');
  Route::post('/hoadon', [DatahoadonController::class, 'data1'])->name('employee.hoadon.data1');
  Route::delete('/hoadon/{id}', [DatahoadonController::class, 'delete'])->name('employee.hoadon.delete');
  Route::post('/hoadon/markAsPaid', [DataHoaDonController::class, 'markAsPaid'])->name('employee.hoadon.markAsPaid');
  // Tư Vấn Và Khám Bệnh
Route::get('/tuvanvakhambenh', [DatahoadonController::class, 'index2'])->name('employee.tuvanvakhambenh.index');
Route::post('/tuvanvakhambenh/markAsPaid', [DataHoaDonController::class, 'markAsPaid'])->name('employee.tuvanvakhambenh.markAsPaid');

  // Hóa Đơn chi tiết
  Route::get('/hoadonchitiet/{id}/{idhd}', [DatahoadonchitietController::class, 'index1'])->name('employee.hoadonchitiet.index');
// Bệnh nhân
Route::get('/benhnhan', [DataBenhNhanController::class, 'index1'])->name('employee.benhnhan.index');
Route::post('/benhnhan', [DataBenhNhanController::class, 'data1'])->name('employee.benhnhan.data');
Route::delete('/benhnhan/{id}', [DataBenhNhanController::class, 'delete'])->name('employee.benhnhan.delete');
Route::put('/benhnhan/{id}', [DataBenhNhanController::class, 'update1'])->name('employee.benhnhan.update');
   // Lịch Hẹn
   Route::get('/lichhen', [DatalichhenController::class, 'index1'])->name('employee.lichhen.index');
   Route::post('/lichhen', [DatalichhenController::class, 'data1'])->name('employee.lichhen.data');
   Route::delete('/lichhen/{id}', [DatalichhenController::class, 'delete'])->name('employee.lichhen.delete');
   Route::put('/lichhen/{id}', [DatalichhenController::class, 'update1'])->name('employee.lichhen.update');

Route::get('/thembenhnhan', [DataBenhNhanController::class, 'indextructiep'])->name('employee.thembenhnhan.index');
Route::post('/thembenhnhan', [DataBenhNhanController::class, 'datatructiep'])->name('employee.thembenhnhan.datatructiep');
Route::delete('/thembenhnhan/{id}', [DataBenhNhanController::class, 'delete'])->name('employee.thembenhnhan.delete');
Route::put('/thembenhnhan/{id}', [DataBenhNhanController::class, 'updatetructiep'])->name('employee.thembenhnhan.update');

// Xử Lý Hóa Đơn
Route::get('/xulyhoadon', [XuLyHoaDonController::class, 'index'])->name('employee.xulyhoadon.index');
Route::get('/thanhtoan', [XuLyHoaDonController::class, 'indexthanhtoan'])->name('employee.thanhtoan.index');
Route::post('/xulyhoadon/luuDuLieu', [XuLyHoaDonController::class, 'luuDuLieu'])->name('employee.xulyhoadon.luuDuLieu');

Route::get('/dichvusanpham', [DataDichVuSanPhamController::class, 'index1'])->name('employee.dichvusanpham.index');
Route::get('/xulyhoadon/delete/{rowId}', [XuLyHoaDonController::class, 'delete'])->name('employee.xulyhoadon.delete');
Route::get('/xulyhoadon/search', [XuLyHoaDonController::class, 'search'])->name('employee.xulyhoadon.search');

Route::post('/xulyhoadon/updatesoluong', [XuLyHoaDonController::class, 'updatesoluong'])->name('employee.xulyhoadon.updatesoluong');


Route::post('/xulyhoadon', [XuLyHoaDonController::class, 'add'])->name('employee.xulyhoadon.add');
});

Route::middleware('admin')->group(function(){

   Route::prefix('admin')->group(function () {
      // Bệnh nhân
      Route::get('/',
'App\Http\Controllers\Admin\AdminHomeController@index')
->name("admin.home.index");
         Route::get('/benhnhan', [DataBenhNhanController::class, 'index'])->name('admin.benhnhan.index');
         Route::post('/benhnhan', [DataBenhNhanController::class, 'data'])->name('admin.benhnhan.data');
         Route::delete('/benhnhan/{id}', [DataBenhNhanController::class, 'delete'])->name('admin.benhnhan.delete');
         Route::put('/benhnhan/{id}', [DataBenhNhanController::class, 'update'])->name('admin.benhnhan.update');
      // Nhân viên
         Route::get('/nhanvien', [DataNhanVienController::class, 'index'])->name('admin.nhanvien.index');
         Route::post('/nhanvien', [DataNhanVienController::class, 'data'])->name('admin.nhanvien.data');
         Route::delete('/nhanvien/{id}', [DataNhanVienController::class, 'delete'])->name('admin.nhanvien.delete');
         Route::put('/nhanvien/{id}', [DataNhanVienController::class, 'update'])->name('admin.nhanvien.update');
      // Dịch Vụ Sản PHẩm
      Route::get('/dichvusanpham', [DataDichVuSanPhamController::class, 'index'])->name('admin.dichvusanpham.index');
      Route::post('/dichvusanpham', [DataDichVuSanPhamController::class, 'data'])->name('admin.dichvusanpham.data');
      Route::delete('/dichvusanpham/{id}', [DataDichVuSanPhamController::class, 'delete'])->name('admin.dichvusanpham.delete');
      Route::put('/dichvusanpham/{id}', [DataDichVuSanPhamController::class, 'update'])->name('admin.dichvusanpham.update');
      // Lịch Hẹn
      Route::get('/lichhen', [DatalichhenController::class, 'index'])->name('admin.lichhen.index');
      Route::post('/lichhen', [DatalichhenController::class, 'data'])->name('admin.lichhen.data');
      Route::delete('/lichhen/{id}', [DatalichhenController::class, 'delete'])->name('admin.lichhen.delete');
      Route::put('/lichhen/{id}', [DatalichhenController::class, 'update'])->name('admin.lichhen.update');
      // Phòng Khám
      Route::get('/phongkham', [DataphongkhamController::class, 'index'])->name('admin.phongkham.index');
      Route::post('/phongkham', [DataphongkhamController::class, 'data'])->name('admin.phongkham.data');
      Route::delete('/phongkham/{id}', [DataphongkhamController::class, 'delete'])->name('admin.phongkham.delete');
      Route::put('/phongkham/{id}', [DataphongkhamController::class, 'update'])->name('admin.phongkham.update');
      // Hóa Đơn
      Route::post('/hoadon/markAsPaid', [DataHoaDonController::class, 'markAsPaid'])->name('admin.hoadon.markAsPaid');
      Route::get('/hoadon', [DatahoadonController::class, 'index'])->name('admin.hoadon.index');
      Route::get('/hoadon/search', [DatahoadonController::class, 'searchByDate'])->name('admin.hoadon.searchByDate');
      Route::post('/hoadon', [DatahoadonController::class, 'data'])->name('admin.hoadon.data');
      Route::delete('/hoadon/{id}', [DatahoadonController::class, 'delete'])->name('admin.hoadon.delete');
      // Hóa Đơn chi tiết
      Route::get('/hoadonchitiet/{id}/{idhd}', [DatahoadonchitietController::class, 'index'])->name('admin.hoadonchitiet.index');

      }); 
});





Auth::routes();

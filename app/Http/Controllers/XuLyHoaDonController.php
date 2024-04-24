<?php

namespace App\Http\Controllers;
use App\Http\Controllers\mysqli;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\BenhNhan;
use App\Models\HoaDon;
use App\Models\DichVuSanPham;
use App\Models\HoaDonChiTiet;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class XuLyHoaDonController extends Controller
{
 
        public function index()
        {
          $viewData["hoadons"]= HoaDon::all();
          $viewData["nhanviens"]= NhanVien::all();
          $viewData["benhnhans"] = BenhNhan::all();
          $viewData["dichvusanphams"] = DichVuSanPham::all();

        return view('employee.xulyhoadon.index')->with("viewData", $viewData);
        }   


        public function indexthanhtoan()
        {
          $viewData["hoadons"]= HoaDon::all();
          $viewData["nhanviens"]= NhanVien::all();
          $viewData["benhnhans"] = BenhNhan::all();
          $viewData["dichvusanphams"] = DichVuSanPham::all();

        return view('employee.thanhtoan.index')->with("viewData", $viewData);
        } 
        public function luuDuLieu(Request $request)
        {
          $data=Cart::content();
          
      foreach ($data as $sanPham) {
        $hoadonchitiet = new HoaDonChiTiet;
         $hoadonchitiet->mahoadon = $request->input('mahoadon');
         $hoadonchitiet->mabenhnhan= $request->input('mabenhnhan');
         $hoadonchitiet->tendichvusanpham = $sanPham->name;
         $hoadonchitiet->madichvusanpham = $sanPham->options->get('madichvusanpham');
         $hoadonchitiet->dongia = $sanPham->price;
         $hoadonchitiet->soluong = $sanPham->qty;
         $ghiChuSanPham = $request->input("ghichu." . $sanPham->id, 'Ghi chú mặc định nếu không có');
    $hoadonchitiet->ghichu = $ghiChuSanPham;
         $hoadonchitiet->save();
      }
      $hoadon = new Hoadon;
      $hoadon->mahoadon = $request->input('mahoadon');
      $hoadon->mabenhnhan = $request->input('mabenhnhan');
      $hoadon->tenbenhnhan = $request->input('tenbenhnhan');
      $hoadon->tennhanvien = $request->input('tennhanvien');
      
      // Loại bỏ dấu phẩy khỏi giá trị 'tongtien'
      $tongtien = str_replace(',', '', $request->input('tongtien'));
      $hoadon->tongtien = $tongtien;
      $hoadon->tinhtrang = 'Chưa Xử Lý';
      $hoadon->httt = $request->input('httt');
      $hoadon->save();
Cart::destroy();
    return redirect()->route('employee.tuvanvakhambenh.index');
}      
 public function add(Request $request)
{
  $id = $request->id_hidden;
    $quantity=$request->quantity;
    $check = DB::table('dichvusanphams')->where('id',$id)->first();
    $data['id']=$check->id;
    $data['ten'] = $check->ten;
    $data['dongia'] = $check->dongia;
    $data['quantity'] = $quantity;
    $data['madichvusanpham']=$check->madichvusanpham;
    $data['anh']= $check->anh;
  Cart::add(['id' =>  $data['id'],
     'name'=>  $data['ten'],
      'qty'=> $data['quantity'],
       'price' =>  $data['dongia'],
       'options' => ['madichvusanpham' => $data['madichvusanpham'],
                      'anh'=>$data['anh']
      ],
      ]);
      session::flash('message','Thêm Dịch Vụ Sản Phẩm Thành Công!');
    return redirect::to('/employee/dichvusanpham');
}

public function delete($rowId)
{
  Cart::update($rowId,0);
  return redirect::to('/employee/xulyhoadon');
}

public function updatesoluong(Request $request)
{
$rowId= $request->input('rowidhidden');
$qty= $request->input('quantity');
  Cart::update($rowId,$qty);
  return redirect::to('/employee/xulyhoadon');
}

}

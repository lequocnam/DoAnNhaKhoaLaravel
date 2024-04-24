<?php

namespace App\Http\Controllers\Admin\Data;
use App\Models\DichVuSanPham;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DataDichVuSanPhamController extends Controller
{
    public function data(Request $request)
{
$request->validate([
"madichvusanpham" => "required",
"ten" => "required|max:255",
"dongia" => "required|numeric|gt:0",
'anh' => "nullable|mimes:png,jpg,webp"
]);
if($request->has('anh'))
{
    $file= $request->file('anh');
    $extension = $file->getClientOriginalExtension();
    $filename= time().'.'.$extension;
    $path ='hinhanh/';
    $file->move($path, $filename);
}
DichVuSanPham::create(
    ['madichvusanpham'=> $request->madichvusanpham,
'anh' => $request->$path.$filename,
'ten' => $request->ten,
'dongia' => $request->dongia,]
);
return redirect()->route('admin.dichvusanpham.index')->with('success', 'Thêm Dịch Vụ Sản Phẩm thành công');
}
public function delete($id)
{
    DichVuSanPham::destroy($id);
return back();
}
public function index()
{
$viewData = [];
$viewData["dichvusanphams"] = DichVuSanPham::all();
$viewData["dichvusanphams"] = DichVuSanPham::orderBy('updated_at', 'desc')->get(); // Sắp xếp từ mới nhất đến cũ nhất
return view('admin.dichvusanpham.index')->with("viewData", $viewData);
}

public function indexuser()
{
$viewData = [];
$viewData["dichvusanphams"] = DichVuSanPham::all();
return view('tranguser.index')->with("viewData", $viewData);
}

public function index1()
{
    $viewData = [];
    $viewData["title"] = "dichvusanphams";
    $viewData["subtitle"] = "List of dichvusanphams";
    $viewData["dichvusanphams"] = DichVuSanPham::all();
    $cart = Cart::content(); // Đoạn này giả sử bạn đang sử dụng Cart model

    return view('employee.dichvusanpham.index')->with("viewData", $viewData)->with("cart", $cart);
}

public function update(Request $request, $id)
{
    $request->validate([
        "madichvusanpham" => "required",
        "ten" => "required|max:255",
        "dongia" => "required|numeric|gt:0",
        'anh' => "nullable|mimes:png,jpg,webp"
    ]);

    $dichvusanpham = DichVuSanPham::findOrFail($id);
    $filename = $dichvusanpham->anh; // Giữ lại tên ảnh cũ

    if ($request->hasFile('anh')) {
        $file = $request->file('anh');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $path = 'hinhanh/';

        if(File::exists(public_path($path.$dichvusanpham->anh))) {
            File::delete(public_path($path.$dichvusanpham->anh));
        }

        $file->move(public_path($path), $filename);
    }

    $dichvusanpham->update([
        'madichvusanpham'=> $request->madichvusanpham,
        'anh' => $filename, // Sửa lại cách gán đường dẫn ảnh
        'ten' => $request->ten,
        'dongia' => $request->dongia,
    ]);
    return redirect()->route('admin.dichvusanpham.index')->with('success', 'Cập nhật Dịch Vụ Sản Phẩm thành công');
}
}

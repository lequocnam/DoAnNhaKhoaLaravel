<?php

namespace App\Http\Controllers\Admin\Data;
use App\Models\BenhNhan;
use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class DataNhanVienController extends Controller
{
    public function data(Request $request)
{
$request->validate([
"manhanvien" => "required",
"ten" => "required|max:255",
"gioitinh" => "required",
"ngaysinh" => "required",
"sodienthoai" => "required",
"cmnd" => "required",
"diachi" => "required",
"email" => "required",
"loai" => "required",
"anh" =>  "nullable|mimes:png,jpg,webp",

]);

if($request->has('anh'))
{
    $file= $request->file('anh');
    $extension = $file->getClientOriginalExtension();
    $filename= time().'.'.$extension;
    $path ='hinhanh/';
    $file->move($path, $filename);
}
nhanvien::create(
    ['manhanvien'=> $request->manhanvien,
'anh' => $request->$path.$filename,
'ten' => $request->ten,
'gioitinh' => $request->gioitinh,
'ngaysinh' => $request->ngaysinh,
'sodienthoai' => $request->sodienthoai,
'cmnd' => $request->cmnd,
'diachi' => $request->diachi,
'email' => $request->email,
'loai' => $request->loai,
]
);


return redirect()->route('admin.nhanvien.index')->with('success', 'Thêm bệnh nhân thành công');
}
public function delete($id)
{
    NhanVien::destroy($id);
return back();
}
public function index()
{
$viewData = [];
$viewData["title"] = "nhanviens";
$viewData["subtitle"] = "List of nhanviens";
$viewData["nhanviens"] = NhanVien::all();
return view('admin.nhanvien.index')->with("viewData", $viewData);
}
public function update(Request $request, $id)
{
    $request->validate([
        "manhanvien" => "required",
        "ten" => "required|max:255",
        "gioitinh" => "required",
        "ngaysinh" => "required",
        "sodienthoai" => "required",
        "cmnd" => "required",
        "diachi" => "required",
        "email" => "required",
        "loai" => "required",
        "anh" => "nullable|mimes:png,jpg,webp",
    ]);
    
    $nhanvien = nhanvien::findOrFail($id);
    
    $filename = $nhanvien->anh; // Giữ lại tên ảnh cũ
    
    // Kiểm tra xem người dùng đã tải lên một tệp hình ảnh mới hay không
    if ($request->hasFile('anh')) {
        $file = $request->file('anh');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $path ='hinhanh/';
    
        // Xóa tệp hình ảnh cũ nếu tồn tại
        if(File::exists(public_path($path.$nhanvien->anh))) {
            File::delete(public_path($path.$nhanvien->anh));
        }
    
        // Lưu tệp hình ảnh mới
        $file->move(public_path($path), $filename);
    }
    
    // Cập nhật nhân viên trong cơ sở dữ liệu, bao gồm cả ảnh mới nếu có
    $nhanvien->update([
        'manhanvien'=> $request->manhanvien,
        'anh' => $filename, // Chỉ lưu tên file ảnh
        'ten' => $request->ten,
        'gioitinh' => $request->gioitinh,
        'ngaysinh' => $request->ngaysinh,
        'sodienthoai' => $request->sodienthoai,
        'cmnd' => $request->cmnd,
        'diachi' => $request->diachi,
        'email' => $request->email,
        'loai' => $request->loai,
    ]);
    
    return redirect()->route('admin.nhanvien.index')->with('success', 'Cập nhật thông tin nhân viên thành công!');
}
}
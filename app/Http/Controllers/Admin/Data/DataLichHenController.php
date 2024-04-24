<?php

namespace App\Http\Controllers\Admin\Data;
use App\Models\LichHen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataLichHenController extends Controller
{
    public function data(Request $request)
{
$request->validate([
    "malichhen" => "required",
    "ten" => "required|max:255",
    "gioitinh" => "required",
    "sodienthoai" => "required",
    "diachi" => "required",
    "noidungkham" => "required",
    "ngayhen" => "required",
    "ngaydukien" => "required",
    "trangthai" => "required",

]);
$creationData = $request->only(["malichhen","ten", "gioitinh","sodienthoai","diachi","noidungkham","ngayhen","ngaydukien","trangthai"]);
lichhen::create($creationData);
return redirect()->route('admin.lichhen.index')->with('success', 'Thêm bệnh nhân thành công');
}
//Xóa

public function delete($id)
{
    lichhen::destroy($id);
return back();
}
//Trang chủ
public function index()
{
$viewData = [];
$viewData["title"] = "lichhens";
$viewData["subtitle"] = "List of lichhens";
$viewData["lichhens"] = lichhen::all();
return view('admin.lichhen.index')->with("viewData", $viewData);
}
// Thêm
public function update(Request $request, $id)
{
    $request->validate([
        "malichhen" => "required",
"ten" => "required|max:255",
"gioitinh" => "required",
"sodienthoai" => "required",
"diachi" => "required",
"noidungkham" => "required",
"ngayhen" => "required",
"ngaydukien" => "required",
"trangthai" => "required",
        ]);
        $lichhen = lichhen::findOrFail($id);
        $lichhen -> malichhen= $request->input("malichhen");
        $lichhen -> ten= $request->input("ten");
        $lichhen -> gioitinh= $request->input("gioitinh");
        $lichhen -> ngayhen= $request->input("ngayhen");
        $lichhen -> sodienthoai= $request->input("sodienthoai");
        $lichhen -> ngaydukien= $request->input("ngaydukien");
        $lichhen -> diachi= $request->input("diachi");
        $lichhen -> trangthai= $request->input("trangthai");
        $lichhen -> noidungkham= $request->input("noidungkham");
        $lichhen->save();
        if ($lichhen->update($request->all())) {
            return redirect()->route('admin.lichhen.index');
        } else {
            // Xử lý lỗi nếu cần
            return back()->withInput()->withErrors('Cập nhật thất bại');
        }
 return redirect()->route('admin.lichhen.index');
}
//trang nhân viên
public function data1(Request $request)
{
$request->validate([
    "malichhen" => "required",
    "ten" => "required|max:255",
    "gioitinh" => "required",
    "sodienthoai" => "required",
    "diachi" => "required",
    "noidungkham" => "required",
    "ngayhen" => "required",
    "ngaydukien" => "required",
    "trangthai" => "required",

]);
$creationData = $request->only(["malichhen","ten", "gioitinh","sodienthoai","diachi","noidungkham","ngayhen","ngaydukien","trangthai"]);
lichhen::create($creationData);
return redirect()->route('employee.lichhen.index')->with('success', 'Thêm bệnh nhân thành công');
}

public function index1()
{
$viewData = [];
$viewData["title"] = "lichhens";
$viewData["subtitle"] = "List of lichhens";
$viewData["lichhens"] = lichhen::all();
return view('employee.lichhen.index')->with("viewData", $viewData);
}
public function update1(Request $request, $id)
{
    $request->validate([
        "malichhen" => "required",
"ten" => "required|max:255",
"gioitinh" => "required",
"sodienthoai" => "required",
"diachi" => "required",
"noidungkham" => "required",
"ngayhen" => "required",
"ngaydukien" => "required",
"trangthai" => "required",
        ]);
        $lichhen = lichhen::findOrFail($id);
        $lichhen -> malichhen= $request->input("malichhen");
        $lichhen -> ten= $request->input("ten");
        $lichhen -> gioitinh= $request->input("gioitinh");
        $lichhen -> ngayhen= $request->input("ngayhen");
        $lichhen -> sodienthoai= $request->input("sodienthoai");
        $lichhen -> ngaydukien= $request->input("ngaydukien");
        $lichhen -> diachi= $request->input("diachi");
        $lichhen -> trangthai= $request->input("trangthai");
        $lichhen -> noidungkham= $request->input("noidungkham");
        $lichhen->save();
        if ($lichhen->update($request->all())) {
            return redirect()->route('employee.lichhen.index')->with('success', 'Cập nhật bệnh nhân thành công');
        } else {
            // Xử lý lỗi nếu cần
            return back()->withInput()->withErrors('Cập nhật thất bại');
        }
 return redirect()->route('employee.lichhen.index');
}

public function data2(Request $request)
{
$request->validate([
    "malichhen" => "required",
    "ten" => "required|max:255",
    "gioitinh" => "required",
    "sodienthoai" => "required",
    "diachi" => "required",
    "noidungkham" => "required",
    "ngaydukien" => "required",
]);
$lichhen = new lichhen;
$lichhen -> malichhen= $request->input("malichhen");
$lichhen -> ten= $request->input("ten");
$lichhen -> gioitinh= $request->input("gioitinh");
$lichhen -> ngayhen= date("Y-m-d");
$lichhen -> sodienthoai= $request->input("sodienthoai");
$lichhen -> ngaydukien= $request->input("ngaydukien");
$lichhen -> diachi= $request->input("diachi");
$lichhen -> trangthai= 'Chưa Đến';
$lichhen -> noidungkham= $request->input("noidungkham");
$lichhen->save();
return redirect()->route('tranguser.index')->with('success', 'Thêm bệnh nhân thành công');
}
}

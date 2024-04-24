<?php

namespace App\Http\Controllers\Admin\Data;
use App\Models\BenhNhan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataBenhNhanController extends Controller
{
    public function data(Request $request)
{
$request->validate([
"mabenhnhan" => "required",
"ten" => "required|max:255",
"gioitinh" => "required",
"ngaysinh" => "required",
"sodienthoai" => "required",
"cmnd" => "required",
"diachi" => "required",
]);
$creationData = $request->only(["mabenhnhan","ten", "gioitinh","ngaysinh", "sodienthoai","cmnd","diachi"]);
BenhNhan::create($creationData);
return redirect()->route('admin.benhnhan.index')->with('success', 'Thêm bệnh nhân thành công');
}

public function data1(Request $request)
{
$request->validate([
"mabenhnhan" => "required",
"ten" => "required|max:255",
"gioitinh" => "required",
"ngaysinh" => "required",
"sodienthoai" => "required",
"cmnd" => "required",
"diachi" => "required",
]);
$creationData = $request->only(["mabenhnhan","ten", "gioitinh","ngaysinh", "sodienthoai","cmnd","diachi"]);
BenhNhan::create($creationData);
return redirect()->route('employee.benhnhan.index')->with('success', 'Thêm bệnh nhân thành công');
}

public function datatructiep(Request $request)
{
$request->validate([
"mabenhnhan" => "required",
"ten" => "required|max:255",
"gioitinh" => "required",
"ngaysinh" => "required",
"sodienthoai" => "required",
"cmnd" => "required",
"diachi" => "required",
]);
$creationData = $request->only(["mabenhnhan","ten", "gioitinh","ngaysinh", "sodienthoai","cmnd","diachi"]);
BenhNhan::create($creationData);
return redirect()->route('employee.thembenhnhan.index')->with('success', 'Thêm bệnh nhân thành công');
}

public function delete($id)
{
    BenhNhan::destroy($id);
return back();
}
public function index()
{
$viewData = [];
$viewData["title"] = "benhnhans  ";
$viewData["subtitle"] = "List of benhnhans";
$viewData["benhnhans"] = BenhNhan::all();
return view('admin.benhnhan.index')->with("viewData", $viewData);
}

public function index1()
{
$viewData = [];
$viewData["title"] = "benhnhans  ";
$viewData["subtitle"] = "List of benhnhans";
$viewData["benhnhans"] = BenhNhan::all();
return view('employee.benhnhan.index')->with("viewData", $viewData);
}

public function indextructiep()
{
$viewData = [];
$viewData["title"] = "benhnhans  ";
$viewData["subtitle"] = "List of benhnhans";
$viewData["benhnhans"] = BenhNhan::all();
return view('employee.thembenhnhan.index')->with("viewData", $viewData);
}

public function tuvanvakhambenh()
{
$viewData = [];
$viewData["title"] = "Tu Van  ";
$viewData["benhnhans"] = BenhNhan::all();
return view('employee.tuvanvakhambenh.index')->with("viewData", $viewData);
}

public function dulieu($id)
{
    $viewData = [];
    $viewData["benhnhan"] = BenhNhan::findOrFail($id);
    return view('employee.tuvanvakhambenh.chitietbenhnhan.index')->with("viewData", $viewData);
}
public function update(Request $request, $id)
{
    $request->validate([
        "mabenhnhan" => "required",
        "ten" => "required|max:255",
        "gioitinh" => "required",
        "ngaysinh" => "required",
        "sodienthoai" => "required",
        "cmnd" => "required",
        "diachi" => "required",
        ]);
        $benhnhan = BenhNhan::findOrFail($id);
        $benhnhan -> mabenhnhan= $request->input("mabenhnhan");
        $benhnhan -> ten= $request->input("ten");
        $benhnhan -> gioitinh= $request->input("gioitinh");
        $benhnhan -> ngaysinh= $request->input("ngaysinh");
        $benhnhan -> sodienthoai= $request->input("sodienthoai");
        $benhnhan -> cmnd= $request->input("cmnd");
        $benhnhan -> diachi= $request->input("diachi");
        $benhnhan->save();
        if ($benhnhan->update($request->all())) {
            return redirect()->route('admin.benhnhan.index')->with('success', 'Cập nhật bệnh nhân thành công');;
        } else {
            // Xử lý lỗi nếu cần
            return back()->withInput()->withErrors('Cập nhật thất bại');
        }
 return redirect()->route('admin.benhnhan.index');
}

public function update1(Request $request, $id)
{
    $request->validate([
        "mabenhnhan" => "required",
        "ten" => "required|max:255",
        "gioitinh" => "required",
        "ngaysinh" => "required",
        "sodienthoai" => "required",
        "cmnd" => "required",
        "diachi" => "required",
        ]);
        $benhnhan = BenhNhan::findOrFail($id);
        $benhnhan -> mabenhnhan= $request->input("mabenhnhan");
        $benhnhan -> ten= $request->input("ten");
        $benhnhan -> gioitinh= $request->input("gioitinh");
        $benhnhan -> ngaysinh= $request->input("ngaysinh");
        $benhnhan -> sodienthoai= $request->input("sodienthoai");
        $benhnhan -> cmnd= $request->input("cmnd");
        $benhnhan -> diachi= $request->input("diachi");
        $benhnhan->save();
        if ($benhnhan->update($request->all())) {
            return redirect()->route('employee.benhnhan.index')->with('success', 'Cập nhật bệnh nhân thành công');
        } else {
            // Xử lý lỗi nếu cần
            return back()->withInput()->withErrors('Cập nhật thất bại');
        }
 return redirect()->route('employee.benhnhan.index');
}

public function updatetructiep(Request $request, $id)
{
    $request->validate([
        "mabenhnhan" => "required",
        "ten" => "required|max:255",
        "gioitinh" => "required",
        "ngaysinh" => "required",
        "sodienthoai" => "required",
        "cmnd" => "required",
        "diachi" => "required",
        ]);
        $benhnhan = BenhNhan::findOrFail($id);
        $benhnhan -> mabenhnhan= $request->input("mabenhnhan");
        $benhnhan -> ten= $request->input("ten");
        $benhnhan -> gioitinh= $request->input("gioitinh");
        $benhnhan -> ngaysinh= $request->input("ngaysinh");
        $benhnhan -> sodienthoai= $request->input("sodienthoai");
        $benhnhan -> cmnd= $request->input("cmnd");
        $benhnhan -> diachi= $request->input("diachi");
        $benhnhan->save();
        if ($benhnhan->update($request->all())) {
            return redirect()->route('employee.thembenhnhan.indextructiep')->with('success', 'Cập nhật bệnh nhân thành công');
        } else {
            // Xử lý lỗi nếu cần
            return back()->withInput()->withErrors('Cập nhật thất bại');
        }
 return redirect()->route('employee.thembenhnhan.indextructiep');
}
}
<?php

namespace App\Http\Controllers\Admin\Data;
use App\Models\PhongKham;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataPhongKhamController extends Controller
{
    public function data(Request $request)
    {
    $request->validate([
    "maphongkham" => "required",
    "tenphongkham" => "required",
    ]);
    $creationData = $request->only(["maphongkham","tenphongkham"]);
    phongkham::create($creationData);
    
    return redirect()->route('admin.phongkham.index')->with('success', 'Thêm Phòng Khám thành công');
    }
    public function delete($id)
    {
        phongkham::destroy($id);
    return back();
    }
    public function index()
    {
    $viewData = [];
    $viewData["title"] = "phongkhams";
    $viewData["phongkhams"] = phongkham::all();
    return view('admin.phongkham.index')->with("viewData", $viewData);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "maphongkham" => "required",
            "tenphongkham" => "required",
            ]);
            $phongkham = phongkham::findOrFail($id);
            $phongkham -> maphongkham= $request->input("maphongkham");
            $phongkham -> tenphongkham= $request->input("tenphongkham");
            $phongkham->save();
            if ($phongkham->update($request->all())) {
                return redirect()->route('admin.phongkham.index')->with('success', 'Cập nhật Phòng Khám thành công');
            } else {
                // Xử lý lỗi nếu cần
                return back()->withInput()->withErrors('Cập nhật thất bại');
            }
     return redirect()->route('admin.phongkham.index');
    }
}

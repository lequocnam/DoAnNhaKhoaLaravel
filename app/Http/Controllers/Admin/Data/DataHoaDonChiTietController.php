<?php

namespace App\Http\Controllers\Admin\Data;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BenhNhan;

class DataHoaDonChiTietController extends Controller
{
   
    public function index($id,$idhd)
    {
    $viewData = [];
    $viewData["title"] = "hoadons";
    $benhnhan =BenhNhan::where('mabenhnhan', $id)->firstOrFail();
    $all_hoadon = DB::table('hoadons')
    ->join('benhnhans','benhnhans.ten','=','hoadons.tenbenhnhan')
    ->join('hoadonchitiets','hoadonchitiets.mahoadon','=','hoadons.mahoadon')
    ->select('hoadons.*','benhnhans.ten','benhnhans.mabenhnhan','hoadonchitiets.tendichvusanpham','hoadonchitiets.mahoadon','hoadonchitiets.soluong','hoadonchitiets.dongia')
    ->where('hoadons.mahoadon', $idhd) // Sửa thành 'hoadons.mahoadon'
    ->orderBy('hoadons.id','desc')->get();
    $tongtien = $all_hoadon->sum('tongtien');
    return view('admin.hoadonchitiet.index', compact('viewData', 'all_hoadon','benhnhan','tongtien'));
    }
    public function index1($id,$idhd)
    {
    $viewData = [];
    $viewData["title"] = "hoadons";
    $benhnhan =BenhNhan::where('mabenhnhan', $id)->firstOrFail();
    $all_hoadon = DB::table('hoadons')
    ->join('benhnhans','benhnhans.ten','=','hoadons.tenbenhnhan')
    ->join('hoadonchitiets','hoadonchitiets.mahoadon','=','hoadons.mahoadon')
    ->select('hoadons.*','benhnhans.ten','benhnhans.mabenhnhan','hoadonchitiets.tendichvusanpham','hoadonchitiets.mahoadon','hoadonchitiets.soluong','hoadonchitiets.dongia')
    ->where('hoadons.mahoadon', $idhd) // Sửa thành 'hoadons.mahoadon'
    ->orderBy('hoadons.id','desc')
    ->get();
    $tongtien = $all_hoadon->sum('tongtien');
    return view('employee.hoadonchitiet.index', compact('viewData', 'all_hoadon','benhnhan','tongtien'));
    }
}

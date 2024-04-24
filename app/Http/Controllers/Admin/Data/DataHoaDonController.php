<?php

namespace App\Http\Controllers\Admin\Data;
use App\Models\HoaDon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataHoaDonController extends Controller
{
    public function delete($id)
    {
        hoadon::destroy($id);
    return back();
    }
    public function index()
    {
    $all_hoadon = DB::table('hoadons')
    ->join('benhnhans','benhnhans.ten','=','hoadons.tenbenhnhan')
    ->select('hoadons.*','benhnhans.ten')
    ->orderBy('hoadons.id','desc')->get();
    $tongtien = $all_hoadon->sum('tongtien');
    return view('admin.hoadon.index', compact('all_hoadon','tongtien'));
    }
 
    public function searchByDate(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        // Thực hiện truy vấn để lấy dữ liệu từ ngày bắt đầu đến ngày kết thúc
        $all_hoadon = DB::table('hoadons')
            ->join('benhnhans', 'benhnhans.ten', '=', 'hoadons.tenbenhnhan')
            ->select('hoadons.*', 'benhnhans.ten')
            ->whereDate('hoadons.created_at', '>=', $startDate)
            ->whereDate('hoadons.created_at', '<=', $endDate)
            ->orderBy('hoadons.id', 'desc')
            ->get();
        $tongtien = $all_hoadon->sum('tongtien');
        return view('admin.hoadon.index', compact('all_hoadon' ,'startDate' ,'endDate','tongtien'));
    }

    public function index1()
    {
    $all_hoadon = DB::table('hoadons')
    ->join('benhnhans','benhnhans.ten','=','hoadons.tenbenhnhan')
    ->select('hoadons.*','benhnhans.ten')
    ->orderBy('hoadons.id','desc')->get();
    $tongtien = $all_hoadon->sum('tongtien');
    return view('employee.hoadon.index', compact('all_hoadon','tongtien'));
    }
    public function index2()
    {
    $all_hoadon = DB::table('hoadons')
    ->join('benhnhans','benhnhans.ten','=','hoadons.tenbenhnhan')
    ->select('hoadons.*','benhnhans.ten')
    ->orderBy('hoadons.id','desc')->get();
    $tongtien = $all_hoadon->sum('tongtien');
    return view('employee.tuvanvakhambenh.index', compact('all_hoadon','tongtien'));
    }
    public function searchByDate1(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        // Thực hiện truy vấn để lấy dữ liệu từ ngày bắt đầu đến ngày kết thúc
        $all_hoadon = DB::table('hoadons')
            ->join('benhnhans', 'benhnhans.ten', '=', 'hoadons.tenbenhnhan')
            ->select('hoadons.*', 'benhnhans.ten')
            ->whereDate('hoadons.created_at', '>=', $startDate)
            ->whereDate('hoadons.created_at', '<=', $endDate)
            ->orderBy('hoadons.id', 'desc')
            ->get();
        $tongtien = $all_hoadon->sum('tongtien');
        return view('employee.hoadon.index', compact('all_hoadon' ,'startDate' ,'endDate','tongtien'));
    }
    public function markAsPaid(Request $request)
    {
        $id = $request->id;
        $hoaDon = HoaDon::findOrFail($id);
        $hoaDon->tinhtrang = 'Đã thanh toán';
        $hoaDon->save();

        return response()->json(['message' => 'Đánh dấu hóa đơn đã thanh toán thành công'], 200);
    }
}

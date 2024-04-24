<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\HoaDonChiTiet;
use Carbon\Carbon;
class AdminHomeController extends Controller
{
    public function index(Request $request)
    {
        $filterOption = $request->input('filteroption', ''); // Mặc định cho biến $filterOption là chuỗi rỗng nếu không có giá trị được truyền vào
    
        if (!empty($filterOption)) {
            switch ($filterOption) {
                case 'lastweek':
                    $fromDate = now()->subWeek()->startOfWeek()->toDateString();
                    $toDate = now()->subWeek()->endOfWeek()->toDateString();
                    break;
                case 'lastmonth':
                    $fromDate = now()->subMonth()->startOfMonth()->toDateString();
                    $toDate = now()->subMonth()->endOfMonth()->toDateString();
                    break;
                case 'nowmonth':
                    $fromDate = now()->startOfMonth()->toDateString();
                    $toDate = now()->endOfMonth()->toDateString();
                    break;
                case 'lastyear':
                    $fromDate = now()->subYear()->startOfYear()->toDateString();
                    $toDate = now()->subYear()->endOfYear()->toDateString();
                    break;
                // Thêm các trường hợp khác nếu cần
            }
        } else {
            $fromDate = $request->input('start_date', now()->startOfMonth()->toDateString());
            $toDate = $request->input('end_date', now()->toDateString());
        }
        if (!isset($fromDate) || empty($fromDate)) {
            // Nếu $fromDate không tồn tại hoặc rỗng, gán giá trị mặc định cho nó
            $fromDate =  $request->input('start_date', now()->startOfMonth()->toDateString());
        }
        if (!isset($toDate) || empty($toDate)) {
            // Nếu $toDate không tồn tại hoặc rỗng, gán giá trị mặc định cho nó
            $toDate = $request->input('end_date', now()->toDateString());
        }
        
        // Tiếp tục sử dụng biến $toDate sau khi đã kiểm tra
        $startDate = Carbon::parse($fromDate);
        $endDate = Carbon::parse($toDate)->endOfDay();
    
        // Kiểm tra nếu $filterOption không phải là 'lastyear' thì xử lý doanh thu theo ngày, ngược lại xử lý theo tháng
        if ($filterOption != 'lastyear') {
            // Xử lý doanh thu theo ngày như cũ
            $revenueData = collect();
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $formattedDate = $date->format('Y-m-d');
                if ($revenueData->has($formattedDate)) {
                    continue;
                }
                $revenueData->put($formattedDate, 0);
            }
    
            $revenueDataFromDB = Hoadon::whereBetween('created_at', [$fromDate, $endDate])
                ->orderBy('created_at')
                ->where('hoadons.tinhtrang', 'đã thanh toán')
                ->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('Y-m-d');
                })
                ->map(function ($item) {
                    return $item->sum('tongtien');
                });
    
            $revenueData = $revenueData->merge($revenueDataFromDB);
        } else {
            // Xử lý doanh thu theo tháng
            $revenueData = collect();        
            // Khởi tạo các giá trị ban đầu cho mỗi tháng
            for ($month = 1; $month <= 12; $month++) {
                $revenueData->put($month, 0);
            }
        
            // Lấy dữ liệu từ cơ sở dữ liệu
            $revenueDataFromDB = Hoadon::whereYear('created_at', $startDate->year)
                ->orderBy('created_at')
                ->where('hoadons.tinhtrang', 'đã thanh toán')
                ->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('n'); // Sử dụng 'n' thay vì 'm'
                });
        
            // Lặp qua từng tháng và tính tổng doanh thu và số lượng sản phẩm
            foreach (range(1, 12) as $month) {
                $revenueData[$month] = $revenueDataFromDB->has($month) ? $revenueDataFromDB[$month]->sum('tongtien') : 0;
            }
        }
    
 
            $productQuantities = HoaDonChiTiet::selectRaw('tendichvusanpham, SUM(soluong) as totalQuantity')
    ->join('hoadons', 'hoadonchitiets.mahoadon', '=', 'hoadons.mahoadon')
    ->whereBetween('hoadons.created_at', [$fromDate, $endDate])
    ->where('hoadons.tinhtrang', 'đã thanh toán')
    ->groupBy('tendichvusanpham')
    ->pluck('totalQuantity', 'tendichvusanpham');
    
        $all_hoadon = DB::table('hoadons')
            ->join('benhnhans', 'benhnhans.ten', '=', 'hoadons.tenbenhnhan')
            ->select('hoadons.*', 'benhnhans.ten')
            ->whereDate('hoadons.created_at', '>=', $startDate)
            ->whereDate('hoadons.created_at', '<=', $endDate)
            ->where('hoadons.tinhtrang', 'Đã Thanh Toán')
            ->orderBy('hoadons.id', 'desc')
            ->get();
    
        $tongtien = $all_hoadon->sum('tongtien');
        return view('admin.home.index', compact('revenueData', 'fromDate', 'toDate', 'productQuantities', 'filterOption'));
    }
}

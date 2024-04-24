<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\NhanVien;

class NhanVienAvatarMiddleware
{
    public function handle($request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            // Lấy email của người dùng đã đăng nhập
            $email = Auth::user()->email;

            // Tìm thông tin nhân viên tương ứng với email trong bảng nhanviens
            $nhanVien = NhanVien::where('email', $email)->first();

            // Kiểm tra xem có thông tin nhân viên không và lấy đường dẫn ảnh
            if ($nhanVien) {
                $avatar = $nhanVien->anh;
                $name = $nhanVien->ten;
            } else {
                // Xử lý trường hợp khi không tìm thấy thông tin nhân viên
                $avatar = '';
                $name = '';
            }
            // Truyền đường dẫn ảnh vào view
            view()->share('adminAvatar', $avatar);
            view()->share('adminName', $name);
        }

        return $next($request);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    //use HasFactory;
    protected $table = 'nhanviens';
 protected $fillable = [
    'manhanvien',
    'ten', 
    'gioitinh',
    'ngaysinh',
     'sodienthoai',
    'cmnd',
    'diachi',
    'email',
    'loai',
    'anh',
    ];
    

 public function getId() {
    return $this
    ->attributes['id'];
    }
    public function setId($id) {
    $this
    ->attributes['id'] = $id;
    }
    public function getmanhanvien() {
        return $this
        ->attributes['manhanvien'];
        }
        public function setmanhanvien($manhanvien) {
        $this
        ->attributes['manhanvien'] = $manhanvien;
        }   
public function getloai() {
        return $this
        ->attributes['loai'];
        }
        public function setloai($loai) {
        $this
        ->attributes['loai'] = $loai;
        }
public function getemail() {
        return $this
        ->attributes['email'];
        }
        public function setemail($email) {
        $this
        ->attributes['email'] = $email;
        }   
    public function getten() {
    return $this
    ->attributes['ten'];
    }
    public function setten($ten) {
    $this
    ->attributes['ten'] = $ten;
    }
    public function getngaysinh() {
    return $this
    ->attributes['ngaysinh'];
    }
    public function setngaysinh($ngaysinh) {
    $this
    ->attributes['ngaysinh'] = $ngaysinh;
    }
    public function getgioitinh() {
    return $this
    ->attributes['gioitinh'];
    }
    public function setgioitinh($gioitinh) {
    $this
    ->attributes['gioitinh'] = $gioitinh;
    }
    public function getdiachi() {
        return $this
        ->attributes['diachi'];
        }
        public function setdiachi($diachi) {
        $this
        ->attributes['diachi'] = $diachi;
        }
        public function getsodienthoai() {
            return $this
            ->attributes['sodienthoai'];
            }
            public function setsodienthoai($sodienthoai) {
            $this
            ->attributes['sodienthoai'] = $sodienthoai;
            }
            public function getcmnd() {
                return $this
                ->attributes['cmnd'];
                }
                public function setcmnd($cmnd) {
                $this
                ->attributes['cmnd'] = $cmnd;
                }
        public function getCreatedAt() {
        return $this
        ->attributes['created_at'];
        }
        public function setCreatedAt($createdAt) {
        $this
        ->attributes['created_at'] = $createdAt;
        }
        public function getUpdatedAt() {
        return $this
        ->attributes['updated_at'];
        }
        public function setUpdatedAt($updatedAt) {
        $this
        ->attributes['updated_at'] = $updatedAt;
        }
        public function getanh() {
            return $this
            ->attributes['anh'];
            }
            public function setanh($anh) {
            $this
            ->attributes['anh'] = $anh;
            }
}

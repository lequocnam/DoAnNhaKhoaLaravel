<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichHen extends Model
{
    protected $table = 'lichhens';
 protected $fillable = [
    'malichhen',
    'ten', 
    'gioitinh',
    'ngayhen',
     'sodienthoai',
    'noidungkham',
    'diachi',
    'ngaydukien',
    'trangthai',
    ];
    

 public function getId() {
    return $this
    ->attributes['id'];
    }
    public function setId($id) {
    $this
    ->attributes['id'] = $id;
    }
    public function getmalichhen() {
        return $this
        ->attributes['malichhen'];
        }
        public function setmalichhen($malichhen) {
        $this
        ->attributes['malichhen'] = $malichhen;
        }   
public function gettrangthai() {
        return $this
        ->attributes['trangthai'];
        }
        public function settrangthai($trangthai) {
        $this
        ->attributes['trangthai'] = $trangthai;
        }
public function getngaydukien() {
        return $this
        ->attributes['ngaydukien'];
        }
        public function setngaydukien($ngaydukien) {
        $this
        ->attributes['ngaydukien'] = $ngaydukien;
        }   
    public function getten() {
    return $this
    ->attributes['ten'];
    }
    public function setten($ten) {
    $this
    ->attributes['ten'] = $ten;
    }
    public function getngayhen() {
    return $this
    ->attributes['ngayhen'];
    }
    public function setngayhen($ngayhen) {
    $this
    ->attributes['ngayhen'] = $ngayhen;
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
            public function getnoidungkham() {
                return $this
                ->attributes['noidungkham'];
                }
                public function setnoidungkham($noidungkham) {
                $this
                ->attributes['noidungkham'] = $noidungkham;
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
}

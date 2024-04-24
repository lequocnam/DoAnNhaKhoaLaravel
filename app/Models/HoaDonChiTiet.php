<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonChiTiet extends Model
{
   
    protected $table = 'hoadonchitiets';
    protected $fillable = [
       ];

    public function getId() {
        return $this
        ->attributes['id'];
        }
        public function setId($id) {
        $this
        ->attributes['id'] = $id;
        }
        public function getmahoadon() {
            return $this
            ->attributes['mahoadon'];
            }
            public function setmahoadon($mahoadon) {
            $this
            ->attributes['mahoadon'] = $mahoadon;
            }
            public function getmadichvusanpham() {
                return $this
                ->attributes['madichvusanpham'];
                }
                public function setmadichvusanpham($madichvusanpham) {
                $this
                ->attributes['madichvusanpham'] = $madichvusanpham;
                }     
        public function dichvusanpham(){
            return $this->belongsTo(DichVuSanPham::class);
            }
            public function getDichvusanpham(){
                return $this->dichvusanpham;
                }
                public function setDichvusanpham($dichvusanpham){
                $this->dichvusanpham = $dichvusanpham;
                }  
        
                public function hoadon(){
                    return $this->belongsTo(Hoadon::class);
                    }
                    public function getHoadon(){
                    return $this->hoadon;
                    }
                    public function setHoadon($hoadon){
                    $this->hoadon = $hoadon;
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

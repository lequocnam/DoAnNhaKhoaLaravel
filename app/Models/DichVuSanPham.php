<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DichVuSanPham extends Model
{
    protected $table = 'dichvusanphams';
    protected $fillable = [
       'madichvusanpham',
       'anh',
       'ten', 
       'dongia',
       ];
       
   
    public function getId() {
       return $this
       ->attributes['id'];
       }
       public function setId($id) {
       $this
       ->attributes['id'] = $id;
       }
       public static function sumPricesByQuantities($dichvusanphams, $dichvusanphamsInsession)
    {
        $total=0;
        foreach($dichvusanphams as $dichvusanpham)
        {
            $total= $total + ($dichvusanpham->getdongia()*$dichvusanphamsInsession[$dichvusanpham->getId()]);
        }
        return $total;
    }
       public function getmadichvusanpham() {
           return $this
           ->attributes['madichvusanpham'];
           }
           public function setmadichvusanpham($madichvusanpham) {
           $this
           ->attributes['madichvusanpham'] = $madichvusanpham;
           }   
       public function getten() {
       return $this
       ->attributes['ten'];
       }
       public function setten($ten) {
       $this
       ->attributes['ten'] = $ten;
       }
       public function getdongia() {
       return $this
       ->attributes['dongia'];
       }
       public function setdongia($dongia) {
       $this
       ->attributes['dongia'] = $dongia;
       }
       public function getanh() {
        return $this
        ->attributes['anh'];
        }
        public function setanh($anh) {
        $this
        ->attributes['anh'] = $anh;
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
           }}

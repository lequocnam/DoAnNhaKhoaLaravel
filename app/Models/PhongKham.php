<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhongKham extends Model
{
    protected $table = 'phongkhams';
    protected $fillable = [
       'maphongkham',
       'tenphongkham',
       ];

    public function getId() {
        return $this
        ->attributes['id'];
        }
        public function setId($id) {
        $this
        ->attributes['id'] = $id;
        }
        public function getmaphongkham() {
            return $this
            ->attributes['maphongkham'];
            }
            public function setmaphongkham($maphongkham) {
            $this
            ->attributes['maphongkham'] = $maphongkham;
            }   
        public function gettenphongkham() {
        return $this
        ->attributes['tenphongkham'];
        }
        public function settenphongkham($tenphongkham) {
        $this
        ->attributes['tenphongkham'] = $tenphongkham;
        }
}

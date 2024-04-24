<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $table = 'hoadons';
    protected $fillable = [
       'mahoadon',
       'httt',
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
        public function gethttt() {
        return $this
        ->attributes['httt'];
        }
        public function sethttt($httt) {
        $this
        ->attributes['httt'] = $httt;
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
            public function getngayhientai() {
                return new \DateTime($this->created_at);
            }
}

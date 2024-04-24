<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaLamViec extends Model
{
    protected $table = 'calamviecs';
    protected $fillable = [
       'title',
       'start',
       'end',
       ];

    public function getId() {
        return $this
        ->attributes['id'];
        }
        public function setId($id) {
        $this
        ->attributes['id'] = $id;
        }
        public function gettitle() {
            return $this
            ->attributes['title'];
            }
            public function settitle($title) {
            $this
            ->attributes['title'] = $title;
            }   
        public function getstart() {
        return $this
        ->attributes['start'];
        }
        public function setstart($start) {
        $this
        ->attributes['start'] = $start;
        }
        public function getend() {
        return $this
        ->attributes['end'];
        }
        public function setend($end) {
        $this
        ->attributes['end'] = $end;
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

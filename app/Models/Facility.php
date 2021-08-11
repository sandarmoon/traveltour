<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name','price','fcategory_id'];


    public function fcategory(){
        return $this->belongsTo(Fcategory::class);
    }

    public function  rooms(){
        return $this->belongsToMany(Room::class);
    }
}

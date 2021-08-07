<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Fcategory extends Model
{
    use HasFactory,SoftDeletes;

     protected $fillable=['name','type_id'];
     
      public function type(){
        return $this->belongsTo(Type::class);
    }

}

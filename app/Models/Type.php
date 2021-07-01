<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    
     use HasFactory,SoftDeletes;
   
    protected $fillable=['name','parent_id'];

    
    public function child()
    {
        return $this->hasMany(\App\Models\Type::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Type::class, 'parent_id');
    }
}

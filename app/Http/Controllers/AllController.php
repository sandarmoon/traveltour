<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Resources\PickupResource;

class AllController extends Controller
{
   public function getPickup(){
    $pickups=City::whereNotNull('parent_id')->with('parent')->get();
    return  PickupResource::collection($pickups);
   }
}

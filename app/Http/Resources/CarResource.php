<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'photo' => $this->photo,
            'model' => $this->model,
            'seat' => $this->seats,
            'door' => $this->door,
            'bags' => $this->bags,
            'aircon' => $this->aircon,
            'brand' => $this->brand->name,
            'type' => $this->type->name,
            'company_name' => $this->company->name,
            'company_address' => $this->company->address,
            'company_phone' => $this->company->phone,
            'priceperday' => $this->priceperday,
            'discount' => $this->discount,
            'city' => $this->city->name,
            'location' => $this->whenPivotLoaded('pickuppivot', function () {
            return $this->pivot->name;
        }),
        ];
    }
}

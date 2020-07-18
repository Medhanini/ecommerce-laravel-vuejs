<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Variations as VariationsResource;
class Products extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  array_merge(parent::toArray($request),[
            'variation'=> VariationsResource::collection(
                $this->variations
                )
        ]);
    }
}

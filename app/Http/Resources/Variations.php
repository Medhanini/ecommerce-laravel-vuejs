<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class Variations extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if( $this->resource instanceof Collection ){
            return Variations::collection($this->resource);
        }
        return [
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'type' => $this->type,
        ];
        
    }
}

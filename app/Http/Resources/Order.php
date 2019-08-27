<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrderItem;


class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'address' => $this->address,
          'pincode' => $this->pincode,
          'delivery_at' => $this->delivery_at,
          'status' => $this->status,
          'items' => OrderItem::collection($this->order_items)

        ];
    }
}

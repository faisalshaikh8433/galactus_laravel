<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Shop as Shop;
use App\Customer as Customer;
use App\Http\Resources\Shop as ShopResource;
use App\Http\Resources\Customer as CustomerResource;
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
        'shop' => new ShopResource(Shop::find($this->shop_id)),
        'customer' => new CustomerResource(Customer::find($this->customer_id)),
        'items' => OrderItem::collection($this->order_items)

      ];
    }
}

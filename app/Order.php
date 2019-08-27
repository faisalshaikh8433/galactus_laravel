<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
  protected $fillable = ['customer_id', 'shop_id', 'address', 'pincode', 'landmark', 'delivery_at', 'status'];

  public function shop()
  {
    return $this->belongsTo('App\Shop');
  }

  public function customer()
  {
    return $this->belongsTo('App\Customer');
  }

  public function order_items()
  {
    return $this->hasMany('App\OrderItem');
  }

  public function setDeliveryAtAttribute($value) // using mutator for converting the timestamp to Datetime which we get from the frontend
  {
    $this->attributes['delivery_at'] = Carbon::createFromTimestamp($value);
  }
}

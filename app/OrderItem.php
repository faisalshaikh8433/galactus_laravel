<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
  protected $fillable = ['order_id', 'name', 'message', 'weight', 'price'];
  public function orders()
  {
    return $this->belongsTo('App\Order');
  }
}

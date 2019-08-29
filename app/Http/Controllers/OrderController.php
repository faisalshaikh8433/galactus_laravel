<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Http\Resources\Order as OrderResource;
use \Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $orders = Order::with(['shop', 'customer'])->paginate(20);
      return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(),[
        'shop_id' => 'required|exists:shops,id',
        'customer_id' => 'required|exists:customers,id',
        'address' => 'required',
        'pincode' => 'required|min:6|max:6',
        'delivery_at' => [
                            'required',
                            function ($attribute, $value, $fail) {
                              $datetime = Carbon::createFromTimestamp($value);
                              if($datetime <= now()) {
                                $fail('Delivery date & time should be greater than the current date and time');
                              }
                            }
                          ],
        'status' => 'required',
        'items.*.name' => 'required',
        'items.*.weight' => 'required',
        'items.*.price' => 'required',
      ]);

      if ($validator->fails()){
        return response()->json(array("errors"=> $validator->errors()), 400);
      }else{
        $order = Order::create($request->except('items'));
        $order->order_items()->createMany($request->get('items'));
        return new OrderResource($order, 200);
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $order = Order::findOrFail($id);
      return new OrderResource($order);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

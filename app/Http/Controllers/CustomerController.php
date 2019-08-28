<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Http\Resources\Customer as CustomerResource;
use \Illuminate\Support\Facades\Validator;
// use App\Http\Requests\CustomerRequest;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $customers = Customer::paginate(20);
      return CustomerResource::collection($customers, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'phone' => 'required|min:10|max:10|unique:customers,phone'
      ]);

      if ($validator->fails()) {
        return response()->json(array("errors"=> $validator->errors()), 400);
      } else {
        $customer = Customer::create($request->all());
        return new CustomerResource($customer, 200);
      }
      // $validated = $request->validated();
    }

    public function find_by_phone($phone){
      $customer =  Customer::wherePhone($phone)->firstOrFail();
      return new CustomerResource($customer, 200);
    }

}

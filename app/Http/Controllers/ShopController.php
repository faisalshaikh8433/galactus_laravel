<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\Http\Resources\Shop as ShopResource;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $shops = Shop::paginate(20);
      return ShopResource::collection($shops);
    }

}

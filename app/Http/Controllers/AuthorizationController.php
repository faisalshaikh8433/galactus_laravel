<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use App\User;

class AuthorizationController extends Controller
{
    
    public function create_user(Request $request){
      $validator = Validator::make($request->all(),[
        'name' => 'required',
        'phone' => 'required|min:10|max:10',
        'email' => 'required|email',
        'role' => 'required|string',
        'password' => 'required|string|min:8',
      ]);

      if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
      } else {
        $user = new User;
        $user->fill($request->all());
        do{
          $api_token = str_random(60);
        }while(User::where('api_token', $api_token)->exists());
        $user->api_token = $api_token;
        return response($user, 200);
      }
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
      $validator = Validator::make($request->all(),[
        'email' => 'required|email',
        'password' => 'required|string|min:8',
      ]);

      if ($validator->fails()){
        return response()->json($validator->errors(), 400);
      }

      $user_exist = User::where([
        ['email', $request->get('email')],
        ['password', $request->get('password')]
      ])->exists();
      
      if($user_exist){
        $user = User::where('email', $request->get('email'))->first();
        $user->rollApiKey(); //Model Function
        return response($user);
      }

      return response(array('errors' => 'Unauthorized, check your credentials.'), 401);

    }
}

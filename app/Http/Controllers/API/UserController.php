<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;
class UserController extends Controller
{
public $successStatus = 200;
/**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){

      if (request('grant_type')=='social') {
        if(Auth::attempt(['provider' => 'facebook', 'provider_id' => request('facebook_id')])) {
          $user = Auth::user();
          $success['access_token'] =  $user->createToken('EasyGo')-> accessToken;
          $success['token_type'] = "Bearer";
          $success['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d H:i:s');
//          return response()->json(['success' => $success], $this-> successStatus);
          return response()->json($success, $this-> successStatus);
        }
      }
      elseif (request('grant_type')=='password') {
        if(Auth::attempt(['email' => request('username'), 'password' => request('password')])){
          $user = Auth::user();
          $success['access_token'] =  $user->createToken('EasyGo')-> accessToken;
          $success['token_type'] = "user";
          $success['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d H:i:s');
//          return response()->json(['success' => $success], $this-> successStatus);
          return response()->json($success, $this-> successStatus);
        }
      }
      else{
          return response()->json(['error'=>'Unauthorised'], 401);
      }
      return response()->json(['error'=>'Unauthorised'], 401);
    }
/**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'token_type' => 'required|string|max:5',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
        'password_confirmation' => 'required|string|same:password',
      ]);
      if ($validator->fails()) {
//        return response()->json(['error'=>$validator->errors()], 401);
        return response()->json(['message'=>"Register fail."], 400);
      }
      $input = $request->all();
      $input['name']=$input['first_name']." ".$input['last_name'];
      $input['password'] = bcrypt($input['password']);
      $user = User::create($input);
      $success['access_token'] =  $user->createToken('EasyGo')-> accessToken;
      $success['token_type'] = $input['token_type'];
      $success['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d H:i:s');
//      return response()->json(['success'=>$success], $this-> successStatus);
      return response()->json($success, $this-> successStatus);
    }
/**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
      $user = Auth::user();
      return response()->json(['success' => $user], $this-> successStatus);
    }

    // logout api

    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json([ 'data' => 'User logged out.' ], 200);
    }

}
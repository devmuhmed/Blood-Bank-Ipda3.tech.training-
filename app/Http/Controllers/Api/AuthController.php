<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = validator()->make($request->all(),[
            'email' => 'required|unique:clients',
            'phone' => 'required|unique:clients',
            'name' => 'required',
            'blood_type_id' => 'required',
            'last_donation_date' => 'required',
            'city_id' => 'required',
            'password' => 'required|confirmed',
        ]);
        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->save();
        return responseJson(1,'add operation success',[
            'api_token' => $client->api_token,
            'Client' => $client
        ]);
    }

    public function login(Request $request){
        $validator = validator()->make($request->all(),[
            'phone' => 'required',
            'password' => 'required'
        ]);
        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $client = Client::where('phone',$request->phone)->first();
        if ($client){
            if(Hash::check($request->password, $client->password)){
                return responseJson(1,'login success',[
                    'api_token' => $client->api_token,
                    'client' => $client
                ]);
            }else{
                return responseJson(0,'there \'s a something wrong with your password');
            }
        }else{
            return responseJson(0,'there \'s a something wrong with your phone');
        }
    }
    public function resetPassword(Request $request){
        $validator = validator()->make($request->all(),['phone' => 'required']);
        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $user = Client::where('phone',$request->phone)->first();
        if($user){
            $code = rand(1111,9999);
            $update = $user->update(['pin_code' => $code]);
            if($update){
                //send mail
                Mail::to($user->email)
                ->bcc(env('mil'))
                ->send(new ResetPassword($code));
                return responseJson(1,'check your phone you should recieve code',['pin_code' => $code]);
            }else{
                return responseJson(1,'something wrong happen try again');
            }
        }else{
            return responseJson(1,'something wrong happen try again');
        }
    }
    public function profile(Request $request){
        $validator = validator()->make($request->all(),[
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $loginUser = $request->user();
        $loginUser->update($request->all());
        if($request->has('password')){
            $loginUser->password = bcrypt($request->password);
            $loginUser->save();
        }
        return responseJson(1,'updated success',$loginUser);
    }
    public function togglePostFavourites (Request $request){
        $validator = validator($request->all(),[
            'post_id' => 'required'
        ]);
        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $toggle = $request->user()->posts()->toggle($request->post_id);
        return responseJson(1,'post add to favourites',$toggle);
    }

}

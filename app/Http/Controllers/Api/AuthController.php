<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}

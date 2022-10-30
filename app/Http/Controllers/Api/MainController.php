<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Token;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function governorates(){
        $governorates = Governorate::all();
        return responseJson(1, 'success', $governorates);
    }
    public function cities(Request $request){
        $cities = City::where(function ($query) use($request){
            if($request->has('governorate_id')){
                $query->where('governorate_id',$request->governorate_id);
            }
        })->paginate(10);
        return responseJson(1, 'success', $cities);
    }
    public function posts(){
        $posts = Post::with('category')->paginate(10);
        return responseJson(1, 'success', $posts);
    }
    public function contact(Request $request){
        $validator = validator()->make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        if($validator ->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $contact = Contact::create($request->all());
        return responseJson(1,'message sending successfuly',$contact);
    }
    public function settings(){
        $settings = Setting::first();
        return responseJson(1,'success',$settings);
    }
    public function categories(){
        $categories = Category::all();
        return responseJson(1,'success',$categories);
    }
    public function bloodTypes(){
        $bloodTypes = BloodType::all();
        return responseJson(1,"success",$bloodTypes);
    }
    public function favouritesPosts(Request $request){
        $favouritePosts = $request->user()->posts()->latest()->paginate(20);
        return responseJson(1,'your favourites posts get successfully',$favouritePosts);
    }
    public function donationRequestCreate(Request $request){
        $validator = validator()->make($request->all(),[
            'patient_name' => 'required',
            'patient_phone' => 'required|digits:11',
            'patient_age' => 'required',
            'blood_type_id' =>'required|exists:blood_types,id',
            'bags_num' => 'required',
            'hospital_address' =>'required',
            'city_id' => 'required|exists:cities,id',
        ]);
        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $donationRequest = $request->user()->donationrequests()->create($request->all());
        $clientsIds = $donationRequest->city->governorate->clients()->whereHas('bloodTypes',function($q) use($request){
            $q->where('blood_types.id',$request->blood_type_id);
        })->pluck('clients.id')->toArray();
        if(count($clientsIds)){
            $notification = $donationRequest->notifications()->create([
                'title' => 'need someone donate',
                'content' => $request->user()->name."need donator blood type"
            ]);
            $notification->clients()->attach($clientsIds);
            $tokens = Token::whereIn('client_id',$clientsIds)->where('token','!=','null')->pluck('token')->toArray();
            if(count($tokens)){
                $audience = ['include_players_id' => $tokens];
                $content = [];
            }
        }
        return responseJson(1,$clientsIds);
    }

}

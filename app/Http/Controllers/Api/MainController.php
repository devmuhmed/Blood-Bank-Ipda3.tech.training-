<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Setting;
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
        $contact->save();
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
}

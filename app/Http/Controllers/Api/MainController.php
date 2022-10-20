<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function governorates(){
        $governorates = Governorate::all();
        return responseJson(1, 'success', $governorates);
    }
    public function cities(){
        $cities = City::all();
        return responseJson(1, 'success', $cities);
    }
    public function posts(){
        $posts = Post::with('category')->paginate(10);
        return responseJson(1, 'success', $posts);
    }
}

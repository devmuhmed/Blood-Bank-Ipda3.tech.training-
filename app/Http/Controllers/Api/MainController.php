<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function governorates(){
        $governorates = Governorate::all();
        return responseJson(200, 'success', $governorates);
    }
    public function cities(){
        $cities = City::all();
        return responseJson(200, 'success', $cities);
    }
}

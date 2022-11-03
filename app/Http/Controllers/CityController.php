<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $records = City::paginate(9);
        return view('cities.index',compact('records'));
    }

    public function create()
    {
        $governorates = Governorate::all();
        $select = [];
        foreach ($governorates as $governorate){
                $select[$governorate->id] = $governorate->name;
        }
        return view('cities.create',compact('select'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];
        $this->validate($request,$rules);
        City::create($request->all());
        return redirect(route('city.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $model = City::findOrFail($id);
        $governorates = Governorate::all();
        $select = [];
        foreach ($governorates as $governorate){
            $select[$governorate->id] = $governorate->name;
        }
        return view('cities.edit',compact('model','select'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required'
        ];
        $this->validate($request,$rules);
        $record = City::findOrFail($id);
        $record->update($request->all());
        return redirect(route('city.index'));
    }

    public function destroy($id)
    {
        $record = City::findOrFail($id);
        $record->delete();
        return redirect(route('city.index'));
    }
}

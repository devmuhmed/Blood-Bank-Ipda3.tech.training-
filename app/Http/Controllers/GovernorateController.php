<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    public function index()
    {
        $records = Governorate::paginate(9);
        return view('governorates.index',compact('records'));
    }
    public function create()
    {
        return view('governorates.create');
    }
    public function store(Request $request)
    {
        $rules = [
          'name' => 'required'
        ];
        $message = [
          'name.required' => 'Name must be not empty'
        ];
        $this->validate($request,$rules,$message);
        Governorate::create($request->all());
        return redirect(route('governorate.index'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $model = Governorate::findOrFail($id);
        return view('governorates.edit',compact('model'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
        ];
        $this->validate($request,$rules);
        $record = Governorate::findOrFail($id);
        $record->update($request->all());
        return redirect(route('governorate.index'));
    }
    public function destroy($id)
    {
        $record = Governorate::findOrFail($id);
        $record->delete();
        return redirect(route('governorate.index'));
    }
}

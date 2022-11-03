<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $records = Category::paginate(9);
        return view('categories.index',compact('records'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $rules = ['name'=>'required'];
        $this->validate($request,$rules);
        Category::create($request->all());
        return redirect(route('category.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $model = Category::findOrFail($id);
        return view('categories.edit',compact('model'));
    }

    public function update(Request $request, $id)
    {
        $rules=['name'=>'required'];
        $this->validate($request,$rules);
        $record = Category::findOrFail($id);
        $record->update($request->all());
        return redirect(route('category.index'));
    }

    public function destroy($id)
    {
        $record = Category::findOrFail($id);
        $record->delete();
        return redirect(route('category.index'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Categorie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        $data['categories'] = $categories;
        return view('admin.categories', $data);
    }

    public function create()
    {
        return view('admin.categoriesCreate');
    }

    public function store(Request $request)
    {
        $a = $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $categorie = new Categorie();
        $categorie->name = $request->all()['name'];
        $categorie->description = $request->all()['description'];
        $categorie->save();
        return redirect()->route('admin.categories');
    }

    public function edit($categorie_id)
    {
        $categorie = Categorie::find($categorie_id);
        $data['categorie'] = $categorie;
        return view('admin.categoriesEdit', $data);
    }

    public function update($categorie_id, Request $request)
    {
        $a = $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $categorie = Categorie::find($categorie_id);
        $categorie->name = $request->all()['name'];
        $categorie->description = $request->all()['description'];
        $categorie->save();
        return redirect()->route('admin.categories');
    }

    public function delete($categorie_id)
    {
        $categorie = Categorie::find($categorie_id);
        $categorie->delete();
        return redirect()->route('admin.categories');
    }
}

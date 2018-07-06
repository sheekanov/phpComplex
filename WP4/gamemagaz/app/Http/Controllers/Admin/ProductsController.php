<?php

namespace App\Http\Controllers\Admin;

use App\Categorie;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {

        $products = Product::all();
        $data['products'] = $products;
        return view('admin.products', $data);

    }

    public function create()
    {
        $categories = Categorie::all();
        $data['categories'] = $categories;
        return view('admin.productsCreate', $data);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $product = new Product();
        $product->name = $request->all()['name'];
        $product->categorie_id = $request->all()['categorie_id'];
        $product->description = $request->all()['description'];
        $product->price = $request->all()['price'];
        $product->save();

        Storage::makeDirectory('uploads/products/prod-id-' . $product->id);
        //echo storage_path();
        if ($request->hasFile('pic')) {
            $request->file('pic')->move(storage_path() . '/app/public/uploads/products/prod-id-' . $product->id, 'productPic.jpg');
            $product->pic = '/storage/uploads/products/prod-id-' . $product->id . '/productPic.jpg';
            $product->save();
        }
        return redirect()->route('admin.products');
    }

    public function edit($product_id)
    {
        $product = Product::find($product_id);
        $categories = Categorie::all();
        $data['product'] = $product;
        $data['categories'] = $categories;
        return view('admin.productsEdit', $data);
    }

    public function update($product_id, Request $request)
    {
        $a = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'categorie_id' => 'required'
        ]);

        $product = Product::find($product_id);
        $product->name = $request->all()['name'];
        $product->description = $request->all()['description'];
        $product->price = $request->all()['price'];
        $product->categorie_id = $request->all()['categorie_id'];
        if ($request->hasFile('pic')) {
            $request->file('pic')->move(storage_path() . '/app/public/uploads/products/prod-id-' . $product->id, 'productPic.jpg');
            $product->pic = '/storage/uploads/products/prod-id-' . $product->id . '/productPic.jpg';
        }
        $product->save();
        return redirect()->route('admin.products');
    }

    public function delete($product_id)
    {

        $product = Product::find($product_id);
        $product->delete();
        return redirect()->route('admin.products');
    }
}

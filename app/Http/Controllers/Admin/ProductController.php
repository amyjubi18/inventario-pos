<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read-products');
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-products');
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create-products');
        $data= $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);
        $product = Product::create($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'El producto se ha creado con exito'
        ]);

        return redirect()->route('admin.products.index', $product );

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        Gate::authorize('update-products');
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        Gate::authorize('update-products');
        $data= $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);
        $product->update($data);
        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'El producto se ha actualizado con exito'
        ]);
        return redirect()->route('admin.products.index', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Gate::authorize('delete-products');
        if($product->inventories()->exists()){
            session()->flash('swal',[
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'No se puede eliminar el producto porque tiene inventarios asociados'
                ]);
        }
        if($product->purchaseOrders()->exists() || $product->quotes()->exists()){
            session()->flash('swal',[
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'No se puede eliminar el producto porque tiene ordenes de compra o cotizaciones asociadas'
                ]);
            return redirect()->route('admin.products.index');
        }
        $product->delete();
        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'El producto se ha eliminado con exito'
        ]);
        return redirect()->route('admin.products.index');
    }

    public function dropzone(Request $request, Product $product)
    {
        Gate::authorize('update-products');

      $image = $product->images()->create([
           'path' =>Storage::disk('public')->put('/images', $request->file('file')),
           'size' => $request->file('file')->getSize(),

       ]);

       return response()->json([
            'id' => $image->id,
           'path' => $image->path,
       ]);
    }
    public function kardex(Product $product)
    {
        Gate::authorize('read-products');
        return view('admin.products.kardex', compact('product'));
    }
    public function import()
    {
        Gate::authorize('create-products');
        return view('admin.products.import');
    }

}

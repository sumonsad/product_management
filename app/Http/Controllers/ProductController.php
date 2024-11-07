<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->orderBy('name','asc')->orderBy('price','desc');

        if ($request->filled('search')) {
            $query->where('product_id', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('sort_by')) {
            $query->orderBy($request->sort_by, 'asc');
        }

        $products = $query->paginate(10);

        return view('index', compact('products'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|unique:products',
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'nullable|integer',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
    $request->validate([
        'product_id' => 'required|unique:products,product_id,' . $product->id,
        'name' => 'required',
        'description' => 'nullable',
        'price' => 'required|numeric',
        'stock' => 'nullable|integer',
        'image' => 'nullable|image',
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('images', 'public');
    }

    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

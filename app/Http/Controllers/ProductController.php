<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests; 

    public function index()
    {
        $products = Product::with('user')->paginate(10);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('manage-product'); 
        
        $users = User::all();
        return view('product.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->authorize('manage-product');

        $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
        ]);

        Product::create($request->all());

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('product.view', compact('product'));
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        $users = User::all();
        return view('product.edit', compact('product', 'users'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer|min:0', // Pastikan divalidasi sebagai 'qty'
            'price' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
        ]);

        // Jika form kamu mengirim 'quantity', kita harus mengubahnya menjadi 'qty' sebelum update
        $data = $request->all();
        if ($request->has('quantity')) {
            $data['qty'] = $request->quantity;
        }

        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function delete(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}
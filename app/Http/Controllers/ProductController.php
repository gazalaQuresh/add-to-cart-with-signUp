<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\AddToCart;

class ProductController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $user_role = $user->role;
            $products = Product::all();

            //return response()->json(["user_role"=>$user_role,"products"=>$products]);
            return view('products.index', compact('products', 'user_role'));
        } else {

            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to access this page.']);
        }
    }

    public function fetch()
    {
        $user = Auth::user();

        if ($user) {
            $user_role = $user->role;
            $products = Product::all();
            $data = [];
            foreach ($products as $product) {
                $data[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $product->quantity,
                    'edit_url' => route('products.edit', $product->id),
                    'delete_url' => route('products.destroy', $product->id),
                ];
            }

            return response()->json(["user_role" => $user_role, "products" => $data]);
            // /return view('products.index', compact('products','user_role'));

        } else {

            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to access this page.']);
        }
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->role == "admin") {
            return view('products.create');
        }
    }

    public function edit($id)
    {
        $user = Auth::user();

        if ($user->role == "admin") {
            $product = Product::find($id);
            return view('products.edit', compact('product'));
        }
    }

    public function  store(Request $request)
    {

        $user = Auth::user();

        if ($user->role == "admin") {
            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'quantity' => 'required'
            ]);


            Product::create($request->all());
            return redirect()->route('products.index')
                ->with('success', 'Product created successfully.');
        }
    }
    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->role == "admin") {
            $product = Product::find($id);
            $product->delete();
            return redirect()->route('products.index');
        }
    }
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if ($user) {
            if ($user->role == "admin") {
                $request->validate([
                    'name' => 'required',
                    'price' => 'required',
                    'quantity' => 'required'
                ]);

                $product = Product::find($id);
                $product->name = $request->input('name');
                $product->price = $request->input('price');
                $product->quantity = $request->input('quantity');
                $product->save();
                return redirect()->route('products.index');
            }
        } else {

            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to access this page.']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\AddToCart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function index()
    {

        $user = Auth::user();
        if ($user) {
            if ($user->role == "customer") {

                $carts = AddToCart::with('product', 'user')
                    ->where('user_id', auth()->id())
                    ->get();

                return view('cart.index', compact('carts'));
            }
        } else {

            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to access this page.']);
        }
    }
    public function addToCart(Request $request)
    {

        $user = Auth::user();
        if ($user) {
            $productId = $request->input('product_id');
            $quantity = $request->input('quantity', 1);

            $product = Product::find($productId);

            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            if ($product->quantity < $quantity) {
                return response()->json(['error' => 'Not enough stock available'], 400);
            }

            $cartItem = AddToCart::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {

                if ($quantity > $product->quantity) {
                    return response()->json(['error' => 'Not enough stock available'], 400);
                }
                $cartItem->quantity += $quantity;
            } else {

                $cartItem = new AddToCart();
                $cartItem->user_id = Auth::id();
                $cartItem->product_id = $productId;
                $cartItem->quantity = $quantity;
            }

            $cartItem->save();

            // Decrease the product quantity
            $product->quantity -= $quantity;
            $product->save();

            return response()->json(['message' => 'Product added to cart', 'cartItem' => $cartItem]);
        } else {

            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to access this page.']);
        }
    }
}

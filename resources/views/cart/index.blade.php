<!-- cart/index.blade.php -->
@extends('layout')

@section('content')
<h1>Cart List</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
            <!-- <th>Actions</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach($carts as $cart)
        <tr>
            <td>{{ $cart->product->name }}</td>
            <td>{{ $cart->quantity }}</td>
            <td>{{ $cart->product->price }}</td>
            <td>{{ $cart->quantity * $cart->product->price }}</td>

        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total</th>
            <th>{{ $carts->sum(function ($cart) { return $cart->quantity * $cart->product->price; }) }}</th>
            <th></th>
        </tr>
    </tfoot>
</table>
@endsection
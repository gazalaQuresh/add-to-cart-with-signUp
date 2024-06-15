@extends('layout')

@section('content')
    <h1>Edit Product</h1>
    <div class="container">
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
 
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter product name" name="name" value="{{ $product->name }}" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" placeholder="Enter Quantity" name="quantity" value="{{ $product->quantity }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" class="form-control" id="price" placeholder="Enter Price" name="price" value="{{ $product->price }}" required>
        </div>
   
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    </div>
@endsection

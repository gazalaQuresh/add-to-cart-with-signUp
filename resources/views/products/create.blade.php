@extends('layout')

@section('content')
<h1>Create Product</h1>
<div class="container">
  <form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <label for="name">Product Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter product name" name="name">
    </div>
    <div class="form-group">
      <label for="quantity">Quantity:</label>
      <input type="text" class="form-control" id="quantity" placeholder="Enter Quantity" name="quantity">
    </div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="text" class="form-control" id="Price" placeholder="Enter Price" name="price">
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>


@endsection
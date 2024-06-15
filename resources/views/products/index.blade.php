@extends('layout')

@section('content')

<div class="container">
  <h1>Product List</h1>
  @if($user_role == "admin")
  <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
  @endif
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Available Quantity</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="products-container">
      <!-- Products will be rendered here dynamically -->
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
    fetchProducts();

    function fetchProducts() {
      $.ajax({
        url: '{{ route("products.fetch") }}',
        method: 'GET',
        success: function(response) {
          var products = response.products;
          var html = '';
          for (var i = 0; i < products.length; i++) {
            html += '<tr>';
            html += '<td>' + products[i].name + '</td>';
            html += '<td>' + products[i].price + '</td>';
            html += '<td>' + products[i].quantity + '</td>';
            html += '<td>';
            if ('{{ $user_role }}' == "admin") {
              html += '<a href="' + products[i].edit_url + '" class="btn btn-primary">Edit</a>';
              html += '<button class="btn btn-danger delete-product" data-product-id="' + products[i].id + '">Delete</button>';
            } else {
              html += '<button class="btn btn-primary add-to-cart" data-product-id="' + products[i].id + '">Add to Cart</button>';
            }
            html += '</td>';
            html += '</tr>';
          }
          $('#products-container').html(html);
        },
        error: function(response) {
          alert('Error: ' + response.responseJSON.error);
        }
      });
    }

    $(document).on('click', '.add-to-cart', function() {
      var productId = $(this).data('product-id');
      console.log(productId);
      $.ajax({
        url: '{{ route("cart.add") }}',
        method: 'POST',
        data: {
          _token: '{{ csrf_token() }}',
          product_id: productId,
          quantity: 1 // Or get quantity dynamically if needed
        },
        success: function(response) {
          alert(response.message);
          fetchProducts();
          // Optionally, update the cart UI
        },
        error: function(response) {
          alert('Error: ' + response.responseJSON.error);
        }
      });
    });

    $(document).on('click', '.delete-product', function() {
      var productId = $(this).data('product-id');

      $.ajax({
        url: '{{ route("products.destroy", ":id") }}'.replace(':id', productId),
        method: 'DELETE',
        data: {
          _token: '{{ csrf_token() }}' // Add the CSRF token here
        },
        success: function(response) {

          fetchProducts();
        },
        error: function(response) {
          alert('Error: ' + response.responseJSON.error);
        }
      });
    });
  });
</script>

@endsection
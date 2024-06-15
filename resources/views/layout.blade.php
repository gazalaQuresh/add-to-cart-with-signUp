<!DOCTYPE html>
<html>

<head>
    <title>Product List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            overflow: hidden;
            background-color: #333;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .content {
            padding: 16px;
            margin-top: 50px;
            /* Add a top margin to avoid content overlay */
        }

        .alert {
            margin-top: 10px;
            padding: 15px;
            background-color: #4CAF50;
            /* Green */
            color: white;
        }
    </style>
</head>

<body>
    <div class="navbar">

        @if (Auth::check())

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <a href="{{ route('products.index') }}">Home</a>


        @if(Auth::user()->role == "admin")
        <a href="{{ route('products.create') }}">Create Product</a>
        @endif

        @if(Auth::user()->role == "customer")
        <a href="{{ route('cart.index') }}">Cart List </a>


        @endif
        @endif
        <!-- Add more links as needed -->
    </div>

    <div class="content">
        @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
        @endif
        @yield('content')
    </div>
</body>

</html>
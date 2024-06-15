<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #f0f0f0;
    }

   .registration-form {
      width: 300px;
      background-color: #f7f7f7;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

   .registration-form h2 {
      margin-top: 0;
      font-weight: bold;
      color: #333;
    }

   .registration-form input[type="text"],.registration-form input[type="email"],.registration-form input[type="password"] {
      width: 100%;
      height: 40px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
    }

   .registration-form button[type="submit"] {
      width: 100%;
      height: 40px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

   .registration-form button[type="submit"]:hover {
      background-color: #3e8e41;
    }

   .registration-form p {
      margin-top: 20px;
      font-size: 14px;
      color: #666;
    }
   .error {
    color: red;
    font-size: 15px;
    margin-bottom: 10px;
}
  </style>
</head>
<body>
<div class="registration-form">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        @error('name')
            <span class="error">{{ $message }}</span>
        @enderror
        <input type="text" placeholder="Full Name"  name="name"/>
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror
        <input type="email" placeholder="Email"  name="email"/>
        @error('password')
            <span class="error">{{ $message }}</span>
        @enderror
        <input type="password" placeholder="Password" name="password" />
    

        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="#">Login</a></p>
</div>
</body>
</html>
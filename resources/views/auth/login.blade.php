<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #f0f0f0;
    }

    .login-form {
      width: 300px;
      background-color: #f7f7f7;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-form h2 {
      margin-top: 0;
      font-weight: bold;
      color: #333;
    }

    .login-form input[type="text"],
    .login-form input[type="password"] {
      width: 100%;
      height: 40px;
      margin-bottom: 20px;

      border: 1px solid #ccc;
    }

    .login-form button[type="submit"] {
      width: 100%;
      height: 40px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .login-form button[type="submit"]:hover {
      background-color: #3e8e41;
    }

    .login-form p {
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
  <div class="login-form">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      @error('email')
      <span class="error">{{ $message }}</span>
      @enderror
      <input type="text" placeholder="Enter email" name="email" />
      @error('login_password')
      <span class="error">{{ $message }}</span>
      @enderror
      <input type="password" placeholder="Enter Password" name="password" />
      <button type="submit">Login</button>
    </form>

  </div>
</body>

</html>
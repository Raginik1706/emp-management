<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LoginPage</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">

    @vite(['resources/js/app.js'])

</head>

<body>

    <div class=" login-container ">
        <h2>Employee Login</h2>
        <form id="loginForm">
            
            @csrf
            <label for="">Email Address</label>
            <input type="email" name="email" id="login-email">

            @error('email')
                <span style="color: red">{{$message}}</span>
            @enderror
            <div>
                <label for="">Password</label>
                <br>
                <br>
                <input type="password" name="password" id="login-password">
            </div>
 
            @error('password')
                <span style="color: red">{{$message}}</span>
            @enderror

            <button type="submit">Login</button>
            <div class="create-account-link">
                <span>Don't have account?</span><a href="/">Create Account</a>
            </div>

        </form>

    </div>

</body>

</html>
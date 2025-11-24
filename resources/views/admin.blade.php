<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminPage</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>

<body>

    <div class=" login-container ">
        <h2>Admin Login</h2>
        <form action="/empLogin" method="POST">
            @csrf
           <div>
               <label for="">Email Address</label>
               <input type="email" name="email" id="login-email">

                @error('email')
                <span style="color: red">{{$message}}</span>
                @enderror
                </div>


            <div>
                <label for="">Password</label>
                <br>
                <br>
                <input type="password" name="password" id="login-password">
                 @error('password')
                    <span style="color: red">{{$message}}</span>
                 @enderror
            </div>


            <button type="submit">Login</button>
           

        </form>

    </div>

</body>

</html>
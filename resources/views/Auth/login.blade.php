<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if (session('error'))
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
    @endif

    <br>

    <form action="{{ route('login.post') }}" method="post">
        @csrf
        <input type="email" name="email" value="email@gmail.com"> <br>
        @error('email') <p>Email Wajib Diisi</p> @enderror
        <input type="password" name="password" value="123123123"> <br>
        @error('password') <p>Email Wajib Diisi</p> @enderror

        <input type="submit" value="login">
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pinama - Login</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <style>
        body {
            background-color: #4e73df;
            background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
        }

        .card-body {
            text-align: center;
            padding: 40px;
        }

        .login-form {
            width: 100%;
            max-width: 330px;
            margin: auto;
        }

        .login-form input {
            margin-bottom: 20px;
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-form button {
            background-color: #4e73df;
            color: #fff;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #2e59d9;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome To Pinama!</h1>
                </div>
                @if(session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if($errors->any())
                    @foreach($errors->all() as $err)
                        <p class="alert alert-danger">{{ $err }}</p>
                    @endforeach
                @endif

                <form class="login-form" action="{{ route('login.action') }}" method="post">
                    @csrf
                    <input name="username" value="{{ old('username') }}" type="username" placeholder="Username" required>
                    <input name="password" type="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>

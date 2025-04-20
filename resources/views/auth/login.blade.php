<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 50px;
            border-radius: 18px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .login-container h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        .input-group input {
            width: 100%;
            padding: 10px 40px 10px 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .input-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        .input-group .toggle-password {
            right: 10px;
            left: auto;
            cursor: pointer;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="login-container">
        <h1>Login</h1>
        <form method="POST" action="{{ route('loginproses') }}">
            @csrf
            <div class="input-group">
                <i class="fa fa-user" style="color: rgb(211, 182, 95);"></i>
                <input type="text" id="name" name="name" placeholder="Name" required autofocus>
            </div>
            <div class="input-group">
                <i class="fa fa-envelope" style="color: rgba(220, 215, 215, 0.908);"></i>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <i class="fa fa-lock" style="color: rgb(224, 224, 41);"></i>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="fa fa-eye toggle-password"  onclick="togglePasswordVisibility('password')" style="color: rgb(39, 39, 38);"></i>
            </div>
            <button type="submit">LOGIN</button>
        </form>
    </div>
    <script>
        function togglePasswordVisibility(id) {
            const input = document.getElementById(id);
            const icon = input.nextElementSibling;
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>

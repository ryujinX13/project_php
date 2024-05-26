<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .welcome-container {
            margin-top: 100px;
        }

        .welcome-text {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
        }

        .button-container button.login {
            background-color: #007bff;
            color: white;
            margin-right: 10px;
        }

        .button-container button.login:hover {
            background-color: #0056b3;
        }

        .button-container button.register {
            background-color: #28a745;
            color: white;
        }

        .button-container button.register:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>

    <div class="welcome-container">
        <h1>Welcome to Our Website!</h1>
        <p>Please login to access your account.</p>
        <div class="button-container">

            <a href="view/user/login.php"><button class="login">Login</button></a>

            <a href="view/user/register.php"><button class="register">Register</button></a>
        </div>
    </div>

</body>

</html>

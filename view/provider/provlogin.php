<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9; /* Light beige background */
            margin: 0;
            padding: 0;
            color: #333; /* Dark grey text for better readability */
        }
        .tab-bar {
            display: flex;
            align-items: center;
            background-color: #96B6C5;
            padding: 10px 0;
            justify-content: center;
            position: fixed;
            top: 0;
            width: 100%;
        }

        .tab-bar img {
            height: 70px;
            margin-right: 500px;
        }

        .tab-link {
            padding: 10px 20px;
            text-decoration: none;
            color: black;
            border: 1px solid transparent;
            border-radius: 3px;
            margin: 0 10px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .tab-link:hover {
            background-color: #ccc;
            border-color: #bbb;
        }
        .tab-link.login {
            background-color: #F4CE14;
            color: black;
            border-radius: 10px;
        }
        .tab-link.register {
            background-color: #007bff;
            color: white;
            border-radius: 10px;
        }

        .tab-link.login:hover, .tab-link.register:hover {
            background-color: #F4CE14;
            color: white;
        }

        .login-container {
            width: 340px; /* Adjusted for better spacing */
            padding: 10px;
            border: none; /* Removing the border for a cleaner look */
            border-radius: 8px;
            background-color: #96B6C5;
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
            text-align: center;
            margin-top: 120px; /* Added margin to prevent overlap with the tab bar */
            margin-left: auto; /* Centering horizontally */
            margin-right: auto; /* Centering horizontally */
        }


        .login-logo img {
            width: 340px; /* Example width */
            height: 150px; /* Example height */
            margin-bottom: 20px;
        }

        h3 {
            color: #000000; /* Softer color for the header */
            margin-bottom: 15px;
        }

        label {
            float: left;
            font-size: 14px;
            color: #666; /* Soft color for labels */
            clear: both; /* Ensures labels align properly with input fields */
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px; /* Increased for better spacing */
            border: 1px solid #96B6C5; /* Thicker border for focus */
            border-radius: 15px;
            box-sizing: border-box; /* Better width management */
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #ADC4CE; /* Highlight on focus */
        }

        input[type="submit"] {
            width: 40%;
            padding: 12px;
            background-color: #F4CE14; /* Consistent with theme */
            border: none;
            border-radius: 20px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #7a95a8; /* Slightly darker on hover */
        }

        .forgot-password {
            margin-top: 12px;
        }

        .forgot-password a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-password a:hover {
            color: #0056b3; /* Darker blue on hover */
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="tab-bar">
    <img src="img/logo1.png" alt="Logo">
    <a href="index.html" class="tab-link">หน้าแรก</a>
    <a href="booking.html" class="tab-link">การจอง</a>
    <a href="booking_list.html" class="tab-link">รายการจอง</a>
    <a href="history.html" class="tab-link">ประวัติ</a>
    <a href="careers.html" class="tab-link">สมัครงาน</a>
    <a href="login.html" class="tab-link login">เข้าสู่ระบบ</a>
    <a href="register.html" class="tab-link register">ลงทะเบียน</a>
</div>

<div class="login-container">
    <div class="login-logo">
        <img src="img/logo1.png" alt="Logo">
    </div>
    <h3>ลงชื่อเข้าใช้ผู้ให้บริการ</h3>
    <form action="../../process/provlogin_process.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Login">
    </form>
    <div class="forgot-password">
        <a href="recover_psw.php">ลืมรหัสผ่าน?</a>
    </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFE4CF;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .tab-bar {
            display: flex;
            align-items: center;
            background-color: #96B6C5;
            padding: 10px 0;
            justify-content: center;
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

        .content-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .login-container {
            background-color: #F5F7F8;
            width: 600px;
            padding: 40px;
            margin-right: 20px;
            border-radius: 10px;

        }

        h2 {
            text-align: center;
        }

        .login-image {
            width: 600px;
            padding: 30px;
            margin-right: 20px;
            border-radius: 30px;

        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 40px);
            padding: 12px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f8f8f8;
        }

        input[type="submit"] {
            width: 30%;
            padding: 15px;
            background-color: #F4CE14;
            border: none;
            border-radius: 20px;
            color: white;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #007bff;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
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

        .tab-link.login:hover,
        .tab-link.register:hover {
            background-color: #F4CE14;
            color: white;
        }
    </style>
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="index.php" class="tab-link">หน้าแรก</a>
        <a href="select_provider.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติ</a>
        <a href="careers.php" class="tab-link">สมัครงาน</a>
        <a href="login.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.php" class="tab-link register">ลงทะเบียน</a>
    </div>
    <div class="content-wrapper">
        <img src="../../img/p1.jpg" class="login-image" alt="Login Image">
        <div class="login-container">
            <h2>เข้าสู่ระบบ</h2>
            <form action="../../process/login_process.php" method="post">
                <label for="username">E-mail:</label>
                <input type="text" id="username" name="username" required placeholder="กรุณากรอก E-mail">
                <label for="password">รหัสผ่าน:</label>
                <input type="password" id="password" name="password" required placeholder="กรุณากรอกรหัสผ่าน">
                <input type="submit" value="Login">
            </form>
            <div class="forgot-password">
                <a href="recover_psw.php">ลืมรหัสผ่าน?</a>
            </div>
        </div>
    </div>
</body>

</html>
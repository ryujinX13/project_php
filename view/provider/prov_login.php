<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="../../css/provider/stylesprovlogin.css">
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
    </div>

    <div class="content-wrapper">
        <img src="../../img/p1.jpg" class="login-image" alt="Login Image">
        <div class="login-container">
            <h2>เข้าสู่ระบบผู้ให้บริการ</h2>
            <form action="../../process/provlogin_process.php" method="post">
                <label for="username">ชื่อผู้ใช้:</label>
                <input type="text" id="username" name="username" required placeholder="กรุณากรอกชื่อผู้ใช้">
                <label for="password">รหัสผ่าน:</label>
                <input type="password" id="password" name="password" required placeholder="กรุณากรอกรหัสผ่าน">
                <input type="submit" value="เข้าสู่ระบบ">
            </form>
            <div class="forgot-password">
                <a href="recover_psw.php">ลืมรหัสผ่าน?</a>
            </div>
        </div>
    </div>
</body>

</html>

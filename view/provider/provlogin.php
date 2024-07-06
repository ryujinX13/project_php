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
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="select_provider.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติ</a>
        <a href="announce.php" class="tab-link">สมัครงาน</a>
        <a href="login.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.php" class="tab-link register">ลงทะเบียน</a>
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
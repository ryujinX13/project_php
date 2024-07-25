<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesadmin_login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="tab-bar">
        <button class="back-button" onclick="window.location.href='../user/login_level.php'">⬅️</button>
        <img src="../../img/logo1.png" alt="Logo" style="margin-left: 10px;">
    </div>

    <body>

    <div class="content-wrapper">
        <div class="login-container">
            <h2>เข้าสู่ระบบ</h2>
            <h3>ผู้ดูแลระบบ</h3>
            <form action="../../process/adminlogin_process.php" method="post">
                <label for="username">ชื่อผู้ใช้:</label>
                <input type="text" id="username" name="username" required placeholder="กรุณากรอกชื่อผู้ใช้">
                <label for="password">รหัสผ่าน:</label>
                <input type="password" id="password" name="password" required placeholder="กรุณากรอกรหัสผ่าน">
                <input type="submit" value="เข้าสู่ระบบ" name="admin_login">
            </form>
        </div>
    </div>
</body>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.querySelectorAll('.booking-link, .booking-list-link, .history-link').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                $('#loginModal').modal('show');
            });
        });
    </script>
</body>

</html>

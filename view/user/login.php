<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลูกหลานสำรอง - บริการพาไปหาหมอ ดูแลแทนญาติเหมือนลูกหลานของท่าน</title>
    <link rel="stylesheet" type="text/css" href="../../css/user/styleslogin.css">
</head>

<body>
    <div class="tab-bar">
        <button class="back-button" onclick="window.location.href='../../index.php'">⬅️</button>
        <img src="../../img/logo1.png" alt="Logo" style="margin-left: 10px;">
    </div>
  
    <div class="content-wrapper">
        <img src="../../img/p1.jpg" class="login-image" alt="Login Image">
        
        <div class="login-container">
            
            <h2>เข้าสู่ระบบผู้ใช้งาน</h2>
            <form action="../../process/login_process.php" method="post">
                <label for="username">ชื่อผู้ใช้:</label>
                <input type="text" id="username" name="username" required placeholder="กรุณากรอกชื่อผู้ใช้" class="form-input">
                <label for="password">รหัสผ่าน:</label>
                <input type="password" id="password" name="password" required placeholder="กรุณากรอกรหัสผ่าน" class="form-input">
                <input type="checkbox" id="show-password" class="checkbox">
            <input type="submit" value="เข้าสู่ระบบ" class="submit-button">
</form>
            <div class="forgot-password">
                <a href="recover_psw.php">ลืมรหัสผ่าน?</a>
            </div>
            <div class="register">
                <a href="register.php">สร้างบัญชี</a>
            </div>
        </div>
    </div>
    
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
    <script>
        document.getElementById('show-password').addEventListener('change', function() {
            var passwordInput = document.getElementById('password');
            if (this.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
</body>

</html>

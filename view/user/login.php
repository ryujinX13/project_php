<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="../../css/user/styleslogin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="select_provider.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติ</a>
        <a href="../provider/announce.php" class="tab-link">สมัครงาน</a>
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

    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">กรุณาเข้าสู่ระบบ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    กรุณาเข้าสู่ระบบก่อนทำการจอง
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <a href="login.php" class="btn btn-primary">เข้าสู่ระบบ</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('booking-link').addEventListener('click', function (event) {
            event.preventDefault();
            $('#loginModal').modal('show');
        });

        document.getElementById('booking-list-link').addEventListener('click', function (event) {
            event.preventDefault();
            $('#loginModal').modal('show');
        });

        document.getElementById('history-link').addEventListener('click', function (event) {
            event.preventDefault();
            $('#loginModal').modal('show');
        });
    </script>

</body>

</html>
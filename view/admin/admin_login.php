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
        <button class="back-button" onclick="window.location.href='../user/login_level.php'">⬅️</button>
        <img src="../../img/logo1.png" alt="Logo" style="margin-left: 10px;">
    </div>

    <div class="content-wrapper">
        <img src="../../img/p1.jpg" class="login-image" alt="Login Image">
        <div class="login-container">
            <h2>เจ้าหน้าที่พนักงาน</h2>
            <form action="../../process/login_process.php" method="post">
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
        document.querySelectorAll('.booking-link, .booking-list-link, .history-link').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                $('#loginModal').modal('show');
            });
        });
    </script>
</body>

</html>
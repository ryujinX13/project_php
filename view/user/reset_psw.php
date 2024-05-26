<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบฟอร์มรีเซ็ตรหัสผ่าน</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #96B6C5;
            /* สีพื้นหลัง */
            color: #343a40;
            /* สีข้อความ */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* แบบอักษร */
        }

        .navbar {
            border-bottom: 1px solid #fff;
            /* เส้นขอบ navbar */
            border-radius: 15px;
            padding: 40px;
        }

        .card {
            border: none;
            /* ไม่มีเส้นขอบของ card */
            border-radius: 15px;
            /* มุมของ card */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            /* เงาของ card */
        }

        .card-header {
            background-color: #0077b6;
            /* สีพื้นหลัง header card */
            color: #fff;
            /* สีข้อความ header card */
            border-radius: 15px 15px 0 0;
            /* มุมของ header card */
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 10px;
            /* ขอบใน header card */
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
        }

        .card-header h5 {
            margin-bottom: 0;
            text-align: center;
            font-size: 18px;
        }

        .logo {
            width: 200px;
            /* ขนาดโลโก้ */
            position: absolute;
            left: 50%;
            top: -100px;
            /* ตำแหน่งโลโก้ */
            transform: translateX(-50%);
        }

        .btn-primary {
            padding: 10px 40px;
            /* ขนาด padding ของปุ่ม */
            font-size: 16px;
            /* ขนาดตัวอักษรของปุ่ม */
            background-color: #03045e;
            /* สีพื้นหลังปุ่ม */
            border-color: #0062cc;
            /* สีเส้นขอบปุ่ม */
            border-radius: 30px;
            /* มุมของปุ่ม */
        }

        .btn-primary:hover {
            background-color: #03045e;
            /* สีพื้นหลังปุ่มเมื่อ hover */
            border-color: #0052cc;
            /* สีเส้นขอบปุ่มเมื่อ hover */
        }

        .form-control {
            border-radius: 10px;
            /* มุมของ input field */
        }

        .centered {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }
    </style>
</head>

<body>
    <main class="centered">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <img src="img/logo1.png" alt="Logo" class="logo">
                            <h5>รีเซ็ตรหัสผ่านของคุณ</h5>
                        </div>
                        <div class="card-body">
                            <form action="#" method="POST" name="login">
                                <div class="form-group">
                                    <label for="password">รหัสผ่านใหม่</label>
                                    <div class="input-group">
                                        <input type="password" id="password" class="form-control" name="password"
                                            required autofocus>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small id="passwordHelp"
                                        class="form-text text-muted">โปรดใส่รหัสผ่านใหม่ที่คุณต้องการใช้
                                        ระวังตัวอักษรตัวเล็กและตัวใหญ่</small>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary" name="reset">รีเซ็ต</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        const toggle = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        toggle.addEventListener('click', function () {
            if (password.type === "password") {
                password.type = 'text';
                toggle.classList.remove('bi-eye-slash');
                toggle.classList.add('bi-eye');
            } else {
                password.type = 'password';
                toggle.classList.remove('bi-eye');
                toggle.classList.add('bi-eye-slash');
            }
        });
    </script>
</body>

</html>
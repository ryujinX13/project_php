<?php
session_start();
include ('../../connect/connection.php');

if (isset($_POST["reset"])) {
    $user_password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // ตรวจสอบเงื่อนไขรหัสผ่าน
    if (strlen($user_password) < 8) {
        ?>
        <script>
            alert("รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร");
        </script>
        <?php
    } elseif (!preg_match("/[A-Z]/", $user_password)) {
        ?>
        <script>
            alert("รหัสผ่านต้องมีตัวอักษรตัวใหญ่ (A-Z) อย่างน้อย 1 ตัว");
        </script>
        <?php
    } elseif (!preg_match("/[a-z]/", $user_password)) {
        ?>
        <script>
            alert("รหัสผ่านต้องมีตัวอักษรตัวเล็ก (a-z) อย่างน้อย 1 ตัว");
        </script>
        <?php
    } elseif (!preg_match("/[0-9]/", $user_password)) {
        ?>
        <script>
            alert("รหัสผ่านต้องมีตัวเลข (0-9) อย่างน้อย 1 ตัว");
        </script>
        <?php
    } elseif ($user_password !== $confirm_password) {
        ?>
        <script>
            alert("รหัสผ่านไม่ตรงกัน โปรดลองอีกครั้ง");
        </script>
        <?php
    } else {
        if (isset($_SESSION['User_email'])) {
            $user_email = $_SESSION['User_email'];

            // เข้ารหัสรหัสผ่าน
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT);

            $sql = "UPDATE user SET User_password='$hashed_password' WHERE User_email='$user_email'";

            if (mysqli_query($conn, $sql)) {
                ?>
                <script>
                    window.location.replace("../../index.php");
                    alert("รหัสผ่านของคุณได้รับการรีเซ็ตเรียบร้อยแล้ว");
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("เกิดข้อผิดพลาดขณะรีเซ็ตรหัสผ่าน โปรดลองอีกครั้ง");
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("ไม่ได้กำหนดที่อยู่อีเมล โปรดลองอีกครั้ง");
            </script>
            <?php
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีเซ็ตรหัสผ่านของคุณ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .card-header {
            text-align: center;
        }
        .form-control {
            padding-right: 10px;
        }
        .password-requirements {
            font-size: 14px;
            color: red;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="#">Password Reset Form</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">แก้ไขรหัสผ่านของคุณ</div>
                        <div class="card-body">
                            <form action="#" method="POST" name="login">
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">รหัสผ่านใหม่</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirm_password" class="col-md-4 col-form-label text-md-right">ยืนยันรหัสผ่าน</label>
                                    <div class="col-md-6">
                                        <input type="password" id="confirm_password" class="form-control" name="confirm_password" required>
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" value="แก้ไข" name="reset" class="btn btn-primary">
                                </div>
                                <div class="password-requirements">
                                    <p>รหัสผ่านต้องมี:</p>
                                    <ul>
                                        <li>ความยาวอย่างน้อย 8 ตัวอักษร</li>
                                        <li>ตัวอักษรตัวใหญ่ (A-Z) อย่างน้อย 1 ตัว</li>
                                        <li>ตัวอักษรตัวเล็ก (a-z) อย่างน้อย 1 ตัว</li>
                                        <li>ตัวเลข (0-9) อย่างน้อย 1 ตัว</li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>

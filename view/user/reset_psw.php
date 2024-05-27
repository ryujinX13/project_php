<?php
session_start();
include ('../../connect/connection.php');

if (isset($_POST["reset"])) {
    $user_password = $_POST["password"];

    if (isset($_SESSION['User_email'])) {
        $user_email = $_SESSION['User_email'];

        $sql = "UPDATE user SET User_password='$user_password' WHERE User_email='$user_email'";

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
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
                        <div class="card-header">Reset Your Password</div>
                        <div class="card-body">
                            <form action="#" method="POST" name="login">
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">New
                                        Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password"
                                            required autofocus>
                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" value="Reset" name="reset">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const toggle = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        toggle.addEventListener('click', function () {
            if (password.type === "password") {
                password.type = 'text';
            } else {
                password.type = 'password';
            }
            this.classList.toggle('bi-eye');
        });
    </script>

</body>

</html>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลูกหลานสำรองบริการพาไปหาหมอ - ลืมรหัสผ่าน</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0ead6;
            margin: 0;
            padding: 0;
        }

        .navbar-laravel {
            background-color: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .login-form {
            padding-top: 50px;
        }

        .card {
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }

        .header-text {
            color: #222;
            font-size: 24px;
            font-weight: 500;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #ffcc00;
            border-color: #ffcc00;
            color: #000;
        }

        .btn-primary:hover {
            background-color: #ff9900;
            border-color: #ff9900;
        }

        .form-group label {
            font-weight: 500;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../../img/logo1.png" alt="Logo" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">การจอง</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">รายการจอง</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ประวัติ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">สมัครงาน</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">เข้าสู่ระบบ</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning" href="#">ลงทะเบียน</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header header-text">ลืมรหัสผ่าน</div>
                        <div class="card-body">
                            <form action="#" method="POST" name="recover_psw" onsubmit="return validateForm()">
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">กรุณาใส่ Email ที่คุณใช้ล็อคอิน</label>
                                    <div class="col-md-6">
                                        <input type="email" id="email_address" class="form-control" name="email"
                                            required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" name="recover">ตรวจสอบ</button>
                                    </div>
                                </div>
                                <div id="error-message" class="text-danger text-center"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        function validateForm() {
            const email = document.getElementById('email_address').value;
            const errorMessage = document.getElementById('error-message');
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

            if (!emailPattern.test(email)) {
                errorMessage.textContent = 'กรุณาใส่อีเมลที่ถูกต้อง';
                return false;
            }

            errorMessage.textContent = '';
            return true;
        }
    </script>
</body>

</html>

<?php
if (isset($_POST["recover"])) {
    include ('../../connect/connection.php');
    $email = $_POST["email"];

    $stmt = $conn->prepare("SELECT * FROM user WHERE User_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $fetch = $result->fetch_assoc();

    if ($result->num_rows <= 0) {
        echo "<script>alert('Sorry, no email exists');</script>";
    } elseif ($fetch["User_status"] == 0) {
        echo "<script>
                alert('Sorry, your account must verify first, before you recover your password!');
                window.location.replace('index.php');
              </script>";
    } else {
        $token = bin2hex(random_bytes(50));

        $_SESSION['token'] = $token;
        $_SESSION['User_email'] = $email;

        require '../../Mail/phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'rewza568@gmail.com';
        $mail->Password = 'khqp zihl rhfu ppdk';

        $mail->setFrom('rewza568@gmail.com', 'Ryujin');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Recover your password';
        $mail->Body = "<b>Dear User</b>
                       <h3>We received a request to reset your password.</h3>
                       <p>Kindly click the below link to reset your password</p>
                       <a href='http://localhost/project_php/view/user/reset_psw.php?token=$token'>Reset Password</a>
                       <br><br>
                       <p>With regards,</p>
                       <b>Programming with Lam</b>";

        if (!$mail->send()) {
            echo "<script>alert('Invalid Email');</script>";
        } else {
            echo "<script>window.location.replace('notification.html');</script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

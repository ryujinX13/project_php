<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลูกหลานสำรองบริการพาไปหาหมอ - ลืมรหัสผ่าน</title>
    <link rel="stylesheet" type="text/css" href="../../css/user/stylesrecover_psw.css">
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="booking.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติการจอง</a>
        <a href="announce.php" class="tab-link">ประกาสรับสมัครงาน</a>
        <a href="login_level.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.php" class="tab-link register">ลงทะเบียน</a>
    </div>

    <main class="login-form">
        <div class="container">
            <div class="form-wrapper">
                <div class="card">
                    <div class="card-header header-text">ลืมรหัสผ่าน</div>
                    <div class="card-body">
                        <form action="#" method="POST" name="recover_psw" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="email_address" class="form-label">กรุณาใส่ Email ที่คุณใช้ล็อคอิน</label>
                                <input type="email" id="email_address" class="form-control" name="email" required autofocus>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="recover">ตรวจสอบ</button>
                            </div>
                            <div id="error-message" class="text-danger text-center"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

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
                window.location.replace('otp_verification.php');
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
        $mail->Username = 'lookhlan909@gmail.com';
        $mail->Password = 'ffnq ulkn acxb srqz';

        $mail->setFrom('lookhlan909@gmail.com', 'Lookhlan');
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

<?php
session_start();
include ('../../connect/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM User WHERE User_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $fetch = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        if ($fetch["User_status"] == 0) {
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['user_email'] = $email;

            require "../../Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = 'lookhlan909@gmail.com';
            $mail->Password = 'ffnq ulkn acxb srqz';

            $mail->setFrom('lookhlan909@gmail.com', 'Lookhlan');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Your verify code";
            $mail->Body = 'รหัส OTP ของคุณคือ ' . $otp;

            if ($mail->send()) {
                echo '<script>alert("รหัส OTP ได้ถูกส่งใหม่แล้ว"); window.location.replace("otp_verification.php");</script>';
            } else {
                echo 'เกิดข้อผิดพลาดในการส่งอีเมล์: ' . $mail->ErrorInfo;
            }
        } else {
            echo '<script>alert("บัญชีนี้ได้รับการยืนยันแล้ว"); window.location.replace("login.php");</script>';
        }
    } else {
        echo '<script>alert("ไม่พบอีเมลนี้ในระบบ");</script>';
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resend OTP</title>
    <link rel="stylesheet" href="../../css/user/stylesresend_otp.css">
</head>
<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="select_provider.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติการจอง</a>
        <a href="announce.php" class="tab-link">ประกาสรับสมัครงาน</a>
        <a href="login.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.php" class="tab-link register">ลงทะเบียน</a>
    </div>
    <main class="login-form">
        <div class="container">
            <div class="form-wrapper">
                <div class="card">
                    <div class="card-header header-text">ส่งรหัส OTP ใหม่</div>
                    <div class="card-body">
                        <form action="resend_otp.php" method="post" name="send_otp">
                            <div class="form-group">
                                <label for="email" class="form-label">อีเมล:</label>
                                <input type="email" id="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">ส่งรหัส OTP ใหม่</button>
                            </div>
                            <div id="error-message" class="text-danger text-center"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>


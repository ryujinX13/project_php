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
            $mail->Username = 'rewza568@gmail.com';
            $mail->Password = 'khqp zihl rhfu ppdk';

            $mail->setFrom('rewza568@gmail.com', 'Ryujin');
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
    <link rel="stylesheet" type="text/css" href="../../css/user/stylesresend_otp.css">
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="select_provider.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติ</a>
        <a href="announce.php" class="tab-link">สมัครงาน</a>
        <a href="login.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.php" class="tab-link register">ลงทะเบียน</a>
    </div>
    <div class="container">
        <h1>ส่งรหัส OTP ใหม่</h1>
        <form action="resend_otp.php" method="post">
            <label for="email">อีเมล์:</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="ส่งรหัส OTP ใหม่">
        </form>
    </div>
</body>

</html>
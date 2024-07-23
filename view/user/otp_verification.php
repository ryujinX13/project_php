<?php
session_start();
include ('../../connect/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp_code = $_POST['otp_code'];
    $user_email = $_SESSION['user_email'];
    $stored_otp = $_SESSION['otp'];

    if ($stored_otp == $otp_code) {
        $sql = "UPDATE User SET User_status = 1 WHERE User_email = '$user_email'";

        if ($conn->query($sql) === TRUE) {
            unset($_SESSION['otp']);
            echo '<script>alert("ยืนยันบัญชีสำเร็จ"); window.location.replace("login.php");</script>';
        } else {
            echo "เกิดข้อผิดพลาดในการยืนยันบัญชี: " . $conn->error;
        }
    } else {
        echo '<script>alert("รหัส OTP ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง");</script>';
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" type="text/css" href="../../css/user/stylesverification.css">
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
        <h1>ยืนยันรหัส OTP</h1>
        <form action="otp_verification.php" method="post">
            <label for="otp_code">รหัส OTP:</label>
            <input type="text" id="otp_code" name="otp_code" required>
            <input type="submit" value="ยืนยัน">
        </form>
        <p>ยังไม่ได้รับรหัส OTP? <a href="resend_otp.php">ส่งรหัสใหม่</a>.</p>
    </div>
</body>

</html>
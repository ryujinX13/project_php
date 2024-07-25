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
    <title>ยืนยันรหัส OTP</title>
    <link rel="stylesheet" type="text/css" href="../../css/user/stylesotp_verification.css">
</head>

<body>
    <div class="tab-bar">
    <button class="back-button" onclick="window.location.href='login_level.php'">⬅️</button>
    <img src="../../img/logo1.png" alt="Logo" style="margin-left: 10px;">
        
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
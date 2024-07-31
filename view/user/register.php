<?php
include ('../../connect/connection.php');
session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $user_gender = mysqli_real_escape_string($conn, $_POST['user_gender']);
    $user_birthday = mysqli_real_escape_string($conn, $_POST['user_birthday']);
    $user_addressnow = mysqli_real_escape_string($conn, $_POST['user_addressnow']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $user_phone = mysqli_real_escape_string($conn, $_POST['user_phone']);

    if ($user_gender != '0' && $user_gender != '1') {
        die("เกิดข้อผิดพลาด: เพศไม่ถูกต้อง");
    }

    // ตรวจสอบเงื่อนไขรหัสผ่าน
    if (strlen($password) < 8) {
        die("รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร");
    }
    if (!preg_match("/[A-Z]/", $password)) {
        die("รหัสผ่านต้องมีตัวอักษรตัวใหญ่ (A-Z) อย่างน้อย 1 ตัว");
    }
    if (!preg_match("/[a-z]/", $password)) {
        die("รหัสผ่านต้องมีตัวอักษรตัวเล็ก (a-z) อย่างน้อย 1 ตัว");
    }
    if (!preg_match("/[0-9]/", $password)) {
        die("รหัสผ่านต้องมีตัวเลข (0-9) อย่างน้อย 1 ตัว");
    }

    // ตรวจสอบว่ารหัสผ่านตรงกันหรือไม่
    if ($password !== $confirm_password) {
        die("รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน");
    }

    // ตรวจสอบว่า email ซ้ำหรือไม่
    $sql_check_email = $conn->prepare("SELECT User_email FROM User WHERE User_email = ?");
    $sql_check_email->bind_param("s", $user_email);
    $sql_check_email->execute();
    $sql_check_email->store_result();

    if ($sql_check_email->num_rows > 0) {
        echo '<script>alert("อีเมลนี้ถูกใช้ไปแล้ว กรุณาใช้อีเมลอื่น"); window.history.back();</script>';
        $sql_check_email->close();
    } else {
        $sql_check_email->close();

        // เข้ารหัสรหัสผ่าน
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // เตรียมคำสั่ง SQL และ bind ค่า
        $sql = $conn->prepare("INSERT INTO User (User_id, User_Username, User_password, User_name, User_gender, User_birthday, User_addressnow, User_email, User_phone ,User_status) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0)");
        $sql->bind_param("ssssssssss", $user_id, $username, $hashed_password, $user_name, $user_gender, $user_birthday, $user_addressnow, $user_email, $user_phone);

        // ดำเนินการคำสั่ง SQL
        if ($sql->execute() === TRUE) {
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['user_email'] = $user_email;

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
            $mail->addAddress($user_email);

            $mail->isHTML(true);
            $mail->Subject = "Your verify code";
            $mail->Body = 'รหัส OTP ของคุณคือ ' . $otp;

            if ($mail->send()) {
                echo '<script>alert("ลงทะเบียนสำเร็จ"); window.location.replace("verification.php");</script>';
            } else {
                echo 'เกิดข้อผิดพลาดในการส่งอีเมล์: ' . $mail->ErrorInfo;
            }
        } else {
            echo "เกิดข้อผิดพลาด: " . $sql->error;
        }

        // ปิดคำสั่ง
        $sql->close();
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>

<?php
include ('../connect/connection.php');
session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $user_gender = mysqli_real_escape_string($conn, $_POST['user_gender']);
    $user_birthday = mysqli_real_escape_string($conn, $_POST['user_birthday']);
    $user_addressnow = mysqli_real_escape_string($conn, $_POST['user_addressnow']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $user_phone = mysqli_real_escape_string($conn, $_POST['user_phone']);

    if ($user_gender != '0' && $user_gender != '1') {
        die("เกิดข้อผิดพลาด: เพศไม่ถูกต้อง");
    }

    $sql = "INSERT INTO User (User_id, User_Username, User_password, User_name, User_gender, User_birthday, User_addressnow, User_email, User_phone ,User_status) 
        VALUES ('$user_id', '$username', '$password', '$user_name', '$user_gender', '$user_birthday', '$user_addressnow', '$user_email', '$user_phone',0)";

    if ($conn->query($sql) === TRUE) {
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['user_email'] = $user_email;

        require "../Mail/phpmailer/PHPMailerAutoload.php";

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'rewza568@gmail.com';
        $mail->Password = 'khqp zihl rhfu ppdk';

        $mail->setFrom('rewza568@gmail.com', 'Ryujin');
        $mail->addAddress($user_email);

        $mail->isHTML(true);
        $mail->Subject = "Your verify code";
        $mail->Body = 'รหัส OTP ของคุณคือ ' . $otp;

        if ($mail->send()) {
            echo '<script>alert("ลงทะเบียนสำเร็จ"); window.location.replace("../view/user/verification.php");</script>';
        } else {
            echo 'เกิดข้อผิดพลาดในการส่งอีเมล์: ' . $mail->ErrorInfo;
        }
    } else {
        echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

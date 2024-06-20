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
        echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .tab-bar {
            display: flex;
            align-items: center;
            background-color: #96B6C5;
            padding: 10px 0;
            justify-content: center;
        }

        .tab-bar img {
            height: 70px;
            margin-right: 500px;
        }

        .tab-link {
            padding: 10px 20px;
            text-decoration: none;
            color: black;
            border: 1px solid transparent;
            border-radius: 3px;
            margin: 0 10px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .tab-link:hover {
            background-color: #ccc;
            border-color: #bbb;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 500;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        textarea,
        select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 30%;
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            margin: 20px auto;
            transition: background-color 0.2s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
        }

        p a {
            color: #007bff;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        .gender-select {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .gender-select input[type="radio"] {
            display: none;
        }

        .gender-select input[type="radio"]+label {
            background-color: #f0f0f0;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .gender-select input[type="radio"]:checked+label {
            background-color: #007bff;
            color: white;
        }

        .tab-link.login {
            background-color: #F4CE14;
            color: black;
            border-radius: 10px;
        }

        .tab-link.register {
            background-color: #007bff;
            color: white;
            border-radius: 10px;
        }

        .tab-link.login:hover,
        .tab-link.register:hover {
            background-color: #F4CE14;
            color: white;
        }
    </style>
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="select_provider.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติ</a>
        <a href="applyProvider.php" class="tab-link">สมัครงาน</a>
        <a href="login.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.php" class="tab-link register">ลงทะเบียน</a>
    </div>
    </div>

    <div class="container">
        <h1>ลงทะเบียน</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="user_id">เลขบัตรประจำตัวประชาชน:</label>
            <input type="text" id="user_id" name="user_id" required>

            <label for="username">ชื่อผู้ใช้:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">รหัสผ่าน:</label>
            <input type="password" id="password" name="password" required>

            <label for="user_name">ชื่อ-นามสกุล:</label>
            <input type="text" id="user_name" name="user_name" required>

            <label for="user_gender">เพศ:</label>
            <div class="gender-select">
                <input type="radio" id="male" name="user_gender" value="0" required>
                <label for="male">ชาย</label>
                <input type="radio" id="female" name="user_gender" value="1" required>
                <label for="female">หญิง</label>
            </div>


            <label for="user_birthday">วันเกิด:</label>
            <input type="date" id="user_birthday" name="user_birthday" required>

            <label for="user_addressnow">ที่อยู่ปัจจุบัน:</label>
            <textarea id="user_addressnow" name="user_addressnow" required></textarea>

            <label for="user_email">อีเมล์:</label>
            <input type="email" id="user_email" name="user_email" required>

            <label for="user_phone">เบอร์โทรศัพท์:</label>
            <input type="tel" id="user_phone" name="user_phone" required>

            <input type="submit" value="ลงทะเบียน">
        </form>
        <p>มีบัญชีผู้ใช้อยู่แล้ว? <a href="login.html">เข้าสู่ระบบที่นี่</a>.</p>
    </div>
</body>

</html>
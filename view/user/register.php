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
    <title>ลูกหลานสำรอง-บริการพาไปหาหมอ ดูแลแทนญาติเหมือนลูกหลานของท่าน</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/user/stylesregister.css">
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var genderMale = document.getElementById("male").checked;
            var genderFemale = document.getElementById("female").checked;

            if (password.length < 8) {
                alert("รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร");
                return false;
            }
            if (!/[A-Z]/.test(password)) {
                alert("รหัสผ่านต้องมีตัวอักษรตัวใหญ่ (A-Z) อย่างน้อย 1 ตัว");
                return false;
            }
            if (!/[a-z]/.test(password)) {
                alert("รหัสผ่านต้องมีตัวอักษรตัวเล็ก (a-z) อย่างน้อย 1 ตัว");
                return false;
            }
            if (!/[0-9]/.test(password)) {
                alert("รหัสผ่านต้องมีตัวเลข (0-9) อย่างน้อย 1 ตัว");
                return false;
            }
            if (!genderMale && !genderFemale) {
                alert("กรุณาเลือกเพศ");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="select_provider.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติการจอง</a>
        <a href="announce.php" class="tab-link">สมัครงาน</a>
        <a href="login_level.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.php" class="tab-link register">ลงทะเบียน</a>
    </div>

    <div class="container">
        <div>
            <button class="back-button" onclick="window.location.href='../../index.php'">⬅️</button>
        </div>
        <h1>ลงทะเบียน</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
            <label for="user_id">เลขบัตรประจำตัวประชาชน:</label>
            <input type="text" id="user_id" name="user_id" required>

            <label for="username">ชื่อผู้ใช้:</label>
            <input type="text" id="username" name="username" required>

            <div class="password-container">
                <label for="password">รหัสผ่าน:</label>
                <input type="password" id="password" name="password" required>
                <span onclick="togglePasswordVisibility()">⊙</span>
            </div>
            <label for="user_name">ชื่อ-นามสกุล:</label>
            <input type="text" id="user_name" name="user_name" required>

            <label for="user_gender">เพศ:</label>
            <div class="gender-select">
                <input type="radio" id="male" name="user_gender" value="0">
                <label for="male">ชาย</label>
                <input type="radio" id="female" name="user_gender" value="1">
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
        <p>มีบัญชีผู้ใช้อยู่แล้ว? <a href="login.php">เข้าสู่ระบบที่นี่</a>.</p>
    </div>
    <script>
function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var toggleIcon = document.querySelector(".password-container span");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.textContent = "⊚"; // เปลี่ยนอีโมจิเป็นตาปิด
    } else {
        passwordInput.type = "password";
        toggleIcon.textContent = "⊙"; // เปลี่ยนอีโมจิเป็นตาเปิด
    }
}
</script>
</body>

</html>

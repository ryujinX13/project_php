<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/user/stylesregister.css">
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="select_provider.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติการจอง</a>
        <a href="../provider/announce.php" class="tab-link">สมัครงาน</a>
        <a href="login_level.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.php" class="tab-link register">ลงทะเบียน</a>
    </div>

    <div class="container">
        <h1>ลงทะเบียน</h1>
        <form action="../../process/register_process.php" method="post">
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
        <p>มีบัญชีผู้ใช้อยู่แล้ว? <a href="login.php">เข้าสู่ระบบที่นี่</a>.</p>
    </div>
</body>

</html>

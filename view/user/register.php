<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../../css/user/stylesregister.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="booking.php" class="tab-link" id="booking-link">การจอง</a>
        <a href="booking_list.php" class="tab-link" id="booking-list-link">รายการจอง</a>
        <a href="history.php" class="tab-link" id="history-link">ประวัติการจอง</a>
        <a href="announce.php" class="tab-link announce">สมัครงาน</a>
        <a href="login_level.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.php" class="tab-link register">ลงทะเบียน</a>
    </div>

    <div class="container">
        <a href="../../index.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
        <h1>ลงทะเบียน</h1>

        <form action="../../process/register_process.php" method="post" enctype="multipart/form-data">
            <label for="firstname">ชื่อ:</label>
            <input type="text" id="firstname" name="firstname" required>

            <label for="lastname">นามสกุล:</label>
            <input type="text" id="lastname" name="lastname" required>

            <label for="phone">เบอร์โทร:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="citizen_id">เลขประจำตัวประชาชน:</label>
            <input type="text" id="citizen_id" name="citizen_id" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">รหัสผ่าน:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">ยืนยันรหัสผ่าน:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <div class="checkbox-container">
                <input type="checkbox" id="show_password" name="show_password">
                <label for="show_password">แสดงรหัสผ่าน</label>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" id="confirm_correctness" name="confirm_correctness">
                <label for="confirm_correctness">ตรวจสอบความถูกต้อง</label>
            </div>

            <label for="gender">เพศ:</label>
            <div class="gender-select">
                <input type="radio" id="male" name="gender" value="male" required>
                <label for="male">ชาย</label>
                <input type="radio" id="female" name="gender" value="female" required>
                <label for="female">หญิง</label>
                <input type="radio" id="other" name="gender" value="other" required>
                <label for="other">ไม่ระบุ</label>
            </div>

            <label for="birthdate">วันเกิด:</label>
            <input type="date" id="birthdate" name="birthdate" required>

            <label for="address">ที่อยู่:</label>
            <textarea id="address" name="address" required></textarea>

            <input type="submit" value="ลงทะเบียน">
        </form>
        <p>มีบัญชีผู้ใช้อยู่แล้ว? <a href="login_level.php">เข้าสู่ระบบที่นี่</a>.</p>
    </div>
</body>

</html>

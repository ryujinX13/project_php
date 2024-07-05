<?php
include ('../../connect/connection.php');
session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Provider Management</title>
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesupdate_prov.css">
  
</head>

<body>

    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="index.html" class="tab-link">หน้าแรก</a>
        <a href="booking.html" class="tab-link">ข้อมูลพนักงาน</a>
        <a href="booking_list.html" class="tab-link">การอบรม</a>
        <a href="history.html" class="tab-link">รายงาน</a>  
        <a href="login.html" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.html" class="tab-link register">ลงทะเบียน</a>
    </div>

    <div class="container">
        <h2>อัปเดตผู้ให้บริการ</h2>
        <form method="post" action="../../process/updateProv_process.php">
            <label for="Prov_id">รหัสบัตรประชาชน:</label>
            <input type="text" name="Prov_id"><br>
            <label for="Prov_Username">ชื่อผู้ใช้:</label>
            <input type="text" name="Prov_Username"><br>
            <label for="Prov_password">รหัสผ่าน:</label>
            <input type="text" name="Prov_password"><br>
            <label for="Prov_email">Email:</label>
            <input type="email" name="Prov_email"><br>
            <label for="Prov_name">ชื่อ-สกุล:</label>
            <input type="text" name="Prov_name"><br>
            <label for="Prov_gender">เพศ:</label>
            <select id="Prov_gender" name="Prov_gender" required>
                <option value="0">ชาย</option>
                <option value="1">หญิง</option>
            </select><br>
            <label for="Prov_birthday">วันเกิด:</label>
            <input type="date" name="Prov_birthday"><br>
            <label for="Prov_datejob">วันที่เริ่มงาน:</label>
            <input type="date" name="Prov_datejob"><br>
            <label for="Prov_address">ที่อยู่:</label>
            <input type="text" name="Prov_address"><br>
            <label for="Prov_addressnow">ที่อยู่ปัจจุบัน:</label>
            <input type="text" name="Prov_addressnow"><br>
            <label for="Prov_nationality">สัญชาติ:</label>
            <input type="text" name="Prov_nationality"><br>
            <label for="Prov_religion">ศาสนา:</label>
            <input type="text" name="Prov_religion"><br>
            <label for="Prov_train">สถานะการอบรม:</label>
            <input type="text" name="Prov_train"><br>
            <label for="Prov_phone">เบอร์โทรศัพท์:</label>
            <input type="text" name="Prov_phone"><br>
            <label for="Prov_study">วุฒิการศึกษา:</label>
            <input type="text" name="Prov_study"><br>
            <input type="submit" value="อัปเดต">
        </form>
    </div>
</body>

</html>

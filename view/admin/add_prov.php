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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesadd_prov.css">
</head>

<body>

    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
     
    </div>
    <div class="container">
    <button class="back-button" onclick="window.location.href='prov_display.php'">⬅️</button>
        <h2>เพิ่มผู้ให้บริการ</h2>
        <form method="post" action="../../process/addProv_process.php">
            รหัสบัตรประชาชน: <input type="text" name="Prov_id"><br>
            ชื่อผู้ใช้: <input type="text" name="Prov_Username"><br>
            รหัสผ่าน: <input type="text" name="Prov_password"><br>
            Email: <input type="email" name="Prov_email"><br>
            ชื่อ-สกุล <input type="text" name="Prov_name"><br>
            เพศ:<br>
            <input type="radio" id="male" name="Prov_gender" value="male" required>
            <label for="male">ชาย</label>
            <input type="radio" id="female" name="Prov_gender" value="female" required>
            <label for="female">หญิง</label>
            <br>
            <br>
            วันเกิด: <input type="date" name="Prov_birthday"><br>
            วันที่เริ่มงาน: <input type="date" name="Prov_datejob"><br>
            ที่อยู่: <input type="text" name="Prov_address"><br>
            ที่อยู่ปัจจุบัน: <input type="text" name="Prov_addressnow"><br>
            สัญชาติ: <input type="text" name="Prov_nationality"><br>
            ศาสนา: <input type="text" name="Prov_religion"><br>
            สถานะการอบรม: <input type="text" name="Prov_train"><br>
            เบอร์โทรศัพท์: <input type="text" name="Prov_phone"><br>
            วุฒิการศึกษา: <input type="text" name="Prov_study"><br>
            <input type="submit" value="บันทึก">
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</body>

</html>
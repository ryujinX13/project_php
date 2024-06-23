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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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

        .container {
            width: 45%;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
        }

        h2 {
            text-align: center;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 20%;
            padding: 15px;
            background-color: #F4CE14;
            border: none;
            border-radius: 20px;
            color: white;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
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

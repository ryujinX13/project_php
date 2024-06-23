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
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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
        input[type="checkbox"] {
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
</body>

</html>
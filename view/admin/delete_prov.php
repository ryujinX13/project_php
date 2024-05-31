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
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการผู้ให้บริการ</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9; /* เปลี่ยนสีพื้นหลัง */
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #000000; /* เปลี่ยนสีข้อความเป็นสีน้ำเงิน */
            text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
        }

        form {
            text-align: center;
        }

        input[type="text"] {
            padding: 10px;
            margin-bottom: 20px;
            width: 60%;
            border: 2px solid #e5e5e5; /* เปลี่ยนสีเส้นขอบเป็นสีน้ำเงิน */
            border-radius: 5px;
            transition: border-color 0.9s;
        }

        input[type="text"]:focus {
            border-color: #e5e5e5; /* เปลี่ยนสีเส้นขอบเมื่อได้รับการโฟกัส */
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>ลบผู้ให้บริการ</h2>
        <form method="post" action="../../process/deleteProv_process.php">
            รหัสผู้ให้บริการ: <input type="text" name="Prov_id" placeholder="กรอกรหัสผู้ให้บริการที่นี่"><br>
            <input type="submit" value="ลบผู้ให้บริการ">
        </form>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
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

        .tab-link.login:hover, .tab-link.register:hover {
            background-color: #F4CE14;
            color: white;
        }
        
        .container {
            width: auto; /* ปรับขนาดความกว้างให้กว้างขึ้นเล็กน้อย */
            max-width: 100%;
            margin: 50px ; /* จัดกลางตามแนวนอน */
            padding: 50px; /* ปรับให้มีพื้นที่เพิ่มขึ้น */
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            color: #007bff;
            text-align: center; /* จัดข้อความให้กลาง */
        }
        
        table {
            width: 80%; /* ทำให้ตารางเต็มขนาดของคอนเทนเนอร์ */
            border-collapse: collapse;
            margin: 20px auto;
        }
        
        th, td {
            padding: 5px;
            border: 1px solid #ddd;
            text-align: center; /* จัดข้อความในเซลล์ตารางให้กลาง */
        }
        
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            font-size: 18px;
        }
        
        td {
            font-size: 16px;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
        
        .button-container {
            margin-top: 20px; /* เพิ่มระยะห่างระหว่างปุ่มกับตาราง */
            text-align: center;
        }
        
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 20px;
            margin: 0 5px; /* ปรับระยะห่างของปุ่ม */
            transition: background-color 0.3s ease;
        }
        
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="index.html" class="tab-link">หน้าแรก</a>
        <a href="booking.html" class="tab-link">การจอง</a>
        <a href="booking_list.html" class="tab-link">รายการจอง</a>
        <a href="history.html" class="tab-link">ประวัติ</a>
        <a href="careers.html" class="tab-link">สมัครงาน</a>
        <a href="login.html" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.html" class="tab-link register">ลงทะเบียน</a>
    </div>

    <div class="container">
        <h2>Provider Information</h2>
        <?php include '../../process/displayProv_process.php'; ?>
        <div class="button-container">
            <a class="button" href="add_prov.php">เพิ่มผู้ให้บริการ</a>
            <a class="button" href="delete_prov.php">ลบผู้ให้บริการ</a>
            <a class="button" href="update_prov.php">อัปเดตผู้ให้บริการ</a>
        </div>
    </div>
</body>
</html>

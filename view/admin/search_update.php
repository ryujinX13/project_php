<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>ค้นหาผู้ให้บริการ</title>
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
        <h2>ค้นหาผู้ให้บริการ</h2>
        <form method="get" action="update_prov.php"> <!-- เปลี่ยน method เป็น get -->
            <label for="Prov_id">รหัสบัตรประชาชน:</label>
            <input type="text" name="Prov_id"><br> <!-- ลบ attribute name ที่ไม่จำเป็นออก -->
            <input type="submit" value="ค้นหา">
        </form>
    </div>
</body>

</html>

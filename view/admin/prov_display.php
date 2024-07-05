<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesprov_display.css">
    <title>Provider Information</title>
    
       
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

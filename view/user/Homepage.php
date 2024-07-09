<?php
// เริ่มเซสชัน
session_start();

// ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
$isLoggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/user/stylesHomepage.css">
</head>

<body>

    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="select_provider.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติ</a>
        <a href="../user/announce.php" class="tab-link announce">สมัครงาน</a>
        
        <!-- แสดงปุ่มตามสถานะการเข้าสู่ระบบ -->
        <?php if ($isLoggedIn): ?>
            <button class="tab-button"><?php echo $_SESSION['username']; ?></button>
        <?php else: ?>
            <a href="login_level.php" class="tab-link login">เข้าสู่ระบบ</a>
            <a href="register.php" class="tab-link register">ลงทะเบียน</a>
        <?php endif; ?>
    </div>

    <div class="container mt-5">
        
        <h1>ลูกหลานสำรอง บริการพาไปหาหมอ <br> ดูแลแทนญาติเหมือนลูกหลานของท่าน</h1>
        <br>
        <p>เมื่อพ่อแม่ ผู้สูงอายุ หรือคนที่คุณรัก มีนัดไปหาหมอที่โรงพยาบาล หรือไปทำธุระต่างๆ แต่คุณติดงานและลาไม่ได้
            หาคนดูแลไม่ได้ จะทำอย่างไร<br>
            เราเป็นกลุ่มนักเรียนนักศึกษา ได้เห็นความลำบากของคนไข้สูงอายุที่มาโรงพยาบาล
            ในสังคมปัจจุบันที่มีผู้สูงอายุมากขึ้น ลูกหลานต่างมีภาระหน้าที่การงาน<br>
            จึงอยากเข้ามารับอาสา ทำหน้าที่ตรงนี้ และอยากหารายได้พิเศษระหว่างเรียนด้วย
            จึงจัดตั้งกลุ่มนี้ขึ้นมาเพื่อแก้ปัญหานี้ของสังคมครับ</p>
        <img src="../../img/p3.png" class="home-image" alt="home image">
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

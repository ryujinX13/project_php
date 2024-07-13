<?php
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือยัง
if (isset($_SESSION['username'])) {
    // ถ้าเข้าสู่ระบบอยู่ ให้เปลี่ยนเส้นทางไปยังหน้า homepage.php
    header("Location: view/user/homepage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/user/stylesHomepage.css">
</head>

<body>

    <div class="tab-bar">
        <img src="img/logo1.png" alt="Logo">
        <a href="index.php" class="tab-link">หน้าแรก</a>
        <a href="view/user/booking.php" class="tab-link" id="booking-link">การจอง</a>
        <a href="view/user/booking_list.php" class="tab-link" id="booking-list-link">รายการจอง</a>
        <a href="view/user/history.php" class="tab-link" id="history-link">ประวัติการจอง</a>
        <a href="view/user/announce.php" class="tab-link announce">สมัครงาน</a>
        <a href="view/user/login_level.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="view/user/register.php" class="tab-link register">ลงทะเบียน</a>
    </div>
    
    <header>
        ลูกหลานสำรอง บริการพาไปหาหมอ ดูแลแทนญาติเหมือนลูกหลานของท่าน
    </header>
    
    <div class="container">
        <div class="content-section about-text">
            <h3>เกี่ยวกับเรา</h3>
            <p>เมื่อพ่อแม่ผู้สูงอายุหรือคนที่คุณรักมีนัดไปหาหมอที่โรงพยาบาลหรือไปทำธุระต่างๆ แต่คุณติดงานและลาไม่ได้หาคนดูแลไม่ได้จะทำอย่างไร<br>
            เราเป็นกลุ่มนักเรียนนักศึกษาได้เห็นความลำบากของคนไข้สูงอายุที่มาโรงพยาบาล<br>
            จึงอยากเข้ามารับอาสาทำหน้าที่บริการพาผู้สูงอายุไปพบแพทย์ตามนัดหรือเฝ้าที่โรงพยาบาล<br>
            และอยากหารายได้พิเศษระหว่างเรียนด้วย จึงจัดตั้งกลุ่มนี้ขึ้นมาเพื่อแก้ปัญหานี้ค่ะ</p>
        </div>
        
        <div class="images">
            <img src="img/p3.png" class="home-image" alt="home image">
        </div>

        <div class="content-section">
            <h2>บริการของเรา</h2>
            <ul>
                <li>รับ-ส่งคนไข้มาโรงพยาบาล (หรือนัดเจอที่โรงพยาบาล)</li>
                <li>พาจองคิวห้องตรวจ เช็คสิทธิ์ เตรียมเอกสารต่างๆ</li>
                <li>พาชั่งน้ำหนัก วัดส่วนสูง รออยู่เป็นเพื่อนรอพบแพทย์</li>
                <li>พาไปห้องเจาะเลือด x-ray ห้องตรวจต่างๆ พาไปห้องจ่ายยา ห้องการเงิน</li>
                <li>พาไปทานอาหาร น้ำดื่ม อาหารว่าง ไม่ปล่อยให้หิว</li>
                <li>เข้ารับฟังแพทย์ชี้แจงแนวทางรักษาร่วมกับคนไข้ (แล้วแต่กรณี ต้องได้รับอนุญาตจากคนไข้และแพทย์ก่อน)</li>
                <li>รอส่งคนไข้กลับบ้าน หรือให้ลูกหลานมารับ</li>
            </ul>
        </div>

        <div class="content-section">
            <h2>พื้นที่ให้บริการในจังหวัดขอนแก่น</h2>
            <ul>
                <li>โรงพยาบาลศรีนครินทร์ คณะแพทยศาสตร์มหาวิทยาลัยขอนแก่น</li>
                <li>ศูนย์หัวใจสิริกิติ์ ภาคตะวันออกเฉียงเหนือ</li>
                <li>โรงพยาบาลขอนแก่น</li>
                <li>ศูนย์อนามัยแม่และเด็ก</li>
                <li>โรงพยาบาลจิตเวชราชนครินทร์</li>
            </ul>
        </div>

        <div class="content-section">
            <h2>อัตราค่าบริการแพคเกจ</h2>
            <ul>
                <li>แพคเกจคลินิกนอกเวลา 4ชม./400฿ (เริ่ม16.00-20.00น.)</li>
                <li>แพคเกจครึ่งเช้า 6 ชั่วโมง/ 500 บาท (เริ่ม 07.00-13.00 น.)</li>
                <li>แพคเกจครึ่งเช้า 8 ชั่วโมง/ 600 บาท (เริ่ม 07.00-15.00 น.)</li>
                <li>แพคเกจทั้งวัน 10 ชั่วโมง/ 700฿ (เริ่ม 07.00-17.00น.)</li>
                <li>แพคเกจ เวรนอนเฝ้าไข้ 12 ชั่วโมง 600฿ (19.00-07.00 น.)</li>
                <li>แพคเกจ เวรนอนเฝ้าไข้ 24 ชั่วโมง 1,000฿ (19.00-19.00น.)</li>
                <li>**เกินนั้นคิดชั่วโมงละ 100฿</li>
            </ul>
        </div>

        <div class="content-section">
            <h2>ค่าเดินทางรับส่งคนไข้คิดตามระยะทาง</h2>
            <ul>
                <li>ระยะทางไม่เกิน 10 กม.แรก เหมาจ่าย 300฿ (รับและส่ง)</li>
                <li>ระยะทางเกิน 10 กม. คิด 10กม.แรก 300฿ หลังจากนั้นจะคิด กม.ละ 5฿</li>
                <li>การนับระยะทาง เริ่มจากขับรถไปรับที่บ้าน- ไปรพ ส่งกลับบ้าน- ขับรถกลับ</li>
                <li>***หากต้องเสียค่าที่จอดรถ คนไข้เป็นผู้จ่าย</li>
            </ul>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

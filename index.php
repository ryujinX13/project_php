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
    <link rel="stylesheet" type="text/css" href="css/stylesindex.css">
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
    
    <header class="header">
        <h1>ลูกหลานสำรองบริการพาผู้สูงอายุไปหาหมอ</h1>
        <p>บริการพาผู้สูงอายุไปหาหมอตามนัด หมดห่วงเรื่องการเดินทางและการดูแล</p>
        <a href="view/user/login_level.php" class="btn">เข้าสู่ระบบ</a>

    </header>

    <div class="content-section">
        <div class="about-section">
            <img src="img/home2.png" alt="เกี่ยวกับเรา">
            <div class="text-content">
                <h3>เกี่ยวกับเรา</h3>
                <p>เมื่อพ่อแม่ ผู้สูงอายุ หรือคนที่คุณรัก มีนัดไปหาหมอที่โรงพยาบาล หรือไปทำธุระต่างๆ</p>
                <p>แต่คุณติดงานและลาไม่ได้ หาคนดูแลไม่ได้ จะทำอย่างไร</p>
                <p> เราเป็นกลุ่มนักเรียนนักศึกษา ได้เห็นความลำบากของคนไข้สูงอายุที่มาโรงพยาบาล</p> 
                <p> ในสังคมปัจจุบันที่มีผู้สูงอายุมากขึ้น ลูกหลานต่างมีภาระหน้าที่การงาน</p> 
                <p> จึงอยากเข้ามารับอาสา ทำหน้าที่ตรงนี้ และอยากหารายได้พิเศษระหว่างเรียนด้วย</p>
                <p>  จึงจัดตั้งกลุ่มนี้ขึ้นมาเพื่อแก้ปัญหานี้ของสังคม</p>
            </div>
        </div>

        <div class="service-section">
            <div class="container">
                <h2>บริการของเรา</h2>
                <div class="row">
                    <div class="col-md-4 service-item">
                        <i class="fas fa-car"></i>
                        <h3>รับ-ส่งคนไข้มาโรงพยาบาล</h3>
                        <p>หรือนัดเจอที่โรงพยาบาล</p>
                    </div>
                    <div class="col-md-4 service-item">
                        <i class="fas fa-calendar-check"></i>
                        <h3>พาจองคิวห้องตรวจ</h3>
                        <p>เช็คสิทธิ์ เตรียมเอกสารต่างๆ</p>
                    </div>
                    <div class="col-md-4 service-item">
                        <i class="fas fa-weight"></i>
                        <h3>พาชั่งน้ำหนัก วัดส่วนสูง</i>
                        <p>รออยู่เป็นเพื่อนรอพบแพทย์</p>
                    </div>
                    <div class="col-md-4 service-item">
                        <i class="fas fa-vial"></i>
                        <h3>พาไปห้องเจาะเลือด x-ray</h3>
                        <p>ห้องตรวจต่างๆ พาไปห้องจ่ายยา ห้องการเงิน</p>
                    </div>
                    <div class="col-md-4 service-item">
                        <i class="fas fa-utensils"></i>
                        <h3>พาไปทานอาหาร น้ำดื่ม</h3>
                        <p>อาหารว่าง ไม่ปล่อยให้หิว</p>
                    </div>
                    <div class="col-md-4 service-item">
                        <i class="fas fa-stethoscope"></i>
                        <h3>เข้ารับฟังแพทย์ชี้แจงร่วมกับคนไข้</h3>
                        <p>แล้วแต่กรณีต้องได้รับอนุญาตจากคนไข้และแพทย์</p>
                    </div>
                    <div class="col-md-4 service-item">
                        <i class="fas fa-home"></i>
                        <h3>รอส่งคนไข้กลับบ้าน</h3>
                        <p>หรือให้ลูกหลานมารับ</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="service-area-section">
            <div class="text-content">
                <h2>พื้นที่ให้บริการในจังหวัดขอนแก่น</h2>
                <ul>
                    <li>โรงพยาบาลศรีนครินทร์ คณะแพทยศาสตร์มหาวิทยาลัยขอนแก่น</li>
                    <li>ศูนย์หัวใจสิริกิติ์ ภาคตะวันออกเฉียงเหนือ</li>
                    <li>โรงพยาบาลขอนแก่น</li>
                    <li>ศูนย์อนามัยแม่และเด็ก</li>
                    <li>โรงพยาบาลจิตเวชราชนครินทร์</li>
                </ul>
            </div>
            <img src="img/home1.png" alt="พื้นที่ให้บริการในจังหวัดขอนแก่น">
        </div>

        <div class="package-section">
            <h2>อัตราค่าบริการแพคเกจ</h2>
            <div class="package-item">
                <i class="fas fa-clock"></i>
                <h3>แพคเกจคลินิกนอกเวลา</h3>
                <p>4ชม./400฿ (เริ่ม16.00-20.00น.)</p>
            </div>
            <div class="package-item">
                <i class="fas fa-sun"></i>
                <h3>แพคเกจครึ่งเช้า</h3>
                <p>6 ชั่วโมง/ 500 บาท (เริ่ม 07.00-13.00 น.)</p>
            </div>
            <div class="package-item">
                <i class="fas fa-sun"></i>
                <h3>แพคเกจครึ่งเช้า</h3>
                <p>8 ชั่วโมง/ 600 บาท (เริ่ม 07.00-15.00 น.)</p>
            </div>
            <div class="package-item">
                <i class="fas fa-sun"></i>
                <h3>แพคเกจทั้งวัน</h3>
                <p>10 ชั่วโมง/ 700฿ (เริ่ม 07.00-17.00น.)</p>
            </div>
            <div class="package-item">
                <i class="fas fa-moon"></i>
                <h3>แพคเกจ เวรนอนเฝ้าไข้</h3>
                <p>12 ชั่วโมง 600฿ (19.00-07.00 น.)</p>
            </div>
            <div class="package-item">
                <i class="fas fa-moon"></i>
                <h3>แพคเกจ เวรนอนเฝ้าไข้</h3>
                <p>24 ชั่วโมง 1,000฿ (19.00-19.00น.)</p>
            </div>
            <div class="package-item">
                <i class="fas fa-hourglass-half"></i>
                <h3>ชั่วโมงละ</h3>
                <p>เกินนั้นคิดชั่วโมงละ 100฿</p>
            </div>
        </div>

        <div class="travel-fee-section">
            <div class="text-content">
                <h2>ค่าเดินทางรับส่งคนไข้คิดตามระยะทาง</h2>
                <ul>
                    <li>ระยะทางไม่เกิน 10 กม.แรก เหมาจ่าย 300฿ (รับและส่ง)</li>
                    <li>ระยะทางเกิน 10 กม. คิด 10กม.แรก 300฿ หลังจากนั้นจะคิด กม.ละ 5฿</li>
                    <li>การนับระยะทาง เริ่มจากขับรถไปรับที่บ้าน- ไปรพ ส่งกลับบ้าน- ขับรถกลับ</li>
                    <li>***หากต้องเสียค่าที่จอดรถ คนไข้เป็นผู้จ่าย</li>
                </ul>
            </div>
            <img src="img/img1.png" alt="ค่าเดินทางรับส่งคนไข้คิดตามระยะทาง">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/user/stylesHomepage.css">
    <title>ลูกหลานสำรอง - บริการพาไปหาหมอ ดูแลแทนญาติเหมือนลูกหลานของท่าน</title>
   
</head>

<body>
<div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="booking.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติการจอง</a>
        <a href="../user/announce.php" class="tab-link announce">สมัครงาน</a>
        
        <!-- แสดงปุ่มตามสถานะการเข้าสู่ระบบ -->
        <?php if ($isLoggedIn): ?>
            <div class="dropdown">
                <button class="tab-button dropdown-toggle" type="button" id="dropdownMenuButton">
                    <?php echo $_SESSION['username']; ?>
                </button>
                <div class="dropdown-menu" id="dropdownMenu">
                    <a class="dropdown-item" href="account_details.php">รายละเอียดบัญชี</a>
                    <a class="dropdown-item" href="../../process/logout.php">ล็อคเอ้าท์</a>
                </div>
            </div>
        <?php else: ?>
            <a href="login_level.php" class="tab-link login">เข้าสู่ระบบ</a>
            <a href="register.php" class="tab-link register">ลงทะเบียน</a>
        <?php endif; ?>
    </div>
    <header>
        ลูกหลานสำรอง - บริการพาไปหาหมอ ดูแลแทนญาติเหมือนลูกหลานของท่าน
    </header>
    <div class="container">
        <div class="content-section about-text">
            <h2>เกี่ยวกับเรา</h2>
            <p>เมื่อพ่อแม่ ผู้สูงอายุ หรือคนที่คุณรัก มีนัดไปหาหมอที่โรงพยาบาล หรือไปทำธุระต่างๆ แต่คุณติดงานและลาไม่ได้ หาคนดูแลไม่ได้ จะทำอย่างไร</p>
            <p>เราเป็นกลุ่มนักเรียนนักศึกษา ได้เห็นความลำบากของคนไข้สูงอายุที่มาโรงพยาบาล ในสังคมปัจจุบันที่มีผู้สูงอายุมากขึ้น ลูกหลานต่างมีภาระหน้าที่การงาน จึงอยากเข้ามารับอาสา ทำหน้าที่ตรงนี้ และอยากหารายได้พิเศษระหว่างเรียนด้วย จึงจัดตั้งกลุ่มนี้ขึ้นมาเพื่อแก้ปัญหานี้ของสังคมครับ</p>
        </div>
        <div class="content-section">
            <h2>บริการของเรา</h2>
            <div class="row">
                <div class="col-md-6">
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
                <div class="col-md-6">
                    <img src="../../img/home1.png" alt="บริการของเรา" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="content-section">
            <h2>พื้นที่ให้บริการในจังหวัดขอนแก่น</h2>
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li class="service-package"><span class="text-highlight">โรงพยาบาลศรีนครินทร์</span> คณะแพทยศาสตร์มหาวิทยาลัยขอนแก่น</li>
                        <li class="service-package"><span class="text-highlight">ศูนย์หัวใจสิริกิติ์</span> ภาคตะวันออกเฉียงเหนือ</li>
                        <li class="service-package"><span class="text-highlight">โรงพยาบาลขอนแก่น</li>
                        <li class="service-package"><span class="text-highlight">ศูนย์อนามัยแม่และเด็ก</li>
                        <li class="service-package"><span class="text-highlight">โรงพยาบาลจิตเวชราชนครินทร์</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <img src="../../img/img1.png" alt="พื้นที่ให้บริการ" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="content-section">
            <h2>อัตราค่าบริการแพคเกจ เหมาจ่าย</h2>
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li class="service-package">แพคเกจคลินิกนอกเวลา 4ชม./400฿ (เริ่ม16.00-20.00น.)</li>
                        <li class="service-package">แพคเกจครึ่งเช้า 6 ชั่วโมง/ 500 บาท (เริ่ม 07.00-13.00 น.)</li>
                        <li class="service-package">แพคเกจครึ่งเช้า 8 ชั่วโมง/ 600 บาท (เริ่ม 07.00-15.00 น.)</li>
                        <li class="service-package">แพคเกจทั้งวัน 10 ชั่วโมง/ 700฿ (เริ่ม 07.00-17.00น.)</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <li class="service-package">แพคเกจ เวรนอนเฝ้าไข้ 12 ชั่วโมง 600฿ (19.00-07.00 น.)</li>
                        <li class="service-package">แพคเกจ เวรนอนเฝ้าไข้ 24 ชั่วโมง 1,000฿ (19.00-19.00น.)</li>
                        <li class="service-package">เกินนั้นคิดชั่วโมงละ 100฿</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content-section">
            <h2>ค่าเดินทางรับส่งคนไข้คิดตามระยะทาง</h2>
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <img src="../../img/p1.jpg" alt="ค่าเดินทาง" class="img-fluid">
                </div>
                <div class="col-md-6 order-md-1">
                    <ul>
                        <li class="service-package">ระยะทางไม่เกิน 10 กม.แรก เหมาจ่าย 300฿ (รับและส่ง)</li>
                        <li class="service-package">ระยะทางเกิน 10 กม. คิด 10กม.แรก 300฿ หลังจากนั้นจะคิด กม.ละ 5 ฿</li>
                        <li class="service-package">การนับระยะทาง เริ่มจาก ขับรถไปรับที่บ้าน- ไปรพ ส่งกลับบ้าน- ขับรถกลับ</li>
                        <li class="service-package">***หากต้องเสียค่าที่จอดรถ คนไข้เป็นผู้จ่าย</li>
                    </ul>
                </div>
                

        
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('dropdownMenuButton').addEventListener('click', function () {
            var dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-toggle')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === 'block') {
                        openDropdown.style.display = 'none';
                    }
                }
            }
        }
    </script>

</body>

</html>

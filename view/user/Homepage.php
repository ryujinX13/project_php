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

    <div class="container mt-5">
        <h3>ลูกหลานสำรอง บริการพาไปหาหมอ<br>
            ดูแลแทนญาติเหมือนลูกหลานของท่าน</h3>
            <p>เมื่อพ่อแม่ ผู้สูงอายุ หรือคนที่คุณรัก มีนัดไปหาหมอที่โรงพยาบาล หรือไปทำธุระต่างๆ แต่คุณติดงานและลาไม่ได้ หาคนดูแลไม่ได้ จะทำอย่างไร<br> 
        เราเป็นกลุ่มนักเรียนนักศึกษา ได้เห็นความลำบากของคนไข้สูงอายุที่มาโรงพยาบาล ในสังคมปัจจุบันที่มีผู้สูงอายุมากขึ้น ลูกหลานต่างมีภาระหน้าที่การงาน<br>
        จึงอยากเข้ามารับอาสา ทำหน้าที่ตรงนี้ และอยากหารายได้พิเศษระหว่างเรียนด้วย จึงจัดตั้งกลุ่มนี้ขึ้นมาเพื่อแก้ปัญหานี้ของสังคม</p>
        
        <img src="../../img/p3.png" class="home-image" alt="home image">

        <div class="section-title">บริการของเรา</div>
        <ul>
            <li>รับ-ส่งคนไข้มาโรงพยาบาล (หรือนัดเจอที่โรงพยาบาล)</li>
            <li>พาจองคิวห้องตรวจ เช็คสิทธิ์ เตรียมเอกสารต่างๆ</li>
            <li>พาชั่งน้ำหนัก วัดส่วนสูง รออยู่เป็นเพื่อนรอพบแพทย์</li>
            <li>พาไปห้องเจาะเลือด x-ray ห้องตรวจต่างๆ พาไปห้องจ่ายยา ห้องการเงิน</li>
            <li>พาไปทานอาหาร น้ำดื่ม อาหารว่าง ไม่ปล่อยให้หิว</li>
            <li>เข้ารับฟังแพทย์ชี้แจงแนวทางรักษาร่วมกับคนไข้ <br>(แล้วแต่กรณี ต้องได้รับอนุญาตจากคนไข้และแพทย์ก่อน)</li>
            <li>รอส่งคนไข้กลับบ้าน หรือให้ลูกหลานมารับ</li>
        </ul>
        <div class="location">พื้นที่ให้บริการในจังหวัดขอนแก่น</div>
            <li>โรงพยาบาลศรีนครินทร์ คณะแพทยศาสตร์มหาวิทยาลัยขอนแก่น</li>
            <li>ศูนย์หัวใจสิริกิติ์ ภาคตะวันออกเฉียงเหนือ</li>
            <li>โรงพยาบาลขอนแก่น</li>
            <li>ศูนย์อนามัยแม่และเด็ก</li>
            <li>โรงพยาบาลจิตเวชราชนครินทร์</li>
        <img src="../../img/img1.png" class="image1" alt="image1">
        
    
        <img src="../../img/รพศรี.jpg" class="image2" alt="image2">
        <img src="../../img/รพขอนแก่น.jpg" class="image3" alt="image3">
        <img src="../../img/ศูนหัวใจ.jpg" class="image4" alt="image4">
        <img src="../../img/อนามัย.jpg" class="image5" alt="image5">
        <img src="../../img/จิตเวช.jpg" class="image6" alt="image6">
     
        <div class="pac"></div>
            <ul>
            <h4>อัตราค่าบริการแพคเกจ เหมาจ่าย</h4>
            <li>แพคเกจคลินิกนอกเวลา 4ชม./400฿ (เริ่ม16.00-20.00น.)</li>
            <li>แพคเกจครึ่งเช้า 6 ชั่วโมง/ 500 บาท (เริ่ม 07.00-13.00 น.)</li>
            <li>แพคเกจครึ่งเช้า 8 ชั่วโมง/ 600 บาท (เริ่ม 07.00-15.00 น.)</li>
            <li>แพคเกจทั้งวัน 10 ชั่วโมง/ 700฿ (เริ่ม 07.00-17.00น.)</li>
            <li>แพคเกจ บรอนเฝ้าไข้ 12 ชั่วโมง 600฿ (19.00-07.00 น.)</li>
            <li>แพคเกจ บรอนเฝ้าไข้ 24 ชั่วโมง 1,000฿ (19.00-19.00น.)</li>
            <li>เกินนั้นคิดชั่วโมงละ 100฿</li>
            <br>
            <h4>ค่าเดินทางรับส่งคนไข้คิดตามระยะทาง</h4>
            <li>ระยะทางไม่เกิน 10 กม.แรก เหมาจ่าย 300฿(รับและส่ง)</li>
            <li>ระยะทางเกิน 10 กม. คิด 10กม.แรก 300฿ หลังจากนั้นจะคิด กม.ละ5฿</li>
            <li>แระยะทางเกิน 10 กม. คิด 10กม.แรก 300฿ หลังจากนั้นจะคิด กม.ละ5฿</li>
            <li>การนับระยะทาง เริ่มจากขับรถไปรับที่บ้าน- ไปรพส่งกลับบ้าน- ขับรถกลับ</li>
            <li>หากต้องเสียค่าที่จอดรถ คนไข้เป็นผู้จ่าย</li>
            </ul>
           
        </div>
    




        <footer>
        <div class="contact-info">
            <p>ติดต่อ-สอบถามยูคลินิกแล็บ</p>
            <p>📞 <a href="tel:093-5017778">093-5017778</a></p>
            <p><a href="https://line.me/R/ti/p/@ulab" target="_blank"><img src="../../img/Line.png" alt="Line Icon"> @ulab</a></p>
            <p>📧 <a href="mailto:ucliniclab@gmail.com">ucliniclab@gmail.com</a></p>
        </div>

        <div class="address">
        <p><a href="https://maps.app.goo.gl/f8urFAwixWuarR8n9" target="_blank">
                ที่อยู่ กังสดาร ใกล้รพ.ศรีนครินทร์ มหาวิทยาลัยขอนแก่น<br>
                - กังสดาล วงเวียนสามแยก เลยบึงหนองแวงตราชู<br>
                - มาจากในเมืองขอนแก่น ให้ขับผ่าน รพ.ราชพฤกษ์ แล้วเลี้ยวซ้าย<br>
                ก่อนถึงปั้ม ปตท. เข้าซอยสวัสดี ขับเรื่อยๆจนเจอวงเวียนสามแยก
            </a></p>

            </div>
            
            <div class="footimg">
                <a href="https://maps.app.goo.gl/f8urFAwixWuarR8n9" target="_blank">
                    <img src="../../img/ประกาศ02.png" alt="footer" onclick="bounceAnimation(this)">
                </a>
                <a href="https://www.facebook.com/lookhlan" target="_blank">
                    <img src="../../img/ปกลูกหลาน.png" alt="footer" onclick="bounceAnimation(this)">
                </a>
                <a href="https://www.facebook.com/Ucliniclab" target="_blank">
                    <img src="../../img/ประกาศ03.png" alt="footer" onclick="bounceAnimation(this)">
                </a>
            </div>
    </footer>

        
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

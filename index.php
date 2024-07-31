<?php
session_start();
include ('connect/connection.php');

// ตรวจสอบว่าผู้ใช้ล็อคอินอยู่หรือไม่
if (isset($_SESSION['username'])) {
    // ถ้าเข้าสู่ระบบอยู่ ให้เปลี่ยนเส้นทางไปยังหน้า homepage.php
    header("Location: view/user/homepage.php");
    exit();
}

// ตรวจสอบการเชื่อมต่อกับฐานข้อมูล
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลจากตาราง travel_distance_cost
$sql = "SELECT Tracost_distance, TraCost_excess, Tracost_flatrate FROM travel_distance_cost";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// เก็บข้อมูลในตัวแปร
while ($row = $result->fetch_assoc()) {
$Tracos_distance = $row['Tracost_distance'];
$TraCost_excess = $row['TraCost_excess'];
$Tracost_flatrate = $row['Tracost_flatrate'];
}
} else {
$Tracos_distance = 300; // ค่าเริ่มต้นหากไม่มีข้อมูล
$TraCost_excess = 5; // ค่าเริ่มต้นหากไม่มีข้อมูล
$Tracost_flatrate = 10; // ค่าเริ่มต้นหากไม่มีข้อมูล (เพิ่มค่าเริ่มต้นสำหรับ Tracost_flatrate)
}

// ดึงข้อมูลจากตาราง rates
$rate_sql = "SELECT * FROM rates";
$rate_result = $conn->query($rate_sql);
$rates = [];
if ($rate_result->num_rows > 0) {
// เก็บข้อมูลในตัวแปร
while ($row = $rate_result->fetch_assoc()) {
$rates[] = $row;
}
}
$conn->close();

// ฟังก์ชันเพื่อเลือกไอคอนตามชื่อแพ็กเกจ
function getIconClass($rate_name) {
$icons = [
'คลินิกนอกเวลา' => 'fas fa-clock',
'ครึ่งเช้า' => 'fas fa-sun',
'ทั้งวัน' => 'fas fa-sun',
'เวรนอนเฝ้าไข้' => 'fas fa-moon',
'ชั่วโมงละ' => 'fas fa-hourglass-half'
];
foreach ($icons as $key => $icon) {
if (strpos($rate_name, $key) !== false) {
return $icon;
}
}
return 'fas fa-question'; // Default icon if not found
}

// ฟังก์ชันเพื่อจัดการเวลาให้อยู่ในรูปแบบ HH:MM
function formatTime($time) {
$time_parts = explode(':', $time);
return $time_parts[0] . ':' . $time_parts[1];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลูกหลานสำรอง - บริการพาไปหาหมอ ดูแลแทนญาติเหมือนลูกหลานของท่าน</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/stylesindex.css">
</head>

<body>
    <div class="tab-bar">
        <img src="img/logo1.png" alt="Logo">
        <a href="index.php" class="tab-link">หน้าแรก</a>
        <a href="view/user/booking.php" class="tab-link" id="booking-link">การจอง</a>
        <a href="#" class="tab-link" id="booking-list-link">รายการจอง</a>
        <a href="#" class="tab-link" id="history-link">ประวัติการจอง</a>
        <a href="view/user/announce.php" class="tab-link announce">สมัครงาน</a>
        <a href="view/user/login.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="view/user/register.php" class="tab-link register">ลงทะเบียน</a>
    </div>

    <div class="content">
        <header class="header">
            <h1>ลูกหลานสำรองบริการพาผู้สูงอายุไปหาหมอ</h1>
            <p>บริการพาผู้สูงอายุไปหาหมอตามนัด หมดห่วงเรื่องการเดินทางและการดูแล</p>
            <a href="view/user/login.php" class="btn">เข้าสู่ระบบ</a>
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
                    <p> จึงจัดตั้งกลุ่มนี้ขึ้นมาเพื่อแก้ปัญหานี้ของสังคม</p>
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
                            <h3>พาชั่งน้ำหนัก วัดส่วนสูง</h3>
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
                <?php foreach ($rates as $rate): ?>
                    <div class="package-item">
                        <i class="<?php echo getIconClass($rate['Rates_name']); ?>"></i>
                        <h3><?php echo $rate['Rates_name']; ?></h3>
                        <p><?php echo $rate['Rates_sarary']; ?> บาท (เริ่ม <?php echo formatTime($rate['Rates_time_go']); ?>
                            - <?php echo formatTime($rate['Rates_time_return']); ?>)</p>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="travel-fee-section">
                <div class="text-content">
                    <h2>ค่าเดินทางรับส่งคนไข้คิดตามระยะทาง</h2>
                    <ul>
                        <li>ระยะทางไม่เกิน <?php echo $Tracost_flatrate; ?> กม.แรก เหมาจ่าย
                            <?php echo $Tracos_distance; ?> บาท (รับและส่ง)</li>
                        <li>ระยะทางเกิน <?php echo $Tracost_flatrate; ?> กม. คิด <?php echo $Tracost_flatrate; ?>กม. แรก
                            <?php echo $Tracos_distance; ?> บาท <br>หลังจากนั้นจะคิด กม.ละ
                            <?php echo $TraCost_excess; ?> บาท</li>
                        <li>การนับระยะทาง เริ่มจากขับรถไปรับที่บ้าน- ไปโรงพยาบาล<br> ส่งกลับบ้าน- ขับรถกลับ</li>
                        <li>หากต้องเสียค่าที่จอดรถ คนไข้เป็นผู้จ่าย</li>
                    </ul>
                </div>
                <img src="img/img1.png" alt="ค่าเดินทางรับส่งคนไข้คิดตามระยะทาง">
            </div>
        </div>
    </div>

    <footer>
        <div class="contact-info">
            <p>ติดต่อ-สอบถามยูคลินิกแล็บ</p>
            <p>📞 <a href="tel:093-5017778">093-5017778</a></p>
            <p><a href="https://line.me/R/ti/p/@ulab" target="_blank"><img src="img/Line.png" alt="Line Icon"> @ulab</a>
            </p>
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
                <img src="img/ประกาศ02.png" alt="footer">
            </a>
            <a href="https://www.facebook.com/lookhlan" target="_blank">
                <img src="img/ปกลูกหลาน.png" alt="footer">
            </a>
            <a href="https://www.facebook.com/Ucliniclab" target="_blank">
                <img src="img/ประกาศ03.png" alt="footer">
            </a>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
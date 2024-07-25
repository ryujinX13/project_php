<?php
session_start();
include('../../connect/connection.php');

// ตรวจสอบว่าผู้ใช้ล็อคอินอยู่หรือไม่
$isLoggedIn = isset($_SESSION['username']);

// ตรวจสอบการเชื่อมต่อกับฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลจากตาราง travel_distance_cost
$sql = "SELECT Tracost_distance, TraCost_excess FROM travel_distance_cost";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // เก็บข้อมูลในตัวแปร
    while ($row = $result->fetch_assoc()) {
        $Tracos_distance = $row['Tracost_distance'];
        $TraCost_excess = $row['TraCost_excess'];
    }
} else {
    $Tracos_distance = 300; // ค่าเริ่มต้นหากไม่มีข้อมูล
    $TraCost_excess = 5;    // ค่าเริ่มต้นหากไม่มีข้อมูล
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

// ฟังก์ชันเพื่อกำหนดไอคอน
function getIconClass($rateName) {
    if (strpos($rateName, 'คลินิกนอกเวลา') !== false) {
        return 'fas fa-clock';
    } elseif (strpos($rateName, 'ครึ่งเช้า') !== false) {
        return 'fas fa-sun';
    } elseif (strpos($rateName, 'ทั้งวัน') !== false) {
        return 'fas fa-sun';
    } elseif (strpos($rateName, 'เวรนอนเฝ้าไข้') !== false) {
        return 'fas fa-moon';
    } elseif (strpos($rateName, 'ชั่วโมงละ') !== false) {
        return 'fas fa-hourglass-half';
    }
    return 'fas fa-question';
}
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
        <a href="#" class="tab-link">รายการจอง</a>
        <a href="#" class="tab-link">ประวัติการจอง</a>
        <a href="../user/announce.php" class="tab-link announce">สมัครงาน</a>
        
        <?php if ($isLoggedIn): ?>
            <div class="dropdown">
                <button class="tab-button dropdown-toggle" type="button" id="dropdownMenuButton">
                    <?php echo $_SESSION['username']; ?>
                </button>
                <div class="dropdown-menu" id="dropdownMenu" style="background-color: #f8f9fa; border-radius: 8px;">
                    <a class="dropdown-item" href="account_user.php">
                        <span style="margin-right: 8px;">🔍</span>รายละเอียดบัญชี
                    </a>
                    <a class="dropdown-item" href="#">
                        <span style="margin-right: 8px;">📅</span>รายการจอง
                    </a>
                    <a class="dropdown-item" href="#">
                        <span style="margin-right: 8px;">📜</span>ประวัติการจอง
                    </a>
                    <a class="dropdown-item" href="private_agency.php">
                        <span style="margin-right: 8px;">🏢</span>ข้อมูลหน่วยงาน
                    </a>
                    <a class="dropdown-item" href="../../process/logout.php">
                        <span style="margin-right: 8px;">🔓</span>ออกจากระบบ
                    </a>
                </div>

            </div>
        <?php else: ?>
            <a href="login_level.php" class="tab-link login">เข้าสู่ระบบ</a>
            <a href="register.php" class="tab-link register">ลงทะเบียน</a>
        <?php endif; ?>
    </div>
    <header>
        ลูกหลานสำรอง บริการพาไปหาหมอ ดูแลแทนญาติเหมือนลูกหลานของท่าน
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
                        <?php foreach ($rates as $rate): ?>
                        <li class="service-package"><i class="<?php echo getIconClass($rate['Rates_name']); ?>"></i> <?php echo $rate['Rates_name']; ?> <?php echo $rate['Rates_sarary']; ?> บาท (<?php echo $rate['Rates_time']; ?>)</li>
                        <?php endforeach; ?>
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
                        <li class="service-package">-ระยะทางไม่เกิน 10 กม.แรก เหมาจ่าย <?php echo $Tracos_distance; ?> บาท (รับและส่ง)</li>
                        <li class="service-package">-ระยะทางเกิน 10 กม. คิด 10กม.แรก <?php echo $Tracos_distance; ?> บาท<br> หลังจากนั้นจะคิด กม.ละ <?php echo $TraCost_excess; ?> บาท</li>
                        <li class="service-package">-การนับระยะทาง เริ่มจาก ขับรถไปรับที่บ้าน-ไปโรงพยาบาล <br>ส่งกลับบ้าน- ขับรถกลับ</li>
                        <li class="service-package">-หากต้องเสียค่าที่จอดรถ คนไข้เป็นผู้จ่าย</li>
                    </ul>
                </div>
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

                const rect = dropdownMenu.getBoundingClientRect();
                const windowWidth = window.innerWidth;

                if (rect.right > windowWidth) {
                    dropdownMenu.style.left = 'auto';
                    dropdownMenu.style.right = '0';
                } else if (rect.left < 0) {
                    dropdownMenu.style.left = '0';
                    dropdownMenu.style.right = 'auto';
                } else {
                    dropdownMenu.style.left = '0';
                    dropdownMenu.style.right = 'auto';
                }
            });

            window.onclick = function(event) {
                if (!event.target.matches('.tab-button')) {
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

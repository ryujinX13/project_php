<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
include ('../../connect/connection.php');

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลจากตาราง private_agency
$sql = "SELECT Pva_id, Pva_name, Pva_detail, Pva_address, Pva_email, Pva_phone, Pva_photo FROM private_agency";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ข้อมูลหน่วยงาน</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../../css/user/stylesannounce.css">
    <style>
        body {
            font-family: "Mitr", sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .tab-bar {
            position: relative; 
            z-index: 10; 
            display: flex;
            align-items: center;
            background-color: #8ab7cc;
            padding: 10px 0;
            justify-content: center;
            font-family: "Mitr", sans-serif;
        }

        .tab-bar img {
            height: 80px;
            margin-right: auto;
            margin-left: 20px;
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

        .tab-link.login,
        .tab-link.logout {
            background-color: #F4CE14;
            color: #fff;
            border-radius: 10px;
        }

        .tab-link.register {
            background-color: #007bff;
            color: white;
            border-radius: 10px;
        }

        .tab-link.login:hover,
        .tab-link.register:hover {
            background-color: #e4b800;
            color: white;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown .tab-button {
            background-color: #F4CE14;
            color: black;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            margin: 0 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .dropdown .tab-button:hover {
            background-color: #F4CE14;
            color: white;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #d1d7da;
            border-radius: 10px;
            padding: 10px;
            z-index: 1;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }

        .dropdown-item {
            color: black;
            padding: 10px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
            border-radius: 5px;
        }

        .dropdown-item:hover {
            background-color: #F4CE14;
            color: white;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 900px;
            padding: 20px;
            margin: 20px auto;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-header img {
            width: 70%; /* ปรับขนาดเป็น 50% ของความกว้างของ container */
            max-width: 500px; /* กำหนดขนาดสูงสุดของรูปภาพ */
            height: auto; /* ให้ความสูงอัตโนมัติเพื่อรักษาสัดส่วนของรูปภาพ */
            object-fit: cover; /* ให้ครอบคลุมพื้นที่ของ element และรักษาสัดส่วนของรูปภาพ */
            margin-bottom: 10px;
            border-radius: 15px; /* เพิ่มขอบมนให้กับรูปภาพ */
        }

        .profile-header h1 {
            margin: 0;
            font-size: 28px; /* เพิ่มขนาดตัวหนังสือ */
            color: #333;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .profile-info div {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .profile-info div span {
            font-weight: bold;
            color: #555;
            flex: 1 1 30%;
            font-size: 18px; /* เพิ่มขนาดตัวหนังสือ */
        }
    </style>
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
                <div class="dropdown-menu" id="dropdownMenu">
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

    <main>
        <div class="container">
            <?php
            if ($result->num_rows > 0) {
                // แสดงผลข้อมูลแต่ละแถว
                while($row = $result->fetch_assoc()) {
                    // แปลง binary data เป็นรูปภาพ base64
                    $imageData = base64_encode($row['Pva_photo']);
                    $imageSrc = 'data:image/jpeg;base64,'.$imageData;
            ?>

            <div class="profile-header">
                <img src="<?php echo $imageSrc; ?>" alt="รูปภาพหน่วยงาน">
                <h1>รายละเอียดหน่วยงาน</h1>
            </div>
            <div class="profile-info">
                <div><span>ชื่อหน่วยงาน:</span> <?php echo $row['Pva_name']; ?></div>
                <div><span>รายละเอียดหน่วยงาน:</span> <?php echo $row['Pva_detail']; ?></div>
                <div><span>ที่อยู่หน่วยงาน:</span> <?php echo $row['Pva_address']; ?></div>
                <div><span>อีเมลหน่วยงาน:</span> <?php echo $row['Pva_email']; ?></div>
                <div><span>เบอร์โทรศัพท์หน่วยงาน:</span> <?php echo $row['Pva_phone']; ?></div>
            </div>

            <?php
                }
            } else {
                echo "<div class='container'><div class='profile-header'><h1>ไม่มีข้อมูล</h1></div></div>";
            }
            $conn->close();
            ?>
        </div>
    </main>

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

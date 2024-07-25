<?php
session_start();
include ('../../connect/connection.php');

// ตรวจสอบว่าผู้ใช้ล็อคอินอยู่หรือไม่
if (!isset($_SESSION['admin_username'])) {
    header('Location: admin_login.php'); // เปลี่ยนเส้นทางไปยังหน้า login หากผู้ใช้ยังไม่ได้ล็อคอิน
    exit;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลของผู้ใช้ที่ล็อคอินอยู่
$admin_username = $_SESSION['admin_username']; // ใช้ session admin_username
$sql = "SELECT Admin_id, Admin_name, Admin_Username, Admin_address, Admin_phone, Admin_photo FROM admin WHERE Admin_Username = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $admin_username);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result === false) {
    die("Get result failed: " . $stmt->error);
}

$admin = $result->fetch_assoc();

if ($admin === null) {
    die("No admin found with the username: " . htmlspecialchars($admin_username));
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>รายละเอียดผู้ดูแลระบบ</title>
    <style>
 @import url('https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap');

body {
    font-family: "Mitr", sans-serif;
    line-height: 1.6;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-weight: 400; /* ลดความหนาตัวหนังสือ */
}

.tab-bar {
    width: 100%;
    background-color: #8ab7cc;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px 0;
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
    background-color: #96B6C5;
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

.main-container {
            display: flex;
            width: 100%;
            max-width: 1300px;
            margin: 20px auto;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #f1f1f1;
        }

        .sidebar {
            flex: 1;
            max-width: 300px;
            background-color: #fff;
            padding: 5px;
            margin-right: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 250px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            text-decoration: none;
            color: #333;
            border-radius: 4px;
            transition: background-color 0.3s;

        }

        .sidebar a:hover {
            background-color: #f1f1f1;
        }

        .sidebar a.active {
            background-color: #8ab7cc;
            color: white;
        }
.profile-container {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    max-width: 600px;
    width: 100%;
}

.profile-container img {
    width: 150px;
    height: 150px; 
    display: block;
    margin: 0 auto 20px;
    border-radius: 50%;
    border: 1px solid #000000; 
    object-fit: cover; 
}

.profile-container h1 {
    text-align: center;
    margin-bottom: 20px;
    font-weight: 300; /* ลดความหนาตัวหนังสือ */
}

.profile-container p {
    margin: 10px 0;
    padding-bottom: 10px;
    border-bottom: 1px solid #e0e0e0;
}

.profile-container p strong {
    display: inline-block;
    width: 150px;
}

    </style>
</head>

<body>
<div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="admin_dashboard.php" class="tab-link">หน้าแรก</a>
        <a href="prov_display.php" class="tab-link">ข้อมูลพนักงาน</a>
        <a href="show_training_record.php" class="tab-link">การอบรม</a>
        <a href="history.html" class="tab-link">รายงาน</a>
        <a href="edit_announce.php" class="tab-link">ประกาศรับสมัครงาน</a>
        <div class="dropdown">
            <button class="tab-button dropdown-toggle" type="button" id="dropdownMenuButton">
                <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
            </button>
            <div class="dropdown-menu" id="dropdownMenu">
                <a class="dropdown-item" href="account_admin.php">
                    <span style="margin-right: 8px;">🔍</span>รายละเอียดบัญชี
                </a>
                <a class="dropdown-item" href="../../process/logout.php">
                    <span style="margin-right: 8px;">🔓</span>ออกจากระบบ
                </a>
            </div>
        </div>
    </div>

    <div class="main-container">
    <div class="sidebar">
            <a href="../admin/account_admin.php" class="menu-item">
                <span style="margin-right: 8px;">🔍</span>รายละเอียดบัญชี
            </a>
            <a href="../admin/edit_agency.php" class="menu-item">
                <span style="margin-right: 8px;">🏢</span>ข้อมูลหน่วยงาน
            </a>
            <a href="../admin/manage_travel_cost.php" class="menu-item">
                <span style="margin-right: 8px;">🚑</span>จัดการข้อมูลระยะทาง
            </a>
            <a href="../admin/manage_rates.php" class="menu-item">
                <span style="margin-right: 8px;">💰</span>จัดการข้อมูลแพคเกจ
            </a>
            <a href="../../process/logout.php" class="menu-item">
                <span style="margin-right: 8px;">🔓</span>ออกจากระบบ
            </a>
        </div>

        <div class="profile-container">
            <h1>รายละเอียดผู้ดูแลระบบ</h1>
            <div class="admin-detail">
                <img src="../../process/show_imageAdmin.php" alt="รูปภาพของ <?php echo htmlspecialchars($admin['Admin_name']); ?>">
                <p><strong>รหัสบัตรประจำตัวประชาชน:</strong> <?php echo htmlspecialchars($admin['Admin_id']); ?></p>
                <p><strong>ชื่อผู้ใช้:</strong> <?php echo htmlspecialchars($admin['Admin_Username']); ?></p>
                <p><strong>ชื่อ-นามสกุล:</strong> <?php echo htmlspecialchars($admin['Admin_name']); ?></p>
                <p><strong>ที่อยู่:</strong> <?php echo htmlspecialchars($admin['Admin_address']); ?></p>
                <p><strong>เบอร์โทรศัพท์:</strong> <?php echo htmlspecialchars($admin['Admin_phone']); ?></p>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('dropdownMenuButton').addEventListener('click', function () {
            var dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';

            // Check if the dropdown menu is out of the viewport
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

        // Close the dropdown menu if the user clicks outside of it
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

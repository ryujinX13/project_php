<?php
session_start();
include ('../../connect/connection.php');

if (!isset($_SESSION['admin_username'])) {
    header('Location: admin_login.php');
    exit;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$admin_username = $_SESSION['admin_username'];
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
    die("ไม่พบผู้ดูแลระบบที่มีชื่อผู้ใช้: " . htmlspecialchars($admin_username));
}

$stmt->close();
$conn->close();

// ตรวจสอบว่ามีรูปโปรไฟล์หรือไม่
$admin_photo = $admin['Admin_photo'] ? '../../uploads/' . $admin['Admin_photo'] : '../../img/placeholder.png';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายละเอียดผู้ดูแลระบบ</title>
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesaccount_admin.css">
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
            <a href="../admin/account_admin.php" class="menu-item active">
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
                <img src="<?php echo htmlspecialchars($admin_photo); ?>" alt="รูปภาพของ <?php echo htmlspecialchars($admin['Admin_name']); ?>" width="150" height="150">
                <p><strong>รหัสบัตรประจำตัวประชาชน:</strong> <?php echo htmlspecialchars($admin['Admin_id']); ?></p>
                <p><strong>ชื่อผู้ใช้:</strong> <?php echo htmlspecialchars($admin['Admin_Username']); ?></p>
                <p><strong>ชื่อ-นามสกุล:</strong> <?php echo htmlspecialchars($admin['Admin_name']); ?></p>
                <p><strong>ที่อยู่:</strong> <?php echo htmlspecialchars($admin['Admin_address']); ?></p>
                <p><strong>เบอร์โทรศัพท์:</strong> <?php echo htmlspecialchars($admin['Admin_phone']); ?></p>
                <a href="edit_admin.php" class="btn-edit">แก้ไขข้อมูล</a>
            </div>
        </div>
    </div>
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

        window.onclick = function (event) {
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

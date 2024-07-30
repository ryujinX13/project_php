<?php
session_start();
include('../../connect/connection.php');

if (!isset($_SESSION['provider_username'])) {
    header('Location: prov_login.php');
    exit;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$provider_username = $_SESSION['provider_username'];  // ใช้ provider_username จาก session
$sql = "SELECT * FROM provider WHERE Prov_Username = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $provider_username);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result === false) {
    die("Get result failed: " . $stmt->error);
}

$provider = $result->fetch_assoc();

if ($provider === null) {
    die("ไม่พบผู้ให้บริการที่มีชื่อผู้ใช้: " . htmlspecialchars($provider_username));
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>แก้ไขรายละเอียดผู้ให้บริการ</title>
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
                <?php echo htmlspecialchars($_SESSION['provider_username']); ?>
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
            <h1>แก้ไขรายละเอียดผู้ให้บริการ</h1>
            <form action="../../process/updateprov_profile.php" method="POST">
                <input type="hidden" name="Prov_id" value="<?php echo htmlspecialchars($provider['Prov_id']); ?>">
                <p><strong>ชื่อผู้ใช้:</strong> <input type="text" name="Prov_Username" value="<?php echo htmlspecialchars($provider['Prov_Username']); ?>" readonly style="border:none; background-color: transparent;"></p>
                <p><strong>ชื่อ-นามสกุล:</strong> <input type="text" name="Prov_name" value="<?php echo htmlspecialchars($provider['Prov_name']); ?>"></p>
                <p><strong>เพศ:</strong> <input type="text" name="Prov_gender" value="<?php echo htmlspecialchars($provider['Prov_gender']); ?>"></p>
                <p><strong>วันเกิด:</strong> <input type="date" name="Prov_birthday" value="<?php echo htmlspecialchars($provider['Prov_birthday']); ?>"></p>
                <p><strong>ที่อยู่ตามทะเบียนบ้าน:</strong> <input type="text" name="Prov_address" value="<?php echo htmlspecialchars($provider['Prov_address']); ?>"></p>
                <p><strong>ที่อยู่ปัจจุบัน:</strong> <input type="text" name="Prov_addressnow" value="<?php echo htmlspecialchars($provider['Prov_addressnow']); ?>"></p>
                <p><strong>สัญชาติ:</strong> <input type="text" name="Prov_nationality" value="<?php echo htmlspecialchars($provider['Prov_nationality']); ?>"></p>
                <p><strong>ศาสนา:</strong> <input type="text" name="Prov_religion" value="<?php echo htmlspecialchars($provider['Prov_religion']); ?>"></p>
                <p><strong>อีเมล์:</strong> <input type="email" name="Prov_email" value="<?php echo htmlspecialchars($provider['Prov_email']); ?>"></p>
                <p><strong>เบอร์โทรศัพท์:</strong> <input type="text" name="Prov_phone" value="<?php echo htmlspecialchars($provider['Prov_phone']); ?>"></p>
                <p><strong>รหัสผ่านใหม่:</strong> <input type="password" name="Prov_password" placeholder="กรอกรหัสผ่านใหม่"></p>
                <p><strong>ยืนยันรหัสผ่านใหม่:</strong> <input type="password" name="Prov_confirm_password" placeholder="ยืนยันรหัสผ่านใหม่"></p>
                <p><strong>วุฒิการศึกษา:</strong> <textarea name="Prov_study"><?php echo htmlspecialchars($provider['Prov_study']); ?></textarea></p>
                <p><button type="submit">บันทึก</button></p>
            </form>
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

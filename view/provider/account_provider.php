<?php
session_start();
include('../../connect/connection.php');

// ตรวจสอบว่าผู้ใช้ล็อคอินอยู่หรือไม่
if (!isset($_SESSION['provider_username'])) {
    header('Location: prov_login.php'); // เปลี่ยนเส้นทางไปยังหน้า login หากผู้ใช้ยังไม่ได้ล็อคอิน
    exit;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลของผู้ให้บริการที่ล็อคอินอยู่
$prov_username = $_SESSION['provider_username']; // ใช้ session username
$sql = "SELECT Prov_id, Prov_Username, Prov_password, Prov_name, 
        Prov_gender, Prov_birthday, Prov_addressnow, Prov_email, 
        Prov_phone, Prov_train, Prov_img FROM provider WHERE Prov_Username = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $prov_username);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result === false) {
    die("Get result failed: " . $stmt->error);
}

$prov = $result->fetch_assoc();

if ($prov === null) {
    die("No provider found with the username: " . htmlspecialchars($prov_username));
}

$stmt->close();
$conn->close();

// ตรวจสอบว่ามีรูปโปรไฟล์หรือไม่
$prov_photo = $prov['Prov_img'] ? 'data:image/jpeg;base64,' . base64_encode($prov['Prov_img']) : '../../img/placeholder.png';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายละเอียดผู้ให้บริการ</title>
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/user/stylesaccount_user.css">
</head>

<body>
<div class="tab-bar">
    <button class="back-button" onclick="window.location.href='../user/Homepage.php'">⬅️</button>
    <img src="../../img/logo1.png" alt="Logo" style="margin-left: 10px;">
</div>
<div class="container d-flex">
    <div class="menu-container">
        <a href="account_provider.php" class="menu-item active">
            <span style="margin-right: 8px;">🔍</span>รายละเอียดบัญชี
        </a>
        <a href="#" class="menu-item ">
            <span style="margin-right: 8px;">📅</span>รายการจอง
        </a>
        <a href="#" class="menu-item">
            <span style="margin-right: 8px;">📜</span>ประวัติการจอง
        </a>
        <a href="#" class="menu-item ">
            <span style="margin-right: 8px;">📜</span>ข้อมูลหน่วยงาน
        </a>
        <a href="../../process/logout.php" class="menu-item">
            <span style="margin-right: 8px;">🔓</span>ออกจากระบบ
        </a>
    </div>
    <div class="profile-container ml-4">
        <img src="<?php echo $prov_photo; ?>" alt="รูปภาพของ <?php echo htmlspecialchars($prov['Prov_name']); ?>" style="width: 100px; height: 100px;">
        <h1>รายละเอียดผู้ให้บริการ</h1>
        <p><strong>รหัสบัตรประจำตัวประชาชน:</strong> <?php echo htmlspecialchars($prov['Prov_id']); ?></p>
        <p><strong>ชื่อผู้ใช้:</strong> <?php echo htmlspecialchars($prov['Prov_Username']); ?></p>
        <p><strong>ชื่อ-นามสกุล:</strong> <?php echo htmlspecialchars($prov['Prov_name']); ?></p>
        <p><strong>เพศ:</strong> <?php echo $prov['Prov_gender'] == '0' ? 'ชาย' : 'หญิง'; ?></p>
        <p><strong>วันเกิด:</strong> <?php echo htmlspecialchars($prov['Prov_birthday']); ?></p>
        <p><strong>ที่อยู่ปัจจุบัน:</strong> <?php echo htmlspecialchars($prov['Prov_addressnow']); ?></p>
        <p><strong>อีเมล์:</strong> <?php echo htmlspecialchars($prov['Prov_email']); ?></p>
        <p><strong>เบอร์โทรศัพท์:</strong> <?php echo htmlspecialchars($prov['Prov_phone']); ?></p>
        <p><strong>สถานะการอบรม:</strong> <?php echo $prov['Prov_train'] == '1' ? 'ผ่าน' : 'ไม่ผ่าน'; ?></p>
        <a href="edit_provider.php" class="edit-button">แก้ไขข้อมูล</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

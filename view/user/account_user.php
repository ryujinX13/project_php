<?php
session_start();
include ('../../connect/connection.php');

// ตรวจสอบว่าผู้ใช้ล็อคอินอยู่หรือไม่
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // เปลี่ยนเส้นทางไปยังหน้า login หากผู้ใช้ยังไม่ได้ล็อคอิน
    exit;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลของผู้ใช้ที่ล็อคอินอยู่
$user_username = $_SESSION['username']; // ใช้ session username
$sql = "SELECT User_id, User_Username, User_password, User_name, 
        User_gender, User_birthday, User_addressnow, User_email, 
        User_phone, User_status, user_photo FROM user WHERE User_Username = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $user_username);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result === false) {
    die("Get result failed: " . $stmt->error);
}

$user = $result->fetch_assoc();

if ($user === null) {
    die("No user found with the username: " . htmlspecialchars($user_username));
}

$stmt->close();
$conn->close();

// ตรวจสอบว่ามีรูปโปรไฟล์หรือไม่
$user_photo = $user['user_photo'] ? '../../uploads/' . $user['user_photo'] : '../../img/placeholder.png';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายละเอียดผู้ใช้งาน</title>
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
            <a href="../user/account_user.php" class="menu-item">
                <span style="margin-right: 8px;">🔍</span>รายละเอียดบัญชี
            </a>
            <a href="#" class="menu-item active">
                <span style="margin-right: 8px;">📅</span>รายการจอง
            </a>
            <a href="#" class="menu-item">
                <span style="margin-right: 8px;">📜</span>ประวัติการจอง
            </a>
            <a href="#" class="menu-item">
                <span style="margin-right: 8px;">🏢</span>ข้อมูลหน่วยงาน
            </a>
            <a href="../../process/logout.php" class="menu-item">
                <span style="margin-right: 8px;">🔓</span>ออกจากระบบ
            </a>
            
        </div>
        <div class="profile-container ml-4">
            <img src="<?php echo htmlspecialchars($user_photo); ?>" alt="รูปภาพของ <?php echo htmlspecialchars($user['User_name']); ?>" style="width: 100px; height: 100px;">
            <h1>รายละเอียดผู้ใช้งาน</h1>
            <p><strong>รหัสบัตรประจำตัวประชาชน:</strong> <?php echo htmlspecialchars($user['User_id']); ?></p>
            <p><strong>ชื่อผู้ใช้:</strong> <?php echo htmlspecialchars($user['User_Username']); ?></p>
            <p><strong>ชื่อ-นามสกุล:</strong> <?php echo htmlspecialchars($user['User_name']); ?></p>
            <p><strong>เพศ:</strong> <?php echo $user['User_gender'] == 0 ? 'ชาย' : 'หญิง'; ?></p>
            <p><strong>วันเกิด:</strong> <?php echo htmlspecialchars($user['User_birthday']); ?></p>
            <p><strong>ที่อยู่ปัจจุบัน:</strong> <?php echo htmlspecialchars($user['User_addressnow']); ?></p>
            <p><strong>อีเมล์:</strong> <?php echo htmlspecialchars($user['User_email']); ?></p>
            <p><strong>เบอร์โทรศัพท์:</strong> <?php echo htmlspecialchars($user['User_phone']); ?></p>
            <p><strong>สถานะการยืนยัน:</strong> <?php echo $user['User_status'] == 1 ? 'ยืนยันแล้ว' : 'ยังไม่ยืนยัน'; ?></p>
            <a href="edit_profile.php" class="edit-button">แก้ไขข้อมูล</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

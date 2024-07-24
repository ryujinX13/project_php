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
    font-weight: 300; /* ลดความหนาตัวหนังสือ */
}

.tab-bar {
    display: flex;
    align-items: center;
    background-color: #8ab7cc;
    padding: 20px; /* ลด padding */
    justify-content: center;
    height: 80px; /* ปรับความสูง */
}

.tab-bar img {
    height: 60px; /* ปรับความสูงของรูปภาพ */
    margin-left: 20px; /* ลด margin-left */
}

.back-button {
    position: absolute;
    left: 10px; /* ปรับตำแหน่งให้ชิดซ้าย */
    background: none;
    border: none;
    font-size: 2em; /* ปรับขนาด */
    color: black;
    cursor: pointer;
    transition: color 0.3s ease, transform 0.3s ease;
}

.back-button:hover {
    color: white;
    transform: scale(1.1);
}

.container {
    display: flex;
    justify-content: flex-start; /* จัดวางเนื้อหาให้อยู่ทางซ้าย */
    align-items: flex-start; /* จัดวางเนื้อหาให้อยู่ด้านบน */
    margin: 40px auto 0; /* ปรับ margin เพื่อเลื่อนเนื้อหาลงมาเล็กน้อย */
    gap: 20px;
    max-width: 1000px; /* กำหนดความกว้างสูงสุด */
    padding-left: 20px; /* เพิ่ม padding-left */
}

.menu-container {
    width: 200px;
    background: #fff;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    height: 150px; /* ตั้งค่าความสูงให้ลดลงตามต้องการ */
}

.menu-item {
    display: flex;
    align-items: center;
    padding: 5px;
    margin-bottom: 10px;
    border-radius: 4px;
    text-decoration: none;
    color: #333;
    transition: background-color 0.3s, font-weight 0.3s;
}

.menu-item img {
    margin-right: 10px;
    width: 20px;
    height: 20px;
}

.menu-item:hover {
    background-color: #eee;
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
        <button class="back-button" onclick="window.location.href='../user/Homepage.php'">⬅️</button>
        <img src="../../img/logo1.png" alt="Logo">
    </div>
    <div class="container">
        <div class="menu-container">
            <a href="../user/account_user.php" class="menu-item">
                <span style="margin-right: 8px;">🔍</span>รายละเอียดบัญชี
            </a>
            <a href="#" class="menu-item">
                <span style="margin-right: 8px;">🏣</span>ข้อมูลหน่วยงาน
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
</body>

</html>

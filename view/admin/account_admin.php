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
        .admin-detail {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }

        .admin-detail img {
            max-width: 100px;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }

        .edit-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }

        .edit-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>รายละเอียดผู้ดูแลระบบ</h1>
    <div class="admin-detail">
        <img src="../../process/show_imageAdmin.php" alt="รูปภาพของ <?php echo htmlspecialchars($admin['Admin_name']); ?>">
        <p><strong>รหัสบัตรประจำตัวประชาชน:</strong> <?php echo htmlspecialchars($admin['Admin_id']); ?></p>
        <p><strong>ชื่อผู้ใช้:</strong> <?php echo htmlspecialchars($admin['Admin_Username']); ?></p>
        <p><strong>ชื่อ-นามสกุล:</strong> <?php echo htmlspecialchars($admin['Admin_name']); ?></p>
        <p><strong>ที่อยู่:</strong> <?php echo htmlspecialchars($admin['Admin_address']); ?></p>
        <p><strong>เบอร์โทรศัพท์:</strong> <?php echo htmlspecialchars($admin['Admin_phone']); ?></p>
    </div>
</body>

</html>

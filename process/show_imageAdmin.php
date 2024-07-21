<?php
session_start();
include ('../connect/connection.php');

// ตรวจสอบว่าผู้ใช้ล็อคอินอยู่หรือไม่
if (!isset($_SESSION['admin_username'])) {
    header('Location: ../view/user/admin_login.php'); // เปลี่ยนเส้นทางไปยังหน้า login หากผู้ใช้ยังไม่ได้ล็อคอิน
    exit;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลของผู้ใช้ที่ล็อคอินอยู่
$admin_username = $_SESSION['admin_username']; // ใช้ session admin_username
$sql = "SELECT Admin_photo FROM admin WHERE Admin_Username = ?";
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

// ตรวจสอบข้อมูลรูปภาพ
if (!empty($admin['Admin_photo'])) {
    header("Content-type: image/jpeg");
    echo $admin['Admin_photo'];
} else {
    die("No image found for the admin.");
}

$stmt->close();
$conn->close();
?>

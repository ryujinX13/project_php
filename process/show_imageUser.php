<?php
session_start();
include ('../connect/connection.php');

// ตรวจสอบว่าผู้ใช้ล็อคอินอยู่หรือไม่
if (!isset($_SESSION['username']))

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลของผู้ใช้ที่ล็อคอินอยู่
$user_username = $_SESSION['username']; // ใช้ session username
$sql = "SELECT User_photo FROM user WHERE User_Username = ?";
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
    die("No user found with the username: " . $user_username);
}

// ตรวจสอบข้อมูลรูปภาพ
if (!empty($user['User_photo'])) {
    header("Content-type: image/jpeg");
    echo $user['User_photo'];
} else {
    die("No image found for the user.");
}

$stmt->close();
$conn->close();
?>

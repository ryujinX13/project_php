<?php
session_start();
include ('../connect/connection.php');

// ตรวจสอบว่าผู้ใช้ล็อคอินอยู่หรือไม่
if (!isset($_SESSION['admin_username'])) {
    header('Location: ../view/admin/login.php');
    exit;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
$admin_id = $_POST['Admin_id'];
$admin_name = $_POST['Admin_name'];
$admin_address = $_POST['Admin_address'];
$admin_phone = $_POST['Admin_phone'];
$admin_password = $_POST['Admin_password'];

// สำหรับการอัพโหลดรูปภาพ
$profile_pic_path = null;
$allowed_file_types = ['image/jpeg', 'image/png', 'image/gif']; // ประเภทไฟล์ที่อนุญาต
$max_file_size = 2 * 1024 * 1024; // ขนาดไฟล์สูงสุด 2MB

if (isset($_FILES['Admin_photo']) && $_FILES['Admin_photo']['error'] === UPLOAD_ERR_OK) {
    // ตรวจสอบประเภทไฟล์
    $file_type = mime_content_type($_FILES['Admin_photo']['tmp_name']);
    if (!in_array($file_type, $allowed_file_types)) {
        die("File type not allowed.");
    }

    // ตรวจสอบขนาดไฟล์
    if ($_FILES['Admin_photo']['size'] > $max_file_size) {
        die("File size exceeds limit.");
    }

    $file_tmp = $_FILES['Admin_photo']['tmp_name'];
    $file_name = basename($_FILES['Admin_photo']['name']);
    $file_path = '../uploads/' . $file_name;

    // ตรวจสอบว่าไดเรกทอรีอัพโหลดมีอยู่หรือไม่
    if (!is_dir('../uploads')) {
        mkdir('../uploads', 0777, true);
    }

    if (move_uploaded_file($file_tmp, $file_path)) {
        $profile_pic_path = $file_name;
    } else {
        die("Failed to move uploaded file.");
    }
}

// สร้างคำสั่ง SQL สำหรับอัปเดตข้อมูล
$sql = "UPDATE admin SET Admin_name = ?, Admin_address = ?, Admin_phone = ?";
$params = [$admin_name, $admin_address, $admin_phone];

if (!empty($admin_password)) {
    $sql .= ", Admin_password = ?";
    $params[] = $admin_password; // ไม่แฮชรหัสผ่าน
}

if ($profile_pic_path) {
    $sql .= ", Admin_photo = ?";
    $params[] = $profile_pic_path;
}

$sql .= " WHERE Admin_id = ?";
$params[] = $admin_id;

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$param_types = str_repeat('s', count($params));
$stmt->bind_param($param_types, ...$params);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$stmt->close();
$conn->close();

header('Location: ../view/admin/account_admin.php');
exit;
?>

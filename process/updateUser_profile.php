<?php
session_start();
include ('../connect/connection.php');

// ตรวจสอบว่าผู้ใช้ล็อคอินอยู่หรือไม่
if (!isset($_SESSION['username'])) {
    header('Location: ../view/user/login.php');
    exit;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
$user_username = $_SESSION['username'];
$user_birthday = mysqli_real_escape_string($conn, $_POST['User_birthday']);
$user_addressnow = mysqli_real_escape_string($conn, $_POST['User_addressnow']);
$user_phone = mysqli_real_escape_string($conn, $_POST['User_phone']);
$user_password = $_POST['User_password'];

// สำหรับการอัพโหลดรูปภาพ
$profile_pic_path = null;
if (isset($_FILES['user_photo']) && $_FILES['user_photo']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['user_photo']['tmp_name'];
    $file_name = basename($_FILES['user_photo']['name']);
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
if (!empty($user_password)) {
    // แฮชรหัสผ่านใหม่
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    $sql = "UPDATE user SET User_birthday = ?, User_addressnow = ?, User_phone = ?, User_password = ?";
    if ($profile_pic_path) {
        $sql .= ", user_photo = ?";
    }
    $sql .= " WHERE User_Username = ?";
    
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    if ($profile_pic_path) {
        $stmt->bind_param("ssssss", $user_birthday, $user_addressnow, $user_phone, $hashed_password, $profile_pic_path, $user_username);
    } else {
        $stmt->bind_param("sssss", $user_birthday, $user_addressnow, $user_phone, $hashed_password, $user_username);
    }
} else {
    $sql = "UPDATE user SET User_birthday = ?, User_addressnow = ?, User_phone = ?";
    if ($profile_pic_path) {
        $sql .= ", user_photo = ?";
    }
    $sql .= " WHERE User_Username = ?";
    
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    if ($profile_pic_path) {
        $stmt->bind_param("sssss", $user_birthday, $user_addressnow, $user_phone, $profile_pic_path, $user_username);
    } else {
        $stmt->bind_param("ssss", $user_birthday, $user_addressnow, $user_phone, $user_username);
    }
}

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$stmt->close();
$conn->close();

header('Location: ../view/user/account_user.php');
exit;
?>

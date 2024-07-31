<?php
include('../../connect/connection.php');

$prov_id = mysqli_real_escape_string($conn, $_POST['Prov_id']);
$prov_name = mysqli_real_escape_string($conn, $_POST['Prov_name']);
$prov_gender = mysqli_real_escape_string($conn, $_POST['Prov_gender']);
$prov_birthday = mysqli_real_escape_string($conn, $_POST['Prov_birthday']);
$prov_address = mysqli_real_escape_string($conn, $_POST['Prov_address']);
$prov_addressnow = mysqli_real_escape_string($conn, $_POST['Prov_addressnow']);
$prov_nationality = mysqli_real_escape_string($conn, $_POST['Prov_nationality']);
$prov_religion = mysqli_real_escape_string($conn, $_POST['Prov_religion']);
$prov_email = mysqli_real_escape_string($conn, $_POST['Prov_email']);
$prov_phone = mysqli_real_escape_string($conn, $_POST['Prov_phone']);
$prov_password = $_POST['Prov_password'];
$prov_confirm_password = $_POST['Prov_confirm_password'];
$prov_study = mysqli_real_escape_string($conn, $_POST['Prov_study']);

if ($prov_password != $prov_confirm_password) {
    die("รหัสผ่านไม่ตรงกัน");
}

// ตรวจสอบว่าอีเมลซ้ำหรือไม่
$sql_check_email = "SELECT Prov_id FROM provider WHERE Prov_email = ? AND Prov_id != ?";
$stmt_check = $conn->prepare($sql_check_email);
$stmt_check->bind_param("si", $prov_email, $prov_id);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    $stmt_check->close();
    $conn->close();
    die("อีเมลนี้ถูกใช้ไปแล้ว กรุณาใช้อีเมลอื่น");
}

$stmt_check->close();

// ตรวจสอบและอัปเดตรหัสผ่าน
if (!empty($prov_password)) {
    $hashed_password = password_hash($prov_password, PASSWORD_DEFAULT);
    $update_sql = "UPDATE provider SET Prov_name = ?, Prov_gender = ?, Prov_birthday = ?, Prov_address = ?, Prov_addressnow = ?, Prov_nationality = ?, Prov_religion = ?, Prov_email = ?, Prov_phone = ?, Prov_password = ?, Prov_study = ? WHERE Prov_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssssssssssi", $prov_name, $prov_gender, $prov_birthday, $prov_address, $prov_addressnow, $prov_nationality, $prov_religion, $prov_email, $prov_phone, $hashed_password, $prov_study, $prov_id);
} else {
    $update_sql = "UPDATE provider SET Prov_name = ?, Prov_gender = ?, Prov_birthday = ?, Prov_address = ?, Prov_addressnow = ?, Prov_nationality = ?, Prov_religion = ?, Prov_email = ?, Prov_phone = ?, Prov_study = ? WHERE Prov_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssssssssi", $prov_name, $prov_gender, $prov_birthday, $prov_address, $prov_addressnow, $prov_nationality, $prov_religion, $prov_email, $prov_phone, $prov_study, $prov_id);
}

if ($stmt->execute()) {
    echo "อัปเดตข้อมูลสำเร็จ";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
header('Location: ../admin/account_admin.php');
?>

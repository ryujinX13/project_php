<?php
include('../../connect/connection.php');

$prov_id = $_POST['Prov_id'];
$prov_name = $_POST['Prov_name'];
$prov_gender = $_POST['Prov_gender'];
$prov_birthday = $_POST['Prov_birthday'];
$prov_address = $_POST['Prov_address'];
$prov_addressnow = $_POST['Prov_addressnow'];
$prov_nationality = $_POST['Prov_nationality'];
$prov_religion = $_POST['Prov_religion'];
$prov_email = $_POST['Prov_email'];
$prov_phone = $_POST['Prov_phone'];
$prov_password = $_POST['Prov_password'];
$prov_confirm_password = $_POST['Prov_confirm_password'];
$prov_study = $_POST['Prov_study'];

if ($prov_password != $prov_confirm_password) {
    die("รหัสผ่านไม่ตรงกัน");
}

// ตรวจสอบและอัปเดตรหัสผ่าน
if (!empty($prov_password)) {
    $hashed_password = password_hash($prov_password, PASSWORD_DEFAULT);
    $update_sql = "UPDATE provider SET Prov_name = ?, Prov_gender = ?, Prov_birthday = ?, Prov_address = ?, Prov_addressnow = ?, Prov_nationality = ?, Prov_religion = ?, Prov_email = ?, Prov_phone = ?, Prov_password = ?, Prov_study = ? WHERE Prov_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssssssssssi", $prov_name, $prov_gender, $prov_birthday, $prov_address, $prov_addressnow, $prov_nationality, $prov_religion, $prov_email, $prov_phone, $hashed_password, $prov_study, $prov_id);
} else {
    $update_sql = "UPDATE provider SET Prov_name = ?, Prov_gender = ?, Prov_birthday = ?, Prov_address = ?, Prov_addressnow = ?, Prov_nationality = ?, Prov_religion = ?, Prov_email = ?, Prov_phone = ?, Prov_study = ? WHERE Prov_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssssssssssi", $prov_name, $prov_gender, $prov_birthday, $prov_address, $prov_addressnow, $prov_nationality, $prov_religion, $prov_email, $prov_phone, $prov_study, $prov_id);
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

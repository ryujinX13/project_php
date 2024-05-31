<?php
include ('../connect/connection.php');
session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$Prov_id = $_POST['Prov_id'];

// ตรวจสอบและกำหนดค่าที่ถูกส่งมาใน $_POST
$update_fields = array();
if(isset($_POST['Prov_Username']) && $_POST['Prov_Username'] !== '') {
    $Prov_Username = $_POST['Prov_Username'];
    $update_fields[] = "Prov_Username = '$Prov_Username'";
}
if(isset($_POST['Prov_password']) && $_POST['Prov_password'] !== '') {
    $Prov_password = $_POST['Prov_password'];
    $update_fields[] = "Prov_password = '$Prov_password'";
}
if(isset($_POST['Prov_name']) && $_POST['Prov_name'] !== '') {
    $Prov_name = $_POST['Prov_name'];
    $update_fields[] = "Prov_name = '$Prov_name'";
}
if(isset($_POST['Prov_gender']) && $_POST['Prov_gender'] !== '') {
    $Prov_gender = $_POST['Prov_gender'];
    $update_fields[] = "Prov_gender = '$Prov_gender'";
}
if(isset($_POST['Prov_birthday']) && $_POST['Prov_birthday'] !== '') {
    $Prov_birthday = $_POST['Prov_birthday'];
    $update_fields[] = "Prov_birthday = '$Prov_birthday'";
}
if(isset($_POST['Prov_datejob']) && $_POST['Prov_datejob'] !== '') {
    $Prov_datejob = $_POST['Prov_datejob'];
    $update_fields[] = "Prov_datejob = '$Prov_datejob'";
}
if(isset($_POST['Prov_address']) && $_POST['Prov_address'] !== '') {
    $Prov_address = $_POST['Prov_address'];
    $update_fields[] = "Prov_address = '$Prov_address'";
}
if(isset($_POST['Prov_addressnow']) && $_POST['Prov_addressnow'] !== '') {
    $Prov_addressnow = $_POST['Prov_addressnow'];
    $update_fields[] = "Prov_addressnow = '$Prov_addressnow'";
}
if(isset($_POST['Prov_nationality']) && $_POST['Prov_nationality'] !== '') {
    $Prov_nationality = $_POST['Prov_nationality'];
    $update_fields[] = "Prov_nationality = '$Prov_nationality'";
}
if(isset($_POST['Prov_religion']) && $_POST['Prov_religion'] !== '') {
    $Prov_religion = $_POST['Prov_religion'];
    $update_fields[] = "Prov_religion = '$Prov_religion'";
}
if(isset($_POST['Prov_train']) && $_POST['Prov_train'] !== '') {
    $Prov_train = $_POST['Prov_train'];
    $update_fields[] = "Prov_train = '$Prov_train'";
}
if(isset($_POST['Prov_email']) && $_POST['Prov_email'] !== '') {
    $Prov_email = $_POST['Prov_email'];
    $update_fields[] = "Prov_email = '$Prov_email'";
}
if(isset($_POST['Prov_phone']) && $_POST['Prov_phone'] !== '') {
    $Prov_phone = $_POST['Prov_phone'];
    $update_fields[] = "Prov_phone = '$Prov_phone'";
}
if(isset($_POST['Prov_study']) && $_POST['Prov_study'] !== '') {
    $Prov_study = $_POST['Prov_study'];
    $update_fields[] = "Prov_study = '$Prov_study'";
}

// สร้างสตริงสำหรับคำสั่ง SQL UPDATE
$update_query = "UPDATE provider SET ";
$update_query .= implode(', ', $update_fields);
$update_query .= " WHERE Prov_id = '$Prov_id'";

// ทำการอัปเดตในฐานข้อมูล
if ($conn->query($update_query) === TRUE) {
    echo "<script>alert('Update Successfully!');</script>";
    echo "<script>window.location.href='../view/admin/prov_display.php'</script>";
} else {
    echo "Error: " . $update_query . "<br>" . $conn->error;
}

// ปิดการเชื่อมต่อ MySQL
$conn->close();
?>

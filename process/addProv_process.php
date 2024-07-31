<?php
include ('../connect/connection.php');
session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$Prov_id = mysqli_real_escape_string($conn, $_POST['Prov_id']);
$Prov_Username = mysqli_real_escape_string($conn, $_POST['Prov_Username']);
$Prov_password = $_POST['Prov_password'];
$Prov_name = mysqli_real_escape_string($conn, $_POST['Prov_name']);
$Prov_gender = mysqli_real_escape_string($conn, $_POST['Prov_gender']);
$Prov_birthday = mysqli_real_escape_string($conn, $_POST['Prov_birthday']);
$Prov_datejob = mysqli_real_escape_string($conn, $_POST['Prov_datejob']);
$Prov_address = mysqli_real_escape_string($conn, $_POST['Prov_address']);
$Prov_addressnow = mysqli_real_escape_string($conn, $_POST['Prov_addressnow']);
$Prov_nationality = mysqli_real_escape_string($conn, $_POST['Prov_nationality']);
$Prov_religion = mysqli_real_escape_string($conn, $_POST['Prov_religion']);
$Prov_train = mysqli_real_escape_string($conn, $_POST['Prov_train']);
$Prov_email = mysqli_real_escape_string($conn, $_POST['Prov_email']);
$Prov_phone = mysqli_real_escape_string($conn, $_POST['Prov_phone']);
$Prov_study = mysqli_real_escape_string($conn, $_POST['Prov_study']);

// เข้ารหัสรหัสผ่าน
$hashed_password = password_hash($Prov_password, PASSWORD_BCRYPT);

$sql = "INSERT INTO provider (Prov_id, Prov_Username, Prov_password, Prov_name, Prov_gender, Prov_birthday, Prov_datejob, Prov_address, Prov_addressnow, Prov_nationality, Prov_religion, Prov_train, Prov_email, Prov_phone, Prov_study) 
VALUES ('$Prov_id', '$Prov_Username', '$hashed_password', '$Prov_name', '$Prov_gender', '$Prov_birthday', '$Prov_datejob', '$Prov_address', '$Prov_addressnow', '$Prov_nationality', '$Prov_religion', '$Prov_train', '$Prov_email', '$Prov_phone', '$Prov_study')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Record Inserted Successfully!');</script>";
    echo "<script>window.location.href='../view/admin/prov_display.php'</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// ปิดการเชื่อมต่อ MySQL
$conn->close();
?>

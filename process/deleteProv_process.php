<?php
include ('../connect/connection.php');
session_start();

// เชื่อมต่อฐานข้อมูล MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
$Prov_id = $_POST['Prov_id'];

// ลบข้อมูลจากฐานข้อมูล
$sql = "DELETE FROM provider WHERE Prov_id='$Prov_id'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว!');</script>";
    echo "<script>window.location.href='../view/provider/prov_display.php'</script>";
} else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
}

// ปิดการเชื่อมต่อ
$conn->close();
?>

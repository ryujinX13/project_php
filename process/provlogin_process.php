<?php
include ('../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM provider WHERE Prov_Username='$username' AND prov_password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "เข้าสู่ระบบสำเร็จ";
} else {
    echo "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
}

$conn->close();
?>
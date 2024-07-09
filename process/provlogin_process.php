<?php
include ('../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// ใช้การเตรียมคำสั่ง (Prepared Statements) เพื่อป้องกัน SQL Injection
$stmt = $conn->prepare("SELECT * FROM provider WHERE Prov_Username = ? AND Prov_password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // ตั้งค่า session หรือ redirect ไปยังหน้าที่ต้องการ
    session_start();
    $_SESSION['username'] = $username;
    echo "เข้าสู่ระบบสำเร็จ";
    // ตัวอย่างการ redirect ไปยังหน้า dashboard.php
    // header("Location: dashboard.php");
} else {
    echo "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
}

$stmt->close();
$conn->close();
?>

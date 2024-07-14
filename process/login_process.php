<?php
include ('../connect/connection.php');

// เริ่มต้นเซสชัน
session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE User_Username='$username' AND User_password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // บันทึกข้อมูลผู้ใช้ในเซสชัน
    $_SESSION['username'] = $username;

    echo "เข้าสู่ระบบสำเร็จ";
    echo "<script>window.location.href='../view/user/Homepage.php'</script>";
} else {
    echo "<script>
        alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
        window.location.href='../view/user/login.php';
    </script>";
}

$conn->close();
?>
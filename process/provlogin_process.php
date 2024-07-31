<?php
include ('../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];

// ใช้การเตรียมคำสั่ง (Prepared Statements) เพื่อป้องกัน SQL Injection
$stmt = $conn->prepare("SELECT * FROM provider WHERE Prov_Username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // ตรวจสอบรหัสผ่านที่แฮชไว้
    if (password_verify($password, $row['Prov_password'])) {
        // ตั้งค่า session หรือ redirect ไปยังหน้าที่ต้องการ
        session_start();
        $_SESSION['provider_username'] = $username;
        echo "เข้าสู่ระบบสำเร็จ";
        // ตัวอย่างการ redirect ไปยังหน้า account_provider.php
        header("Location: ../view/provider/account_provider.php");
        exit();
    } else {
        echo "<script>
            alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
            window.location.href='../view/provider/login.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
        window.location.href='../view/provider/login.php';
    </script>";
}

$stmt->close();
$conn->close();
?>

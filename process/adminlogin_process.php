<?php
session_start();
include('../connect/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM admin WHERE Admin_Username = ? AND Admin_Password = ?");
    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["Admin_Username"] = $username;
        header("Location: #");
    } else {
        echo "<script>
                alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
                window.location.href = '../../view/admin/admin_login.php';
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>

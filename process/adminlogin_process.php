<?php
session_start();
include ('../connect/connection.php');

if (isset($_POST["admin_login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE Admin_Username = ? AND Admin_Password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin_username'] = $username;
        header("Location: ../view/admin/admin_dashboard.php");
        exit();
    } else {
        echo "<script>
        alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
        window.location.href='../view/admin/admin_login.php';
    </script>";

    }

    $stmt->close();
    $conn->close();
}
?>
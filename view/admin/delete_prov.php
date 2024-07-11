<?php
include ('../../connect/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM Provider WHERE Prov_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "ลบข้อมูลเรียบร้อยแล้ว";
        } else {
            echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "เกิดข้อผิดพลาดในการเตรียม statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "ไม่มี ID สำหรับลบข้อมูล";
}
?>

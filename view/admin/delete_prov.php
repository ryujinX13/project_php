<?php
include ('../../connect/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // สร้างคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM Provider WHERE Prov_id = ?";

    // เตรียม statement
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

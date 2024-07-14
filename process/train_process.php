<?php
include ('../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM training_record";
if ($stmt = $conn->prepare($sql)) {
    $stmt->execute();
    $result = $stmt->get_result();

    // ตรวจสอบเงื่อนไข training_time = 8
    while ($row = $result->fetch_assoc()) {
        if ($row['training_time'] == 8) {
            // อัพเดตตาราง provider
            $update_sql = "UPDATE provider SET prov_train = 1 WHERE Prov_id = ?";
            if ($update_stmt = $conn->prepare($update_sql)) {
                $update_stmt->bind_param("s", $row['Prov_id']);
                $update_stmt->execute();
                $update_stmt->close();
            } else {
                die("ข้อผิดพลาดในการเตรียมคำสั่ง: " . $conn->error);
            }
        }
    }
    $stmt->close();
} else {
    die("ข้อผิดพลาดในการเตรียมคำสั่ง: " . $conn->error);
}

$conn->close();
?>

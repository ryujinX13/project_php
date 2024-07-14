<?php
include ('../../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $training_id = $_POST['Training_id'];
    $training_date = $_POST['Training_date'];
    $prov_id = $_POST['Prov_id'];
    $ajob_id = $_POST['Ajob_id'];
    $training_time = $_POST['training_time'];

    $conn->begin_transaction();

    try {
        // ตรวจสอบว่า Prov_id มีอยู่ใน provider หรือไม่
        $check_sql = "SELECT Prov_id FROM provider WHERE Prov_id = ?";
        $check_stmt = $conn->prepare($check_sql);
        if (!$check_stmt) {
            throw new Exception("ข้อผิดพลาดในการเตรียมคำสั่งตรวจสอบ: " . $conn->error);
        }
        $check_stmt->bind_param("s", $prov_id);
        $check_stmt->execute();
        $check_stmt->store_result();
        if ($check_stmt->num_rows == 0) {
            throw new Exception("Prov_id ไม่ถูกต้อง หรือไม่มีอยู่ใน provider");
        }
        $check_stmt->close();

        // อัพเดตข้อมูลการฝึกอบรม
        $sql = "UPDATE training_record SET Training_date=?, Training_time=? WHERE Training_id=?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("ข้อผิดพลาดในการเตรียมคำสั่งอัพเดต training_record: " . $conn->error);
        }
        $stmt->bind_param("sii", $training_date, $training_time, $training_id);
        $stmt->execute();
        $stmt->close();

        // ตรวจสอบเงื่อนไข training_time = 8
        if ($training_time == 8) {
            // อัพเดตตาราง provider
            $update_sql = "UPDATE provider SET prov_train = 1 WHERE Prov_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            if (!$update_stmt) {
                throw new Exception("ข้อผิดพลาดในการเตรียมคำสั่งอัพเดต provider: " . $conn->error);
            }
            $update_stmt->bind_param("s", $prov_id);
            $update_stmt->execute();
            $update_stmt->close();
        }

        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        die($e->getMessage());
    }

    header("Location: show_training_record.php");
    exit();
}

$training_id = $_GET['training_id'];
$sql = "SELECT * FROM training_record WHERE Training_id=?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("ข้อผิดพลาดในการเตรียมคำสั่งดึงข้อมูล: " . $conn->error);
}
$stmt->bind_param("i", $training_id);
$stmt->execute();
$result = $stmt->get_result();
$training = $result->fetch_assoc();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>แก้ไขข้อมูลการฝึกอบรม</title>
</head>

<body>
    <h2>แก้ไขข้อมูลการฝึกอบรม</h2>
    <form method="post">
        <input type="hidden" name="Training_id" value="<?php echo htmlspecialchars($training['Training_id']); ?>">
        รหัสผู้ให้บริการ: <span><?php echo htmlspecialchars($training['Prov_id']); ?></span>
        <input type="hidden" name="Prov_id" value="<?php echo htmlspecialchars($training['Prov_id']); ?>"><br>
        รหัสงาน: <span><?php echo htmlspecialchars($training['Ajob_id']); ?></span>
        <input type="hidden" name="Ajob_id" value="<?php echo htmlspecialchars($training['Ajob_id']); ?>"><br>
        วันที่ฝึกอบรม: <input type="date" name="Training_date"
            value="<?php echo htmlspecialchars($training['Training_date']); ?>"><br>
        เวลาฝึกอบรม: <input type="number" name="training_time"
            value="<?php echo htmlspecialchars($training['Training_time']); ?>"><br>
        <input type="submit" value="บันทึก">
    </form>
</body>

</html>
<?php
session_start(); // เริ่มต้นเซสชั่น
include ('../../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

if (isset($_GET['Training_id'])) {
    $training_id = $_GET['Training_id'];

    // ดึงข้อมูลการอบรมจากฐานข้อมูล
    $sql = "SELECT * FROM training_record WHERE Training_id='$training_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $training_date = $row['Training_date'];
        $training_time = $row['Training_time'];
        $prov_id = $row['Prov_id'];

        // ดึงค่าของ Pva_Time_to_train จากตาราง private_agency
        $sql_check = "SELECT Pva_Time_to_train FROM private_agency WHERE Pva_id=(SELECT Pva_id FROM training_record WHERE Training_id='$training_id')";
        $result_check = $conn->query($sql_check);
        if ($result_check->num_rows > 0) {
            $row_check = $result_check->fetch_assoc();
            $max_training_time = $row_check['Pva_Time_to_train'];
        } else {
            die("ไม่พบข้อมูล Pva_Time_to_train");
        }
    } else {
        die("ไม่พบข้อมูลการอบรม");
    }
} else {
    die("ไม่มีการกำหนด Training_id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesedit_training.css">
    <title>แก้ไขการอบรม</title>
</head>
<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
    </div>

    <div class="container">
        <button class="back-button" onclick="window.location.href='show_training_record.php'">⬅️</button>
        <h1>แก้ไขการอบรม</h1>
    
        <form method="post" action="../../process/save_training_record.php" onsubmit="return validateForm()">
            <input type="hidden" name="Training_id" value="<?php echo $training_id; ?>">
            <input type="hidden" name="Prov_id" value="<?php echo $prov_id; ?>">
            <label for="Training_date">แก้ไขวันที่อบรม:</label>
            <input type="date" name="Training_date" id="Training_date" value="<?php echo $training_date; ?>" required><br><br>
            <label for="Training_time">แก้ไขชั่วโมงอบรม:</label>
            <input type="number" name="Training_time" id="Training_time" value="<?php echo $training_time; ?>" max="<?php echo $max_training_time; ?>" required><br><br>
            <button type="submit">บันทึก</button>
        </form>
    </div>

    <script>
        var maxTrainingTime = <?php echo json_encode($max_training_time); ?>; // ดึงค่าจากฐานข้อมูล

        function validateForm() {
            var trainingTime = document.getElementById("Training_time").value;
            if (trainingTime > maxTrainingTime) {
                alert("ชั่วโมงการอบรมไม่สามารถเกิน " + maxTrainingTime + " ชั่วโมง");
                return false;
            }
            return true;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

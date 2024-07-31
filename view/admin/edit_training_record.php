<?php
session_start(); // เริ่มต้นเซสชั่น
include ('../../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $training_id = $_POST['Training_id'];
    $training_date = $_POST['Training_date'];
    $training_time = $_POST['Training_time'];
    $prov_id = $_POST['Prov_id']; // เพิ่ม Prov_id
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
    
    <form method="post" action="../../process/save_training_record.php">
        <input type="hidden" name="Training_id" value="<?php echo $training_id; ?>">
        <input type="hidden" name="Prov_id" value="<?php echo $prov_id; ?>"> <!-- เพิ่มฟิลด์นี้ -->
        <label for="Training_date">แก้ไขวันที่อบรม:</label>
        <input type="date" name="Training_date" id="Training_date" value="<?php echo $training_date; ?>"><br><br>
        <label for="Training_time">แก้ไขชั่วโมงอบรม:</label>
        <input type="number" name="Training_time" id="Training_time" value="<?php echo $training_time; ?>"><br><br>
        <button type="submit">บันทึก</button>
      
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>

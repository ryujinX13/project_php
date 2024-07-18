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
    <title>Edit Training Record</title>
</head>
<body>
    <h1>Edit Training Record</h1>
    <form method="post" action="../../process/save_training_record.php">
        <input type="hidden" name="Training_id" value="<?php echo $training_id; ?>">
        <input type="hidden" name="Prov_id" value="<?php echo $prov_id; ?>"> <!-- เพิ่มฟิลด์นี้ -->
        <label for="Training_date">Training Date:</label>
        <input type="date" name="Training_date" id="Training_date" value="<?php echo $training_date; ?>"><br><br>
        <label for="Training_time">Training Time:</label>
        <input type="number" name="Training_time" id="Training_time" value="<?php echo $training_time; ?>"><br><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>

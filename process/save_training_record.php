<?php
session_start(); // เริ่มต้นเซสชั่น
include ('../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $training_id = $_POST['Training_id'];
    $training_date = $_POST['Training_date'];
    $training_time = $_POST['Training_time'];
    $prov_id = $_POST['Prov_id'];

    // Update the training_record table
    $sql = "UPDATE training_record SET Training_date='$training_date', Training_time='$training_time' WHERE Training_id='$training_id'";

    if ($conn->query($sql) === TRUE) {
        // Check if Training_time is equal to Training_Time_to_train (assumed to be 8)
        $sql_check = "SELECT training_Time_to_train FROM training_record WHERE Training_id='$training_id'";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($training_time == $row['training_Time_to_train']) {
                // If Training_time is equal to Training_Time_to_train, update Prov_train in provider table
                $sql_prov = "UPDATE provider SET Prov_train=1 WHERE Prov_id='$prov_id'";
                if ($conn->query($sql_prov) !== TRUE) {
                    echo "Error updating provider record: " . $conn->error;
                }
            }
        }
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

    // Redirect back to the show_training_record.php page
    header("Location: ../view/admin/show_training_record.php");
    exit();
}
?>

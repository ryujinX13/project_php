<?php
session_start(); // เริ่มต้นเซสชั่น
include ('../../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM training_record";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Record</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Training Records</h1>
    <table>
        <thead>
            <tr>
                <th>Training ID</th>
                <th>Training Date</th>
                <th>Ajob ID</th>
                <th>Training Time</th>
                <th>Prov ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['Training_id']}</td>
                        <td>{$row['Training_date']}</td>
                        <td>{$row['Ajob_id']}</td>
                        <td>{$row['Training_time']}</td>
                        <td>{$row['Prov_id']}</td>
                        <td>
                            <form method='post' action='edit_training_record.php'>
                                <input type='hidden' name='Training_id' value='{$row['Training_id']}'>
                                <input type='hidden' name='Training_date' value='{$row['Training_date']}'>
                                <input type='hidden' name='Training_time' value='{$row['Training_time']}'>
                                <input type='hidden' name='Prov_id' value='{$row['Prov_id']}'> <!-- เพิ่มฟิลด์นี้ -->
                                <button type='submit'>Edit</button>
                            </form>
                        </td>
                    </tr>";
                }
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>

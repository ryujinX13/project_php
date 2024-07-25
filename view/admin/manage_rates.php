<?php
session_start();
include('../../connect/connection.php');

// ตรวจสอบว่าผู้ใช้ล็อคอินอยู่หรือไม่
if (!isset($_SESSION['username']))

// ตรวจสอบการเชื่อมต่อกับฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลจากตาราง rates
$sql = "SELECT * FROM rates";
$result = $conn->query($sql);

// อัพเดทข้อมูลเมื่อมีการส่งข้อมูลจากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $sarary = $_POST['sarary'];
    $time = $_POST['time'];
    $update_sql = "UPDATE rates SET Rates_name = '$name', Rates_sarary = '$sarary', Rates_time = '$time' WHERE Rates_id = '$id'";
    if ($conn->query($update_sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rates</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Manage Rates</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Sarary</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Rates_id'] . "</td>";
                        echo "<td>" . $row['Rates_name'] . "</td>";
                        echo "<td>" . $row['Rates_sarary'] . "</td>";
                        echo "<td>" . $row['Rates_time'] . "</td>";
                        echo "<td>
                                <form action='' method='POST'>
                                    <input type='hidden' name='id' value='" . $row['Rates_id'] . "'>
                                    <input type='text' name='name' value='" . $row['Rates_name'] . "' required>
                                    <input type='number' name='sarary' value='" . $row['Rates_sarary'] . "' required>
                                    <input type='text' name='time' value='" . $row['Rates_time'] . "' required>
                                    <button type='submit' class='btn btn-primary'>Update</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>

<?php
session_start();
include('../../connect/connection.php');

// ตรวจสอบว่าผู้ใช้ล็อคอินอยู่หรือไม่
if (!isset($_SESSION['username']))

// ตรวจสอบการเชื่อมต่อกับฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลจากตาราง travel_distance_cost
$sql = "SELECT * FROM travel_distance_cost";
$result = $conn->query($sql);

// อัพเดทข้อมูลเมื่อมีการส่งข้อมูลจากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $distance = $_POST['distance'];
    $excess = $_POST['excess'];
    $update_sql = "UPDATE travel_distance_cost SET Tracost_distance = '$distance', TraCost_excess = '$excess' WHERE TraCost_id = '$id'";
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
    <title>Manage Travel Cost</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesmanage_travel_cost.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Manage Travel Distance Cost</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Distance Cost</th>
                    <th>Excess Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['TraCost_id'] . "</td>";
                        echo "<td>" . $row['Tracost_distance'] . "</td>";
                        echo "<td>" . $row['TraCost_excess'] . "</td>";
                        echo "<td>
                                <form action='' method='POST'>
                                    <input type='hidden' name='id' value='" . $row['TraCost_id'] . "'>
                                    <input type='number' name='distance' value='" . $row['Tracost_distance'] . "' required>
                                    <input type='number' name='excess' value='" . $row['TraCost_excess'] . "' required>
                                    <button type='submit' class='btn btn-primary'>Update</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
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

<?php
session_start();
include ('../../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM job_announcement";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Announcements</title>
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesedit_announce.css">
</head>
<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="admin_dashboard.php" class="tab-link">หน้าแรก</a>
        <a href="prov_display.php" class="tab-link">ข้อมูลพนักงาน</a>
        <a href="booking_list.html" class="tab-link">การอบรม</a>
        <a href="history.html" class="tab-link">รายงาน</a>
        <a href="announce.php" class="tab-link">ประกาศรับสมัครงาน</a>
        <div class="dropdown">
            <button class="tab-button dropdown-toggle" type="button" id="dropdownMenuButton">
                <?php echo $_SESSION['admin_username']; ?>
            </button>
            <div class="dropdown-menu" id="dropdownMenu">
                <a class="dropdown-item" href="admin_account_details.php">รายละเอียดบัญชี</a>
                <a class="dropdown-item" href="../../process/logout.php">ล็อคเอ้าท์</a>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>ตารางประกาศรับสมัครงาน</h2>
        <table>
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>วันที่เปิดรับสมัคร</th>
                    <th>วันที่ปิดรับสมัคร</th>
                    <th>รายละเอียด</th>
                    <th>การกระทำ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['Ajob_id']; ?></td>
                            <td><?php echo $row['Ajob_opening']; ?></td>
                            <td><?php echo $row['Ajob_closing']; ?></td>
                            <td><?php echo $row['Ajob_details']; ?></td>
                            <td>
                                <a href="edit_single_announce.php?id=<?php echo $row['Ajob_id']; ?>">แก้ไข</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">ไม่มีข้อมูล</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>

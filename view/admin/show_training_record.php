<?php
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
<html>
<head>
    <title>แสดงข้อมูลการฝึกอบรม</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>ข้อมูลการฝึกอบรม</h2>
    <table>
        <tr>
            <th>รหัสการฝึกอบรม</th>
            <th>รหัสพนักงาน</th>
            <th>เลขที่ใบสมัคร</th>
            <th>รายละเอียดการฝึกอบรม</th>
            <th>การดำเนินการ</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['Training_id']); ?></td>
            <td><?php echo htmlspecialchars($row['Prov_id']); ?></td>
            <td><?php echo htmlspecialchars($row['Ajob_id']); ?></td>
            <td>
                วันที่: <?php echo htmlspecialchars($row['Training_date']); ?><br>
                เวลาฝึกอบรม: <?php echo htmlspecialchars($row['Training_time']); ?> ชั่วโมง
            </td>
            <td><a href="edit_training_record.php?training_id=<?php echo htmlspecialchars($row['Training_id']); ?>">แก้ไข</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>

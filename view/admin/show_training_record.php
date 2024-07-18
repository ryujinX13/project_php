<?php
session_start(); // เพิ่มการเริ่มต้นเซสชั่น
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
    <link rel="stylesheet" type="text/css" href="../../css/admin/styles_training.css">
</head>
<body>
<div class="tab-bar">
    <img src="../../img/logo1.png" alt="Logo">
    <a href="admin_dashboard.php" class="tab-link">หน้าแรก</a>
    <a href="prov_display.php" class="tab-link">ข้อมูลพนักงาน</a>
    <a href="show_training_record.php" class="tab-link">การอบรม</a>
    <a href="history.html" class="tab-link">รายงาน</a>
    <a href="edit_announce.php" class="tab-link">ประกาศรับสมัครงาน</a>
    <div class="dropdown">
        <button class="tab-button dropdown-toggle" type="button" id="dropdownMenuButton">
            <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
        </button>
        <div class="dropdown-menu" id="dropdownMenu" style="background-color: #f8f9fa; border-radius: 8px;">
            <a class="dropdown-item" href="account_details.php">
                <span style="margin-right: 8px;">🔍</span>รายละเอียดบัญชี
            </a>
            <a class="dropdown-item" href="../../process/logout.php">
                <span style="margin-right: 8px;">🔓</span>ออกจากระบบ
            </a>
        </div>
    </div>
</div>
<div class="container">
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
</div>
<script>
    document.getElementById('dropdownMenuButton').addEventListener('click', function () {
        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';

        // Check if the dropdown menu is out of the viewport
        const rect = dropdownMenu.getBoundingClientRect();
        const windowWidth = window.innerWidth;

        if (rect.right > windowWidth) {
            dropdownMenu.style.left = 'auto';
            dropdownMenu.style.right = '0';
        } else {
            dropdownMenu.style.left = '0';
            dropdownMenu.style.right = 'auto';
        }
    });

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.tab-button')) {
            var dropdowns = document.getElementsByClassName("dropdown-menu");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === 'block') {
                    openDropdown.style.display = 'none';
                }
            }
        }
    }
</script>
</body>
</html>

<?php
$conn->close();
?>
